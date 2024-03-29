<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Document</title>

    <link rel='stylesheet' href='../assets/css/message.css'>
</head>
<body>
    <div class='container'>
        <div class='subContainer'>
            <div class='backContainer' onclick='toggleSubContainer(event)'>
                <a href='../adminPanel/dashboard.php'>
                    <img class='backIcon' src='../assets/img/chevron-left (1).png' alt=''>
                </a>
            </div>
            
            <div class='searchBarContainer'>
                <input class='searchBar' type='text' placeholder='Search'>
            </div>

            <div class='messageContainer'>
                <div class='subMessageContainer' onclick='toggleChatContainer()'>
                    <div class='nameContainer'>
                        <p>Student name:</p>
                    </div>

                    <div class='deleteContainer'>
                        <div class='subDeleteContainer'>
                            <img class='delete' src='../assets/img/delete-permanent.png' alt=''>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class='chatContainer' onclick='toggleSubContainer()'>
            <div class='subChatContainer'>
                <div class='studentChatContainer'>
                    <div class='backContainer' onclick='toggleSubContainer(event)'>
                        <img class='backIcon' src='../assets/img/chevron-left (1).png' alt=''>
                    </div>

                    <div class='studentChat'>
                        <p class='chat'>HI</p>
                    </div>

                    <div class='adminChat'>
                        <p class='chat1'>HI</p>
                    </div>
                </div>

                <div class='chatBarContainer'>
                    <div class='subChatBarContainer'>
                        <textarea class='chatBar' name='' id='' cols='30' rows='10'></textarea>
                    </div>

                    <div class='sendContainer'>
                        <img class='sendIcon' src='../assets/img/201-2016537_send-message-icon-white-clipart-computer-icons-clip.png' alt=''>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src='../assets/js/message.js'></script>
</body>
</html>
