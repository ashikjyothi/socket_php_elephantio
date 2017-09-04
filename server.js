var socket 	= require('socket.io'),
	express	= require('express'),
	https	= require('https'),
	http 	= require('http'),
	logger 	= require('winston');

logger.remove(logger.transports.Console);
logger.add(logger.transports.Console, { colorize: true, timestamp: true});
logger.info('SocketIO > listening on port ');


var app = express();
var http_server = http.createServer(app).listen(3001);
// http_server.listen(3001)

function emitNewOrder(http_server){
	var io = socket.listen( http_server );
	io.sockets.on('connection',function(socket){
		console.log("socket connection-->",socket.id)
		socket.on("new_order",function(data){
			io.emit("new_order",data)
		})
		socket.on("new_message",function(data){
			console.log("new_message-->",data)
			io.emit("new_message",data)
		})
	});
}

app.get('/', function (req, res) {
	console.log("GET")
	res.send('Hello World')
  })

emitNewOrder(http_server);

// var server     = require('http').createServer(),
// io         = require('socket.io')(server),
// logger     = require('winston'),
// port       = 3001;


// logger.remove(logger.transports.Console);
// logger.add(logger.transports.Console, { colorize: true, timestamp: true });
// logger.info('SocketIO > listening on port ' + port);

// io.on('connection', function (socket){
// logger.info('SocketIO > Connected socket ' + socket.id);

// socket.on('disconnect', function () {
// 	logger.info('SocketIO > Disconnected socket ' + socket.id);
// });

// socket.on('new_order', function (message) {
// 	logger.info('ElephantIO broadcast > ' + JSON.stringify(message));
// });
// });

// server.listen(port);