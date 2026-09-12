#!/bin/sh
SHELL = /bin/sh # Use sh syntax

# ARGUMENT - ENV
ifndef ENV
ENV = dev
else
ENV = $(ENV)
endif

ifeq ($(ENV),dev)
BIN_PHP = php
ENVIRONMENT = develop
else ifeq ($(ENV),staging)
BIN_PHP = php
ENVIRONMENT = staging
else ifeq ($(ENV),preprod)
BIN_PHP = php
ENVIRONMENT = preproduction
else ifeq ($(ENV),prod)
BIN_PHP = php
ENVIRONMENT = production
else
$(error ENV argument is required : dev|staging|preprod|prod)
endif

# VARIABLES
SYMFONY_CONSOLE = $(BIN_PHP) bin/console
APP_NAME = boerbull_mvc
DOMAIN = $(APP_NAME).fr
ENVIRONMENT_TEST = test

ifeq ($(OS), Windows_NT)
	CURRENT_UID = $(cmd id -u)
	CURRENT_GID = $(cmd id -g)
else
	CURRENT_UID = $(shell id -u)
	CURRENT_GID = $(shell id -g)
endif

# EXEC
EXEC_CONTAINER = docker exec -it -u $(CURRENT_UID):$(CURRENT_GID)

# RUN
## www_app from docker-compose.yml
RUN_APP = docker-compose run --rm -u $(CURRENT_UID):$(CURRENT_GID) www_app
RUN_NODE = docker-compose run --rm -u $(CURRENT_UID):$(CURRENT_GID) node_app

# HELP
.DEFAULT_GOAL = help

# Display the list commands whit the command "make"
ifeq ($(OS), Windows_NT)
help:
	@echo "/!\ Make help is disabled on windows /!\ ";
.PHONY: help
else
help:
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'
.PHONY: help
endif

##-----------------------------------------
## DOCKER
##-----------------------------------------

start: ## start application containers
	make docker-start

stop: ## Stop application containers
	make docker-stop

build: ## Build and rebuild application containers
	make docker-build

run: ## run Docker in the background
	make docker-run
	@echo "Accès au projet en local sur : http://127.0.0.1:8971/"
	@echo "Accès au PHPMyAdmin du projet en local sur : http://127.0.0.1:8080/"
	@echo "Accès au MailDev du projet en local sur : http://127.0.0.1:8081/"

down: ## stop and delete all containers, networks, and volumes associated with a Docker Compose project. Limited to the specific project
	make docker-down

docker-build: ## Build and rebuild application containers
	docker-compose build

docker-start: ## start application containers
	docker-compose start

docker-stop: ## Stop application containers
	docker-compose stop

docker-exec-php: ## Enter into the sh of PHP
	docker exec -it boerbull_mvc_www sh

docker-exec-node: ## Enter into the sh of Node
	docker exec -it boerbull_mvc_node sh

docker-run: ## run Docker in the background
	docker-compose up -d

docker-down: ## stop and delete all containers, networks, and volumes associated with a Docker Compose project. Limited to the specific project
	docker-compose down

docker-compose: ## Generate docker-composer.yml file
docker-compose: docker-compose.yml.dist
	@if [ -f docker-compose.yml ]; then \
	    echo 'docker-compose.yml already exists'; \
	else \
	    echo cp docker-compose.yml.dist docker-compose.yml; \
	    cp docker-compose.yml.dist docker-compose.yml; \
	fi

##-----------------------------------------
## RUN & EXEC cli
##-----------------------------------------

container-php: ## Go into app container to run command (ex: composer require, bin/console, etc)
	$(EXEC_CONTAINER) $(APP_NAME)_www /bin/sh

container-php-2: ## Create temporary container of app
	$(RUN_APP) /bin/sh

container-node: ## Create temporary container of node
	$(RUN_NODE) /bin/sh

##-----------------------------------------
## ENV
##-----------------------------------------

generate-env-files: ## Generate env files
generate-env-files: generate-env

ifeq ($(OS), Windows_NT)
generate-env: ## Generate .env (windows)
generate-env: app/.env.dist
	@if exist .env; then \
		echo '.env already exists';\
	else \
		echo cp .env.dist .env;\
		cp .env.dist .env;\
  	fi
else
generate-env: ## Generate .env (unix)
generate-env: app/.env.dist
	@if [ -f .env ]; then \
		echo '.env already exists';\
	else \
		echo cp .env.dist .env;\
		cp .env.dist .env;\
  	fi
endif

generate-app-env-files: ## Generate env files (application)
generate-app-env-files:
	cd app && make generate-env-files

# ----------------------------------------

generate-root-env-files-root: ## Generate env files
generate-root-env-files-root: generate-root-env

ifeq ($(OS), Windows_NT)
generate-root-env: ## Generate root .env (windows)
generate-root-env: .env.dist
	@if exist .env; then \
		echo '.env already exists';\
	else \
		echo cp .env.dist .env;\
		cp .env.dist .env;\
  	fi
else
generate-root-env: ## Generate root .env (unix)
generate-root-env: .env.dist
	@if [ -f .env ]; then \
		echo '.env already exists';\
	else \
		echo cp .env.dist .env;\
		cp .env.dist .env;\
  	fi
endif

generate-root-env-files: ## Generate root env files (root)
generate-root-env-files:
	make generate-root-env-files-root

##-----------------------------------------
## END
##-----------------------------------------