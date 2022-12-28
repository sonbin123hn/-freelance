Install Laradock (Ubuntu)

Clone this repository anywhere on your machine

git clone https://github.com/laradock/laradock.git


Make sure the APP_CODE_PATH_HOST variable points to parent directory

APP_CODE_PATH_HOST=../ 


Go to your web server and create config files to point to different project directory when visiting different domains:


Nginx: nginx/sites.


Apache2: apache2/sites.


Laradock by default includes some sample files for you to copy app.conf.example, laravel.conf.example and symfony.conf.example.



change the default names *.conf:


You can rename the config files, project folders and domains as you like, just make sure the root in the config files, is pointing to the correct project folder name.


You can change server_name in the config file like the server name in the hosts file /etc/hosts. And change the root path like root /var/www/{folder_name}/public;



Add the domains to the hosts files.

Location file hosts: /etc/hosts

127.0.0.1  project-1.test  project-2.test...


Enter the laradock folder and copy .env.example to .env


cp .env.example .env


Run your containers:

(sudo) docker-compose up -d nginx mysql phpmyadmin redis workspace 


Restarts all stopped and running services:

(sudo) docker-compose restart


Enter the workspace container

(sudo) docker-compose exec workspace bash

Source: https://laradock.io/getting-started/

Setup project iLive (iLive Admin)

Copy .env.example to .env


cp .env.example .env


Open your project's .env file and set the following:

DB_HOST=mysql  REDIS_HOST=redis QUEUE_HOST=beanstalkd
DB_DATABASE=default DB_USERNAME=root DB_PASSWORD=root


Generate app key

php artisan key:genInstall Laradock (Ubuntu)

Clone this repository anywhere on your machine

git clone https://github.com/laradock/laradock.git


Make sure the APP_CODE_PATH_HOST variable points to parent directory

APP_CODE_PATH_HOST=../ 


Go to your web server and create config files to point to different project directory when visiting different domains:


Nginx: nginx/sites.


Apache2: apache2/sites.


Laradock by default includes some sample files for you to copy app.conf.example, laravel.conf.example and symfony.conf.example.



change the default names *.conf:


You can rename the config files, project folders and domains as you like, just make sure the root in the config files, is pointing to the correct project folder name.


You can change server_name in the config file like the server name in the hosts file /etc/hosts. And change the root path like root /var/www/{folder_name}/public;



Add the domains to the hosts files.

Location file hosts: /etc/hosts

127.0.0.1  project-1.test  project-2.test...


Enter the laradock folder and copy .env.example to .env


cp .env.example .env


Run your containers:

(sudo) docker-compose up -d nginx mysql phpmyadmin redis workspace 


Restarts all stopped and running services:

(sudo) docker-compose restart


Enter the workspace container

(sudo) docker-compose exec workspace bash

Source: https://laradock.io/getting-started/

Setup project iLive (iLive Admin)

Copy .env.example to .env


cp .env.example .env


Open your project's .env file and set the following:

DB_HOST=mysql  REDIS_HOST=redis QUEUE_HOST=beanstalkd
DB_DATABASE=default DB_USERNAME=root DB_PASSWORD=root


Generate app key

php artisan key:gen