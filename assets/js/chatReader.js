$(document).ready(function () {

    var conn = null;
    var isConnected = false;


    connect();

    function connect () {
        
        var uri = $("#server_ip").val();
        conn = new WebSocket(uri);
    };

    conn.onmessage = function (e) {

        // replace the contents of the div with the link text

        var chat = $("#chatTarget");
        var html = e.data.replace(/\n/g, "<br>");
        chat.html(html);
    };

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