<?php

session_start();
require_once ("Config/DB.php");
include './Navbar/Navbar.php';

if (isset($_POST['Update'])) {
    $id = $_POST['idd'];
    $name = $_POST['name'];
    $province = $_POST['province'];
    $district = $_POST['district'];
    $subdistrict = $_POST['subdistrict'];
    $img = $_FILES['img'];
    $postalcode = $_POST['postalCode'];
    $img2 = $_POST['img2'];
    $upload = $_FILES['img']['name'];

    if($upload !=''){
        $allow = array('jpg', 'jpeg', 'png');
        $extension = explode('.', $img['name']);
        $fileActExt = strtolower(end($extension));
        $fileNew = rand() . "." . $fileActExt;  
        $filePath = 'Upload/'.$fileNew;

        if (in_array($fileActExt, $allow)) {
            if ($img['size'] > 0 && $img['error'] == 0) {
                move_uploaded_file($img['tmp_name'], $filePath);

            }}
    }else{
        $fileNew = $img2;
    }
    $sql = $conn->prepare("UPDATE user SET Name = :name, Img = :img, Province = :province, District = :district, Subdistrict = :subdistrict, PostalCode = :postalcode WHERE id = :id");
    $sql->bindParam(":id", $id);
    $sql->bindParam(":name", $name);
    $sql->bindParam(":img", $fileNew);
    $sql->bindParam(":province", $province);
    $sql->bindParam(":district", $district);
    $sql->bindParam(":subdistrict", $subdistrict);
    $sql->bindParam(":postalcode", $postalcode);
    $sql->execute();
    if ($sql) {
        $_SESSION['success'] = "Data has been inserted successfully";
        header("location: index.php");
    } else {
        $_SESSION['error'] = "Data has not been inserted successfully";
        header("location: index.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud_PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<style>
    .container{
        max-width:px;
    }
    .center_div {
    margin-left: 365px;
    width:100%;
    
}
    </style>
<body>
<!-- Modal -->
    
    <div class="container mt-5">
        <h1>Edit Data</h1>
        <hr>
        <form action="edit.php" method="post" enctype="multipart/form-data">
            <?php 
                if(isset($_GET['id'])){ //รับค่าจาก id มาจาก index     ฟังก์ชั่น isset เป็นฟังก์ชั่นที่ใช้ในการตรวจสอบว่าตัวแปรนั้นมีการกำหนดค่าไว้หรือไม่
                    $Id = $_GET['id'];
                    $stmt = $conn->query("SELECT * FROM user WHERE Id = $Id");
                    $stmt->execute();
                    $data = $stmt->fetch();
                }
            ?>
                <div class="mb-3">
                <label for="firstname" class="col-form-label">ID:</label>
                <input type="text" readonly value ="<?php echo $data['Id']; ?>" required class="form-control" name="idd" >
                </div>
                <div class="mb-3">
                    <label for="img" class="col-form-label">รูปภาพ :</label>
                    <input type="file" required class="form-control" id="imgInput" name="img" value="<?php echo $data['Img']; ?>">
                    <img width="50%" src="Upload/<?php echo $data['Img']; ?>" id="previewImg" alt="">
                </div>
                <div class="mb-3">
                    <label for="firstname" class="col-form-label">ชื่อหมู่บ้าน :</label>
                    <input type="text" value ="<?php echo $data['Name']; ?>" required class="form-control" name="name" >
                    
                    
                </div>
                <div class="mb-3">
                    <label for="firstname" class="col-form-label">จังหวัด :</label>
                    <input type="text" value ="<?php echo $data['Province']; ?>" required class="form-control" name="province">
                </div>
                <div class="mb-3">
                    <label for="firstname" class="col-form-label">อำเภอ :</label>
                    <input type="text" value ="<?php echo $data['District']; ?>" required class="form-control" name="district">
                </div>
                <div class="mb-3">
                    <label for="firstname" class="col-form-label">ตำบล :</label>
                    <input type="text" value ="<?php echo $data['Subdistrict']; ?>" required class="form-control" name="subdistrict">
                </div>
                <div class="mb-3">
                    <label for="firstname" class="col-form-label">รหัสไปรษณี :</label>
                    <input type="text" value ="<?php echo $data['PostalCode']; ?>" required class="form-control" name="postalCode">
                </div>
                <div class="center_div" >
                    <a href="index.php" class="btn btn-secondary padding">Go Back</a>
                    <button type="submit" name="Update" class="btn btn-success">Update</button>
                </div>
            </form>
    </div>

    
</table>
</div>
     
  



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>  
<script>
        let imgInput = document.getElementById('imgInput');
        let previewImg = document.getElementById('previewImg');

        imgInput.onchange = evt => {
            const [file] = imgInput.files;
                if (file) {
                    previewImg.src = URL.createObjectURL(file)
            }
        }
        
</script>
</body>
</html>