# お問い合わせフォーム
## 環境構築
### Dockerビルド
1. git clone ```git@github.com:mikanchaaaan/COACHTECH-contact-form-test.git```
2. docker-compose up -d --build <br>
※ MySQLは、OSによって起動しない場合があるためそれぞれのPCに合わせてdocker-compose.ymlファイルを編集してください。

### Laravel環境構築
1. docker-compose exec php bash
2. composer install
3. .env.exampleファイルから.envを作成し、環境変数を変更
4. php artisan key:generate
5. php aritsan migrate
6. php artisan db:seed

## 使用技術
* PHP 8.3.11
* Laravel Framework 8.83.8
* MySQL 8.0.26

## ER図
![contact_form](https://github.com/user-attachments/assets/8032da84-65d9-4ecc-862c-7bd8c98dc13c)

## URL
* 開発環境：http://localhost/
* phpMyAdmin：http://localhost:8080/
