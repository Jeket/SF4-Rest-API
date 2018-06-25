[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/woprrr/SF4-Rest-API/badges/quality-score.png?b=DDD-structure)](https://scrutinizer-ci.com/g/woprrr/SF4-Rest-API/?branch=DDD-structure)

# Symfony 4 skeleton docker
Symfony 4 starter-kit for multi container stack.

## Run the application

1. run application
    ```
    docker-compose up -d
    ````
2. Load Fixtures
    ```
    docker-compose exec -T php bin/console doctrine:fixtures:load
    ```
