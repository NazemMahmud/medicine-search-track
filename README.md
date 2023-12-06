# About
A Laravel-based API service for drug information search and user-specific medication tracking. \
The service is integrated with the National Library of Medicine's RxNorm APIs for drug data.

# Table of Contents
- [Installation](#installation)


# Installation:

After pulling from the repository
- Copy `.env.example` and paste as `.env`. Change anything such as port number or db configuration if you feel necessary

## Normal Installation
- run command: `composer install`
- _(If needed)_, give storage permission: `chmod -R 777 storage`

## Docker Installation
- Copy `docker-compose.yml.example` and paste as `docker-compose.yml.`. Change anything such as port number or db configuration if you feel necessary
- Run command: `docker compose up -d`
- Or, 
  - Run command `docker compose build --no-cache` for a fresh build
  - Then, run command: `docker compose up -d`
- Go to the bash script of the php related container: run commnad: `docker compose exec php bash`
- **Inside the container:**
    - To install composer packages, run command: `composer install`run command: `composer install`
    - _(If needed)_, give storage permission: `chmod -R 777 storage`
