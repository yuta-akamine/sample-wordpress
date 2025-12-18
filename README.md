# sample-wordpress

## 概要
- WordPress オリジナルテーマ制作のサンプル版（ポートフォリオ用）
- 技術スタック：WordPress, PHP, Node.js, wp-env(Docker), npm
- 開発は`wp-env`を使ったローカルコンテナ環境で行います


## 開発環境（前提）
- Node.jsのバージョン管理は`nvm`を推奨
- Node.js:`v18.20.8`（プロジェクトルート`.nvmrc`に記載）
- Docker（`wp-env`はコンテナを使うため必須）

### 事前確認（初回）
- Dockerが起動していることを確認

### Node.jsのバージョン切り替え(nvm)
```sh
nvm use
```

### npmパッケージのインストール
```sh
npm install
```
※`wp-env`は内部でDockerコンテナを使用。
初回は時間がかかるので要注意

### WP起動コマンド
```sh
npm run start
```

### 画面表示確認
- 開発サイト: http://localhost:8888 🔗

### WP 停止コマンド
```sh
npm run stop
```

### WP 初期化コマンド（注意）
**注意**:`destroy`はDBとボリュームを完全に削除します。実行前にバックアップ推奨
```sh
npm run destroy
```
選択肢で`Y`を実行