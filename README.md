Data Importer Service that consumes a webservice. Built on Laravel 5.4 and Doctrine with few testcases.

API endpoints:
/GET api/customers  - enlists all customers with fullname, email, country
/GET api/customers/{id} - enlist customer profile with fullname, email, username, gender, country, city and phone

/GET /getraw - returns the raw data as patterned with randomuser.api object elements; this serves as the localhost simulator of consuming the webservice instead of the randomuser API

CRON Job:
To execute the cron job:
php artisan schedule:run 
(App\Console\Commands\WebimporterCron)