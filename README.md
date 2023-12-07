# About
A Laravel-based API service for drug information search and user-specific medication tracking. \
The service is integrated with the National Library of Medicine's RxNorm APIs for drug data.

# Table of Contents
- [Installation](#installation)


# Installation:

After pulling from the repository
- Copy `.env.example` and paste as `.env`. Change anything such as port number or db configuration if you feel necessary

## Normal Installation
1. Run command: `composer install`
2. _(If needed)_, give storage permission: `chmod -R 777 storage`
3. Migrate database: `php artisan migrate`
4. Add JWT secret key: `php artisan jwt:secret`
5. Update `JWT_TTL` & `JWT_REFRESH_TTL` value in your `.env` file _(if you feel necessary)_

## Docker Installation
1. Copy `docker-compose.yml.example` and paste as `docker-compose.yml.`. Change anything such as port number or db configuration if you feel necessary
2. Run command: `docker compose up -d` \
   Or,
   3. Run command `docker compose build --no-cache` for a fresh build 
   4. Then, run command: `docker compose up -d`
5. Go to the bash script of the php related container: run commnad: `docker compose exec php bash`
   6. Change directory: `cd ../project/`
6. **Inside the container:**
    - To install composer packages, run command: `composer install`run command: `composer install`
    - _(If needed)_, give storage permission: `chmod -R 777 storage`
    - Add JWT secret key: `php artisan jwt:secret`
    - Migrate database: `php artisan migrate`



# Endpoints
1. **User Authentication Endpoints**
    - **Register User**:
        - Description: Allows new users to register.
        - Payload: **`name`**, **`email`**, **`password`**.
    - **Login User**:
        - Description: Allows users to log in.
        - Payload: **`email`**, **`password`**.
2. **Public Search Endpoint (Unauthenticated)**
    - **Description**: Search for drugs using the RxNorm “getDrugs” endpoint (from https://lhncbc.nlm.nih.gov/RxNav/APIs/RxNormAPIs.html).
    - **Parameters**: **`drug_name`** (string)
    - **Functionality**:
        - Use the “getDrugs” endpoint from the National Library of Medicine for tty = “SBD”.
        - Fetch the “name” of the top 5 results.
        - Additionally, use *getRxcuiHistoryStatus* API from National Library of Medicine to fetch:
            - All **`baseName`** under **`ingredientAndStrength`**.
            - Different **`doseFormGroupName`** from **`doseFormGroupConcept`**.
        - Return fields: rxcui (ID)**,** Drug name (string), Ingredient base names (array), Dosage form (array). // todo
