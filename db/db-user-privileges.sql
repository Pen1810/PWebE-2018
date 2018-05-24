-- membuat db toko --
CREATE DATABASE pweb_shop DEFAULT CHARACTER SET utf8;
USE pweb_shop;

-- membuat user khusus yang akan digunakan pada sql --
CREATE USER 'shoppers'@'localhost' IDENTIFIED BY 'shoppers169';
CREATE USER 'shopadmin'@'localhost' IDENTIFIED BY 'adminturangga';
GRANT SELECT,INSERT,UPDATE ON pweb_shop.* TO 'shoppers'@'localhost';
GRANT ALL PRIVILEGES ON pweb_shop.* TO 'shopadmin'@'localhost';

-- silakan buat file baru untuk ddl --
