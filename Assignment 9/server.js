var sqlite3 = require("sqlite3").verbose();
var db = new sqlite3.Database("assignment9.db");
var express = require('express');
var app = express();

db.serialize(function(){

  db.run("DROP TABLE IF EXISTS Items");
  db.run("CREATE TABLE Items (item TEXT, description TEXT, price INTEGER)");

});

app.get("/api",
  function(req,res)
  {
    console.log("GET REQUEST RECEIVED");

  	db.all("SELECT rowid as id, item, description, price FROM Items",
  		   function(err, results)
  		   {
             console.log(JSON.stringify(results));
             res.send(JSON.stringify(results));
  		   });
  });

app.get("/api/:id",
  function(req,res)
  {
    console.log("GET REQUEST RECEIVED");

  	db.all("SELECT rowid as id, item, description, price FROM Items Where rowid=" + req.params.id,
  		   function(err, results)
  		   {
             console.log(JSON.stringify(results));
             res.send(JSON.stringify(results));
  		   });
  });


app.put("/api",
  function(req,res)
  {
  	console.log("PUT REQUEST RECEIVED");

    var str = "";
    req.on("data", function(chunk) { str += chunk;});
    req.on("end", function() { 
 
      var reqObj = JSON.parse(str);

      console.log(reqObj);

	  db.run("DELETE FROM Items");

      db.serialize(function() {

        var stmt = db.prepare("INSERT INTO Items (item, description, price)  VALUES (?,?,?)");

		for(i = 0; i < reqObj.animal.length; i++){

			stmt.run(reqObj.animal[i].item,
        	         reqObj.animal[i].description,
        	         reqObj.animal[i].price);
		}

        stmt.finalize();

        res.send("ITEM UPDATED");
      });

    });

  });

app.put("/api/:id",
  function(req,res)
  {
  	console.log("PUT REQUEST RECEIVED");

    var str = "";
    req.on("data", function(chunk) { str += chunk;});
    req.on("end", function() { 
 
      var reqObj = JSON.parse(str);

      console.log(str);

      db.serialize(function() {
        var stmt = db.prepare("UPDATE Items set item=(?), " +
        	                    "description=(?), price=(?) WHERE " +
        	                    "rowid=" + req.params.id);
        stmt.run(reqObj.item,
        	     reqObj.description,
        	     reqObj.price);

        stmt.finalize();

        res.send("ITEM UPDATED");
      });

    });

  });

app.delete("/api", 
  function(req,res)
  {
  	console.log("DELETE REQUEST RECEIVED");

    db.run("DELETE FROM Items");
    res.send("COLLECTION DELETED");
  });

app.delete("/api/:id", 
  function(req,res)
  {
  	console.log("DELETE REQUEST RECEIVED");

    db.run("DELETE FROM Items WHERE rowid=" + req.params.id);
    res.send("COLLECTION DELETED");
  });

app.post("/api",
  function(req,res)
  {
  	console.log("POST REQUEST RECEIVED");

    var str = "";
    req.on("data", function(chunk) { str += chunk;});
    req.on("end", function() { 
 
      var reqObj = JSON.parse(str);

      console.log(str);

      db.serialize(function() {
        var stmt = db.prepare("INSERT INTO Items (item, description, price)  VALUES (?,?,?)");
        stmt.run(reqObj.item,
        	     reqObj.description,
        	     reqObj.price);

        stmt.finalize();

        res.send("ITEM INSERTED");
      });

    });

  }); 


var server = app.listen(3000, function(){
  console.log("RESTful API listening on port 3000!")
});
