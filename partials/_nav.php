<?php
error_reporting(0);
if(isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == true)
{
    $loggedin = true;
}
else
{
    $loggedin = false;
}
?>
    <div class="login">

        <link rel="stylesheet" href="_nav.css">
                <nav class="navbar">
                  <div class="title">
                      <div class="navbar-links">
                          
                          <ul >
                            <li ><a href="/Camp-In/welcome.php">Home</a></li>
                  <?php           
                  if(!$loggedin)
                  {
                  ?>
                              <li ><a href="/Camp-In/login.php">Login</a></li>
                              <li ><a href="/Camp-In/signup.php">Signup</a></li>
                  <?php
                  }
                  if($loggedin)
                  {
                  ?>
                              <li ><a href="/Camp-In/logout.php">Logout</a></li>
                  <?php
                  }
                 ?>               
                         </ul>
                  </nav>
                      </div>
                  </div>
    </div>


