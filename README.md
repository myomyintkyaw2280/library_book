# [Library Book Management System](https://lbms.myomyintkyaw.pro)

## Library Books Management System


## Major Technologies
- HTML5
- CSS
- JAVASCRIPT
- BOOTSTRAP
- PHP
- LARAVEL


### Prerequisites
- XAMPP installed
- PHP installed >= 7.4
- Composer installed
- IDE to edit and run the code (We use Visual Studio Code 🔥).
- Git to versioning your work.

### Authors
👤 **MyoMyintKyaw**

- GitHub: [@myomtintkyaw2280](https://github.com/myomyintkyaw2280)
- Linkedin: [Myo Myint Kyaw](https://www.linkedin.com/in/myo-myint-kyaw-049b98126/)
- Website: [www.myomyintkyaw.com](https://myomyintkyaw.com)

### Install & Setup

To setup and install Library Books Management System project, follow the below steps:
- Clone this project from github by the following command: 

```
$ git clone https://github.com/myomyintkyaw2280/library_book.git
```

- Then switch to the project folder by the bellow query:

```
$ cd PATH_TO_YOUR_PROJECT/library_book
```

- Then open ```env``` file and update database credentials.

- Then run the below command to install composer dependencies

```
$ composer install
```

- Then run the below command to install dependencies

```
$ npm i
```

- Then run the below command to migrate the tables.

```

$ php artisan key:generate

$ php artisan migrate 

```

- Then run the below command to run seeder.
- run the database seeder:

```

$ php artisan db:seed --class=PermissionTableSeeder

$ php artisan db:seed --class=CategoriesTableSeeder

$ php artisan db:seed --class=CreateAdminUserSeeder

$ php artisan db:seed --class=CreateUserTypeSeeder

```

- Finally, run the below command to start the project with default port 8000.


```
$ php artisan serve
```

- If you would like to change the port no use --port option show below

```
$ php artisan serve --port=YOUR_PORT_NO
```
