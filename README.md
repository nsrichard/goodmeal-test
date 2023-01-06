
## Instalation

Requirements:
```
composer
docker
docker-compose
```

Project structure:

- apps (apps folder)
    - backend (laravel app)
    - frontend (vuejs app)
- docker (config files)

You can run both projects without docker for this..
Install dependencies in the projects:
```
composer install
npm install
```
Etc..

If you continue with docker:
Edit the team's hosts file and add:

```
127.0.0.1 backend.local
127.0.0.1 frontend.local
```

Build and start docker:
```
docker-compose build && docker-compose up -d 
```

View: http://frontend.local
Documentation: http://backend.local/api/documentation
