<?php
    $data = file_get_contents('sobauthi-send_1.txt'); 
    $element = explode( "\n",$data);
    $cnt = count( $element ); 
    for( $i=0;$i<$cnt;$i++ ){ 
    $fp = fopen("sobauthi-send_2.txt","a");
    $num = count( file('sobauthi-send_2.txt')); 
    $num++;
    $comment = explode(" \n ",$element[$i]); 
    fwrite($fp,$num."　".$comment[0]."\n"); 
    fclose($fp);
    }
    header('Location:../php/sobauthi.php'); 
?>