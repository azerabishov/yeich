# Yeich
Yeich is Restaurant management software app. This repo is rest api for user based part of application

This part of project  provides users with services such as accessing restaurant information, create collection, instant access to discounts, online booking, online payment((cumming soon)).

## Installing Yeich
Through below command, you can install this project to your computer.
`git clone https://github.com/azerabishov/yeich.git`

After 
After clone repo to your comp, you can start using the project by running the following commands:

`composer install`

`npm install`

create copy of `.env.example` file with name `.env` and add your db, mail information to it. 

`php artisan key:generate`

`php artisan migrate`

`php artisan passport:install`


## Usage

And if you don't want to get error. You must run this command also in php tinker for fill db with restaurant information:`factory(App\Menu::class,1)->create()`

Through Postman, you can test feature of yeich.

You can reach the addresses you will send requests from here:
`<current dir>/routes/api.php`




