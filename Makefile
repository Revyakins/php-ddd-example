#Makefile

start :
	docker-compose up -d
	docker-compose exec api php bin/console doctrine:migration:migrate

build :
	docker-compose down
	docker-compose build
	docker-compose up -d
	docker-compose exec api composer install
	docker-compose exec api php bin/console doctrine:migration:migrate

down :
	docker-compose down