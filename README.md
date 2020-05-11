1. clone repository and get vendor directory from composer
2. create copy of .env.example file and name it .env, then set setting what you need
3. run command docker-compose up
4. run   docker exec -i dblar  sh -c 'exec mysql -uroot -p"$MYSQL_ROOT_PASSWORD"' < database/scripts/createdb.sql  // create database
	if you want, i putted test_task.sql in directory database/scripts for import db and all tables. Then no need 6 and 7 steps
5. run 	docker exec -i dblar  sh -c 'exec mysql -uroot -p"$MYSQL_ROOT_PASSWORD"' < database/scripts/regfunctions.sql // register additionals functions for mysql
6. run docker exec -i http-server sh -c 'exec php artisan migrate'
7. run docker exec -i http-server sh -c 'exec php artisan db:seed'
8. run sudo chmod -R 777 storage/
9. run sudo chmod -R 777 bootstrap/cache/



application address http://127.0.0.1:8080/public  for this settings
