<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
</head>
<body>
<script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
</body>
</html>


<?php
error_reporting(E_ALL);
ini_set('display_errors','On');


    use ElephantIO\Client,
		ElephantIO\Engine\SocketIO\Version1X,
		ElephantIO\Exception\ServerConnectionFailureException;
	
	require __DIR__ . '/vendor/autoload.php';
	var_dump($_POST);
	echo json_encode($_POST);

	// $client = new ElephantIO\Client(
	// 	new ElephantIO\Engine\SocketIO\Version1X(
	// 		'https://localhost:3001'
	// 	)
	// );

	// $client = new Client(new Version1X('http://localhost:3001', [
	// 	'headers' => [
	// 		'X-My-Header: websocket rocks',
	// 		'Authorization: Bearer 12b3c4d5e6f7g8h9i'
	// 	]
	// ]));

	$client = new Client(new Version1X('http://localhost:3001'));

	// $client->initialize();
	// $client->emit('new_order', ['foo' => 'bar']);
	// $client->close();
		
	if(isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['message']) && !empty($_POST['message'])) {
		$message = array("name"=>$_POST['name'],"message"=>$_POST['message']);
		$client->initialize();
		$client->emit('new_message',$message);
		$client->close();
		
	}

	// $client = new Client(new Version1X('https://localhost:3001/?token=token', ['context' => ['ssl' => ['verify_peer_name' =>false, 'verify_peer' => false]]]));


	// try
	// {
	// 	$client->initialize();
	// 	echo "client-->";
	// 	$client->emit('new_order', ['foo' => 'bar']);
	// 	$client->close();
	// }
	// catch (ServerConnectionFailureException $e)
	// {
	// 	echo $e;
	// }
?>
