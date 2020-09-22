<?php
    $name = $_POST['name'];
    $comment = $_POST['comment'];
    $date = date("Y/m/d H:i:s");
    $filename = 'outside-send_1.txt'; 
    $fp = fopen($filename,'a'); 
    fwrite($fp,$name.' : '.$comment.' 　( '.$date.')'."\n"); 
    fclose($fp); 
    unlink('outside-send_2.txt'); 
    header('Location:outside-send_2.php'); 
?>