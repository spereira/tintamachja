create database if not exists tintam character set utf8 collate utf8_unicode_ci;
use tintam;

grant all privileges on tintam.* to 'tinta_user'@'localhost' identified by 'secret';