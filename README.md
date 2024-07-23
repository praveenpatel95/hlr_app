## About NEWS API

This is a REST API application HLR.

# Requirement #
 php : ^8.1

# Installation Instructions

Clone the repository:

```
git clone https://github.com/praveenpatel95/hlr_app.git
```
## Environment Setup
Change into project directory before running any commands
- `cd /hlr_app`
  
Rename the .env.example file .env
- `cp .env.example .env`
- Update News KEY ENV value
- Update database credentials or you can use mysqlLite


### Manual Setup
Update the database configuration in the .env file according to your local machine settings.
Install dependencies:
- `composer install`

Generate Key
Run `sail artisan key:generate` or `php artisan key:generate`

Passport Setup
Run `php artisan passport:install`


## Post Setup

- Run Migrations `php artisan migrate`
- Seed default data: `php artisan db:seed`
- Import excel `php artisan app:import-patient-data patients.csv`
  

## Postman Collection
Import the provided Postman collection (HLR Test API's.postman_collection) into your Postman application 
to interact with the API.

## Note for Postman
- base_url: Base URL of the API (e.g., http://localhost/api)
- authToken: Token for authentication (set automatically after login)
- Ensure that the authToken is set in the environment variables in Postman for authenticated requests.
  
## API Endpoints


Description: Checks the status of the API.

Auth 
#### Login: ####
Endpoint `POST {{base_url}}/login`
Body:
```json
{
 "email": "praveen@gmail.com",
 "password": "password"
}
```
Description: Logs in a user and sets a collection variable authToken with the token received.

#### Register: ####
Endpoint: `POST {{base_url}}/register`
Body:
```json
{
 "name": "Praveen",
 "email": "praveen@gmail.com",
 "password": "password",
 "password_confirmation": "password"
}
```
Description: Register as a new user.

#### Logout: ####
Endpoint: `POST {{base_url}}/logout`
Description: Logs out user.

#### Search Patient  ####
Endpoint: `POST {{base_url}}/patient/search`
```
Query Parameters:
    group: "A"
    date_range: "hair"
    fromDate: "2024-07-01 - 2024-07-5"
	
 ```

Description: Group (A-F).
