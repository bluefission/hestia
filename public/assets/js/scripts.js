/*!
* Start Bootstrap - Bare v5.0.7 (https://startbootstrap.com/template/bare)
* Copyright 2013-2021 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-bare/blob/master/LICENSE)
*/
// This file is intentionally blank
// Use this file to add JavaScript to your project
// 
// let lastResponseTimestamp = null;

// This function should be called whenever the chatbot sends a response
function onChatbotResponse() {
	console.log('Chatbot response received');
    lastResponseTimestamp = new Date();
    setTimeout(checkForNextResponse, 30000); // Wait for 30 seconds
}

function checkForNextResponse() {
    const currentTime = new Date();
    const timeSinceLastResponse = currentTime - lastResponseTimestamp;

    // If it's been at least 30 seconds since the last response
    if (timeSinceLastResponse >= 30000) {
        // Ping the BotMan chat service
        pingBotManChatService();
    }
}

function pingBotManChatService() {
    // Send a message to the chatbot to check if it's ready for the next response
    BotManWidget.say('ping');
}

// Listen for messages from the chatbot
document.addEventListener('botmanWidgetLoaded', function() {
    BotManWidget.on('response', function() {
        // Call this function when the chatbot sends a response
        onChatbotResponse();
    });
});
