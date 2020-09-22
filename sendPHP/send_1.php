<?php
    $name = $_POST['name'];
    $comment = $_POST['comment'];
    $date = date("Y/m/d H:i:s");
    $filename = 'send_1.txt'; 
    $fp = fopen($filename,'a'); 
    fwrite($fp,$name.' : '.$comment.' 　( '.$date.')'."\n"); 
    fclose($fp);
    unlink('send_2.txt'); 
    header('Location:send_2.php'); 
?>