<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.7.3/socket.io.min.js"></script>
	<!-- <script src="//localhost:3001/socket.io/socket.io.js"></script> -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
	<title>Title</title>
</head>
<body>
<div class="container" id="container">
<div class="input-group mb-4">
  <input type="text" class="form-control" id="name" placeholder="Enter Name" aria-describedby="basic-addon2">
</div>
<div id="message_container">
<div class="card mb-4">
  <div class="card-body">
    <h4 class="card-title">Chat</h4>
    <p class="card-text">Message</p>
  </div>
</div>
</div>

<div class="input-group">
  <input type="text" class="form-control" id="message" placeholder="Message" aria-describedby="basic-addon2">
	<span class="input-group-btn">
    <button class="btn btn-default" type="button" onclick="send(event);">Send</button>
  </span>
</div>
</div>


<script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
<script>
	var socket = io.connect('//localhost:3001', { query: 's=12345' });

	console.log("message");
	
	socket.on("new_message",function(data){
		console.log("data-->",data)
		var message_div = `
		<div class="card mb-4">
  	<div class="card-body">
    <h4 class="card-title">${data.name}</h4>
    <p class="card-text">${data.message}</p>
  	</div>
		`;
		document.getElementById("message_container").innerHTML += message_div;
	})

function send(e){
	// console.log("clicked-->",e)
		e.preventDefault();
		var message = document.getElementById("message").value;
		var name = document.getElementById("name").value;
		// var data = {"name":name,"message":message};
		// console.log(data)
    var request = $.ajax({
			  type: "post",
        url: "http://localhost:8080/Socket2/emit_test.php",
				// data: JSON.stringify(data)
				data: {name:name,message:message}
				// dataType: 'JSON'
    });
    request.done(function (response, textStatus, jqXHR){
				console.log("Hooray, it worked!");
				document.getElementById("message").value = "";

				// console.log("response-->",response);
				// console.log("textStatus-->",textStatus);
				// console.log("jqXHR-->",jqXHR);
    });
    request.fail(function (jqXHR, textStatus, errorThrown){
        console.error(
            "The following error occurred: "+
            textStatus, errorThrown
        );
    });
}

</script>
</body>
</html>