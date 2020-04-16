<?php

namespace auth;

require dirname(__dir__).'/config.php';

if($_SERVER['REQUEST_METHOD'] === "GET"){
    echo $TWIG->render('login.html');
    die();
}

if($_SERVER['REQUEST_METHOD'] !== "POST" || !isset($_POST['user']) || !isset($_POST['passwd'])){
    echo '参数错误';
    die();
}


$handle = $DB->prepare('select * from user where user = ? and passwd = ?');
$handle->bindValue(1, $_POST['user']);
$handle->bindValue(2, $_POST['passwd']);
$handle->execute();

if(count($handle->fetchAll()) > 0){
    $_SESSION['user'] = $_POST['user'];
    header("location: profile.php");
}else{
    echo "密码错误";
    echo $TWIG->render('login.html');
}


?>