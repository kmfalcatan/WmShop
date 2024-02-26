<?php include('../function/signIn.php') ?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Document</title>

    <link rel='stylesheet' href='../assets/css/signIn.css'>
    <link rel='stylesheet' href='../assets/css/index.css'>
</head>
<body>
    <div class='signInContainer'>
        <div class='subSignInContainer'>
            <form action="" method="POST"> <!-- Added the form tag -->
                <div class='signIn'>
                    <p>Sign in</p>
                </div>

                <div class='inputUserContainer'>
                    <div class='subInputUserContainer'>
                        <input class='inputUser' type='text' name='Email' placeholder='Email' required> <!-- Added name attribute -->
                    </div>

                    <div class='subInputUserContainer'>
                        <input class='inputUser' type='password' name='Password' placeholder='Password' required> <!-- Added name attribute -->
                    </div>

                    <div class='subInputUserContainer'>
                        <button class='signInButton' type='submit'>Sign in</button>
            </form>
                        
                    </div>
                </div>

            <div class='subInputUserContainer1'>
                <p class='text1'>Don't have an account?</p>
                <div class="buttons">
                    <a href='../authetication/signUp.php'>
                        <button class='signInButton'>Sign up</button>
                    </a>

                    <a href='../index.php'>
                        <button class='signInButton'>Back</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
