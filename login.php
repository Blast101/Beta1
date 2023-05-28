<?php
    $login = false; //default
    $showerror = false;
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
       
        require 'partials/_dbconnect.php';    
        $uname = $_POST['uname'];
        $pwd = $_POST['pwd'];

            // $sql = "SELECT * FROM users where uname = '$uname' AND password = '$pwd'";
            $sql = "SELECT * FROM users where uname = '$uname'";


            $result = mysqli_query($conn,$sql);
            $num = mysqli_num_rows($result) ; //check whether only one username is present in table
            if($num == 1)
            {
                while($row = mysqli_fetch_assoc($result))
                {
                    if(password_verify($pwd,$row['password']))
                    {
                        $login =true;
                        session_start();
                        $_SESSION['loggedin']=true;
                        $_SESSION['username']=$uname;
                        header("location:welcome.php");
                    }
                    else
                    {
                        $showerror = "Invalid Credentials";
                    }
                }
            }
            else
            {
                $showerror = "Invalid Credentials";
            }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="signup.css">
    <link rel="stylesheet" href="partials/_nav.css">
</head>
<body>
    <?php
        require 'partials/_nav.php';
    ?>

    <?php 
    if($login)
    {
        echo '<div class="alert">
            <strong>Login Successfull</strong>
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
        <h1>Login to our website</h1>

        <form action="/Camp-In/login.php" method='POST'>
            <div class="fg">
                Username : <input type="text" value="" placeholder="Enter Name" name="uname">
            </div>

            <div class="fg">
                Password : <input type="password" value="" placeholder="Enter Password" name= "pwd">
            </div>

           <button type="submit">login</button>
        </form>
    </div>
    
</body>
</html>