<?php    
    class connectDB{
        function connect(){
            $conn = new mysqli("localhost", "root", "", "vmb");
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }else{
                return $conn;
            }
        }

        function disconnect($conn){
            $conn->close();
        }
    }
?>
