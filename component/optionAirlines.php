<?php
    include 'controller/user.php';
    $p = new cUser();
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    $Airlines = $id ? $p->selectAirlinesByName($id) : null;
    $tblAirlines = $p->selectAirlinesALL();

    if ($tblAirlines) {
        echo "<option value=''>Vui lòng hãng bay</option>";
        if (mysqli_num_rows($tblAirlines) > 0) { 
            while ($row = mysqli_fetch_assoc($tblAirlines)) {

                // Kiểm tra chọn ca trực hiện tại
                $selected = ($row['airline_id'] == $Airlines) ? "selected" : "";

                // Hiển thị <option>
                echo "<option $selected value='" . $row['airline_id'] . "'>".$row['name']."</option>";
            }
        } else {
            echo "<option value=''>Không có dữ liệu</option>";
        }
    } else {
        echo "<option value=''>Lỗi truy xuất dữ liệu</option>";
    }
?>
