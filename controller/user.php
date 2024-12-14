<?php
    include 'model/user.php';
    include '../model/user.php';

    class cUser{
        public function selectLocationID($location){
            $mUser = new mUser();
            $result = $mUser->selectLocationID($location);
            return $result;
        }

        public function selectLocationALL(){
            $mUser = new mUser();
            $result = $mUser->selectLocationALL();
            return $result;
        }

        public function selectAirlinesByName($airline){
            $mUser = new mUser();
            $result = $mUser->selectAirlinesByName($airline);
            return $result;
        }

        public function selectAirlinesALL(){
            $mUser = new mUser();
            $result = $mUser->selectAirlinesALL();
            return $result;
        }

        public function selectInfomationAllByIDAirlines($id){
            $mUser = new mUser();
            $result = $mUser->selectInfomationAllByIDAirlines($id);
            return $result;
        }
    }
?>