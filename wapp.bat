@echo off

echo extension=fileinfo >> .\php\php.ini
echo post_max_size = 100M >> .\php\php.ini
echo memory_limit = 1G >> .\php\php.ini

echo LoadModule speling_module modules/mod_speling.so >> .\apache2\conf\httpd.conf

rmdir /s /q .\apache2\htdocs
mkdir .\apache2\htdocs

robocopy /S ccidb_source .\apache2\htdocs
