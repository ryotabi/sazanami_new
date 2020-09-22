<?php
    $name = $_POST['name'];
    $comment = $_POST['comment'];
    $date = date("Y/m/d H:i:s");
    $filename = 'student-send_1.txt'; 
    $fp = fopen($filename,'a'); 
    fwrite($fp,$name.' : '.$comment.' 　( '.$date.')'."\n"); 
    fclose($fp); 
    unlink('student-send_2.txt'); 
    header('Location:student-send_2.php'); 
?>