# Onstate Challenge

1. I used php + mariadb for parsing shopify API and storing the data into mariadb.

As infrastructure I used an official Docker Composer for Laravel 7  https://hub.docker.com/r/bitnami/laravel
Which contains two containers one for laravel 7 and one for mysql. I added an other container for phpmyadmin exposed via port 8081 (http://localhost:8081)

2.	Install Docker and Docker compose:
      https://docs.docker.com/engine/install/
      https://docs.docker.com/compose/install/
   
3.	Then clone the source code from git https://github.com/YCHOUGRANI/onstate_api 
4.	Position to the onstate_api folder:    cd onstate_api

5.	Run Docker-composer up -d

6.	docker exec laravel php artisan migrate:fresh

8.  docker exec laravel php database/parse-products-list.php

I developed the script only for products but the principle is the same for other tables (categories, variants, options, images ....)
The php script parse-products-list.php : (populate the products table without duplication)
            a. First call the shopify API via curl
            b. Store the resultset into associate array $products_json_decode = json_decode($products_json, true);
            c. Loop through the associal array and for each record
                   1. check if the current record already exist into products table. 
                      $shopify_id = $product['id'];
	                    $sql_check_ref = " select shopify_id  from products  where shopify_id = $shopify_id  ";
                   2. If the record doesn't exist then insert into products table




