var Bot = require("slackbots");

var http = require("http");

var https = require("https");

var request = require('request');

var querystring = require('querystring');

var settings = {
  token: 'xoxb-330726448145-aaDzjb7hVtYwOpIY0ppmw79p',
  name: 'assignment7'
}

var bot = new Bot(settings);

//Start Function
bot.on(
  'start',
  function()
  {
    bot.postMessageToChannel(
      'general',
      'Welcome!\n' +
	  'Here are your available commands:\n' +
	  '1) How are you?\n' +
	  '2) Weather City [region]\n' +
	  '3) Define Word\n' +
	  '4) Joke\n' +
	  '     Joke [name]\n' +
	  '5) Random Fact\n' +
	  '     Random Quotes'
    );
  }
);

//Message Function
bot.on(
  'message',
  function(data)
  {
    console.log(data);

    if (data.bot_id === "B9QJCQ1J4") return ;

    if (data.type !== "message") return ; 


	//Command 1
	if (data.text.substr(0,12) == "How are you?")
	{
		var num = Math.floor(Math.random() * (8 - 0)) + 0;
		var msg = [ "Fine.", "Not bad.", "Fine, thanks.", "Very well, thanks.", "Pretty good.",
					"Great! How are you doing?", "I'm hanging in there.", "I've been better."];

		bot.postMessageToChannel(
		  'general',
		  msg[num]);  

		return;
	}

	//Command 2
	if (data.text.substr(0,7) == "Weather")
	{

		var place = data.text.substr(8);

		var myreq = {
		'q' : 'select * from weather.forecast where woeid in (select woeid from geo.places(1) where text="'+ place +'") and u="c"',
		'format'  : 'json',
		};

		var myreqstr = querystring.stringify(myreq);

		console.log(myreqstr);
		
		var options = { 
		method: 'get',
		host: 'query.yahooapis.com',
		path: '/v1/public/yql?' + myreqstr}; 

		callback = function(response) { 

		var str = ''; 
		response.on('data', function (chunk) { str += chunk; }); 

		response.on('end', function () 
		{ 
		  jsongeodata = JSON.parse(str);

		  bot.postMessageToChannel(
              'general',
			  "Weather Info for " + jsongeodata.query.results.channel.location.city + ", " + jsongeodata.query.results.channel.location.region + ", " + jsongeodata.query.results.channel.location.country +"\n" +
			  "Condition = " + jsongeodata.query.results.channel.item.condition.text + "\n" +
              "Temperature = " + jsongeodata.query.results.channel.item.condition.temp + " *C \n" +
			  "Humidity = " + jsongeodata.query.results.channel.atmosphere.humidity + "% \n" +
			  "Pressure = " + jsongeodata.query.results.channel.atmosphere.pressure + " mb \n" +
			  "Visibility = " + jsongeodata.query.results.channel.atmosphere.visibility + " km \n" +
			  "Wind Speed = " + jsongeodata.query.results.channel.wind.speed + " km/h \n");  
		});

		}

		http.request(options, callback).end();

      return ;

	}

	//Command 3
	if (data.text.substr(0,6) == "Define")
	{

		var word = data.text.substr(7);

		var options = { 
		host: 'od-api.oxforddictionaries.com',
		path: '/api/v1/entries/en/' + word,
		port: "443",
		method: 'GET',
		rejectUnauthorized: false,
		headers: {
		  "Accept": "application/json",
		  "app_id": "27b1fac9",
		  "app_key": "a3305636bd21f6e686cabd9c237109cb"
		}
		};

		callback = function(response) { 

		var str = ''; 
		response.on('data', function (chunk) { str += chunk; }); 

		response.on('end', function () 
		{ 
		  try {
			jsongeodata = JSON.parse(str);
		  }catch (e) {
			  bot.postMessageToChannel(
			  'general',
			   "No definitions found.");
			return console.error(e);
		  }

		  var definitions = '';
		  var senses = jsongeodata.results[0].lexicalEntries[0].entries[0].senses;
		  console.log(senses.length);
		  for(var i = 0; i < senses.length; i++){
			 definitions += '*' + (i+1) + '*. ' + senses[i].definitions + '.\n';
		  }
		  bot.postMessageToChannel(
			  'general',
			   definitions);

		});

		}

		https.request(options, callback).end();

		return ;
	}

	//Command 4
	if (data.text.substr(0,4) == "Joke")
	{
		var arg = data.text.substr(5);

		if(arg != ''){

			var myreq = {
			'firstName' : arg,
			'lastName': ''
			};

			var myreqstr = querystring.stringify(myreq);

			console.log(myreqstr);

			var options = { 
			method: 'get',
			host: 'api.icndb.com',
			path: '/jokes/random?escape=javascript&' + myreqstr}; 

			callback = function(response) { 

			var str = ''; 
			response.on('data', function (chunk) { str += chunk; }); 

			response.on('end', function () 
			{ 
			  jsongeodata = JSON.parse(str);
			  bot.postMessageToChannel(
				  'general',
				  jsongeodata.value.joke); 
			});

			}

			http.request(options, callback).end();


		}else{

			var options = { 
			method: 'get',
			host: 'api.icndb.com',
			path: '/jokes/random?escape=javascript'}; 

			callback = function(response) { 

			var str = ''; 
			response.on('data', function (chunk) { str += chunk; }); 

			response.on('end', function () 
			{ 
			  jsongeodata = JSON.parse(str);
			  bot.postMessageToChannel(
				  'general',
				  jsongeodata.value.joke); 
			});

			}

			http.request(options, callback).end();

		}

		return;
	}

	////Command 5
	if (data.text.substr(0,6) == "Random")
	{
		var arg = data.text.substr(7);

		if(arg == "Fact"){
			var num = Math.floor(Math.random() * (2 - 0)) + 0;

			console.log(num);
			if(num == 0){
				var options = { 
				method: 'get',
				host: 'numbersapi.com',
				path: '/random/trivia?json'}; 

				callback = function(response) { 

				var str = ''; 
				response.on('data', function (chunk) { str += chunk; }); 

				response.on('end', function () 
				{ 
				  jsongeodata = JSON.parse(str);

				  bot.postMessageToChannel(
					  'general',
					  jsongeodata.text);  
				});

				}

				http.request(options, callback).end();

			}else if (num == 1)
			{
				var options = { 
				method: 'get',
				host: 'cat-fact.herokuapp.com',
				path: '/facts/random'}; 

				callback = function(response) { 

				var str = ''; 
				response.on('data', function (chunk) { str += chunk; }); 

				response.on('end', function () 
				{ 
				  jsongeodata = JSON.parse(str);

				  bot.postMessageToChannel(
					  'general',
					  jsongeodata.text);  
				});

				}

				http.request(options, callback).end();
			}

		}else if(arg == "Quotes"){

			var options = { 
			method: 'get',
			host: 'quotesondesign.com',
			path: '/wp-json/posts?filter[orderby]=rand&filter[posts_per_page]=1'}; 

			callback = function(response) { 

			var str = ''; 
			response.on('data', function (chunk) { str += chunk; }); 

			response.on('end', function () 
			{ 
			  jsongeodata = JSON.parse(str);
			  var content = jsongeodata[0].content.replace(/<[^>]*>/g, '');

			  bot.postMessageToChannel(
				  'general',
				  content + ' - ' + jsongeodata[0].title);  
			});

			}

			http.request(options, callback).end();

		}else{
			bot.postMessageToChannel(
		     'general',
			  "Command not found.");  

		}

		return ;
	}

    bot.postMessageToChannel(
      'general',
      'Sorry I didnt get that.'
    );  
  
  }
);







