export UID := $(shell id -u)
export GID := $(shell id -g)

DC := docker compose
RUN := $(DC) run --rm php

.DEFAULT_GOAL := help

.PHONY: help build install update test coverage phpcs phpstan ci shell

help: ## List the available targets
	@grep -hE '^[a-z-]+:.*?## ' $(MAKEFILE_LIST) \
		| awk 'BEGIN {FS = ":.*?## "}; {printf "  \033[36m%-10s\033[0m %s\n", $$1, $$2}'

build: ## Build the PHP image
	$(DC) build

install: ## Install composer dependencies inside the container
	$(RUN) composer install --no-interaction --no-progress --prefer-dist

update: ## Update composer dependencies inside the container
	$(RUN) composer update --no-interaction --no-progress --prefer-dist

test: ## Run the test suite
	$(RUN) vendor/bin/phpunit --testdox

coverage: ## Run the test suite and write an HTML report to coverage/
	$(RUN) vendor/bin/phpunit --coverage-html coverage --coverage-text

phpcs: ## Check the code style
	$(RUN) vendor/bin/phpcs

phpstan: ## Run static analysis
	$(RUN) vendor/bin/phpstan analyse

ci: phpcs phpstan test ## Run the full pipeline, as CI does

shell: ## Open a shell in the container
	$(RUN) sh