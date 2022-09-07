<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


## About Project

<pre> Project created <b>withouth</b> design </pre>

### Laravel
- Download git From: https://git-scm.com/downloads
- Download composer from: https://getcomposer.org/download/
- Install composer
- Donwload mysql from: https://www.mysql.com/downloads/
- Clone the project
- cd on you project dir and run this command via terminal or cmd: `composer install`
- If you have not renamed the `.env.example` file to `.env`, you should do that now. Set database credentials in `.env`
- For datebase migration run this command: `php artisan migrate` and `php artisan db:seed`
- Run this command using terminal or cmd: `php artisan key:generate`
- Run this command using terminal or cmd to link laravel storage and public directories: `php artisan storage:link`
- Run this command for start server: `php artisan serve`

### Vue
<pre>
<b>Note:</b> only dependency in project is <b>axios</b> and <b>vue router</b>. <br/>Didn't used any CSS framework, like bootstrap or Vuetify (Material Design Framework), </br>or VeeValidate for form validations, Vuex for global state management. <br />Everything created from scratch, react atomic design-like architecture.
</pre>
<pre>Created directives, mixins</pre>
<pre>For styling used SCSS and creted bootstrap-like classes</pre>
- `"vue": "^3.2.36", "vue-loader": "^17.0.0"`
- run following command for installing dependencies:
```
$ npm install
```
- Run this command for start server: `npm run watch`


### Example
After seeding DB, 20 user and stock record will be created. <br/>
Each user has 1000$ deposit by default. User list is sorted by profit, not deposit. User can buy stocks, before he's deposit > stock price * amount. <br />
Stocks are editable and it can be deleted. <br />
Users are also editable. 
