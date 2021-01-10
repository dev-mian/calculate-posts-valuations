# Environtment configuration
- Clone the repository from: https://github.com/dev-mian/calculate-post-valuation on your Homestead
- Map in your host file the following fake url:
```
192.168.10.10	calculatepostvaluation.test
```
# Before starting application
- Rename .env.example to .env
- Run<br/>
```php
composer install
```

```php
npm install
```

```php
npm run dev
```
For scss and js code to be compiled

# Start the application
- Go to http://calculatepostvaluation.test/<br/>
Test assignment functionalities by clicking the provided button.
That should trigger a request for both generating and then download the requested .csv file.