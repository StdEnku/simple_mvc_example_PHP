FROM php:8.0.6-apache

# 1. 必要な PHP 拡張機能のインストール（例: pdo_mysql, mbstring など必要に応じて追加）
RUN docker-php-ext-install pdo_mysql mysqli

# 2. Apache の mod_rewrite を有効化（URL書き換えが必要な場合）
RUN a2enmod rewrite

# 3. Render が指定するポート（環境変数 PORT）に対応させるため、Apache のポート設定を動的に変更
# デフォルトの 80 番ポートから $PORT に変更する設定を行います
ENV PORT=10000
RUN sed -i "s/80/${PORT}/g" /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

# 4. ソースコードを Apache のドキュメントルートにコピー
COPY ./ /var/www/html/

# 5. パーミッションの調整（必要に応じて。storageやlogsなど書き込みが必要な場合）
# RUN chown -R www-data:www-data /var/www/html