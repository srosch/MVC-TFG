.DEFAULT_GOAL:=help
DOCKER_COMPOSE?=docker-compose -f docker-compose.yml -f docker-compose.override.yml -f docker-compose.swagger.yml
DOCKER_COMPOSE_DEPLOY=docker-compose -f docker-compose.yml
DEFAULT_CONTAINER=backend-mvc

.PHONY: help
help: ## Displays all available targets
	@awk 'BEGIN {FS = ":.*##"; printf "\nUsage:\n  make \033[36m<target>\033[0m\n\nTargets:\n"} /^[a-zA-Z_-]+:.*?##/ { printf "  \033[36m%-15s\033[0m %s\n", $$1, $$2 }' $(MAKEFILE_LIST)

.PHONY: build
build: ## Build the Docker images and volumes
	docker volume create --name=mvc-web_vendor
	$(DOCKER_COMPOSE) build --force-rm --parallel

.PHONY: start
start: ## Prepare the external Docker services and then the internal ones
	$(DOCKER_COMPOSE) up -d mongo-mvc mailhog-mvc
	$(DOCKER_COMPOSE) up -d

.PHONY: stop
stop: ## Stop the external Docker services and then the internal ones
	$(DOCKER_COMPOSE) down

.PHONY: unit-test
unit-test: ## Runs the unit test ej: make path=pathTest.php unit-test
	$(call run_test,$(path),$(DEFAULT_CONTAINER))

.PHONY: unit-tests
unit-tests: ## Runs the unit tests
	$(call run_tests,unit,,$(DEFAULT_CONTAINER))

.PHONY: clean
clean: ## Turn off running Docker Compose services and remove volumes and images
	$(DOCKER_COMPOSE) down --rmi all -v --remove-orphans -t 180

define run_test
    $(DOCKER_COMPOSE) run --rm --entrypoint "vendor/bin/simple-phpunit --configuration phpunit.xml.dist $(1)" $(2)
endef

define run_tests
    $(DOCKER_COMPOSE) run --rm --entrypoint "vendor/bin/simple-phpunit --configuration phpunit.xml.dist --testsuite $(1)/$(2)" $(3)
endef
