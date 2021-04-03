<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Hotel System

This is a project has features an online Hotel system with different roles and permissions(Admin, Manager,Reciptionist, Client) using Laravel framework. 

### Team Members:
	Ahmed Saleh - Bassam Saad - Hossam Salah - Islam Shabaan - Khaled Elgaml - Mohamed Egila

### Prerequisites

You should have  `composer` installed. If you don't install composer from [here](https://getcomposer.org/download/).

### Installing
1. Download the zipped file and unzip it or Clone it
		```sh
		git clone https://github.com/Ahmed-Saleh-007/Hotels.git
		```
2. cd inside the project
    ```sh
    cd Hotels
    ```
3.  Run this command to download composer packages
    ```sh
    composer install
    ```
4. Run this command to update composer packages
    ```sh
    composer update
    ```
5. Create a copy of your .env file
    ```sh
    cp .env.example .env
    ```
6. Generate an app encryption key
    ```sh
    php artisan key:generate
    ```
7. Create an empty database for our application in your DBMS
8. In the .env file, add database information to allow Laravel to connect to the database
9. Migrate the database
    ```sh
    php artisan migrate
    ```
10. Seed the database
    ```sh
    php artisan db:seed
    ```
11. Generate Storage folder in your public directory to store uploaded files or images
    ```sh
    php artisan storage:link
    ```
12. check your device that can connect to mailtrap through telnet
    ```sh
    telnet smtp.mailtrap.io 465
    ```
    If you don't enable telnet
    You have to go to Control Panel>Programs>Turn Windows features on or off. Then, check "Telnet Client" and save the changes. You might have to wait about a few minutes before the change could take effect.
12. Start schedule to send missing email
    ```sh
    php artisan schedule:work
    ```
13. Start queue to send notifications
    ```sh
    php artisan queue:work
    ```
14. Open mailtrap link to see coming emails ``` https://mailtrap.io/inboxes```

15. Open up the server
    ```sh
    php artisan serve
    ```
15. Open your browser on this url ``` http://localhost:8000```

Demo of laravel hotel project open this link ``` https://laravelhotel.herokuapp.com/```

### License
MIT License

Copyright (c) 2021 OS41

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
