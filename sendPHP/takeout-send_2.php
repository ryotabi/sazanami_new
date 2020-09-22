<?php
    $data = file_get_contents('takeout-send_1.txt');
    $element = explode( "\n",$data);
    $cnt = count( $element ); 
    for( $i=0;$i<$cnt;$i++ ){ 
    $fp = fopen("takeout-send_2.txt","a"); 
    $num = count( file('takeout-send_2.txt'));
    $num++;
    $comment = explode(" \n ",$element[$i]);
    fwrite($fp,$num."　".$comment[0]."\n"); 
    fclose($fp);
    }
    header('Location:../php/takeout.php'); 
?>