<?php

ini_set('max_execution_time', 6 * 60);
date_default_timezone_set('Europe/London');
header('Content-type: text/html; charset=utf-8');

$message = shell_exec("/bin/bash /app/database/get-products.sh");
$products_json = utf8_encode(file_get_contents("/app/database/products.json"));
$products_json_decode = json_decode($products_json, true);

$mysqli = new mysqli("mariadb", "onstate_db", "summer2020", "onstate_db");

// Check connection
if ($mysqli->connect_errno) {
	echo "Failed to connect to MySQL: " . $mysqli->connect_error;
	exit();
}

foreach ($products_json_decode['products'] as $product) {
	$is_product_exists = false;
	$shopify_id = $product['id'];
	$sql_check_ref = " select shopify_id  from products  where shopify_id = $shopify_id  ";
	//echo "\n" . $sql_check_ref;
	$result = $mysqli->query($sql_check_ref);

	// Associative array
	while ($row = $result->fetch_assoc()) {
		$is_product_exists = true;
		echo "exist";
	}
	// Free result set
	//$result->free_result();

	if (!$is_product_exists) {
		// prepare and bind
		$ls_sql_prepare  = "INSERT INTO products (shopify_id, vendor, title, body_html, created_at, handle, published_scope, ";
		$ls_sql_prepare .= " status, updated_at, template_suffix, tags, admin_graphql_api_id)  ";
		$ls_sql_prepare .= "  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

		if ($stmt = $mysqli->prepare($ls_sql_prepare)) {

			$stmt->bind_param("issssssssssi", $ls_shopify_id, $ls_vendor, $ls_title, $ls_body_html, $ls_created_at, $ls_handle, $ls_published_scope, $ls_status, $ls_updated_at, $ls_template_suffix, $ls_tags, $ls_admin_graphql_api_id);
			// set parameters and execute
			$ls_shopify_id = $product['id'];
			$ls_vendor = $product['vendor'];
			$ls_title = $product['title'];
			$ls_body_html = $product['body_html'];
			//$ls_product_type = $product['product_type'];
			$ls_created_at = $product['created_at'];
			$ls_handle = $product['handle'];
			$ls_published_scope = $product['published_scope'];
			$ls_status = $product['status'];
			$ls_updated_at = $product['updated_at'];
			$ls_template_suffix = $product['template_suffix'];
			$ls_tags = $product['tags'];
			$ls_admin_graphql_api_id = $product['admin_graphql_api_id'];

			$stmt->execute();
		} else {
			print_r($mysqli->error);
		}
	}
}
