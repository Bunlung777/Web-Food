<?php

session_start();
include ("../Config/DB.php");

if (isset($_POST['UpdateSet'])) {
    $id = $_POST['id'];
    $Village = $_POST['villageName'];
    $set = $_POST['setName'];
    $FoodName = $_POST['foodName'];
    $img = file_get_contents($_FILES['imgSet']['tmp_name']);

    
        
    
    $sql = $conn->prepare("UPDATE setfood SET VillageSet = :villageSet , ImgSet = :imgSet , SetName = :setName , FoodName = :foodName WHERE Idset = :id");
    $sql->bindParam(":id", $id  );
    $sql->bindParam(":villageSet", $Village);
    $sql->bindParam(":imgSet", $img);
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
$sql = "SELECT Name FROM user";
$userVillage = $conn->prepare($sql);
$userVillage->execute();

// Store options in an array
$options = $userVillage->fetchAll(PDO::FETCH_COLUMN);

$sql = "SELECT FoodName FROM food";
$foodName = $conn->prepare($sql);
$foodName->execute();

// Store options in an array
$food = $foodName->fetchAll(PDO::FETCH_COLUMN);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="css.css"> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud_PHP</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<style>
    .container{
        max-width:px;
    }
    .center_div {
    margin-left: 310px;
    margin-bottom:10px ;
    width:100%;
    
}
    </style>
<body>
<!-- Modal -->
    
    <div class="container ">
        <form action="editSetFood.php" method="post" enctype="multipart/form-data">
            <?php 
                if(isset($_POST['userid'])){ //รับค่าจาก id มาจาก index     ฟังก์ชั่น isset เป็นฟังก์ชั่นที่ใช้ในการตรวจสอบว่าตัวแปรนั้นมีการกำหนดค่าไว้หรือไม่
                    $Id = $_POST['userid'];
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
                    <input type="file" required class="form-control" id="imgInput" name="imgSet" >
                    <?php   echo '<img src="data:image/jpeg;base64,'.base64_encode($data['ImgSet']).'" alt=""  width=350px; id="previewImg" "/> '  ?>
                </div>
                <div class="mb-3">
                    <label for="firstname" class="col-form-label">ชื่อหมู่บ้าน :</label>
                    <select class="form-control form-control-lg" name="villageName" id="options">
                    <option><?php echo $data['VillageSet']; ?></option>"; 
                <?php
                // Generate the dropdown options
                foreach ($options as $option) {
                    echo "<option>$option</option>";
                }
                ?>
                
                </select>
                </div>
                <div class="mb-3">
                    <label for="firstname" class="col-form-label">ชื่อสำรับ :</label>
                    <input type="text" value ="<?php echo $data['SetName']; ?>" required class="form-control" name="setName">
                </div>
                <div class="mb-3">
                    <label for="firstname" class="col-form-label">อาหาร :</label>
                    <select class="form-control form-control-lg" name="foodName" id="options">
                    <option><?php echo $data['FoodName']; ?></option>"; 
                <?php
                // Generate the dropdown options
                foreach ($food as $food) {
                    echo "<option>$food</option>";
                }
                ?>
                
                </select>
                </div>
                <div class="center_div" >
                    <a href="indexsetFood.php" class="btn btn-secondary padding">Go Back</a>
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