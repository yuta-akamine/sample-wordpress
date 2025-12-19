"use strict"

// 出力するWPテーマ名を記入
const themeName = 'sample-wordpress'

// gulpのモジュールを読み込む
const { src, dest, series, watch } = require("gulp")
const sass = require("gulp-dart-sass")

// scssをコンパイルして出力
function scssCompile() {
  return src(`themes/${themeName}/sass/**/*.scss`)
    .pipe(
      sass({
        outputStyle: "expanded"
      }).on("error", sass.logError)
    )
    .pipe(dest(`themes/${themeName}`))
}

// ファイルの変更を監視してタスクを実行
function watchTask() {
  return watch(`themes/${themeName}/sass/**/*.scss`, scssCompile)
}

// gulpのデフォルトタスク
exports.default = series(scssCompile, watchTask)

// 個別のタスク
exports.sass = scssCompile