<?php
/**
 * Text used for 'Entities' (Document Structure Elements) such as
 * Books, Shelves, Chapters & Pages
 */
return [

    // Shared
    'recently_created' => '最近作成',
    'recently_created_pages' => '最近作成されたページ',
    'recently_updated_pages' => '最近更新されたページ',
    'recently_created_chapters' => '最近作成されたチャプター',
    'recently_created_books' => '最近作成されたブック',
    'recently_created_shelves' => '最近作成された本棚',
    'recently_update' => '最近更新',
    'recently_viewed' => '閲覧履歴',
    'recent_activity' => 'アクティビティ',
    'create_now' => '作成する',
    'revisions' => '編集履歴',
    'meta_revision' => 'リビジョン #:revisionCount',
    'meta_created' => '作成: :timeLength',
    'meta_created_name' => '作成: :timeLength (:user)',
    'meta_updated' => '更新: :timeLength',
    'meta_updated_name' => '更新: :timeLength (:user)',
    'meta_owned_name' => '所有者: :user',
    'meta_reference_count' => ':count 項目から参照|:count 項目から参照',
    'entity_select' => 'エンティティ選択',
    'entity_select_lack_permission' => 'この項目を選択するために必要な権限がありません',
    'images' => '画像',
    'my_recent_drafts' => '最近の下書き',
    'my_recently_viewed' => '閲覧履歴',
    'my_most_viewed_favourites' => '最も閲覧したお気に入り',
    'my_favourites' => 'お気に入り',
    'no_pages_viewed' => 'なにもページを閲覧していません',
    'no_pages_recently_created' => '最近作成されたページはありません',
    'no_pages_recently_updated' => '最近更新されたページはありません。',
    'export' => 'エクスポート',
    'export_html' => 'Webページ',
    'export_pdf' => 'PDF',
    'export_text' => 'テキストファイル',
    'export_md' => 'Markdown',
    'export_zip' => 'ポータブルZIP',
    'default_template' => 'デフォルトページテンプレート',
    'default_template_explain' => 'このアイテム内に新しいページを作成する際にデフォルトコンテンツとして使用されるページテンプレートを割り当てます。これはページ作成者が選択したテンプレートページへのアクセス権を持つ場合にのみ使用されることに注意してください。',
    'default_template_select' => 'テンプレートページを選択',
    'import' => 'インポート',
    'import_validate' => 'インポートの検証',
    'import_desc' => 'ポータブルzipエクスポートファイルを使用して、同一または別のインスタンスからブック、チャプタ、ページをインポートします。続行するにはZIPファイルを選択します。 ファイルをアップロードすると検証が行われ、次のビューでインポートの設定と確認ができます。',
    'import_zip_select' => 'アップロードするZIPファイルの選択',
    'import_zip_validation_errors' => '指定された ZIP ファイルの検証中にエラーが検出されました:',
    'import_pending' => '保留中のインポート',
    'import_pending_none' => 'インポートは行われていません。',
    'import_continue' => 'インポートを続行',
    'import_continue_desc' => 'アップロードされたZIPファイルからインポートされるコンテンツを確認してください。準備ができたらインポートを実行してこのシステムにコンテンツを追加します。 アップロードされたZIPファイルは、インポートが成功すると自動的に削除されます。',
    'import_details' => 'インポートの詳細',
    'import_run' => 'インポートを実行',
    'import_size' => 'インポートZIPサイズ: :size',
    'import_uploaded_at' => 'アップロード: :relativeTime',
    'import_uploaded_by' => 'アップロードユーザ:',
    'import_location' => 'インポートの場所',
    'import_location_desc' => 'コンテンツをインポートする場所を選択します。選択した場所に作成するための権限を持つ必要があります。',
    'import_delete_confirm' => 'このインポートを削除してもよろしいですか？',
    'import_delete_desc' => 'アップロードされたインポートZIPファイルは削除され、元に戻すことはできません。',
    'import_errors' => 'インポートエラー',
    'import_errors_desc' => 'インポート中に次のエラーが発生しました：',

    // Permissions and restrictions
    'permissions' => '権限',
    'permissions_desc' => 'ユーザーの役割によって提供されるデフォルトの権限を上書きするため、ここで権限を設定します。',
    'permissions_book_cascade' => 'ブックに設定された権限は、子チャプターや子ページに独自の権限が定義されていない限り、自動的に子チャプターや子ページに継承されます。',
    'permissions_chapter_cascade' => 'チャプターに設定された権限は、子ページに独自の権限が定義されていない限り、自動的に子ページに継承されます。',
    'permissions_save' => '権限を保存',
    'permissions_owner' => '所有者',
    'permissions_role_everyone_else' => 'その他の全員',
    'permissions_role_everyone_else_desc' => '明示的に上書きされていないすべての役割の権限を設定します。',
    'permissions_role_override' => '権限を上書きする役割',
    'permissions_inherit_defaults' => 'デフォルトを継承',

    // Search
    'search_results' => '検索結果',
    'search_total_results_found' => ':count件見つかりました',
    'search_clear' => '検索をクリア',
    'search_no_pages' => 'ページが見つかりませんでした。',
    'search_for_term' => ':term の検索結果',
    'search_more' => 'さらに表示',
    'search_advanced' => '高度な検索',
    'search_terms' => '検索語句',
    'search_content_type' => '種類',
    'search_exact_matches' => '完全一致',
    'search_tags' => 'タグ検索',
    'search_options' => 'オプション',
    'search_viewed_by_me' => '自分が閲覧したことがある',
    'search_not_viewed_by_me' => '自分が閲覧したことがない',
    'search_permissions_set' => '権限が設定されている',
    'search_created_by_me' => '自分が作成した',
    'search_updated_by_me' => '自分が更新した',
    'search_owned_by_me' => '自分が所有している',
    'search_date_options' => '日付オプション',
    'search_updated_before' => '以前に更新',
    'search_updated_after' => '以降に更新',
    'search_created_before' => '以前に作成',
    'search_created_after' => '以降に更新',
    'search_set_date' => '日付を設定',
    'search_update' => 'フィルタを更新',

    // Shelves
    'shelf' => '本棚',
    'shelves' => '本棚',
    'x_shelves' => ':count 本棚|:count 本棚',
    'shelves_empty' => '本棚が作成されていません',
    'shelves_create' => '新しい本棚を作成',
    'shelves_popular' => '人気の本棚',
    'shelves_new' => '新しい本棚',
    'shelves_new_action' => '新しい本棚',
    'shelves_popular_empty' => 'ここに人気の本棚が表示されます。',
    'shelves_new_empty' => '最近作成された本棚がここに表示されます。',
    'shelves_save' => '本棚を保存',
    'shelves_books' => 'この本棚のブック',
    'shelves_add_books' => 'この本棚にブックを追加',
    'shelves_drag_books' => '下にブックをドラッグしてこの本棚に追加',
    'shelves_empty_contents' => 'この本棚にはブックが割り当てられていません。',
    'shelves_edit_and_assign' => '本棚を編集してブックを割り当てる',
    'shelves_edit_named' => '本棚「:name」を編集',
    'shelves_edit' => '本棚を編集',
    'shelves_delete' => '本棚を削除',
    'shelves_delete_named' => '本棚「:name」を削除',
    'shelves_delete_explain' => "これにより、この本棚「:name」が削除されます。含まれているブックは削除されません。",
    'shelves_delete_confirmation' => '本当にこの本棚を削除してよろしいですか？',
    'shelves_permissions' => '本棚の権限',
    'shelves_permissions_updated' => '本棚の権限を更新しました',
    'shelves_permissions_active' => '本棚の権限は有効です',
    'shelves_permissions_cascade_warning' => '本棚の権限は含まれる本には自動的に継承されません。これは、1つのブックが複数の本棚に存在する可能性があるためです。ただし、以下のオプションを使用すると権限を子ブックにコピーできます。',
    'shelves_permissions_create' => '本棚の作成権限は、以下のアクションを使用した子ブックへの権限コピーにのみ使用されます。これはブックの作成を制御するものではありません。',
    'shelves_copy_permissions_to_books' => 'ブックに権限をコピー',
    'shelves_copy_permissions' => '権限をコピー',
    'shelves_copy_permissions_explain' => 'これにより、この本棚の現在の権限設定を本棚に含まれるすべてのブックに適用します。有効にする前に、この本棚の権限への変更が保存されていることを確認してください。',
    'shelves_copy_permission_success' => '本棚の権限が:count個のブックにコピーされました',

    // Books
    'book' => 'ブック',
    'books' => 'ブック',
    'x_books' => ':count ブック',
    'books_empty' => 'まだブックは作成されていません',
    'books_popular' => '人気のブック',
    'books_recent' => '最近のブック',
    'books_new' => '新しいブック',
    'books_new_action' => '新しいブック',
    'books_popular_empty' => 'ここに人気のブックが表示されます。',
    'books_new_empty' => '最近作成されたブックがここに表示されます。',
    'books_create' => '新しいブックを作成',
    'books_delete' => 'ブックを削除',
    'books_delete_named' => 'ブック「:bookName」を削除',
    'books_delete_explain' => '「:bookName」を削除すると、ブック内のページとチャプターも削除されます。',
    'books_delete_confirmation' => '本当にこのブックを削除してよろしいですか？',
    'books_edit' => 'ブックを編集',
    'books_edit_named' => 'ブック「:bookName」を編集',
    'books_form_book_name' => 'ブック名',
    'books_save' => 'ブックを保存',
    'books_permissions' => 'ブックの権限',
    'books_permissions_updated' => 'ブックの権限を更新しました',
    'books_empty_contents' => 'まだページまたはチャプターが作成されていません。',
    'books_empty_create_page' => '新しいページを作成',
    'books_empty_sort_current_book' => 'ブックの並び順を変更',
    'books_empty_add_chapter' => 'チャプターを追加',
    'books_permissions_active' => 'ブックの権限は有効です',
    'books_search_this' => 'このブックから検索',
    'books_navigation' => '目次',
    'books_sort' => '並び順を変更',
    'books_sort_desc' => 'ブック内のチャプタおよびページを移動して内容を再編成できます。他のブックを並べて、ブック間でチャプタやページを簡単に移動することもできます。オプションで自動ソートルールを設定すると、変更時にブックの内容を自動的にソートすることができます。',
    'books_sort_auto_sort' => '自動ソートオプション',
    'books_sort_auto_sort_active' => '自動ソート有効: :sortName',
    'books_sort_named' => 'ブック「:bookName」を並べ替え',
    'books_sort_name' => '名前で並べ替え',
    'books_sort_created' => '作成日で並べ替え',
    'books_sort_updated' => '更新日で並べ替え',
    'books_sort_chapters_first' => 'チャプターを先に',
    'books_sort_chapters_last' => 'チャプターを後に',
    'books_sort_show_other' => '他のブックを表示',
    'books_sort_save' => '並び順を保存',
    'books_sort_show_other_desc' => 'これらのブックを並べ替え操作に追加すると、簡単にブック間の再編成が可能です。',
    'books_sort_move_up' => '上に移動',
    'books_sort_move_down' => '下に移動',
    'books_sort_move_prev_book' => '前のブックに移動',
    'books_sort_move_next_book' => '次のブックに移動',
    'books_sort_move_prev_chapter' => '前のチャプター内に移動',
    'books_sort_move_next_chapter' => '次のチャプター内に移動',
    'books_sort_move_book_start' => '本の先頭に移動',
    'books_sort_move_book_end' => '本の末尾に移動',
    'books_sort_move_before_chapter' => 'チャプターの前に移動',
    'books_sort_move_after_chapter' => 'チャプターの後に移動',
    'books_copy' => 'ブックをコピー',
    'books_copy_success' => 'ブックが正常にコピーされました',

    // Chapters
    'chapter' => 'チャプター',
    'chapters' => 'チャプター',
    'x_chapters' => ':count チャプター',
    'chapters_popular' => '人気のチャプター',
    'chapters_new' => 'チャプターを作成',
    'chapters_create' => 'チャプターを作成',
    'chapters_delete' => 'チャプターを削除',
    'chapters_delete_named' => 'チャプター「:chapterName」を削除',
    'chapters_delete_explain' => 'これにより、チャプター「:chapterName」が削除されます。このチャプターに存在するページもすべて削除されます。',
    'chapters_delete_confirm' => 'チャプターを削除してよろしいですか？',
    'chapters_edit' => 'チャプターを編集',
    'chapters_edit_named' => 'チャプター「:chapterName」を編集',
    'chapters_save' => 'チャプターを保存',
    'chapters_move' => 'チャプターを移動',
    'chapters_move_named' => 'チャプター「:chapterName」を移動',
    'chapters_copy' => 'チャプターをコピー',
    'chapters_copy_success' => 'チャプターが正常にコピーされました',
    'chapters_permissions' => 'チャプター権限',
    'chapters_empty' => 'まだチャプター内にページはありません。',
    'chapters_permissions_active' => 'チャプターの権限は有効です',
    'chapters_permissions_success' => 'チャプターの権限を更新しました',
    'chapters_search_this' => 'このチャプターを検索',
    'chapter_sort_book' => 'ブックを並べ替え',

    // Pages
    'page' => 'ページ',
    'pages' => 'ページ',
    'x_pages' => ':count ページ',
    'pages_popular' => '人気のページ',
    'pages_new' => 'ページを作成',
    'pages_attachments' => '添付',
    'pages_navigation' => 'ページナビゲーション',
    'pages_delete' => 'ページを削除',
    'pages_delete_named' => 'ページ :pageName を削除',
    'pages_delete_draft_named' => 'ページ :pageName の下書きを削除',
    'pages_delete_draft' => 'ページの下書きを削除',
    'pages_delete_success' => 'ページを削除しました',
    'pages_delete_draft_success' => 'ページの下書きを削除しました',
    'pages_delete_warning_template' => 'このページは現在、ブックまたはチャプタのデフォルトページテンプレートとして使用されています。このページが削除されると、それらのアイテムでデフォルトのページテンプレートが割り当てられなくなります。',
    'pages_delete_confirm' => 'このページを削除してもよろしいですか？',
    'pages_delete_draft_confirm' => 'このページの下書きを削除してもよろしいですか？',
    'pages_editing_named' => 'ページ :pageName を編集',
    'pages_edit_draft_options' => '下書きオプション',
    'pages_edit_save_draft' => '下書きを保存',
    'pages_edit_draft' => 'ページの下書きを編集',
    'pages_editing_draft' => '下書きを編集中',
    'pages_editing_page' => 'ページを編集中',
    'pages_edit_draft_save_at' => '下書きを保存済み: ',
    'pages_edit_delete_draft' => '下書きを削除',
    'pages_edit_delete_draft_confirm' => '本当にページの下書変更を削除しますか？ 最後の完全な保存以降の変更はすべて失われ、エディタは保存された最新のページ内容に復元されます。',
    'pages_edit_discard_draft' => '下書きを破棄',
    'pages_edit_switch_to_markdown' => 'Markdownエディタに切り替え',
    'pages_edit_switch_to_markdown_clean' => '(クリーンなコンテンツ)',
    'pages_edit_switch_to_markdown_stable' => '(安定したコンテンツ)',
    'pages_edit_switch_to_wysiwyg' => 'WYSIWYGエディタに切り替え',
    'pages_edit_switch_to_new_wysiwyg' => '新しいWYSIWYGエディタに切り替える',
    'pages_edit_switch_to_new_wysiwyg_desc' => '（ベータテスト版）',
    'pages_edit_set_changelog' => '編集内容についての説明',
    'pages_edit_enter_changelog_desc' => 'どのような変更を行ったのかを記録してください',
    'pages_edit_enter_changelog' => '編集内容を入力',
    'pages_editor_switch_title' => 'エディタの切り替え',
    'pages_editor_switch_are_you_sure' => 'このページのエディタを変更してもよろしいですか？',
    'pages_editor_switch_consider_following' => 'エディタを変更する場合には次の点に注意してください',
    'pages_editor_switch_consideration_a' => '保存すると、新しいエディタはそれ自身で種類を変更できない可能性のあるエディタを含め、今後のエディタとして利用されます。',
    'pages_editor_switch_consideration_b' => 'これにより、特定の状況で詳細と構文が失われる可能性があります。',
    'pages_editor_switch_consideration_c' => '最後の保存以降に行われたタグまたは変更ログの変更は、この変更では保持されません。',
    'pages_save' => 'ページを保存',
    'pages_title' => 'ページタイトル',
    'pages_name' => 'ページ名',
    'pages_md_editor' => 'エディター',
    'pages_md_preview' => 'プレビュー',
    'pages_md_insert_image' => '画像を挿入',
    'pages_md_insert_link' => 'エンティティへのリンクを挿入',
    'pages_md_insert_drawing' => '図を追加',
    'pages_md_show_preview' => 'プレビューを表示',
    'pages_md_sync_scroll' => 'プレビューとスクロールを同期',
    'pages_md_plain_editor' => 'Plaintext editor',
    'pages_drawing_unsaved' => '未保存の図が見つかりました',
    'pages_drawing_unsaved_confirm' => '以前に保存操作が失敗した、未保存の図が見つかりました。
未保存の図面を復元して編集を続けますか？',
    'pages_not_in_chapter' => 'チャプターが設定されていません',
    'pages_move' => 'ページを移動',
    'pages_copy' => 'ページをコピー',
    'pages_copy_desination' => 'コピー先',
    'pages_copy_success' => 'ページが正常にコピーされました',
    'pages_permissions' => 'ページの権限設定',
    'pages_permissions_success' => 'ページの権限を更新しました',
    'pages_revision' => '編集履歴',
    'pages_revisions' => '編集履歴',
    'pages_revisions_desc' => '以下はこのページの過去の全リビジョンです。権限があれば、古いバージョンのページの見返しや比較、復元ができます。システムの設定によっては、古いリビジョンが自動削除されることがあるため、このページの全履歴がここに反映されないことがあります。',
    'pages_revisions_named' => ':pageName のリビジョン',
    'pages_revision_named' => ':pageName のリビジョン',
    'pages_revision_restored_from' => '#:id :summary から復元',
    'pages_revisions_created_by' => '作成者',
    'pages_revisions_date' => '日付',
    'pages_revisions_number' => '#',
    'pages_revisions_sort_number' => 'リビジョン番号',
    'pages_revisions_numbered' => 'リビジョン #:id',
    'pages_revisions_numbered_changes' => 'リビジョン #:id の変更',
    'pages_revisions_editor' => 'エディタの種類',
    'pages_revisions_changelog' => '説明',
    'pages_revisions_changes' => '変更点',
    'pages_revisions_current' => '現在のバージョン',
    'pages_revisions_preview' => 'プレビュー',
    'pages_revisions_restore' => '復元',
    'pages_revisions_none' => 'このページにはリビジョンがありません',
    'pages_copy_link' => 'リンクをコピー',
    'pages_edit_content_link' => 'エディタのセクションへ移動',
    'pages_pointer_enter_mode' => 'セクション選択モードに入る',
    'pages_pointer_label' => 'ページセクションのオプションポップアップ',
    'pages_pointer_permalink' => 'ページセクションのパーマリンク',
    'pages_pointer_include_tag' => 'ページセクションのインクルードタグ',
    'pages_pointer_toggle_link' => 'パーマリンクモード。押下するとインクルードタグを表示',
    'pages_pointer_toggle_include' => 'インクルードタグモード。押下するとパーマリンクを表示',
    'pages_permissions_active' => 'ページの権限は有効です',
    'pages_initial_revision' => '初回の公開',
    'pages_references_update_revision' => '内部リンクのシステム自動更新',
    'pages_initial_name' => '新規ページ',
    'pages_editing_draft_notification' => ':timeDiffに保存された下書きを編集しています。',
    'pages_draft_edited_notification' => 'このページは更新されています。下書きを破棄することを推奨します。',
    'pages_draft_page_changed_since_creation' => 'この下書きが作成されてから、このページが更新されました。この下書きを破棄するか、ページの変更を上書きしないように注意することを推奨します。',
    'pages_draft_edit_active' => [
        'start_a' => ':count人のユーザがページの編集を開始しました',
        'start_b' => ':userNameがページの編集を開始しました',
        'time_a' => '数秒前に保存されました',
        'time_b' => ':minCount分前に保存されました',
        'message' => ':start :time. 他のユーザによる更新を上書きしないよう注意してください。',
    ],
    'pages_draft_discarded' => '下書きは破棄されました。エディタは現在のページ内容へ復元されています。',
    'pages_draft_deleted' => '下書きを削除しました。エディタは現在のページ内容へ復元されています。',
    'pages_specific' => '特定のページ',
    'pages_is_template' => 'ページテンプレート',

    // Editor Sidebar
    'toggle_sidebar' => 'サイドバーの切り替え',
    'page_tags' => 'タグ',
    'chapter_tags' => 'チャプターのタグ',
    'book_tags' => 'ブックのタグ',
    'shelf_tags' => '本棚のタグ',
    'tag' => 'タグ',
    'tags' =>  'タグ',
    'tags_index_desc' => 'システム内のコンテンツにタグを適用して柔軟なカテゴリ分けを行うことができます。タグはキーと値の両方を持つことができ、値は任意です。タグを適用すると、タグの名前と値を使ってコンテンツを検索することができます。',
    'tag_name' =>  'タグの名前',
    'tag_value' => '内容 (オプション)',
    'tags_explain' => "タグを設定すると、コンテンツの管理が容易になります。\nより高度な管理をしたい場合、タグに内容を設定できます。",
    'tags_add' => 'タグを追加',
    'tags_remove' => 'このタグを削除',
    'tags_usages' => 'タグの総使用回数',
    'tags_assigned_pages' => '割り当てられているページの数',
    'tags_assigned_chapters' => '割り当てられているチャプターの数',
    'tags_assigned_books' => '割り当てられているブックの数',
    'tags_assigned_shelves' => '割り当てられている本棚の数',
    'tags_x_unique_values' => ':count個のユニークな値',
    'tags_all_values' => '全ての値',
    'tags_view_tags' => 'タグを表示',
    'tags_view_existing_tags' => '既存のタグを表示',
    'tags_list_empty_hint' => 'タグはページエディタのサイドバーまたはブック、チャプター、本棚の詳細を編集しているときに割り当てることができます。',
    'attachments' => '添付ファイル',
    'attachments_explain' => 'ファイルをアップロードまたはリンクを添付することができます。これらはサイドバーで確認できます。',
    'attachments_explain_instant_save' => 'この変更は即座に保存されます。',
    'attachments_upload' => 'アップロード',
    'attachments_link' => 'リンクを添付',
    'attachments_upload_drop' => 'ファイルをここにドラッグアンドドロップして添付ファイルとしてアップロードすることもできます。',
    'attachments_set_link' => 'リンクを設定',
    'attachments_delete' => 'この添付ファイルを削除してよろしいですか？',
    'attachments_dropzone' => 'アップロードするファイルをここにドロップ',
    'attachments_no_files' => 'ファイルはアップロードされていません',
    'attachments_explain_link' => 'ファイルをアップロードしたくない場合、他のページやクラウド上のファイルへのリンクを添付できます。',
    'attachments_link_name' => 'リンク名',
    'attachment_link' => '添付リンク',
    'attachments_link_url' => 'ファイルURL',
    'attachments_link_url_hint' => 'WebサイトまたはファイルへのURL',
    'attach' => '添付',
    'attachments_insert_link' => '添付ファイルへのリンクをページに追加',
    'attachments_edit_file' => 'ファイルを編集',
    'attachments_edit_file_name' => 'ファイル名',
    'attachments_edit_drop_upload' => 'ファイルをドロップするか、クリックしてアップロード',
    'attachments_order_updated' => '添付ファイルの並び順が変更されました',
    'attachments_updated_success' => '添付ファイルが更新されました',
    'attachments_deleted' => '添付は削除されました',
    'attachments_file_uploaded' => 'ファイルがアップロードされました',
    'attachments_file_updated' => 'ファイルが更新されました',
    'attachments_link_attached' => 'リンクがページへ添付されました',
    'templates' => 'テンプレート',
    'templates_set_as_template' => 'テンプレートに設定',
    'templates_explain_set_as_template' => 'このページをテンプレートとして設定すると、他のページを作成する際にこの内容を利用することができます。他のユーザーは、このページの表示権限を持っていればこのテンプレートを使用できます。',
    'templates_replace_content' => 'ページの内容を置換',
    'templates_append_content' => 'ページの末尾に追加',
    'templates_prepend_content' => 'ページの先頭に追加',

    // Profile View
    'profile_user_for_x' => ':time前に作成',
    'profile_created_content' => '作成したコンテンツ',
    'profile_not_created_pages' => ':userNameはページを作成していません',
    'profile_not_created_chapters' => ':userNameはチャプターを作成していません',
    'profile_not_created_books' => ':userNameはブックを作成していません',
    'profile_not_created_shelves' => ':userNameは本棚を作成していません',

    // Comments
    'comment' => 'コメント',
    'comments' => 'コメント',
    'comment_add' => 'コメント追加',
    'comment_none' => '表示するコメントがありません',
    'comment_placeholder' => 'コメントを記入してください',
    'comment_thread_count' => ':count 個のコメントスレッド|:count 個のコメントスレッド',
    'comment_archived_count' => ':count 個のアーカイブ',
    'comment_archived_threads' => 'アーカイブされたスレッド',
    'comment_save' => 'コメントを保存',
    'comment_new' => '新規コメント作成',
    'comment_created' => 'コメントを作成しました :createDiff',
    'comment_updated' => ':username により更新しました :updateDiff',
    'comment_updated_indicator' => '編集済み',
    'comment_deleted_success' => 'コメントを削除しました',
    'comment_created_success' => 'コメントを追加しました',
    'comment_updated_success' => 'コメントを更新しました',
    'comment_archive_success' => 'コメントをアーカイブしました',
    'comment_unarchive_success' => 'コメントのアーカイブを解除しました',
    'comment_view' => 'コメントを表示',
    'comment_jump_to_thread' => 'スレッドにジャンプ',
    'comment_delete_confirm' => '本当にこのコメントを削除しますか?',
    'comment_in_reply_to' => ':commentIdへ返信',
    'comment_reference' => '参照箇所',
    'comment_reference_outdated' => '（以前の記述）',
    'comment_editor_explain' => 'ここにはページに付けられたコメントを表示します。 コメントの追加と管理は保存されたページの表示時に行うことができます。',

    // Revision
    'revision_delete_confirm' => 'このリビジョンを削除しますか？',
    'revision_restore_confirm' => 'このリビジョンを復元してよろしいですか？現在のページの内容が置換されます。',
    'revision_cannot_delete_latest' => '最新のリビジョンを削除できません。',

    // Copy view
    'copy_consider' => 'コンテンツをコピーする場合は以下の点にご注意ください。',
    'copy_consider_permissions' => 'カスタム権限設定はコピーされません。',
    'copy_consider_owner' => 'あなたはコピーされた全てのコンテンツの所有者になります。',
    'copy_consider_images' => 'ページの画像ファイルは複製されず、元の画像は最初にアップロードされたページとの関係を保持します。',
    'copy_consider_attachments' => 'ページの添付ファイルはコピーされません。',
    'copy_consider_access' => '場所、所有者または権限を変更すると、以前アクセスできなかったユーザーがこのコンテンツにアクセスできるようになる可能性があります。',

    // Conversions
    'convert_to_shelf' => '本棚に変換',
    'convert_to_shelf_contents_desc' => 'このブックを同じ内容の新しい棚に変換できます。このブックに含まれるチャプターは新しいブックに変換されます。このブックにチャプター内にないページが含まれている場合、このブックは名前が変更され、そのようなページを含む新しい本棚の一部となります。',
    'convert_to_shelf_permissions_desc' => 'このブックに設定されているすべての権限は、新しい本棚と、独自の権限が適用されていないすべての新しい子ブックにコピーされます。本棚の権限はブックの場合のように、内部のコンテンツに自動的に継承されないことに注意してください。',
    'convert_book' => 'ブックを変換',
    'convert_book_confirm' => 'このブックを変換してもよろしいですか？',
    'convert_undo_warning' => 'これは簡単には元に戻せません。',
    'convert_to_book' => 'ブックに変換',
    'convert_to_book_desc' => 'このチャプターを同じ内容の新しいブックに変換できます。このチャプターで設定された権限は新しいブックにコピーされますが、親ブックから継承された権限はコピーされないため、アクセス制御が変更される可能性があります。',
    'convert_chapter' => 'チャプターを変換',
    'convert_chapter_confirm' => 'このチャプターを変換してもよろしいですか？',

    // References
    'references' => '参照',
    'references_none' => 'この項目への追跡された参照はありません。',
    'references_to_desc' => 'この項目はシステム内の以下のコンテンツからリンクされています。',

    // Watch Options
    'watch' => 'ウォッチ',
    'watch_title_default' => 'デフォルト設定',
    'watch_desc_default' => 'デフォルトの通知設定に戻します。',
    'watch_title_ignore' => '無効',
    'watch_desc_ignore' => 'ユーザーの通知設定に関わらず、すべての通知を無効にします。',
    'watch_title_new' => 'ページの作成',
    'watch_desc_new' => 'このアイテム内に新しいページが作成されたときに通知します。',
    'watch_title_updates' => 'すべてのページ更新',
    'watch_desc_updates' => 'ページの作成や更新を通知します。',
    'watch_desc_updates_page' => 'ページの更新を通知します。',
    'watch_title_comments' => 'すべてのページ更新とコメント',
    'watch_desc_comments' => 'ページの作成・更新、およびコメント追加を通知します。',
    'watch_desc_comments_page' => 'ページの更新およびコメント追加を通知します。',
    'watch_change_default' => 'デフォルトの通知設定を変更する',
    'watch_detail_ignore' => '通知無効',
    'watch_detail_new' => 'ページ作成をウォッチ',
    'watch_detail_updates' => 'ページの作成と更新をウォッチ',
    'watch_detail_comments' => 'ページの作成・更新とコメントをウォッチ',
    'watch_detail_parent_book' => '親ブックでウォッチ',
    'watch_detail_parent_book_ignore' => '親ブックで通知無効',
    'watch_detail_parent_chapter' => '親チャプタでウォッチ',
    'watch_detail_parent_chapter_ignore' => '親チャプタで通知無効',
];
