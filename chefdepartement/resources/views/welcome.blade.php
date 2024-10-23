<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Chat app Socket.io</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    </head>

    <style>
        .chat-row {
            margin: 50px;
        }        

        ul {
            margin-top:  100px;
            padding: 0;
            list-style: none;
        }

        ul li {
            padding: 8px;
            background: #ecaeae;
            margin-bottom: 20px;
        }

        ul li:nth-child(2n-2) {
            background: #c3c5c5;
        }

        .chat-input {
            border: 1px solid lightgray;
            border-top-right-radius: 10px;
            border-top-left-radius: 10px;
            padding: 8px 10px;
            color: white;

        }
    </style>

    <body>

        <div class="container">
            <div class="row">
                <div class="chat-content">
                    <ul>
                    </ul>

                    <div class="chat-section">
                        <div class="chat-box">
                            <div class="chat-input bg-primary" id="chatInput" contenteditable="">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="https://cdn.socket.io/4.5.0/socket.io.min.js" 
        integrity="sha384-7EyYLQZgWBi67fBtVxw60/OWl1kjsfrPFcaU0pp0nAh+i8FD068QogUvg85Ewy1k" 
        crossorigin="anonymous"></script>
        <script>
            $(function(){
                let ip_address  = 'http://socketlaravel.smartschools.tn';
                //let socket_port = '3000';
                //let socket      = io(ip_address + ':' + socket_port);
                let socket      = io(ip_address);

                let chatInput = $('#chatInput');

                chatInput.keypress(function(e) {
                    let message = $(this).html();
                    console.log(message);

                    if(e.which === 13 && !e.shiftkey) {

                    let notification = {
                        text: value
                    }
                    
                        socket.emit('notification message', notification);
                        chatInput.html('');
                        return false;
                    }
                });

                
                socket.on('notification message', (notification) => {
                    $('.chat-content ul').append(`<li>${notification.text}</li>`);
                });

            });
        </script>
    </body>
</html>
