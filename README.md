# Setting Up Project
After Cloning the project into your local machine go to the project folder and open
terminal into your project folder and run these Commands

1. composer install
2. Run this command in your terminal for getting new .env configuration file
3. **cp .env.example .env**
4. Now Run **php artisan key:generate**
3. **composer dump-autoload**
4. Open localhost/phpmyadmin
5. Create new Database With any name you want.


## Setting Project Configurations
Open your project in any **IDE** such as Visual Code, Php Storm, Netbeans. Edit **.env**
file and update your project configuration

1. Change **APP_URL** value with the url you access your project if you are using **XAMPP**
then URL might be **http://localhost/project_name** if you are using laragon then **APP_URL** will be **http://project_name.test**
2. Replace **DB_DATABASE** constant value with the name you create Database
3. Replace **DB_USERNAME** constant with the name of your Database User Name e.g (root)
4. If you Database is using any password then change **DB_PASSWORD** constant value with
your database password if your database is not using any password then leave it empty.
5. Then Run this Command **php artisan migrate**

## Setting Enviroment for Postman
if you are using **Postman** for testing Api then follow the following steps:

1. Click on Add New Enviorment (Which is on the top right side of Postman)
2. Edit Enviroment name e.g (smake,task e.t.c)
3. So now you have to add two variables
4. First **local_url** with the value of project **APP_URL** e.g (http://localhost/task) 
5. Second **token** leave the initial and Current Value Empty.
6. Make sure before hitting end point you select the correct Enviroment File

### Importing Project API Collection
The collection file will be in project **collection** folder
1. Click on Import for improting new Collection
2. Upload the Collection File

> Now you are done with initial Configuration that are essential to run laravel project

# Testing API
First you have to register new user if you want to hit banks and transactions API

1. Register new user with name, email, password, password_confirmation.
2. The server will return loggedin user data and access_token
3. Copy the access token that you gets after Registeration.
4. Edit your Enviroment File and set token initial value and current value with the value you gets from server.
5. Without Authentication or not passing correct access_token you will get error from server **unauthenticated** so make sure that you put the right value in the token variable.