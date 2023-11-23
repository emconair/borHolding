<?php
    // will be countinue
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
    // $headers = apache_request_headers();

    $requestMethod = $_SERVER["REQUEST_METHOD"];
    $request = json_decode(file_get_contents('php://input'), true);

    require_once(__DIR__ . "/classes/api.class.php");
    $api = new API;
    
    if($requestMethod == "GET"){
        
        if($request["service"] == "car_list"){

            echo $api->getCarList();

        }else if($request["service"] == "car_detail"){

        }else exit("0");

    } else if($requestMethod == "POST"){

        if($request["service"] == "add_car"){

            echo $api->addCar($request);
            
        }else exit("0");

    } else if($requestMethod == "DELETE"){

        if($request["service"] == "remove_car"){

            echo $api->removeCar($request);

        }else exit("0");

    } else if($requestMethod == "PUT"){

        if($request["service"] == "car_update"){

            echo $api->updateCar($request);

        }else exit("0");

    } else exit("0");

?>