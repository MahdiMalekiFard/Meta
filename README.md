## About Base Project

in this project we have a base project for all projects in the future.


## Install Project
1. clone project
2. run `cp .env.example .env`
3. run `composer install`
4. run `php artisan key:generate`
5. run `php artisan migrate`
6. run `php artisan db:seed`
7. run `yarn install`
8. run `yarn run build`
9. run `php artisan serve`


## Swagger Api Documentation Generator
in this project we use [darkaonline/l5-swagger] package for generate swagger documentation.
for generate swagger documentation you can run this command in terminal:
```bash
php artisan l5-swagger:generate
```
after run this command you can see swagger documentation in this url:
url: http://localhost:8000/api/documentation


## phpDocumentor
document php files
```bash
php phpDocumentor.phar -d . -t docs/api -c phpdocumentor.xml
```
## Structure Documentation

package: binarytorch/larecipe
url: http://localhost:8000/docs


## Used Packages:
- darkaonline/l5-swagger
- livewire/livewire
- lorisleiva/laravel-actions
- realrashid/sweet-alert
- spatie/laravel-medialibrary
- spatie/laravel-permission
- spatie/laravel-query-builder
- spatie/laravel-schemaless-attributes
- spatie/laravel-tags
- yajra/laravel-datatables-oracle


we use metronic v8.2.0 and bootstrap 5.3.0 for admin panel in this project.
