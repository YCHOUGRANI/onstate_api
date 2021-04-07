#!/bin/bash

#curl https://chris-r-plus-sandbox.myshopify.com/admin/api/2021-04/products.json \
#          --header 'Content-Type: application/json' \
#          --header 'Accept: application/json' \
#          --header 'Authorization: Basic Nzg3ZjFlMGJmMDJhYzMzNjdhY2NjYjFlNDkyYzY0ZTY6MDY3N2JmODMyMjIyOWRlNjY5OWQzZDRjYmIwNmNjZGE=' > products.json

curl https://787f1e0bf02ac3367acccb1e492c64e6:0677bf8322229de6699d3d4cbb06ccda@chris-r-plus-sandbox.myshopify.com/admin/api/2021-04/products.json \
          --header 'Content-Type: application/json' \
          --header 'Accept: application/json'  > ./products.json
