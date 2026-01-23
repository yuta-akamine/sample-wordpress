<?php

/**
 * CSSやJSなど外部ファイルの読み込み
 */
// CSSやJSファイルをサイトに自動で読み込むための関数
function enqueue_scripts()
{
	// 現在のページがWordPressの管理画面ではないか確認
  if (!is_admin()) {
    // 管理画面以外の場所でCSSやJSを読み込み
    // CSSファイルをサイトに追加
    wp_enqueue_style('style-theme', get_template_directory_uri() . '/app.css', array(), wp_get_theme()->get('Version'));
  }
}
// headタグ生成直前に関数を実行
add_action('wp_enqueue_scripts', 'enqueue_scripts');
