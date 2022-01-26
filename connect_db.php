<?php
$link = mysqli_connect
    ('localhost','HNDSOFTSA15','wK35r5a96G','HNDSOFTSA15');
    if (!$link){
        
        die('Could not connect to MySQL: ' . mysqli_error());
    }
#echo 'Connection OK';


?>