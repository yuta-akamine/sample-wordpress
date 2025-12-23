"use strict"

// WPテーマ名を記入。パス指定で利用
const themeName = 'sample-wordpress'

// Gulpのモジュール読み込み
/* src: 処理対象のファイルを指定（入力）
 * series: タスクを順番に実行
 * dest: 処理結果を書き出し（出力）
 * watch: ファイルの変更を監視
*/
const { src, dest, series, watch } = require("gulp")  // Gulp
const sass = require("gulp-dart-sass")  // Sass
const browserSync = require("browser-sync").create()  // browser-sync(自動リロード機能など)

const themePath = `themes/${themeName}`  // テーマのルートディレクトリパス

// scssをコンパイルして出力
function scssCompile() {
  // コンパイル対象のファイル
  return src(`${themePath}/sass/**/*.scss`)
  // cssファイルに変換。コンパイルエラー時はログ出力
  .pipe(
    sass({ outputStyle: "expanded" }).on("error", sass.logError)
  )
  .pipe(dest(themePath)) // テーマのルートディレクトリパスへcssを出力
  .pipe(browserSync.stream({ match: "**/*.css" })) // BrowserSyncに渡しページの再読み込みなしにCSSを差し替え
}

// BrowserSyncの起動。ファイルの変更を監視しタスクを実行。`done`は関数終了のコールバック
function serve(done) {
  // 変更元URL。BrowserSyncがプロキシするURLは環境変数で上書き可能にする
  const proxyUrl = process.env.BROWSERSYNC_PROXY || "http://localhost:8888"

  // ファイルウォッチのオプション（Docker/WSLなどで環境で監視されない場合は環境変数でポーリング監視を有効化）
  const watchOptions = process.env.WATCH_USE_POLLING === '1' ? { usePolling: true } : {}

  // BrowserSyncを初期化（起動）
  browserSync.init({
    proxy: proxyUrl,  // プロキシ対象URLを指定し、http://localhost:3000（デフォルト）を提供
    open: true,       // デフォルトでブラウザを開く?
    notify: false,    // 右下の通知する?
    ghostMode: true,  // 複数端末のブラウザ操作の同期を有効にする?
  })

  // SCSSを監視（変更時にコンパイル）
  watch(`${themePath}/sass/**/*.scss`, watchOptions, scssCompile)

  // PHP/JSの変更はリロード
  watch(`${themePath}/**/*.php`, watchOptions).on("change", browserSync.reload)
  watch(`${themePath}/**/*.js`, watchOptions).on("change", browserSync.reload)

  done() // serve関数の終了をGulpに通知するコールバックの実行
}

// Gulp実行時のデフォルトタスク。引数の順で処理を実行
exports.default = series(scssCompile, serve)

// 個別のタスク
exports.sass = scssCompile
exports.serve = serve