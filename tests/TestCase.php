<?php

namespace Tests;

use BookStack\Entities\Models\Entity;
use BookStack\Http\HttpClientHistory;
use BookStack\Http\HttpRequestService;
use BookStack\Settings\SettingService;
use BookStack\Users\Models\User;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Testing\Assert as PHPUnit;
use Monolog\Handler\TestHandler;
use Monolog\Logger;
use Ssddanbrown\AssertHtml\TestsHtml;
use Tests\Helpers\EntityProvider;
use Tests\Helpers\FileProvider;
use Tests\Helpers\PermissionsProvider;
use Tests\Helpers\TestServiceProvider;
use Tests\Helpers\UserRoleProvider;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use DatabaseTransactions;
    use TestsHtml;

    protected EntityProvider $entities;
    protected UserRoleProvider $users;
    protected PermissionsProvider $permissions;
    protected FileProvider $files;

    protected function setUp(): void
    {
        $this->entities = new EntityProvider();
        $this->users = new UserRoleProvider();
        $this->permissions = new PermissionsProvider($this->users);
        $this->files = new FileProvider();

        parent::setUp();

        // We can uncomment the below to run tests with failings upon deprecations.
        // Can't leave on since some deprecations can only be fixed upstream.
         // $this->withoutDeprecationHandling();
    }

    /**
     * The base URL to use while testing the application.
     */
    protected string $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        /** @var \Illuminate\Foundation\Application  $app */
        $app = require __DIR__ . '/../bootstrap/app.php';
        $app->register(TestServiceProvider::class);
        $app->make(Kernel::class)->bootstrap();

        return $app;
    }

    /**
     * Set the current user context to be an admin.
     */
    public function asAdmin()
    {
        return $this->actingAs($this->users->admin());
    }

    /**
     * Set the current user context to be an editor.
     */
    public function asEditor()
    {
        return $this->actingAs($this->users->editor());
    }

    /**
     * Set the current user context to be a viewer.
     */
    public function asViewer()
    {
        return $this->actingAs($this->users->viewer());
    }

    /**
     * Quickly sets an array of settings.
     */
    protected function setSettings(array $settingsArray): void
    {
        $settings = app(SettingService::class);
        foreach ($settingsArray as $key => $value) {
            $settings->put($key, $value);
        }
    }

    /**
     * Mock the http client used in BookStack http calls.
     */
    protected function mockHttpClient(array $responses = []): HttpClientHistory
    {
        return $this->app->make(HttpRequestService::class)->mockClient($responses);
    }

    /**
     * Run a set test with the given env variable.
     * Remembers the original and resets the value after test.
     * Database config is juggled so the value can be restored when
     * parallel testing are used, where multiple databases exist.
     */
    protected function runWithEnv(array $valuesByKey, callable $callback, bool $handleDatabase = true): void
    {
        Env::disablePutenv();
        $originals = [];
        foreach ($valuesByKey as $key => $value) {
            $originals[$key] = $_SERVER[$key] ?? null;

            if (is_null($value)) {
                unset($_SERVER[$key]);
            } else {
                $_SERVER[$key] = $value;
            }
        }

        $database = config('database.connections.mysql_testing.database');
        $this->refreshApplication();

        if ($handleDatabase) {
            DB::purge();
            config()->set('database.connections.mysql_testing.database', $database);
            DB::beginTransaction();
        }

        $callback();

        if ($handleDatabase) {
            DB::rollBack();
        }

        foreach ($originals as $key => $value) {
            if (is_null($value)) {
                unset($_SERVER[$key]);
            } else {
                $_SERVER[$key] = $value;
            }
        }
    }

    /**
     * Check the keys and properties in the given map to include
     * exist, albeit not exclusively, within the map to check.
     */
    protected function assertArrayMapIncludes(array $mapToInclude, array $mapToCheck, string $message = ''): void
    {
        $passed = true;

        foreach ($mapToInclude as $key => $value) {
            if (!isset($mapToCheck[$key]) || $mapToCheck[$key] !== $mapToInclude[$key]) {
                $passed = false;
            }
        }

        $toIncludeStr = print_r($mapToInclude, true);
        $toCheckStr = print_r($mapToCheck, true);
        self::assertThat($passed, self::isTrue(), "Failed asserting that given map:\n\n{$toCheckStr}\n\nincludes:\n\n{$toIncludeStr}");
    }

    /**
     * Assert a permission error has occurred.
     */
    protected function assertPermissionError($response)
    {
        PHPUnit::assertTrue($this->isPermissionError($response->baseResponse ?? $response->response), 'Failed asserting the response contains a permission error.');
    }

    /**
     * Assert a permission error has occurred.
     */
    protected function assertNotPermissionError($response)
    {
        PHPUnit::assertFalse($this->isPermissionError($response->baseResponse ?? $response->response), 'Failed asserting the response does not contain a permission error.');
    }

    /**
     * Check if the given response is a permission error.
     */
    private function isPermissionError($response): bool
    {
        if ($response->status() === 403 && $response instanceof JsonResponse) {
            $errMessage = $response->getData(true)['error']['message'] ?? '';
            return $errMessage === 'You do not have permission to perform the requested action.';
        }

        return $response->status() === 302
            && $response->headers->get('Location') === url('/')
            && str_starts_with(session()->pull('error', ''), 'You do not have permission to access');
    }

    /**
     * Assert that the session has a particular error notification message set.
     */
    protected function assertSessionError(string $message)
    {
        $error = session()->get('error');
        PHPUnit::assertTrue($error === $message, "Failed asserting the session contains an error. \nFound: {$error}\nExpecting: {$message}");
    }

    /**
     * Assert the session contains a specific entry.
     */
    protected function assertSessionHas(string $key): self
    {
        $this->assertTrue(session()->has($key), "Session does not contain a [{$key}] entry");

        return $this;
    }

    protected function assertNotificationContains(\Illuminate\Testing\TestResponse $resp, string $text)
    {
        return $this->withHtml($resp)->assertElementContains('.notification[role="alert"]', $text);
    }

    /**
     * Set a test handler as the logging interface for the application.
     * Allows capture of logs for checking against during tests.
     */
    protected function withTestLogger(): TestHandler
    {
        $monolog = new Logger('testing');
        $testHandler = new TestHandler();
        $monolog->pushHandler($testHandler);

        Log::extend('testing', function () use ($monolog) {
            return $monolog;
        });
        Log::setDefaultDriver('testing');

        return $testHandler;
    }

    /**
     * Assert that an activity entry exists of the given key.
     * Checks the activity belongs to the given entity if provided.
     */
    protected function assertActivityExists(string $type, ?Entity $entity = null, string $detail = '')
    {
        $detailsToCheck = ['type' => $type];

        if ($entity) {
            $detailsToCheck['loggable_type'] = $entity->getMorphClass();
            $detailsToCheck['loggable_id'] = $entity->id;
        }

        if ($detail) {
            $detailsToCheck['detail'] = $detail;
        }

        $this->assertDatabaseHas('activities', $detailsToCheck);
    }
}
