$(document).ready(function () {

    var conn = null;
    var isConnected = false;

    
    connect();
   
    setInterval(function () {
        var msg = $("#message").val();
        if (msg) {
            conn.send(msg);
        }
    }, 500);


    function connect () {
        
        var uri = $("#server_ip").val();
        conn = new WebSocket(uri);
    }

       

        conn.onopen = function (e) {
            console.log(e);
            console.log("Connected");
            isConnected = true;
        };

        conn.onclose = function (e) {
            console.log("Disconnected");
            isConnected = false;
        };
    });


