1. clon repository
2. run command docker-compose up
3. run   docker exec -i db  sh -c 'exec mysql -uroot -p"$MYSQL_ROOT_PASSWORD"' < database/scripts/create.sql  // create database
	if you want, i putted test_task.sql in directory database/scripts for import db and all tables. Then no need 6 and 7 steps
4. run 	docker exec -i db  sh -c 'exec mysql -uroot -p"$MYSQL_ROOT_PASSWORD"' < database/scripts/regfunctions.sql // register additionals functions for mysql
5. create copy of .env.example file and name it .env, then set setting what you need
6. run php artisan migrate // in you docker container
7. run php artisan db:seed // in you docker container
8. run sudo chmod -R 777 storage/
9. run sudo chmod -R 777 bootstrap/cache/



application address http://127.0.0.1:8080/public  for this settings