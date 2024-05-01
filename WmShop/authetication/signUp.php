<?php include('../function/signUpStudent.php') ?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Document</title>

    <link rel='stylesheet' href='../assets/css/signUp.css'>
    <link rel='stylesheet' href='../assets/css/index.css'>
</head>
<body>
    <div class='signUpContainer'>
        <div>
            <p><?php echo $message; ?> </p>
        </div>

        <div class='subSignInContainer1'>
            <div class='signIn1'>
                <p>Sign up</p>
            </div>
            
            <form action="" method="POST" enctype="multipart/form-data">
                <div class='inputUserContainer1'>
                    <div class='subInputUserContainer2'>
                        <input class='inputUser1' type='text' placeholder='First name' name='firstName' required>
                        <input class='inputUser1' type='text' placeholder='Last name' name='lastName' required>
                        <input class='inputUser1' type='text' placeholder='Middle name' name='middleName'>
                    </div>

                    <div class='subInputUserContainer2'>
                        <input class='inputUser2' type='text' placeholder='Email' name='email' required>
                    </div>

                    <div class='subInputUserContainer2'>
                        <input class='inputUser2' type='text' placeholder='Address' name='address' required>
                    </div>

                    <div class='subInputUserContainer2'>
                        <input class='inputUser2' type='number' placeholder='Contact no.' name='contactNo' required>
                    </div>

                    <div class='subInputUserContainer2'>
                        <select class='inputUser3' name='college' id='' required>
                            <option value=''>
                                Choose a college
                            </option>
                            <option class="department" value="College of Computing Studies">
                                College of Computing Studies
                            </option>
                            <option class="department" value="College of Agriculture">
                                College of Agriculture
                            </option>
                            <option class="department" value="College of Architecture">
                                College of Architecture
                            </option>
                            <option class="department" value="College of Asian and Islamic Studies">
                                College of Asian and Islamic Studies
                            </option>
                            <option class="department" value="College of Criminal justice Educaiton">
                                College of Criminal justice Educaiton
                            </option>
                            <option class="department" value="College of Engineering">
                                College of Engineering
                            </option>
                            <option class="department" value="College of Forestry and Environmental Studies">
                                College of Forestry and Environmental Studies
                            </option>
                            <option class="department" value="College of Home Economics">
                                College of Home Economics
                            </option>
                            <option class="department" value="College of Law">
                                College of Law
                            </option>
                            <option class="department" value="College of Liberal Arts">
                                College of Liberal Arts
                            </option>
                            <option class="department" value="College of Nursing">
                                College of Nursing
                            </option>
                            <option class="department" value="College of Public Administration and Development Studies">
                                College of Public Administration and Development Studies
                            </option>
                            <option class="department" value="College of Sports Science and Physical Education">
                                College of Sports Science and Physical Education
                            </option>
                            <option class="department" value="College of Science and Mathematics">
                                College of Science and Mathematics
                            </option>
                            <option class="department" value="College of Social Work and Community development">
                                College of Social Work and Community development
                            </option>
                            <option class="department" value="College of Teacher Education">
                                College of Teacher Education
                            </option>
                        </select>
                    </div>

                    <div class='subInputUserContainer2'>
                        <input class='inputUser2' type='password' placeholder='Password' name='password' required>
                    </div>

                    <div class='subInputUserContainer2'>
                        <input class='inputUser2' type='password' placeholder='Confirm Password' name='confirmPassword' required>
                    </div>

                    <div class='subInputUserContainer2'>
                        <button class='signInButton' type='submit'>Sign up</button>
                    </div>
                </div>
            </form>

            <div class='subInputUserContainer3'>
                <p class='text2'>Already have an account?</p>
                <a href='../authetication/signIn.php'>
                    <button class='signInButton'>Sign in</button>
                </a>
            </div>
        </div>
    </div>
</body>
</html>
