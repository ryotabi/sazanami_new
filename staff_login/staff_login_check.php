<?php 

try{
    $staff_name=$_POST['name'];
    $staff_pass=$_POST['pass'];

    $staff_name=htmlspecialchars($staff_name,ENT_QUOTES,'UTF-8');
    $staff_pass=htmlspecialchars($staff_pass,ENT_QUOTES,'UTF-8');

    $staff_pass=md5($staff_pass);

    $dsn='mysql:dbname=s-ryota_sazanami;host=mysql57.s-ryota.sakura.ne.jp;charset=utf8';
    $user='s-ryota';
    $password='sryota1007';
    $dbh=new PDO($dsn,$user,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $sql='SELECT name FROM mst_staff WHERE name=? AND password=?';
    $stmt=$dbh->prepare($sql);
    $data[]=$staff_name;
    $data[]=$staff_pass;
    $stmt->execute($data);
    $dbh = null;

    $rec=$stmt->fetch(PDO::FETCH_ASSOC);

    if(!$rec){
        print 'スタッフ名かパスワードが間違っています。';
        print '<a href="staff_login.html">戻る</a>';
    }else{
        session_start();
        $_SESSION['login']=1;
        $_SESSION['staff_name']=$staff_name;
        header('Location:staff_top.php');
        exit();
    }
}catch(Exception $e){
    print 'ただいまデータベースに障害が起きています。';
    exit();
}