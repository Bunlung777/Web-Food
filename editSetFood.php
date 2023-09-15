<?php

session_start();
require_once ("Config/DB.php");
include './Navbar/Navbar.php';

if (isset($_POST['UpdateSet'])) {
    $id = $_POST['id'];
    $Village = $_POST['villageName'];
    $set = $_POST['setName'];
    $FoodName = $_POST['foodName'];
    $img = $_FILES['imgSet'];
    $img2 = $_POST['img2'];
    $upload = $_FILES['imgSet']['name'];

    if($upload !=''){
        $allow = array('jpg', 'jpeg', 'png');
        $extension = explode('.', $img['name']);
        $fileActExt = strtolower(end($extension));
        $fileNew = rand() . "." . $fileActExt;  
        $filePath = 'UploadSet/'.$fileNew;

        if (in_array($fileActExt, $allow)) {
            if ($img['size'] > 0 && $img['error'] == 0) {
                move_uploaded_file($img['tmp_name'], $filePath);

            }}
    }else{
        $fileNew = $img2;
    }
    $sql = $conn->prepare("UPDATE setfood SET VillageSet = :villageSet , ImgSet = :imgSet , SetName = :setName , FoodName = :foodName WHERE Idset = :id");
    $sql->bindParam(":id", $id  );
    $sql->bindParam(":villageSet", $Village);
    $sql->bindParam(":imgSet", $fileNew);
    $sql->bindParam(":setName", $set);
    $sql->bindParam(":foodName", $FoodName);
    $sql->execute();
    if ($sql) {
        $_SESSION['success'] = "Data has been inserted successfully";
        header("location: indexSetFood.php");
    } else {
        $_SESSION['error'] = "Data has not been inserted successfully";
        header("location: indexSetFood.php");
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
        <form action="editSetFood.php" method="post" enctype="multipart/form-data">
            <?php 
                if(isset($_GET['id'])){ //รับค่าจาก id มาจาก index     ฟังก์ชั่น isset เป็นฟังก์ชั่นที่ใช้ในการตรวจสอบว่าตัวแปรนั้นมีการกำหนดค่าไว้หรือไม่
                    $Id = $_GET['id'];
                    $stmt = $conn->query("SELECT * FROM setfood WHERE Idset = $Id");
                    $stmt->execute();
                    $data = $stmt->fetch();
                }
            ?>
                <div class="mb-3">
                <label for="firstname" class="col-form-label">ID:</label>
                <input type="text" readonly value ="<?php echo $data['Idset']; ?>" required class="form-control" name="id" >
                </div>
                <div class="mb-3">
                    <label for="img" class="col-form-label">รูปภาพสำรับอาหาร :</label>
                    <input type="file" required class="form-control" id="imgInput" name="imgSet" value="<?php echo $data['ImgSet']; ?>">
                    <img width="50%" src="UploadSet/<?php echo $data['ImgSet']; ?>" id="previewImg" alt="">
                </div>
                <div class="mb-3">
                    <label for="firstname" class="col-form-label">ชื่อหมู่บ้าน :</label>
                    <input type="text" value ="<?php echo $data['VillageSet']; ?>" required class="form-control" name="villageName" >
                </div>
                <div class="mb-3">
                    <label for="firstname" class="col-form-label">ชื่อสำรับ :</label>
                    <input type="text" value ="<?php echo $data['SetName']; ?>" required class="form-control" name="setName">
                </div>
                <div class="mb-3">
                    <label for="firstname" class="col-form-label">อาหาร :</label>
                    <input type="text" value ="<?php echo $data['FoodName']; ?>" required class="form-control" name="foodName">
                </div>
                <div class="center_div" >
                    <a href="index.php" class="btn btn-secondary padding">Go Back</a>
                    <button type="submit" name="UpdateSet" class="btn btn-success">Update</button>
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