"# tropicshop"

#Installing projects

##Symfony
- You need to call composer to install dependancy need
>composer Install
- Set your .env with your databases's credentials
        
        DATABASE_URL=mysql://admin:Justecut1234@127.0.0.1:3306/bs441643?serverVersion=5.7

- Ask symfony load/update your database :
>php bin/console doctrine:migrations:migrate



##Lauch app

>php -S localhost:8000 -t public




##Database Mysql
- Connect to your mysql cli like :
> mysql -u [username] -p
- Your should create your user, pwd and database after you are connected
>CREATE USER 'newuser'@'localhost' IDENTIFIED BY 'password';
- You need to give right to your user created
>GRANT ALL PRIVILEGES ON * . * TO 'newuser'@'localhost';
- Now save it and exit
> FLUSH PRIVILEGES;
>exit;

