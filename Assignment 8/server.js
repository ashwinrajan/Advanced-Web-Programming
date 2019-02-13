var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);


app.get('/auction', function(req, res) {
    res.sendFile(__dirname + '/auction.html');
});

app.get('/bidder', function(req, res) {
    res.sendFile(__dirname + '/bidder.html');
});

var topBid = 0;

io.on('connection', function(socket) {
    socket.on("submititem", function(itemdata) {

        topBid = parseFloat(itemdata.price);

        console.log("Item submitted: " + JSON.stringify(itemdata));

        socket.broadcast.emit("deliveritem", itemdata);

        var countdown = 30;
        var timer = setInterval(function() {

            countdown--;
            io.sockets.emit('timer', {
                countdown: "Time Remaining: " + countdown
            });

            if (countdown == 0) {
                io.sockets.emit('timer', {
                    countdown: "Auction complete"
                });
                clearInterval(timer);
            }
        }, 1000);

    });


    socket.on("submitNewBid", function(data) {

        var newBid = parseFloat(data.bid);

        if (newBid > topBid) {
            topBid = newBid;

            console.log(topBid);

            io.sockets.emit('topBid', {
                name: data.name,
                price: newBid
            });
        }
    });
});

http.listen(3000, function() {
    console.log('listening on *:3000');
});