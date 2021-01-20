# Laravel-Vue SPA CRUD



> A Laravel-Vue SPA CRUD starter kit.

<p align="center">
<img src="https://i.imgur.com/K5Zp0uc.jpg">
</p>

## Features

- Laravel 7
- Vue + VueRouter 
- Pages with dynamic import and custom layouts
- Login, logout
- Authentication with sanctum
- Bootstrap 4 + Font Awesome 5

## Installation

- `git clone https://github.com/wailkame/laravel-crud-api.git`
- Edit `.env` and set your database connection details
- `php artisan key:generate`
- `php artisan migrate`
- `npm install`

## Usage

#### Development
- you must set you local domain as crudapp.test
-if you want you use your own local domain you must change the local variable axios.defaults.baseURL = your domain in bootstrap.js
```bash

# Build and watch
npm run watch

# Serve with hot reloading (not working)
npm run hot
```

#### Production

```bash
npm run production
```



## Changelog
