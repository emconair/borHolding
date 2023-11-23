<?php
    class APP {

        private $url = "http://localhost/bor_holding/api.php";

        private function curl($method, $data) {

            $curl = curl_init();
            $settings = array(
                CURLOPT_URL => $this->url,
                CURLOPT_RETURNTRANSFER => TRUE,
                CURLOPT_CUSTOMREQUEST => $method,
                CURLOPT_SSL_VERIFYHOST => FALSE,
                CURLOPT_SSL_VERIFYPEER => FALSE,
                CURLOPT_HTTPHEADER => array("Content-Type: application/json")
            );

            if(!is_null($data) && $data !== ""){
                $settings[CURLOPT_POSTFIELDS] = json_encode($data);
            }

            curl_setopt_array($curl, $settings);
            $response = curl_exec($curl);

            if($response === FALSE){
                return curl_error($curl);
            }

            curl_close($curl);
            return $response;
        }

        public function getAllCarList() {
            
            $response = $this->curl("GET", array(
                "service" => "car_list"
            ));

            return json_decode($response);

        }

        public function updateCar($params) {
            
            $response = $this->curl("PUT", array(
                "service" => "car_update",
                "id" => $params["data_id"],
                "data" => array(
                    "car_name" => $params["car_name"],
                    "car_price" => $params["car_price"],
                    "car_detail" => $params["car_detail"]
                )
            ));

            return $response;
            
        }

        public function deleteCar($params) {
            
            $response = $this->curl("DELETE", array(
                "service" => "remove_car",
                "id" => $params["data_id"]
            ));

            return $response;

        }

        public function addCar($params) {

            $response = $this->curl("POST", array(
                "service" => "add_car",
                "data" => array(
                    "car_name" => $params["car_name"],
                    "car_price" => $params["car_price"],
                    "car_detail" => $params["car_detail"]
                )
            ));

            return $response;
            
        }

    }

?>