<?php

namespace Tests;

use BookStack\Activity\ActivityType;
use BookStack\Activity\DispatchWebhookJob;
use BookStack\Activity\Models\Webhook;
use BookStack\Entities\Models\Book;
use BookStack\Entities\Models\Page;
use BookStack\Entities\Tools\PageContent;
use BookStack\Exceptions\ThemeException;
use BookStack\Facades\Theme;
use BookStack\Theming\ThemeEvents;
use BookStack\Users\Models\User;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use League\CommonMark\Environment\Environment;

class ThemeTest extends TestCase
{
    protected string $themeFolderName;
    protected string $themeFolderPath;

    public function test_translation_text_can_be_overridden_via_theme()
    {
        $this->usingThemeFolder(function () {
            $translationPath = theme_path('/lang/en');
            File::makeDirectory($translationPath, 0777, true);

            $customTranslations = '<?php
            return [\'books\' => \'Sandwiches\'];
        ';
            file_put_contents($translationPath . '/entities.php', $customTranslations);

            $homeRequest = $this->actingAs($this->users->viewer())->get('/');
            $this->withHtml($homeRequest)->assertElementContains('header nav', 'Sandwiches');
        });
    }

    public function test_theme_functions_file_used_and_app_boot_event_runs()
    {
        $this->usingThemeFolder(function ($themeFolder) {
            $functionsFile = theme_path('functions.php');
            app()->alias('cat', 'dog');
            file_put_contents($functionsFile, "<?php\nTheme::listen(\BookStack\Theming\ThemeEvents::APP_BOOT, function(\$app) { \$app->alias('cat', 'dog');});");
            $this->runWithEnv(['APP_THEME' => $themeFolder], function () {
                $this->assertEquals('cat', $this->app->getAlias('dog'));
            });
        });
    }

    public function test_theme_functions_loads_errors_are_caught_and_logged()
    {
        $this->usingThemeFolder(function ($themeFolder) {
            $functionsFile = theme_path('functions.php');
            file_put_contents($functionsFile, "<?php\n\\BookStack\\Biscuits::eat();");

            $this->expectException(ThemeException::class);
            $this->expectExceptionMessageMatches('/Failed loading theme functions file at ".*?" with error: Class "BookStack\\\\Biscuits" not found/');

            $this->runWithEnv(['APP_THEME' => $themeFolder], fn() => null);
        });
    }

    public function test_event_commonmark_environment_configure()
    {
        $callbackCalled = false;
        $callback = function ($environment) use (&$callbackCalled) {
            $this->assertInstanceOf(Environment::class, $environment);
            $callbackCalled = true;

            return $environment;
        };
        Theme::listen(ThemeEvents::COMMONMARK_ENVIRONMENT_CONFIGURE, $callback);

        $page = $this->entities->page();
        $content = new PageContent($page);
        $content->setNewMarkdown('# test', $this->users->editor());

        $this->assertTrue($callbackCalled);
    }

    public function test_event_web_middleware_before()
    {
        $callbackCalled = false;
        $requestParam = null;
        $callback = function ($request) use (&$callbackCalled, &$requestParam) {
            $requestParam = $request;
            $callbackCalled = true;
        };

        Theme::listen(ThemeEvents::WEB_MIDDLEWARE_BEFORE, $callback);
        $this->get('/login', ['Donkey' => 'cat']);

        $this->assertTrue($callbackCalled);
        $this->assertInstanceOf(Request::class, $requestParam);
        $this->assertEquals('cat', $requestParam->header('donkey'));
    }

    public function test_event_web_middleware_before_return_val_used_as_response()
    {
        $callback = function (Request $request) {
            return response('cat', 412);
        };

        Theme::listen(ThemeEvents::WEB_MIDDLEWARE_BEFORE, $callback);
        $resp = $this->get('/login', ['Donkey' => 'cat']);
        $resp->assertSee('cat');
        $resp->assertStatus(412);
    }

    public function test_event_web_middleware_after()
    {
        $callbackCalled = false;
        $requestParam = null;
        $responseParam = null;
        $callback = function ($request, Response $response) use (&$callbackCalled, &$requestParam, &$responseParam) {
            $requestParam = $request;
            $responseParam = $response;
            $callbackCalled = true;
            $response->header('donkey', 'cat123');
        };

        Theme::listen(ThemeEvents::WEB_MIDDLEWARE_AFTER, $callback);

        $resp = $this->get('/login', ['Donkey' => 'cat']);
        $this->assertTrue($callbackCalled);
        $this->assertInstanceOf(Request::class, $requestParam);
        $this->assertInstanceOf(Response::class, $responseParam);
        $resp->assertHeader('donkey', 'cat123');
    }

    public function test_event_web_middleware_after_return_val_used_as_response()
    {
        $callback = function () {
            return response('cat456', 443);
        };

        Theme::listen(ThemeEvents::WEB_MIDDLEWARE_AFTER, $callback);

        $resp = $this->get('/login', ['Donkey' => 'cat']);
        $resp->assertSee('cat456');
        $resp->assertStatus(443);
    }

    public function test_event_auth_login_standard()
    {
        $args = [];
        $callback = function (...$eventArgs) use (&$args) {
            $args = $eventArgs;
        };

        Theme::listen(ThemeEvents::AUTH_LOGIN, $callback);
        $this->post('/login', ['email' => 'admin@admin.com', 'password' => 'password']);

        $this->assertCount(2, $args);
        $this->assertEquals('standard', $args[0]);
        $this->assertInstanceOf(User::class, $args[1]);
    }

    public function test_event_auth_register_standard()
    {
        $args = [];
        $callback = function (...$eventArgs) use (&$args) {
            $args = $eventArgs;
        };
        Theme::listen(ThemeEvents::AUTH_REGISTER, $callback);
        $this->setSettings(['registration-enabled' => 'true']);

        $user = User::factory()->make();
        $this->post('/register', ['email' => $user->email, 'name' => $user->name, 'password' => 'password']);

        $this->assertCount(2, $args);
        $this->assertEquals('standard', $args[0]);
        $this->assertInstanceOf(User::class, $args[1]);
    }

    public function test_event_auth_pre_register()
    {
        $args = [];
        $callback = function (...$eventArgs) use (&$args) {
            $args = $eventArgs;
        };
        Theme::listen(ThemeEvents::AUTH_PRE_REGISTER, $callback);
        $this->setSettings(['registration-enabled' => 'true']);

        $user = User::factory()->make();
        $this->post('/register', ['email' => $user->email, 'name' => $user->name, 'password' => 'password']);

        $this->assertCount(2, $args);
        $this->assertEquals('standard', $args[0]);
        $this->assertEquals([
            'email' => $user->email,
            'name' => $user->name,
            'password' => 'password',
        ], $args[1]);
        $this->assertDatabaseHas('users', ['email' => $user->email]);
    }

    public function test_event_auth_pre_register_with_false_return_blocks_registration()
    {
        $callback = function () {
            return false;
        };
        Theme::listen(ThemeEvents::AUTH_PRE_REGISTER, $callback);
        $this->setSettings(['registration-enabled' => 'true']);

        $user = User::factory()->make();
        $resp = $this->post('/register', ['email' => $user->email, 'name' => $user->name, 'password' => 'password']);
        $resp->assertRedirect('/login');
        $this->assertSessionError('User account could not be registered for the provided details');
        $this->assertDatabaseMissing('users', ['email' => $user->email]);
    }

    public function test_event_webhook_call_before()
    {
        $args = [];
        $callback = function (...$eventArgs) use (&$args) {
            $args = $eventArgs;

            return ['test' => 'hello!'];
        };
        Theme::listen(ThemeEvents::WEBHOOK_CALL_BEFORE, $callback);

        $responses = $this->mockHttpClient([new \GuzzleHttp\Psr7\Response(200, [], '')]);

        $webhook = new Webhook(['name' => 'Test webhook', 'endpoint' => 'https://example.com']);
        $webhook->save();
        $event = ActivityType::PAGE_UPDATE;
        $detail = Page::query()->first();

        dispatch((new DispatchWebhookJob($webhook, $event, $detail)));

        $this->assertCount(5, $args);
        $this->assertEquals($event, $args[0]);
        $this->assertEquals($webhook->id, $args[1]->id);
        $this->assertEquals($detail->id, $args[2]->id);

        $this->assertEquals(1, $responses->requestCount());
        $request = $responses->latestRequest();
        $reqData = json_decode($request->getBody(), true);
        $this->assertEquals('hello!', $reqData['test']);
    }

    public function test_event_activity_logged()
    {
        $book = $this->entities->book();
        $args = [];
        $callback = function (...$eventArgs) use (&$args) {
            $args = $eventArgs;
        };

        Theme::listen(ThemeEvents::ACTIVITY_LOGGED, $callback);
        $this->asEditor()->put($book->getUrl(), ['name' => 'My cool update book!']);

        $this->assertCount(2, $args);
        $this->assertEquals(ActivityType::BOOK_UPDATE, $args[0]);
        $this->assertTrue($args[1] instanceof Book);
        $this->assertEquals($book->id, $args[1]->id);
    }

    public function test_event_page_include_parse()
    {
        /** @var Page $page */
        /** @var Page $otherPage */
        $page = $this->entities->page();
        $otherPage = Page::query()->where('id', '!=', $page->id)->first();
        $otherPage->html = '<p id="bkmrk-cool">This is a really cool section</p>';
        $page->html = "<p>{{@{$otherPage->id}#bkmrk-cool}}</p>";
        $page->save();
        $otherPage->save();

        $args = [];
        $callback = function (...$eventArgs) use (&$args) {
            $args = $eventArgs;

            return '<strong>Big &amp; content replace surprise!</strong>';
        };

        Theme::listen(ThemeEvents::PAGE_INCLUDE_PARSE, $callback);
        $resp = $this->asEditor()->get($page->getUrl());
        $this->withHtml($resp)->assertElementContains('.page-content strong', 'Big & content replace surprise!');

        $this->assertCount(4, $args);
        $this->assertEquals($otherPage->id . '#bkmrk-cool', $args[0]);
        $this->assertEquals('This is a really cool section', $args[1]);
        $this->assertTrue($args[2] instanceof Page);
        $this->assertTrue($args[3] instanceof Page);
        $this->assertEquals($page->id, $args[2]->id);
        $this->assertEquals($otherPage->id, $args[3]->id);
    }

    public function test_event_routes_register_web_and_web_auth()
    {
        $functionsContent = <<<'END'
<?php
use BookStack\Theming\ThemeEvents;
use BookStack\Facades\Theme;
use Illuminate\Routing\Router;
Theme::listen(ThemeEvents::ROUTES_REGISTER_WEB, function (Router $router) {
    $router->get('/cat', fn () => 'cat')->name('say.cat');
});
Theme::listen(ThemeEvents::ROUTES_REGISTER_WEB_AUTH, function (Router $router) {
    $router->get('/dog', fn () => 'dog')->name('say.dog');
});
END;

        $this->usingThemeFolder(function () use ($functionsContent) {

            $functionsFile = theme_path('functions.php');
            file_put_contents($functionsFile, $functionsContent);

            $app = $this->createApplication();
            /** @var \Illuminate\Routing\Router $router */
            $router = $app->get('router');

            /** @var \Illuminate\Routing\Route $catRoute */
            $catRoute = $router->getRoutes()->getRoutesByName()['say.cat'];
            $this->assertEquals(['web'], $catRoute->middleware());

            /** @var \Illuminate\Routing\Route $dogRoute */
            $dogRoute = $router->getRoutes()->getRoutesByName()['say.dog'];
            $this->assertEquals(['web', 'auth'], $dogRoute->middleware());
        });
    }

    public function test_add_social_driver()
    {
        Theme::addSocialDriver('catnet', [
            'client_id'     => 'abc123',
            'client_secret' => 'def456',
        ], 'SocialiteProviders\Discord\DiscordExtendSocialite@handleTesting');

        $this->assertEquals('catnet', config('services.catnet.name'));
        $this->assertEquals('abc123', config('services.catnet.client_id'));
        $this->assertEquals(url('/login/service/catnet/callback'), config('services.catnet.redirect'));

        $loginResp = $this->get('/login');
        $loginResp->assertSee('login/service/catnet');
    }

    public function test_add_social_driver_uses_name_in_config_if_given()
    {
        Theme::addSocialDriver('catnet', [
            'client_id'     => 'abc123',
            'client_secret' => 'def456',
            'name'          => 'Super Cat Name',
        ], 'SocialiteProviders\Discord\DiscordExtendSocialite@handleTesting');

        $this->assertEquals('Super Cat Name', config('services.catnet.name'));
        $loginResp = $this->get('/login');
        $loginResp->assertSee('Super Cat Name');
    }

    public function test_add_social_driver_allows_a_configure_for_redirect_callback_to_be_passed()
    {
        Theme::addSocialDriver(
            'discord',
            [
                'client_id'     => 'abc123',
                'client_secret' => 'def456',
                'name'          => 'Super Cat Name',
            ],
            'SocialiteProviders\Discord\DiscordExtendSocialite@handle',
            function ($driver) {
                $driver->with(['donkey' => 'donut']);
            }
        );

        $loginResp = $this->get('/login/service/discord');
        $redirect = $loginResp->headers->get('location');
        $this->assertStringContainsString('donkey=donut', $redirect);
    }

    public function test_register_command_allows_provided_command_to_be_usable_via_artisan()
    {
        Theme::registerCommand(new MyCustomCommand());

        Artisan::call('bookstack:test-custom-command', []);
        $output = Artisan::output();

        $this->assertStringContainsString('Command ran!', $output);
    }

    public function test_base_body_start_and_end_template_files_can_be_used()
    {
        $bodyStartStr = 'barry-fought-against-the-panther';
        $bodyEndStr = 'barry-lost-his-fight-with-grace';

        $this->usingThemeFolder(function (string $folder) use ($bodyStartStr, $bodyEndStr) {
            $viewDir = theme_path('layouts/parts');
            mkdir($viewDir, 0777, true);
            file_put_contents($viewDir . '/base-body-start.blade.php', $bodyStartStr);
            file_put_contents($viewDir . '/base-body-end.blade.php', $bodyEndStr);

            $resp = $this->asEditor()->get('/');
            $resp->assertSee($bodyStartStr);
            $resp->assertSee($bodyEndStr);
        });
    }

    public function test_export_body_start_and_end_template_files_can_be_used()
    {
        $bodyStartStr = 'garry-fought-against-the-panther';
        $bodyEndStr = 'garry-lost-his-fight-with-grace';
        $page = $this->entities->page();

        $this->usingThemeFolder(function (string $folder) use ($bodyStartStr, $bodyEndStr, $page) {
            $viewDir = theme_path('layouts/parts');
            mkdir($viewDir, 0777, true);
            file_put_contents($viewDir . '/export-body-start.blade.php', $bodyStartStr);
            file_put_contents($viewDir . '/export-body-end.blade.php', $bodyEndStr);

            $resp = $this->asEditor()->get($page->getUrl('/export/html'));
            $resp->assertSee($bodyStartStr);
            $resp->assertSee($bodyEndStr);
        });
    }

    public function test_login_and_register_message_template_files_can_be_used()
    {
        $loginMessage = 'Welcome to this instance, login below you scallywag';
        $registerMessage = 'You want to register? Enter the deets below you numpty';

        $this->usingThemeFolder(function (string $folder) use ($loginMessage, $registerMessage) {
            $viewDir = theme_path('auth/parts');
            mkdir($viewDir, 0777, true);
            file_put_contents($viewDir . '/login-message.blade.php', $loginMessage);
            file_put_contents($viewDir . '/register-message.blade.php', $registerMessage);
            $this->setSettings(['registration-enabled' => 'true']);

            $this->get('/login')->assertSee($loginMessage);
            $this->get('/register')->assertSee($registerMessage);
        });
    }

    public function test_header_links_start_template_file_can_be_used()
    {
        $content = 'This is added text in the header bar';

        $this->usingThemeFolder(function (string $folder) use ($content) {
            $viewDir = theme_path('layouts/parts');
            mkdir($viewDir, 0777, true);
            file_put_contents($viewDir . '/header-links-start.blade.php', $content);
            $this->setSettings(['registration-enabled' => 'true']);

            $this->get('/login')->assertSee($content);
        });
    }

    public function test_custom_settings_category_page_can_be_added_via_view_file()
    {
        $content = 'My SuperCustomSettings';

        $this->usingThemeFolder(function (string $folder) use ($content) {
            $viewDir = theme_path('settings/categories');
            mkdir($viewDir, 0777, true);
            file_put_contents($viewDir . '/beans.blade.php', $content);

            $this->asAdmin()->get('/settings/beans')->assertSee($content);
        });
    }

    public function test_public_folder_contents_accessible_via_route()
    {
        $this->usingThemeFolder(function (string $themeFolderName) {
            $publicDir = theme_path('public');
            mkdir($publicDir, 0777, true);

            $text = 'some-text ' . md5(random_bytes(5));
            $css = "body { background-color: tomato !important; }";
            file_put_contents("{$publicDir}/file.txt", $text);
            file_put_contents("{$publicDir}/file.css", $css);
            copy($this->files->testFilePath('test-image.png'), "{$publicDir}/image.png");

            $resp = $this->asAdmin()->get("/theme/{$themeFolderName}/file.txt");
            $resp->assertStreamedContent($text);
            $resp->assertHeader('Content-Type', 'text/plain; charset=UTF-8');
            $resp->assertHeader('Cache-Control', 'max-age=86400, private');

            $resp = $this->asAdmin()->get("/theme/{$themeFolderName}/image.png");
            $resp->assertHeader('Content-Type', 'image/png');
            $resp->assertHeader('Cache-Control', 'max-age=86400, private');

            $resp = $this->asAdmin()->get("/theme/{$themeFolderName}/file.css");
            $resp->assertStreamedContent($css);
            $resp->assertHeader('Content-Type', 'text/css; charset=UTF-8');
            $resp->assertHeader('Cache-Control', 'max-age=86400, private');
        });
    }

    protected function usingThemeFolder(callable $callback)
    {
        // Create a folder and configure a theme
        $themeFolderName = 'testing_theme_' . str_shuffle(rtrim(base64_encode(time()), '='));
        config()->set('view.theme', $themeFolderName);
        $themeFolderPath = theme_path('');

        // Create theme folder and clean it up on application tear-down
        File::makeDirectory($themeFolderPath);
        $this->beforeApplicationDestroyed(fn() => File::deleteDirectory($themeFolderPath));

        // Run provided callback with theme env option set
        $this->runWithEnv(['APP_THEME' => $themeFolderName], function () use ($callback, $themeFolderName) {
            call_user_func($callback, $themeFolderName);
        });
    }
}

class MyCustomCommand extends Command
{
    protected $signature = 'bookstack:test-custom-command';

    public function handle()
    {
        $this->line('Command ran!');
    }
}
