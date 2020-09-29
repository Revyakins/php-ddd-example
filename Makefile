#Makefile

start :
	docker-compose up -d

build :
	docker-compose down
	docker-compose build
	docker-compose up -d