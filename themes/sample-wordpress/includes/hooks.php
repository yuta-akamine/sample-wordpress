<?php
// WordPressのバージョン情報を非表示（セキュリティ対策）
remove_action( 'wp_head', 'wp_generator' );

/**
 * wp_headにメタタグとOGPを出力
 */
function my_theme_add_meta_tags() {
  // 基本情報の定義
  $site_name = get_bloginfo( 'name' ); // 管理画面/一般設定/サイトタイトル
  $site_description = get_bloginfo( 'description' ); // 管理画面/一般設定/キャッチフレーズ
  $og_image = MY_THEME_URI . '/#'; // デフォルトOGP画像のパス
  $og_url = esc_url( get_permalink() ); // 現在の投稿のパーマリンクを取得
  $og_type = ( is_front_page() || is_home() ) ? 'website' : 'article';
?>
<meta name="description" content="<?php echo esc_attr( $site_description ); ?>">
<meta name="format-detection" content="telephone=no">

<meta property="og:site_name" content="<?php echo esc_attr( $site_name ); ?>">
<meta property="og:url" content="<?php echo esc_url( $og_url ); ?>">
<meta property="og:type" content="<?php echo esc_attr( $og_type ); ?>">
<meta property="og:title" content="<?php echo esc_attr( $site_name ); ?>">
<meta property="og:description" content="<?php echo esc_attr( $site_description ); ?>">
<meta property="og:image" content="<?php echo esc_url( $og_image ); ?>">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="" />
<meta property="og:locale" content="ja_JP">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?php echo esc_attr( $site_name ); ?>">
<meta name="twitter:description" content="<?php echo esc_attr( $site_description ); ?>">
<meta name="twitter:image" content="<?php echo esc_url( $og_image ); ?>">

<?php
}
add_action( 'wp_head', 'my_theme_add_meta_tags', 1 ); // 優先度1で早めに出力
