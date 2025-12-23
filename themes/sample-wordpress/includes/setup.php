<?php
function theme_setup() {
  // 管理画面でタイトルタグを制御
  add_theme_support( 'title-tag' );

}
add_action( 'after_setup_theme', 'theme_setup' );
