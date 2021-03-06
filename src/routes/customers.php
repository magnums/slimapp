<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

$app -> options('/{routes:.+}', function($request, $response, $args) {
	return $response;
});
/*
$app -> add(function($req, $res, $next) {
$response = $next($req, $res);
return $response -> withHeader('Access-Control-Allow-Origin', '*') -> withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization') -> withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});
*/

$app -> add(function($req, $res, $next) {
	$response = $next($req, $res);
	return $response -> withHeader('Content-Type', 'application/json') -> withHeader('Access-Control-Allow-Origin', '*') -> withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization') -> withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});


// Get All Customers
$app -> get('/api/customers/{api}', function(Request $request, Response $response) {

	$api = $request -> getAttribute('api');
	$tools = new tools();
	$apiallow = $tools -> checkapi($api);

	if ($apiallow == true) {

		$sql = "SELECT * FROM customers";

		try {
			// Get DB Object
			$db = new db();
			// Connect
			$db = $db -> connect();

			$stmt = $db -> query($sql);
			$customers = $stmt -> fetchAll(PDO::FETCH_OBJ);
			$db = null;
			
			//echo json_encode($customers);
			
			
			$data = json_encode($customers);
			return $data ;
			
			
		} catch(PDOException $e) {
			echo '{"error": {"text": ' . $e -> getMessage() . '}';
		}

	} else {
		echo '{"error": {"text": You are not Allow!!!}';
	}

});

// Get Single Customer
$app -> get('/api/customer/{api}/{id}', function(Request $request, Response $response) {

	$api = $request -> getAttribute('api');
	$id = $request -> getAttribute('id');

	$tools = new tools();
	$apiallow = $tools -> checkapi($api);

	if ($apiallow == true) {

		$sql = "SELECT * FROM customers WHERE id = $id";

		try {
			// Get DB Object
			$db = new db();
			// Connect
			$db = $db -> connect();

			$stmt = $db -> query($sql);
			$customer = $stmt -> fetch(PDO::FETCH_OBJ);
			$db = null;
			
			
			//echo json_encode($customer);
			
			$data = json_encode($customer);
			return $data ;
			
			
		} catch(PDOException $e) {
			echo '{"error": {"text": ' . $e -> getMessage() . '}';
		}

	} else {
		echo '{"error": {"text": You are not Allow!!!}';
	}
});

// Add Customer
$app -> post('/api/customer/{api}/add', function(Request $request, Response $response) {
		
	$api = $request -> getAttribute('api');
	$tools = new tools();
	$apiallow = $tools -> checkapi($api);

	if ($apiallow == true) {	
	

		$first_name = $request -> getParam('first_name');
		$last_name = $request -> getParam('last_name');
		$phone = $request -> getParam('phone');
		$email = $request -> getParam('email');
		$address = $request -> getParam('address');
		$city = $request -> getParam('city');
		$state = $request -> getParam('state');
	
		$sql = "INSERT INTO customers (first_name,last_name,phone,email,address,city,state) VALUES
	    (:first_name,:last_name,:phone,:email,:address,:city,:state)";
	
		try {
			// Get DB Object
			$db = new db();
			// Connect
			$db = $db -> connect();
	
			$stmt = $db -> prepare($sql);
	
			$stmt -> bindParam(':first_name', $first_name);
			$stmt -> bindParam(':last_name', $last_name);
			$stmt -> bindParam(':phone', $phone);
			$stmt -> bindParam(':email', $email);
			$stmt -> bindParam(':address', $address);
			$stmt -> bindParam(':city', $city);
			$stmt -> bindParam(':state', $state);
	
			$stmt -> execute();
	
			echo '{"notice": {"text": "Customer Added"}';
	
		} catch(PDOException $e) {
			echo '{"error": {"text": ' . $e -> getMessage() . '}';
		}
		
	} else {
		echo '{"error": {"text": You are not Allow!!!} : ';
	}	
		
		
});

// Update Customer
$app -> put('/api/customer/update/{api}/{id}', function(Request $request, Response $response) {

	$id = $request -> getAttribute('id');
	$api = $request -> getAttribute('api');
	
	$tools = new tools();
	$apiallow = $tools -> checkapi($api);

	if ($apiallow == true) {
					
		$first_name = $request -> getParam('first_name');
		$last_name = $request -> getParam('last_name');
		$phone = $request -> getParam('phone');
		$email = $request -> getParam('email');
		$address = $request -> getParam('address');
		$city = $request -> getParam('city');
		$state = $request -> getParam('state');
	
		$sql = "UPDATE customers SET
					first_name 	= :first_name,
					last_name 	= :last_name,
	                phone		= :phone,
	                email		= :email,
	                address 	= :address,
	                city 		= :city,
	                state		= :state
				WHERE id = $id";
	
		try {
			// Get DB Object
			$db = new db();
			// Connect
			$db = $db -> connect();
	
			$stmt = $db -> prepare($sql);
	
			$stmt -> bindParam(':first_name', $first_name);
			$stmt -> bindParam(':last_name', $last_name);
			$stmt -> bindParam(':phone', $phone);
			$stmt -> bindParam(':email', $email);
			$stmt -> bindParam(':address', $address);
			$stmt -> bindParam(':city', $city);
			$stmt -> bindParam(':state', $state);
	
			$stmt -> execute();
	
			echo '{"notice": {"text": "Customer Updated"}';
	
		} catch(PDOException $e) {
			echo '{"error": {"text": ' . $e -> getMessage() . '}';
		}
		
	} else {
		echo '{"error": {"text": You are not Allow!!!} : ';
	}
		
});

// Delete Customer
$app -> delete('/api/customer/delete/{api}/{id}', function(Request $request, Response $response) {
		
	$api = $request -> getAttribute('api');
	$id = $request -> getAttribute('id');
	
	$tools = new tools();
	$apiallow = $tools -> checkapi($api);

	if ($apiallow == true) {
			
		$sql = "DELETE FROM customers WHERE id = $id";
	
		try {
			// Get DB Object
			$db = new db();
			// Connect
			$db = $db -> connect();
	
			$stmt = $db -> prepare($sql);
			$stmt -> execute();
			$db = null;
			echo '{"notice": {"text": "Customer Deleted"}';
		} catch(PDOException $e) {
			echo '{"error": {"text": ' . $e -> getMessage() . '}';
		}
	} else {
		echo '{"error": {"text": You are not Allow!!!}'. $api;
	}
		
	
});
