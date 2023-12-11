# About
A Laravel-based API service for drug information search and user-specific medication tracking. \
The service is integrated with the National Library of Medicine's RxNorm APIs for drug data.

# Table of Contents
- [Installation](#installation)
  - [Common Task](#common-task)
  - [Normal Installation](#normal-installation)
  - [Docker Installation](#docker-installation)
- [Endpoints](#endpoints)
- [Unit tests](#unit-tests)
- [Rate Limit](#rate-limit)
- [Cache](#cache)


# Installation:

## Common Task
After pulling from the repository
- Copy `.env.example` and paste as `.env`. Change anything such as port number or db configuration if you feel necessary
- Redis and Database has 2 types of values for local and docker configuration, set according to your setup.

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
            - All `baseName` under `ingredientAndStrength`.
            - Different `doseFormGroupName` from `doseFormGroupConcept`.
        - Return fields: **rxcui (ID)**, **Drug name** (string), **Ingredient base names** (array), **Dosage form** (array).
3. **Private User Medication Endpoints** (Ensure that all endpoints below are authenticated)
    - **Endpoints**:
        - **Add Drug**:
            - Description: Add a new drug to the user's medication list.
            - Payload: `rxcui` (string)
            - Validation: Ensure `rxcui` is valid (using National Library of Medicine API).
            - **Note:** Here, it is assumed that the drug is already searched and added in our DB. 
        - **Delete Drug**:
            - Description: Delete a drug from the user's medication list.
            - Validation: Ensure `rxcui` is valid and exists in the user’s list.
        - **Get User Drugs**:
            - Description: Retrieve all drugs from the user's medication list.
            - Returns: Rx ID, Drug name, baseNames (ingredientAndStrength), doseFormGroupName (doseFormGroupConcept).


# Unit tests: 

- Run command: `php artisan config:cache --env=testing` (_either in docker container or in your local based on your setup_)
- then run: `php artisan migrate --env=testing`
- The above 2 commands will separate your testing DB from main DB
- Run each test file one by one in this sequel**, (_because we need `ACCESS_TOKEN` for some test file_):
- Run tests file in this sequel:
  - MedicineSearchTest, RegistrationTest, LoginTest, AddMedicationTest, GetMedicationsTest, DeleteMedicationTest
- To run a single test file, run with filepath, like, : `php artisan test tests/Unit/RegistrationTest.php`


# Rate Limit

- Rate limiter is applied for all routes except registration in `routes/api.php`
  - Right now, it is 60 attempts per minute
  - The values are taken from env value, you can update as you need
- A custom exception handler (`ThrottleExceptionHandler`) is used to handle the error response
- Also, **Logged the route path** with error message in the storage file to identify the specific route

# Cache

- Redis cache is applied:
  - **In medicine search and store route:** when a medicine is successfully added in DB, the `drug_name` will be stored in redis. So that later, wont have to search for the same drug
  - **In Login unit test:** to store the access token, in order to use that token by other unit test class where the authentication token is needed.

# Error Log
- Error logs are generated in daily log file inside `storage/log`, so that it can be separated for each day 
- The file names are like this, `laravel-2023-12-10.log`
