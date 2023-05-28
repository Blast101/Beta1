<?php
     session_start();
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
 <div>

 <?php
            $sql6 = "SELECT * FROM Global ";

            $q6 = mysqli_query($conn,$sql6);

            $total = mysqli_num_rows($q6);

            if($total!=0)
            {

    ?>
                <table border=1 cellspacing=7 width=100%>
                <tr>
                    <th width=10%>ID</th>
                    <th width=10%>Cname</th>
                    <th width=15%>Uname</th>
                    <th width=15%>Image</th>
                    <th width=10%>description</th>
                </tr>
     
<?php
                while($result =  mysqli_fetch_assoc($q6))
                {
                  echo " 
                  <tr>
                  <td style='text-align:center'>".$result['id']."</td>
                  <td style='text-align:center'>".$result['cname']." </td>
                  <td style='text-align:center'>".$result['uname']."</td>
                  <td><img src = '".$result['file']."' heigt='100px' width='100px'</td>
                  <td style='text-align:center'>".$result['description']."</td>
                  </tr>";                
                }
              }
              else
              {
                  echo "No record found ";
              }
?>
 </div>

</table>
</body>
<html>










