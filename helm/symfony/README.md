Build the PHP and Nginx Docker images:
```
docker build -t gcr.io/symfony-movie-api/php -t gcr.io/symfony-movie-api/php:latest symfony
docker build -t gcr.io/symfony-movie-api/nginx -t gcr.io/symfony-movie-api/nginx:latest -f symfony/Dockerfile.nginx symfony
docker build -t gcr.io/symfony-movie-api/varnish -t gcr.io/symfony-movie-api/varnish:latest -f symfony/Dockerfile.varnish symfony
```
Push your images to your Docker registry, example with Google Container Registry:
```
gcloud docker -- push gcr.io/symfony-movie-api/php
gcloud docker -- push gcr.io/symfony-movie-api/nginx
gcloud docker -- push gcr.io/symfony-movie-api/varnish
```

Deploy your API to the container:

```
helm install helm/symfony --namespace=symfony --name sf \
    --set php.repository=gcr.io/symfony-movie-api/php \
    --set nginx.repository=gcr.io/symfony-movie-api/nginx \
    --set secret=woprrr \
    --set postgresql.postgresPassword=symfony \
    --set postgresql.persistence.enabled=true \
    --set corsAllowUrl='^https?://[a-z\]*\.movies-local.com$'
```
