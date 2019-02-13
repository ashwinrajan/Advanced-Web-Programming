var http = require('http');

var putoptions = {
  method: 'put',
  host: 'localhost',
  port: '3000',
  path: '/api'
}

var deleteoptions = {
  method: 'delete',
  host: 'localhost',
  port: '3000',
  path: '/api/2'
}

deletecallback = function(response)
{
  var str = "";
  response.on('data', function(chunk) { str += chunk; });
  response.on('end', function()
  {
    console.log(str);
  });
}

callback = function(response)
{
  var str = "";
  response.on('data', function(chunk) { str += chunk; });
  response.on('end', function()
  {
    console.log(str);

	http.request(deleteoptions,deletecallback).end();

  });
}

var putdata =
{"animal":[
			{"item" : "Dog", "description" : "Wags tail when happy", "price" : "250"},
			{"item" : "Rabbit", "description" : "Likes to eat carrots", "price" : "50"},
			{"item" : "Hamster", "description" : "Likes to eat lettuce", "price" : "5"}
		]
}

myreq = http.request(putoptions, callback);
myreq.write(JSON.stringify(putdata));
myreq.end();