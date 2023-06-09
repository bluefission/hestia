import BlueFissionAPI from "./bluefission-api.js"
import { Terminal } from 'xterm';
import { FitAddon } from 'xterm-addon-fit';
import { AttachAddon } from 'xterm-addon-attach';

const terminal = new Terminal();
const fitAddon = new FitAddon();
let socket;
let attachAddon;

//== Class definition
var ModuleTerminal = function() {

	var onLoad = function() {
		app.assign('connection_state', function() { return socket.readyState });
	}

	var readyTerminal = function() {
		var curr_line = '';
		var entries = [];
		var currPos = 0;
		var pos = 0;

        terminal.open(document.getElementById('terminal'));

        terminal.loadAddon(fitAddon);
        fitAddon.fit();

        // Create the WebSocket and attach the addon after the socket is opened
        socket = new WebSocket('ws://localhost:8080'); // Adjust the URL to match your WebSocket server
        socket.addEventListener('open', (event) => {
            attachAddon = new AttachAddon(socket);
            terminal.loadAddon(attachAddon);
        });

        // Add event listener for the message event
        socket.addEventListener('message', (event) => {
            const response = event.data;
            // terminal.write(`\n\u001b[32mresponse> \u001b[37m${response}\n\u001b[32muser> \u001b[37m${curr_line}`);
            terminal.write(`${response}`);
	        terminal.prompt();
        });

        terminal.prompt = () => {
            terminal.write('\r\n\u001b[32muser> \u001b[37m');
        };
        terminal.write('Welcome to BlueFission Opus!');
        terminal.prompt();
        terminal.focus();

        const terminalInput = document.getElementById('terminal-input');

        let messageQueue = [];

		function send(socket, message) {
		    if (socket.readyState === WebSocket.CONNECTING) {
		        // If the WebSocket is still connecting, add the message to the queue
		        messageQueue.push(message);
		    } else if (socket.readyState === WebSocket.OPEN) {
		        // If the WebSocket is open, send the message and any queued messages
		        while (messageQueue.length > 0) {
		            socket.send(messageQueue.shift());
		        }
		        socket.send(message);
		    } else {
		        // If the WebSocket is closed, show an error
		        console.error('WebSocket is not open.');
		    }
		}

		terminalInput.addEventListener('input', () => {
		    const value = terminalInput.value;
		    terminalInput.value = '';
		    curr_line += value;
		    terminal.write(value);
		});

		terminalInput.addEventListener('keydown', (e) => {
			let cursorPosition = curr_line.length;

		    if (e.key === 'Enter') {
		        e.preventDefault();
		        // terminal.prompt();
		        terminal.write('\r\n');
		        // socket.send(curr_line); // Send input to the socket
		        send(socket, curr_line);
		        curr_line = '';
		    } else if (e.key === 'Backspace') {
		        e.preventDefault();
		        if (curr_line.length > 0) {
		            curr_line = curr_line.slice(0, -1);
		            terminal.write('\b \b');
		        }
		    } else if (e.key === 'ArrowUp') {
		        e.preventDefault();
		        if (entries.length > 0) {
		            if (currPos > 0) {
		                currPos -= 1;
		            }
		            curr_line = entries[currPos];
		            terminal.write(`\x1b[2K\x1b[G\u001b[32muser> \u001b[37m${curr_line}`);
		        }
		    } else if (e.key === 'ArrowDown') {
		        e.preventDefault();
		        currPos += 1;
		        if (currPos === entries.length || entries.length === 0) {
		            currPos -= 1;
		            curr_line = '';
		            terminal.write('\x1b[2K\x1b[G\u001b[32muser> \u001b[37m');
		        } else {
		            curr_line = entries[currPos];
		            terminal.write(`\x1b[2K\x1b[G\u001b[32muser> \u001b[37m${curr_line}`);
		        }
		    } else if (e.key === 'ArrowLeft') {
		        e.preventDefault();
		        if (terminal.buffer.active.cursorX > 0) {
		            terminal.write('\x1b[D');
		            cursorPosition--;
		        }
		    } else if (e.key === 'ArrowRight') {
		        e.preventDefault();
		        if (terminal.buffer.active.cursorX < curr_line.length) {
		            terminal.write('\x1b[C');
		            cursorPosition++;
		        }
		    } else if (e.key === 'Delete') {
			    e.preventDefault();
			    if (cursorPosition < curr_line.length) {
			        curr_line = curr_line.slice(0, cursorPosition) + curr_line.slice(cursorPosition + 1);
			        terminal.write('\x1b[K' + curr_line.slice(cursorPosition) + '\x1b[' + (curr_line.length - cursorPosition) + 'D');
			    }
			}
		});

		document.getElementById('terminal').addEventListener('click', () => {
		    terminalInput.focus();
		});

		window.addEventListener('DOMContentLoaded', () => {
		    terminalInput.focus();
		});
	}
	
	return {
        //main function to initiate the module
        init: function () {
			readyTerminal();
			onLoad();
			
			// const socket = new WebSocket('ws://localhost:8080');

			// socket.addEventListener('open', (event) => {
			//     console.log('WebSocket connection opened:', event);
			// });

			// socket.addEventListener('message', (event) => {
			//     console.log('WebSocket message received:', event);
			// });

			// socket.addEventListener('close', (event) => {
			//     console.log('WebSocket connection closed:', event);
			// });

			// socket.addEventListener('error', (event) => {
			//     console.error('WebSocket error:', event);
			// });

        }
    };
}();

jQuery(document).ready(function() {
    ModuleTerminal.init();
});

export default ModuleTerminal;
