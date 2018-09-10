<?php

/*
///////////////////////////////////////////////
// GET All
//$service_url = 'http://localhost/api/customers/apple';  //GET All
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $service_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
curl_close($ch);

$d = json_decode($result,true);
echo "<pre>";
print_r($d);
echo "</pre>";
foreach($d as  $v) {
echo $v['first_name']." ". $v['last_name'] ."<br>";
}
*/

 

///////////////////////////////////////////////
// GET Only one
$service_url = 'http://localhost/api/customer/apple/1'; //GET only one
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $service_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
curl_close($ch);

$d = json_decode($result,true);
echo "<pre>";
print_r($d);
echo "</pre>";

echo $d['first_name']." ". $d['last_name'];



/*
//////////////////////////////////////////////////
//POST (Insert)
$service_url = 'http://localhost/api/customer/apple/add'; //POST
$data = array(
	"id"=>"",
	"first_name"=>"Satit4",
	"last_name"=>"Phayoune4",
	"phone"=>"333-333-3333",
	"email"=>"ssmith@yahoo.com",
	"address"=>"33 Birch Rd",
	"city"=>"Miami",
	"state"=>"FL"
	);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $service_url);
curl_setopt($ch, CURLOPT_POST, 1);// set post data to true
curl_setopt($ch, CURLOPT_POSTFIELDS,$data);   // post data
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
curl_close ($ch);

echo $result ;
*/


/*
//////////////////////////////////////////////////
//PUT (Update)
$service_url = 'http://localhost/api/customer/update/apple/5'; //PUT
$data = array(
	"id"=>"",
	"first_name"=>"Satit55",
	"last_name"=>"Phayoune55",
	"phone"=>"333-333-3333",
	"email"=>"ssmith@yahoo.com",
	"address"=>"33 Birch Rd",
	"city"=>"Miami",
	"state"=>"FL"
	);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $service_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));

$result = curl_exec($ch);
curl_close ($ch);

echo $result ;
*/


/*
///////////////////////////////////////////////
// DELETE Only one
$service_url = 'http://localhost/api/customer/delete/apple/6';  //DELETE
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $service_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
$result = curl_exec($ch);
curl_close($ch);

echo $result;

*/


?>
