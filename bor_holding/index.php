<?php

    session_cache_limiter('private, must-revalidate');
    session_cache_expire(60);
    session_start();

    if(isset($_SESSION["username"])){

        require_once(__DIR__ . "/classes/db.class.php");
        require_once(__DIR__ . "/classes/app.class.php");
        $app = new APP;
        
        require_once(__DIR__ . "/includes/header.php");
        require_once(__DIR__ . "/pages/list.php");
        require_once(__DIR__ . "/includes/footer.php");
    }
    else {
        require_once(__DIR__ . "/pages/login.php");
    }

?>