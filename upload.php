<?php
     require 'partials/_dbconnect.php';   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>

    <link rel="stylesheet" href="partials/_nav.css">
</head>
<body>
<?php
        require 'partials/_nav.php';
    ?>
    <div style="border: 2px solid brown">
        <center>
            <form action="#" method="post" enctype="multipart/form-data"> 
                <!-- enctype is importent while uploading files  -->
                
                <div>
                    Upload Pictures : <input type="file" name ='uploadfile'>
                </div>

        <br>
                <div>
                    Enter description : <input type="text" name ="desc">
                </div>

                <div>
                    Enter Camp Name : <input type = "text" name = "Cname">
                </div>

                 <input type="submit" value="POST" name ='upload'>
            </form>
        </center>
    </div>
    
    <?php
    session_start();
        if($_POST['upload'])
        {
            $uname = $_SESSION['username'];

            $file_name = $_FILES["uploadfile"]["name"];
            $temp_name = $_FILES["uploadfile"]["tmp_name"];
            $folder = "images/".$file_name;
            move_uploaded_file($temp_name,$folder);

            $description = $_POST['desc'];

            $cname = $_POST['Cname'];

            $sql = "INSERT INTO `$cname` (`cname`,`uname`,`files`,`desc`) VALUES ('$cname','$uname','$folder','$description')";

            
            $q1 = mysqli_query($conn,$sql);

            if($q1)
            {
                    echo "Suxx1";
            }
            else
            {
                echo "Failed1";
            }

            $sql6 = " INSERT INTO `Global` (`cname`,`uname`,`file`,`description`) VALUES ('$cname','$uname','$folder','$description')";
            $q6 = mysqli_query($conn,$sql6);

            if($q6)
            {
                    echo "Suxx2";
            }
            else
            {
                echo "Failed2";
            }
           
        }
    ?>
</body>
</html>



