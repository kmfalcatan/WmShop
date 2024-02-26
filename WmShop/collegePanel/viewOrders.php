<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Document</title>

    <link rel='stylesheet' href='../assets/css/viewOrders.css'>
</head>
<body>
    <div class='container'>
        <div class='subContainer'>
            <div class='imageContainer'>
                <div class='subImageContainer'>
                    <div class='slideshow-container'>
                        <div class='mySlides'>
                          <img class='image' src='../assets/img/wmsuLogo.png' alt='Image 1'>
                        </div>

                        <div class='mySlides'>
                            <img class='image' src='../assets/img/chat-lines.png' alt='Image 1'>
                          </div>

                        <a class='prev' onclick='plusSlides(-1)'>&#10094;</a>
                        <a class='next' onclick='plusSlides(1)'>&#10095;</a>
                      </div>
                </div>
            </div>

            <div class='infoContianer'>
                <div class='subInfoContainer'>
                    <p class='inputInfo'>Student name:</p>
                </div>

                <div class='subInfoContainer'>
                    <p class='inputInfo'>Student name:</p>
                </div>

                <div class='subInfoContainer'>
                    <p class='inputInfo'>Quantity:</p>
                    <p class='inputInfo'>Total price:</p>
                    <p class='inputInfo'>Size:</p>
                </div>

                <div class='subInfoContainer'>
                    <p class='inputInfo'>Status:</p>
                </div>

                <div class='editButtonContainer'>
                    <a href='../adminPanel/orders.php'>
                        <button class='editButton'>Back</button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src='../assets/js/viewDashboard.js'></script>
</body>
</html>