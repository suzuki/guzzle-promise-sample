var http = require('http');
var sleep = require('sleep-async')();

var server = http.createServer();
var sleepMiliSecond = 1000;

server.on('request', function(req, res) {
  console.log('Received.');

  sleep.sleep(sleepMiliSecond, function() {
    res.writeHead(200, {'Content-Type': 'text/json'});
    res.write('{"status": "ok"}');
    res.end();
  });
});

server.listen(8008, 'localhost');
