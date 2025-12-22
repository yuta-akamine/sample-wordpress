<?php

// WP外からの直接アクセス禁止
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

/**
 * 1. 定数の定義
 */
// テーマのサーバー上の絶対パス
if ( ! defined( 'MY_THEME_DIR' ) ) {
  define( 'MY_THEME_DIR', get_parent_theme_file_path() );
}

// テーマのブラウザ用URL
if ( ! defined( 'MY_THEME_URI' ) ) {
  define( 'MY_THEME_URI', get_parent_theme_file_uri() );
}

/**
 * 2. 構成ファイルの読み込み
 */
$theme_includes = [
  'includes/setup.php', // テーマの基本設定
  'includes/hooks.php', // アクション・フィルターフック
];

foreach ( $theme_includes as $file ) {
	// フルパス作成。定数とファイル名を結合。スラッシュの付与は動的に処理
  $path = trailingslashit( MY_THEME_DIR ) . $file;

  // includes直下にファイルが存在しない場合、ログに残す
  if ( ! file_exists( $path ) ) {
    trigger_error(
      sprintf( 'インクルートファイルが見つかりません。: %s', esc_html( $path ) ),
      E_USER_WARNING
    );
    continue;
  }
  require_once $path;
}
