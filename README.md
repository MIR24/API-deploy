# API-deploy

#Deployment Instructions api-SmartTV

#Requirements

For the application to work php >=7.1.3, **global** installed *composer* ( см. https://getcomposer.org/doc/00-intro.md)
**global** installed   *deployer* >=6.3 ( см.  https://deployer.org/download)


#Start

Copy the repository (make sure that in github there is an ssh key for the current user):

>git clone git@github.com:MIR24/API-deploy.git

Create a configuration for deployment:

> cp hosts.yml.example  hosts.yml

In the file *hosts.yml* we change:
1. **deploy_path:** (full path to the directory where the project will be located)
2. **http_user:** (user who has rights to the project files, usually it is **www-data** for the server)

Содаем базу данных если нет .
> mysql -u root -p
> CREATE DATABASE database_name;

Create a configuration for a Laravel project.

> cp .env.example .env

In file *.env* we change:

1. **APP_URL** (set the stand url) - not necessarily
2. **APP_HTTP_SCHEME** (http - if ssl is not connected, https - if ssl is connected)
3. **DB_DATABASE** , **DB_USERNAME** , **DB_PASSWORD** (corresponding mysql database settings)


#Routine

We start deploy

>dep deploy --branch=develop

The latest version of the app will be in {{deploy_path}}/current

For server *root* {{deploy_path}}/current/public

For lazy admins change the rights to the group www-data (**Надо sudo** )

>dep user:permission