# API-deploy

#Инструкция по развертованию api-SmartTV

#Requirements

Для работы приложения  необходимо php >=7.1.3, **глобальная** установка *composer* ( см. https://getcomposer.org/doc/00-intro.md)
**глабально** установленый   *deployer* >=6.3 ( см.  https://deployer.org/download)


#Start

Копируем репозиторий (убидитесь что в github есть ключ ssh на текущего пользователя):

>git clone git@github.com:MIR24/API-deploy.git

Создаем конфигурацию для деплоя:

> cp hosts.yml.example  hosts.yml

В файле *hosts.yml* меняем 
1. **deploy_path:** (полный путь до директории где будет лежать проект)
2. **http_user:**  (пользователь каторый будет иметь права к файлам проекта , обычно это **www-data** для сервера)

Содаем базу данных если нет .
> mysql -u root -p
> CREATE DATABASE database_name;

Создаем конфигурацию для Laravel проекта

> cp .env.example .env

В файде *env* меняем:

1. **APP_URL** ( устанавливаем урл стенда) -- не обязательно
2. **APP_HTTP_SCHEME** ( http -- если не подключен ssl , https -- если подключен ssl )
3. **DB_DATABASE** , **DB_USERNAME** , **DB_PASSWORD** ( соответствующие настройки базы данных mysql)


#Routine

Запускаем деплой

>dep deploy --branch=develop

Последняя версия приложения будет лежать в {{deploy_path}}/current

Для сервера *root* {{deploy_path}}/current/public

Для ленивых админов смена прав на группу www-data (**Надо sudo** )
>dep user:permission