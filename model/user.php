<?php
    include_once 'db_connection.php';

    class mUser
    {
        public function selectLocationID($location){
            $p = new connectDB();
            $conn = $p->connect();
            if ($conn) {
                $string = "SELECT location FROM flights LIMIT 1";
                $result = mysqli_query($conn, $string);
                
                $p->disconnect($conn);
                if ($result && mysqli_num_rows($result) > 0) {
                    return mysqli_fetch_assoc($result)['location'];
                } else {
                    return null; 
                }
            } else {
                return false; 
            }
        }

        public function selectLocationALL(){
            $p = new connectDB();
            $conn = $p->connect();
            if ($conn) {
                $string = "SELECT DISTINCT location FROM flights";
                $result = mysqli_query($conn, $string);
                
                $p->disconnect($conn);
                return $result;
            } else {
                return false; 
            }
        }

        public function selectAirlinesByName($idAirline){
            $p = new connectDB();
            $conn = $p->connect();
            if ($conn) {
                $string = "SELECT name FROM airlines WHERE airline_id = $idAirline";
                $result = mysqli_query($conn, $string);
                
                $p->disconnect($conn);
                if ($result && mysqli_num_rows($result) > 0) {
                    return mysqli_fetch_assoc($result)['airline_id'];
                } else {
                    return null; 
                }
            } else {
                return false; 
            }
            
        }

        public function selectAirlinesALL(){
            $p = new connectDB();
            $conn = $p->connect();
            if ($conn) {
                $string = "SELECT DISTINCT name FROM airlines";
                $result = mysqli_query($conn, $string);
                
                $p->disconnect($conn);
                return $result;
            } else {
                return false; 
            }
        }
    }
        
?>