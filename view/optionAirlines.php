<?php
    include_once 'controller/user.php';
    $p = new cUser();
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    $Airlines = $id ? $p->selectAirlinesByName($id) : null;
    $tblAirlines = $p->selectAirlinesALL();

    echo $Airlines; 
    if ($tblAirlines) {
        if (mysqli_num_rows($tblAirlines) > 0) { 
            echo "<option value=''>Vui lòng hãng bay</option>";
            while ($row = mysqli_fetch_assoc($tblAirlines)) {

                // Kiểm tra chọn ca trực hiện tại
                $selected = ($row['airline_id'] == $Airlines) ? "selected" : "";

                // Hiển thị <option>
                echo "<option $selected value='" . $row['airline_id'] . "'>".$row['airline_id']."</option>";
            }
        } else {
            echo "<option value=''>Không có dữ liệu</option>";
        }
    } else {
        echo "<option value=''>Lỗi truy xuất dữ liệu</option>";
    }
?>
