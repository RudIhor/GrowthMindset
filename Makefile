.DEFAULT_GOAL := help

dc := docker-compose
de := $(dc) exec

SHELL := /bin/bash

.PHONY: help
help: ## Display help
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' Makefile | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

.PHONY: dm
dm: ## Drop merged branches
	git checkout master && git branch --merged | grep -v \* | xargs git branch -D

.PHONY: up
up: ## Start application
	$(dc) up -d --build

.PHONY: down
down: ## Stop application
	$(dc) down

.PHONY: php
php: ## Go into php console
	$(de) php /bin/bash

.PHONY: web
web: ## Go into web console
	$(de) web /bin/bash

.PHONY: db
db: ## Go into db console
	$(de) db /bin/bash

.PHONY: restart
restart: ## Restart application
	$(dc) down; $(dc) up -d --build
