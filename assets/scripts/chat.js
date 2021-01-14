$(document).ready(function () {
    var conn = null;
    var isConnected = false;

    $(function () {
        setOffline();
    });

    function setOnline() {
        $("#status").removeClass("label-warning");
        $("#status").addClass("label-success");
        $("#status").html("Connected");
        $("button.connect").html("Disconnect");
        $("#offlineActions").hide();
        $("#onlineActions").show();
        isConnected = true;
    }

    function setOffline() {
        $("#status").addClass("label-warning");
        $("#status").removeClass("label-success");
        $("#status").html("Disconnected");
        $("button.connect").html("Connect");
        $("#offlineActions").show();
        $("#onlineActions").hide();
        isConnected = false;
    }

    $('#send').click(function(){
        msg = $("#message").val();
        if (msg == "") {
            alert("Can't send an empty message");
            return;
        }
        conn.send(msg);
        $("#chatTarget").prepend("Me: " + msg + "<br/>");
        $("#message").val("");
    });


    $('#connect').click(function(){
        var uri = $("#conn_str").val();
        if (isConnected) {
            setOffline();
            return;
        }
        conn = new WebSocket(uri);

        conn.onmessage = function (e) {
            $("#chatTarget").prepend("Not me: " + e.data + "<br/>");
        }

        conn.onopen = function (e) {
            console.log(e);
            setOnline();
            console.log("Connected");
            isConnected = true;
        };

        conn.onclose = function (e) {
            console.log("Disconnected");
            setOffline();
        };

    });
});

