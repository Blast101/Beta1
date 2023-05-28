<?php
    session_start();

    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true)
    {
        header("location:login.php");
        exit; //exits php scripts
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="partials/_nav.css">
    <style>
        
    </style>
</head>

<body>
    <?php
            require 'partials/_nav.php';
            require 'partials/_dbconnect.php';	
            // require 'partials/style1.css';
        ?>
    <!-- <div class="container"> -->
    <!-- <div class="pages"> -->
    <div class="btns">
        <div class=" btn btn1">
            <img src="PNG/profile.png" alt="Image 1" class="tab-img " data-tab="tab1" height="50px">
        </div>

        <div class="btn btn2">
            <img src="PNG/add.png" alt="Image 2" class="tab-img" data-tab="tab2" height="50px">
        </div>

        <div class="btn btn3">
            <img src="PNG/searcch.png" alt="Image 3" class="tab-img active" data-tab="tab3" height="50px">
        </div>

        <div class="btn btn4">
            <img src="PNG/notifi.png" alt="Image 3" class="tab-img" data-tab="tab4" height="50px">
        </div>

        <div class="btn btn5">
            <img src="PNG/camp.png" alt="Image 3" class="tab-img" data-tab="tab5" height="50px">
        </div>
    </div>

    <script>
        // Get all the tab images
        const tabImages = document.querySelectorAll('.tab-img');

        // Add click event listener to each tab image
        tabImages.forEach((tabImage) => {
            tabImage.addEventListener('click', () => {
                const tabId = tabImage.dataset.tab;

                // Remove active class from all tab images and tab contents
                tabImages.forEach((tab) => tab.classList.remove('active'));
                document.querySelectorAll('.tab-content').forEach((tabContent) => {
                    tabContent.classList.remove('active');
                });

                // Add active class to the clicked tab image and tab content
                tabImage.classList.add('active');
                document.getElementById(tabId).classList.add('active');
            });
        });
    </script>

    <!-- btn  -->
    <div id="tab1" class="tab-content ">
        <h1>Profile</h1>
    </div>

    <!-- tab1 ///////////////////////////////////////////////////////////////////////////////////////////////////// -->

    <div id="tab2" class="tab-content">
        <!-- Content for Tab 2 -->
        <div style="border: 2px solid brown">
            <center>
                <form action="#" method="post" enctype="multipart/form-data">
                    <!-- enctype is importent while uploading files  -->

                    <div>
                        Upload Pictures : <input type="file" name='uploadfile'>
                    </div>

                    <br>
                    <div>
                        Enter description : <input type="text" name="desc">
                    </div>

                    <div>
                        Enter Camp Name : <input type="text" name="Cname">
                    </div>

                    <input type="submit" value="POST" name='upload'>
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
    </div>

    <!-- tab2 //////////////////////////////////////////////////////////////////////////////////////////////////// -->


    <div id="tab3" class="tab-content active">

        <!-- <scroll> -->
        <div class="flex">

            <?php
            $sql6 = "SELECT * FROM Global ";

            $q6 = mysqli_query($conn,$sql6);

            $total = mysqli_num_rows($q6);

            if($total!=0)
            {
                while($result =  mysqli_fetch_assoc($q6))
                {
                ?> 
                  <div class='b box'>
                    <div><?php echo $result['cname'] ?></div>
                    <div class="img">
                        <img src = "<?php echo $result['file'] ?>" width="250px" >
                    </div>
                    <div><?php echo $result['uname']?></div>
                    <div><? echo $result['description'] ?></div>
                  </div>

                   <!-- <td style='text-align:center'></td>
                  <td style='text-align:center'>".$result['cname']." </td>
                  <td style='text-align:center'>".$result['uname']."</td>
                  <td><img src = '".$result['file']."' heigt='100px' width='100px'</td>
                  <td style='text-align:center'>".$result['description']."</td>
                  </tr>;                 -->
    <?php
                }
              }
              else
              {
                  echo "No record found ";
              }
?>
        </div>
        <!-- </scroll> -->
    </div>



    <!-- tab3 ///////////////////////////////////////////////////////////////////////////////////////////////////// -->


    <div id="tab4" class="tab-content">
        <h1>notification</h1>
    </div>


    <!-- tab4 ///////////////////////////////////////////////////////////////////////////////////////////////////// -->

    <div id="tab5" class="tab-content">
        <center>
            <form action="#" method="post" enctype="multipart/form-data">
                <!-- enctype is importent while uploading files  -->

                <div>
                    Enter Camp Name : <input type="text" name='cname'>
                </div>
                <input type="submit" value="Create" name='Create'>
            </form>
        </center>
        
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
</div>
    
    <!-- tab5 ///////////////////////////////////////////////////////////////////////////////////////////////////// -->


   

    <div class=" sp">
        <div class="sb2">
            <div class="sbar">searchbar</div>
        </div>

        <div class="stabs">Camp1</div>
        <div class="stabs">Camp2</div>
        <div class="stabs">Camp3</div>
        <div class="stabs">Camp4</div>

    </div>
    </div>
    <!-- pages  -->
    </div>
    <!-- container  -->

</body>

</html>