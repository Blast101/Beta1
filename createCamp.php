<?php
     require 'partials/_dbconnect.php';   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creating Camps</title>
    <link rel="stylesheet" href="partials/_nav.css">
</head>
<body>
<?php
        require 'partials/_nav.php';
    ?>

        <center>
            <form action="#" method="post" enctype="multipart/form-data"> 
                <!-- enctype is importent while uploading files  -->
                
                <div>
                    Enter Camp Name : <input type="text" name ='cname'>
                </div>
                 <input type="submit" value="Create" name ='Create'>
            </form>
        </center>
    </div>
    
    <?php
        session_start();
        if($_POST['Create'])
        {
            $cname = $_POST['cname'];
            $admin = $_SESSION['username'];
            
            $sql2 = "CREATE TABLE `$cname` 
            (
                  `id` INT(10) AUTO_INCREMENT PRIMARY KEY,
                  `cname` VARCHAR(20) ,
                  `uname` VARCHAR(30) ,
                  `files` VARCHAR(400),
                  `desc` VARCHAR(100) 
            )";               
                
                $q2 = mysqli_query($conn,$sql2);

                if($q2)
                {
                    echo "Suxx";
                }
                else
                {
                    echo "Failed";
                }


                $sql5 = " INSERT INTO Clists (`admin`,`cname`) VALUES ('$admin','$cname')";
                $q5 = mysqli_query($conn,$sql5);

                

                if($q5)
                {
                    echo "inserted";
                }
                else
                {
                    echo "Failed";
                }
        }
    ?>
</body>
</html>












