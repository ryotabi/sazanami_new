<?php
    $name = $_POST['name'];
    $comment = $_POST['comment'];
    $date = date("Y/m/d H:i:s");
    $filename = 'takeout-send_1.txt'; 
    $fp = fopen($filename,'a'); 
    fwrite($fp,$name.' : '.$comment.' 　( '.$date.')'."\n");
    fclose($fp); 
    unlink('takeout-send_2.txt'); 
    header('Location:takeout-send_2.php'); 
?>