<?php
    $showalert = false;
    $showerror = false;
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        require 'partials/_dbconnect.php';    
        $uname = $_POST['uname'];
        $pwd = $_POST['pwd'];
        $cpwd = $_POST['cpwd'];
        // $exists = false;

        $existsSQL = " SELECT * FROM `users` WHERE `uname` ='$uname'";
        $rslt = mysqli_query($conn,$existsSQL);

        $numExistsRows = mysqli_num_rows($rslt);

        if($numExistsRows > 0)
        {
            $showerror = "Username already exists";
        }
        else
        {
            // $exists = false;
            if($pwd == $cpwd)
            {
                $hash = password_hash($pwd,PASSWORD_DEFAULT); //secret password
                $sql = "INSERT INTO `users` (`uname`,`password`,`dt`) VALUES ('$uname','$hash',current_timestamp())";
                $result = mysqli_query($conn,$sql);
    
                if($result)
                {
                    $showalert = true; 
                }
    
            }
            else
            {
                $showerror = "Passwords do not match ";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-Up</title>
    <link rel="stylesheet" href="signup.css">
    <link rel="stylesheet" href="partials/_nav.css">
</head>
<body>
    <?php
        require 'partials/_nav.php';
    ?>

    <?php 
    if($showalert)
    {
        echo '<div class="alert">
            <strong>Success</strong>
        </div>';
    }

    if($showerror)
    {
        ?>
    <div class="error">
            <strong><?php echo $showerror; ?></strong>
    </div>
        <?php
    }
    ?>
    <div class="container">
        <h1>SignUp to our website</h1>

        <form action="/Camp-In/signup.php" method='POST'>
            <div class="fg">
                Username : <input type="text" maxlength = "15" value="" placeholder="Enter Name" name="uname">
            </div>

            <div class="fg">
                Password : <input type="password" maxlength = "20" value="" placeholder="Enter Password" name= "pwd">
            </div>

            <div class="fg">
                Conferm Password : <input type="password" maxlength = "20" value="" placeholder="Enter Password" name= "cpwd">
            </div>

            <button type="submit">Signup</button>
        </form>
    </div>
    
</body>
</html>