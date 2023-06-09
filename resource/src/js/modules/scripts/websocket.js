var msgBox = $('#message-box');
var wsUri = "ws://".$host.":".$port."/php-ws/server.php"; 
var websocket = new WebSocket(wsUri); 

websocket.onopen = function(ev) {
    msgBox.append('<div class="system_msg" style="color:#bbbbbb">Welcome to my "Chat box"!</div>');
}
websocket.onmessage = function(ev) {
    var response	= JSON.parse(ev.data); 
    var res_type	= response.type;
    var user_message	= response.message;
    var user_name	= response.name;
    var user_color	= response.color;
    switch(res_type){
    case 'usermsg':
        msgBox.append('<div><span class="user_name" style="color:' + user_color + '">' + user_name + '</span> : <span class="user_message">' + user_message + '</span></div>');
        break;
        case 'system':
        msgBox.append('<div style="color:#bbbbbb">' + user_message + '</div>');
        break;
    }
    msgBox[0].scrollTop = msgBox[0].scrollHeight;
};

websocket.onerror	= function(ev){
    msgBox.append('<div class="system_error">Error Occurred - ' + ev.data + '</div>');
}; 
websocket.onclose	= function(ev){
    msgBox.append('<div class="system_msg">Connection Closed</div>');
}; 
$('#send-message').click(function(){
    send_message();
});

$( "#message" ).on( "keydown", function( event ) {
    if(event.which==13){
        send_message();
    }
});

function send_message(){
    var message_input = $('#message');	var name_input = $('#name'); 
    if(message_input.val() == ""){
        alert("Enter your Name please!");
        return;
    }
    if(message_input.val() == ""){
        alert("Enter Some message Please!");
        return;
    }
    var msg = {
        message: message_input.val(),
        name: name_input.val(),
        color : '<?php echo $colors[$color_pick]; ?>'
    };
    websocket.send(JSON.stringify(msg));
    message_input.val('');
}

export default websocket