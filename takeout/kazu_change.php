<?php
session_start();
session_regenerate_id(true);


$num=$_POST['num'];
$num=htmlspecialchars($num,ENT_QUOTES,'UTF-8');


for($i=0;$i<$num;$i++){

    if(preg_match('/\A[0-9]+\z/',$_POST['kazu'.$i])===0){
        header('Location: takeout_notkazu.html');
        exit();
    }
    if($_POST['kazu'.$i]<1||10<$_POST['kazu'.$i]){
        header('Location: takeout_maxkazu.html');
        exit();
        }
    $kazu[]=$_POST['kazu'.$i];
    
}

$cart=$_SESSION['cart'];

for($i=$num;0<=$i;$i--){
    if(isset($_POST['delete'.$i])){
        array_splice($cart,$i,1);
        array_splice($kazu,$i,1);
    }
}

$_SESSION['cart']=$cart;
$_SESSION['kazu']=$kazu;

header('Location:takeout_cartlook.php');
exit();