<?php
    include_once 'controller/user.php';
    $p = new cUser();
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    $location = $id ? $p->selectLocationID($id) : null;
    $tblLocation = $p->selectLocationALL();



    if ($tblLocation) {
        if (mysqli_num_rows($tblLocation) > 0) { 
            echo "<option value=''>Vui lòng địa điểm</option>";
            while ($row = mysqli_fetch_assoc($tblLocation)) {
                // Xác định ca trực cho từng dòng
                if ($row["location"] == 1) {
                    $city = 'Hồ Chí Minh';
                } elseif ($row["location"] == 2) {
                    $city = 'Hà Nội';
                } elseif ($row["location"] == 3) {
                    $city = 'Đà Nẵng';
                }elseif ($row["location"] == 4) {
                    $city = 'Hải Phòng';
                }elseif ($row["location"] == 5) {
                    $city = 'Nha Trang';
                }elseif ($row["location"] == 6) {
                    $city = 'Huế';
                }elseif ($row["location"] == 7) {
                    $city = 'Cần Thơ';
                }

                // Kiểm tra chọn ca trực hiện tại
                $selected = ($row['location'] == $location) ? "selected" : "";

                // Hiển thị <option>
                echo "<option $selected value='" . $row['location'] . "'>$city</option>";
            }
        } else {
            echo "<option value=''>Không có dữ liệu</option>";
        }
    } else {
        echo "<option value=''>Lỗi truy xuất dữ liệu</option>";
    }
?>
