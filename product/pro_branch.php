<?php

session_start();
session_regenerate_id(true);
if(isset($_SESSION['login'])==false){
    print 'ログインされていません。<br>';
    print '<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
    exit();
}

if(isset($_POST['disp'])){
    $pro_code=$_POST['procode'];
        if(isset($_POST['procode'])===false){
            header('Location:pro_ng.php');
            exit();
        }
    header('Location:pro_disp.php?procode='.$pro_code);
    exit();
}
if(isset($_POST['add'])){
    header('Location:pro_add.php');
    exit();
}
if(isset($_POST['edit'])){
    $pro_code=$_POST['procode'];
        if(isset($_POST['procode'])===false){
            header('Location:pro_ng.php');
            exit();
        }
    header('Location:pro_edit.php?procode='.$pro_code);
    exit();
}
if(isset($_POST['delete'])){
    $pro_code=$_POST['procode'];
    if(isset($_POST['procode'])===false){
        header('Location:pro_ng.php');
        exit();
    }
    header('Location:pro_delete.php?procode='.$pro_code);
    exit();
}