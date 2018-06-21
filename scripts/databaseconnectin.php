<?php

    $con=mysqli_connect("localhost","root","","busforudb"); // for xamp the second root would be changed to empty ""

    //Check connection
         if(mysqli_connect_errno()){
             echo "Failed to connect to the database";
         }

?>