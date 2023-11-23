<?php

    require_once(__DIR__ . "/../config.php");
    require_once(__DIR__ . "/db.class.php");

    class API extends Database{

        public function getCarList() {
            
            $stmt = $this->db->prepare("SELECT * FROM car_list WHERE 1");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if(!$result) return 0;

            return json_encode($result);

        }

        public function removeCar($params) {
            
            if(!isset($params["id"])) {
                return json_encode(array(
                    "ERR" => 1,
                    "description" => "id parametresi gönderilmelidir!"
                ));
            }

            $stmt = $this->db->prepare("DELETE FROM car_list WHERE id = ?");
            $stmt->execute([$params["id"]]);

            return json_encode(array(
                "ERR" => 0,
                "description" => "işlem başarılı!"
            ));

        }

        public function updateCar($params) {

            if(!isset($params["id"])) {
                return json_encode(array(
                    "ERR" => 1,
                    "description" => "id parametresi gönderilmelidir!"
                ));
            }

            if(!isset($params["data"])) {
                return json_encode(array(
                    "ERR" => 1,
                    "description" => "data parametresi gönderilmelidir!"
                ));
            }

            if(count($params["data"]) < 1) {
                return json_encode(array(
                    "ERR" => 1,
                    "description" => "data parametresi boş olamaz!"
                ));
            }


            $stmt = $this->db->prepare("UPDATE car_list SET car_name = ?, car_price = ?, car_detail = ? WHERE id = ?");
            $stmt->execute([$params["data"]["car_name"], $params["data"]["car_price"], $params["data"]["car_detail"], $params["id"]]);

            return json_encode(array(
                "ERR" => 0,
                "description" => "İşlem Başarılı!"
            ));

        }

        public function addCar($params) {

            if(!isset($params["data"])) {
                return json_encode(array(
                    "ERR" => 1,
                    "description" => "data parametresi gönderilmelidir!"
                ));
            }

            if(count($params["data"]) < 1) {
                return json_encode(array(
                    "ERR" => 1,
                    "description" => "data parametresi boş olamaz!"
                ));
            }
            
            $stmt = $this->db->prepare("INSERT INTO car_list(car_name, car_price, car_detail) VALUES(?,?,?)");
            $stmt->execute([$params["data"]["car_name"], $params["data"]["car_price"], $params["data"]["car_detail"]]);

            return json_encode(array(
                "ERR" => 0,
                "description" => "İşlem Başarılı!"
            ));

        }

    }

?>