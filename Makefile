include .env

MYSQL_DUMPS_DIR=./.shared/

help:
	@echo ""
	@echo "usage: make COMMAND"
	@echo ""
	@echo "up: starta os containers docker"
	@echo "down: para os containers docker"
	@echo "roda: os testes automatizados"
	@echo "back: acessa o container do backend"
	@echo "frontend: acessa o container do frontend"

up: 
	docker compose up -d
down: 
	docker compose down
test: 
	docker compose exec app php artisan test
back: 
	docker compose exec app bash
frontend:
	docker compose exec front bash

