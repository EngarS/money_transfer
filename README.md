<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Тестовое задание

Создать приложение, в котором пользователь может переводить денежные средства со своего баланса, на баланс другого пользователя.

Перевод можно запланировать на выбранную дату и время.

При переводе, выбираемая сумма должна быть ограничена балансом пользователя, с учетом запланированных исходящих переводов.

Вводимые данные должны быть провалидированы с выводом соответствующих ошибок пользователю. 

Так же в приложении, помимо страницы для перевода средств, должна быть страница, с ограниченным доступом, для просмотра пользователей и их транзакций.

Для создания таблиц в БД необходимо использовать миграции и сиды для заполнения тестовыми данными.

## Установка
#### Клонировать проект

```
git clone https://github.com/EngarS/money_transfer.git
```

#### Установить зависимости

```
composer install
```

#### Создать файл .env

```
cp .env .env.example
```

#### Сгенерировать ключ

```
php artisan key:generate
```

#### Выполнить миграции

```
php artisan migrate
```

#### Запустить seed для создания тестовых пользователей

```
php artisan db:seed
```

Будет создан администратор:   
E-mail: **admin@admin.comс 
Пароль: **secret** 

Тестовый пользователь: 
E-mail: **user@admin.com**  
Пароль: **secret** 

Остальные пользователи(e-mail узнать через администратора):  
Пароль: **password** 

#### Запустить обработку очередей

```
php artisan queue:work
```

При желании заменить  

```
QUEUE_CONNECTION=database 
```

на 

```
QUEUE_CONNECTION=redis 
```


## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
