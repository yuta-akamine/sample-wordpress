# sample-wordpress

## 概要
- WordPress オリジナルテーマ制作のサンプル版（ポートフォリオ用）
- 技術スタック：WordPress, PHP, Sass(SCSS) Node.js, gulp, wp-env(Docker), npm
- 開発は`wp-env`を使ったローカルコンテナ環境で行います

## 開発環境（前提）
- Node.jsのバージョン管理は`nvm`を推奨
- Node.js:`v18.20.8`（プロジェクトルート`.nvmrc`に記載）
- gulp:`v4.0.2`
- Docker（`wp-env`はコンテナを使うため必須）

### 事前確認
- Dockerが起動していることを確認

### Node.jsのバージョン切り替え(nvm)
※`.nvmrc`のバージョンがnvmにインストールされていない場合、インストール後に切り替えてください。
```sh
nvm install
nvm use
```

### npmパッケージのインストール
```sh
npm install
```
※`wp-env`は内部でDockerコンテナを使用。
初回は時間がかかるので要注意

## WP起動コマンド
- Dockerが起動していることを確認
```sh
npm run start
```
- 実行後、自動で以下開発サイトが立ち上がる
- コード変更を検知しブラウザホットリロード

## 画面表示確認
- 開発サイト(BrowserSync対応): http://localhost:3000 🔗
- 開発サイト(BrowserSync未対応): http://localhost:8888 🔗

## オリジナルテーマへの切り替え（初回）
```sh
npx wp-env run cli wp theme activate sample-wordpress
```

## WP 停止コマンド
```sh
npm run stop
```

## WP 初期化コマンド（注意）
**注意**:`destroy`はDBとボリュームを完全に削除します。実行前にバックアップ推奨
```sh
npm run destroy
```
選択肢で`Y`を実行