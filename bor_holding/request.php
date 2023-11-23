<?php

if(!isset($_POST["action"]) || $_POST["action"] == "") exit(0);

require_once(__DIR__ . "/classes/db.class.php");
require_once(__DIR__ . "/classes/app.class.php");

$database = new Database;
$app = new APP;

if($_POST["action"] === "0"){
    
    $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
    $conn = $database->db->prepare($sql);
    $conn->execute([$_POST["username"], md5($_POST["password"])]);
    $result = $conn->fetchAll(PDO::FETCH_ASSOC);
    
    if(!$result) {
        echo 0;
    } else {
        session_start();
        $_SESSION["username"] = $result[0]["username"];
        echo 1;
    }

}
else if($_POST["action"] === "1"){
    
    $postdata = http_build_query($_POST);
    $opts = array(
        'http' =>
        array(
            'method'  => 'POST',
            'header'  => 'Content-Type: application/x-www-form-urlencoded',
            'content' => $postdata
        )
    );
    $context  = stream_context_create($opts);

    echo file_get_contents('http://localhost/bor_holding/pages/update_content.php', false, $context);

}
else if($_POST["action"] === "2"){
    echo $app->updateCar($_POST);
}
else if($_POST["action"] === "3"){
    echo $app->deleteCar($_POST);
}
else if($_POST["action"] === "4"){
    echo $app->addCar($_POST);
}

?>