<!DOCTYPE html>
<html>
    <head>
    <title>Logout</title>
    </head>
    
    <body>
        Hey You have logged out, <a href="/">click here</a> to login
        <?php
         echo $_COOKIE['login'];
        ?>
    </body>


</html>