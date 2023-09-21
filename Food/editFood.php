<?php

session_start();
include ("../Config/DB.php");

if (isset($_POST['Update'])) {
    $id = $_POST['idd'];
    $name = $_POST['name'];
    $province = $_POST['province'];
    $district = $_POST['district'];
    $subdistrict = $_POST['subdistrict'];
    $img = file_get_contents($_FILES['img']['tmp_name']);
    $postalcode = $_POST['postalCode'];
    

    $sql = $conn->prepare("UPDATE user SET Name = :name, Img = :img, Province = :province, District = :district, Subdistrict = :subdistrict, PostalCode = :postalcode WHERE id = :id");
    $sql->bindParam(":id", $id);
    $sql->bindParam(":name", $name);
    $sql->bindParam(":img", $img);
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
    margin-left: 310px;
    margin-bottom:10px ;
    width:100%;
    
}
    </style>
<body>
<!-- Modal -->
    
    <div class="container ">
        <form action="edit.php" method="post" enctype="multipart/form-data">
            <?php 
                if(isset($_POST['userid'])){ //รับค่าจาก id มาจาก index     ฟังก์ชั่น isset เป็นฟังก์ชั่นที่ใช้ในการตรวจสอบว่าตัวแปรนั้นมีการกำหนดค่าไว้หรือไม่
                    $Id = $_POST['userid'];
                    $stmt = $conn->query("SELECT * FROM food WHERE IdFood = $Id");
                    $stmt->execute();
                    $food = $stmt->fetch();
                }
            ?>
                <div class="mb-3">
                <label for="firstname" class="col-form-label">ID:</label>
                <input type="text" readonly value ="<?php echo $food['IdFood']; ?>" required class="form-control" name="idd" >
                </div>
                <div class="mb-3">
                    <label for="img" class="col-form-label">รูปภาพ :</label>
                    <input type="file" required class="form-control" id="imgInput" name="img" >
                    <?php   echo '<img src="data:image/jpeg;base64,'.base64_encode($food['ImgFood']).'" alt=""  width=350px; id="previewImg" "/> '  ?>
                </div>
                <div class="mb-3">
                    <label for="firstname" class="col-form-label">ชื่อหาร :</label>
                    <input type="text" value ="<?php echo $food['FoodName']; ?>" required class="form-control" name="name" >             
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