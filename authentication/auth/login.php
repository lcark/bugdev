<?php


require dirname(__dir__).'/config.php';

if($_SERVER['REQUEST_METHOD'] === "GET"){
    echo $TWIG->render('login.html.twig');
    die();
}

if($_SERVER['REQUEST_METHOD'] !== "POST" || !isset($_SERVER['CONTENT_TYPE'])){
    echo '参数错误';
    die();
}

$type = $_SERVER['CONTENT_TYPE'];



function login($user, $passwd, $DB){

    $handle = $DB->prepare('select * from user where user = ? and passwd = ?');
    $handle->bindValue(1, $user);
    $handle->bindValue(2, $passwd);
    $handle->execute();

    if(count($handle->fetchAll()) > 0){
        $_SESSION['user'] = $user;
        return json_encode(['message' => 'ok']);
    }else{
        return json_encode(['message' => 'fail']);
    }
}

header("Content-Type: application/json; charset=UTF-8");

if(\strpos($type, 'application/xml') !== false){

    $data = file_get_contents("php://input");
    $xml = simplexml_load_string($data);
    echo login($xml->user, $xml->passwd, $DB);

}else if(\strpos($type, 'application/json') !== false){

    $data = file_get_contents("php://input");
    $json = json_decode($data);
    echo login($json->user, $json->passwd, $DB);

}else{

    if(!isset($_POST['user']) || !isset($_POST['passwd'])){
        echo json_encode(['message' => 'fail']);;
    }else{
        echo login($_POST['user'], $_POST['passwd'], $DB);
    }

}

?>