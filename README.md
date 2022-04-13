https://user-images.githubusercontent.com/62506582/162600284-aa8fe74e-5dca-4d8d-a7bd-b4f907d45958.mp4


<p align="center">Laravel starter app and CRUD generator.</p>

<div align="center">

[![All Contributors](https://img.shields.io/github/contributors/Zzzul/generator?style=flat-square)](https://github.com/Zzzul/generator/graphs/contributors)
![GitHub last commit](https://img.shields.io/github/last-commit/Zzzul/generator.svg?style=flat-square)
[![License](https://img.shields.io/github/license/zuramai/mazer.svg?style=flat-square)](LICENSE)
[![Issues](https://img.shields.io/github/issues/Zzzul/generator?style=flat-square)](Issues)
[![Forks](https://img.shields.io/github/forks/Zzzul/generator?style=flat-square)](Forks)
[![Stars](https://img.shields.io/github/stars/Zzzul/generator?style=flat-square)](Stars)

</div>

## Table of Contents
1. [Requirements](#requirements)
2. [Features](#features)
3. [Setup](#setup)
4. [Usage](#usage)
5. [Examples](#examples)
6. [Screenshots](#screenshots)
7. [License](#license)
8. [Support](#support)

## Requirements
- Laravel ^9.x - [Laravel 9](https://laravel.com/docs/9.x)
- PHP ^8.1 - [PHP 8.1](https://www.php.net/releases/8.1/en.php)

## Features
- [x] Authentication ([Laravel Fortify](https://laravel.com/docs/9.x/fortify))
    - Login
    - Register
    - Forgot Password
    - 2FA Authentication
    - Update profile information 
- [x] Roles and permissions ([Spatie Permissions](https://spatie.be/docs/laravel-permission/v5/introduction))
- [x] Users
- [x] CRUD Generator
    - Support more than [15 column type table](https://laravel.com/docs/9.x/migrations#available-column-types), like string, char, date, year, etc.
    - BelongsTo relation
    - Updload image
    - Input type supported
        - text, email, file, number, date, time, datetime-local, select, radio, textarea
    - Dynamic sidebar menus

## Setup
1. Clone or Or download from [releases](https://github.com/Zzzul/generator/releases)
```shell
git clone https://github.com/Zzzul/generator
```

2. Install laravel dependency
```sh
composer install
```

3. Create copy of ```.env```
```sh
cp .env.example .env
```

4. Generate laravel key
```sh
php artisan key:generate
```

5. Set database name and account in ```.env```
```sh
DB_DATABASE=generator
DB_USERNAME=root
DB_PASSWORD=
```

6.  Run Laravel migrate and seeder
```sh
php artisan migrate --seed
``` 

## Usage
Go to ```/generators/create```

Admin
- Email: admin@example.com
- Password: password


## Examples
Below are some codes that generate by the generator

<img width="960" alt="controller" src="https://user-images.githubusercontent.com/62506582/162600665-00405a4d-00e2-4c30-88da-74a2f447946a.PNG">
<img width="960" alt="model" src="https://user-images.githubusercontent.com/62506582/162600670-d8bd61a4-cc73-4f8b-8e4d-dabd353ff48d.PNG">
<img width="960" alt="migration" src="https://user-images.githubusercontent.com/62506582/162600667-9686c556-f5b3-4067-bf58-f6f295d360c6.PNG">
<img width="960" alt="blade" src="https://user-images.githubusercontent.com/62506582/162600663-5c26a238-633a-4c14-8bb0-acc6d917d221.PNG">

*some code may not format perfectly, but you can format the code manually or using a formatter.

## Screenshots
<img width="960" alt="login page" src="https://user-images.githubusercontent.com/62506582/163182274-c1a3166e-c053-450b-bf1d-15199b6e96c5.PNG">
<img width="960" alt="two factor challenge" src="https://user-images.githubusercontent.com/62506582/163182365-9ed55487-eff0-4db5-bf93-8d096c011286.PNG">
<img width="960" alt="profile page" src="https://user-images.githubusercontent.com/62506582/163182371-9165eef5-0c78-47ce-91e3-08e3eced3b5f.PNG">
<img width="960" alt="profile page" src="https://user-images.githubusercontent.com/62506582/163182653-04584888-837c-46fd-9406-8dc440aeba7e.png">
<img width="960" alt="role page" src="https://user-images.githubusercontent.com/62506582/163182402-24ac870a-d4e1-4511-ad44-4c744f93c6ed.PNG">
<img width="960" alt="crud generator page" src="https://user-images.githubusercontent.com/62506582/163182411-492fdfc3-b7a3-443c-9223-77ff0cac6ecb.PNG">


## License
[MIT License](./LICENSE)

## Support
<a href="https://www.buymeacoffee.com/mzulfahmi" target="_blank">
<img src="https://www.buymeacoffee.com/assets/img/custom_images/orange_img.png" alt="Buy Me A Coffee" style="height: 41px !important;width: 174px !important;box-shadow: 0px 3px 2px 0px rgba(190, 190, 190, 0.5) !important;-webkit-box-shadow: 0px 3px 2px 0px rgba(190, 190, 190, 0.5) !important;">
</a>

Or you can support me at [Ko-fi](https://ko-fi.com/mzulfahmi) or [Saweria](https://saweria.co/zzzul)
