<?php

session_start();

require_once ("Config/DB.php");
include './Navbar/Navbar.php';

$sql = "SELECT Name FROM user";
$userVillage = $conn    ->prepare($sql);
$userVillage->execute();

// Store options in an array
$options = $userVillage->fetchAll(PDO::FETCH_COLUMN);

?>


<!DOCTYPE html>
<html lang="en">
<head>
  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud_PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
    
<!-- Modal -->
<div class="container">
<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">เพิ่มสำรับอาหาร</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="insertSetFood.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
            <label for="firstname" class="col-form-label">ชื่อหมู่บ้าน :</label>
            <select class="form-control form-control-lg" name="village" id="options">
                
            <?php
            // Generate the dropdown options
            foreach ($options as $option) {
                echo "<option>$option</option>";
            }
            ?>
            </select>
            

            

                </div>
                <div class="mb-3">
                    <label for="firstname" class="col-form-label">รูปภาพสำรับอาหาร :</label>
                    <input type="file" required class="form-control" name="imgSet" id="imgInput">
                    <img loading="lazy" width="100%" id="previewImg" alt="">
                </div>
                <div class="mb-3">
                    <label for="firstname" class="col-form-label">ชื่อสำรับ :</label>
                    <input type="text" required class="form-control" name="Setname">
                </div>
                <div class="mb-3">
                    <label for="firstname" class="col-form-label">อาหาร :</label>
                    <input type="text" required class="form-control" name="Foodname">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="submitSet" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
        
        </div>
    </div>
    </div>
    </div>
    
    <div class="container mt-5">
        <div class="row row-cols-2">
            <div class="col-md-8">
                <h1>รายการสำรับอาหาร</h1>
            </div>
            <div class="col-4 d-flex justufly-content-end">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal">เพิ่มสำรับอาหาร</button>
            </div>
        </div>
        <hr>
        <?php if(isset($_SESSION['success'])) {?>
          <div class="alert alert-success">
            <?php echo$_SESSION['success'];  
                  unset($_SESSION['success']);
            ?>
           </div>
        <?php }?>
        <?php if(isset($_SESSION['error'])) {?>
          <div class="alert alert-danger">
            <?php echo$_SESSION['error'];  
                  unset($_SESSION['error']);
            ?>
           </div>
        <?php }?>
    </div>
    <!-- ตารางข้อมูล -->
    <div class="container">
    <table class="table">
  <thead>
    <tr>
    <th scope="col">Id</th>
      <th scope="col">ชื่อหมู่บ้าน</th>
      <th scope="col">รูปภาพสำรับอาหาร</th>
      <th scope="col">ชื่อสำรับ</th>
      <th scope="col">อาหาร</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $stmt = $conn->query("SELECT * FROM setfood ");
      $stmt -> execute();
      $setfood = $stmt->fetchAll(); // Fetch ข้อมูลทั้งหมดมาเก็บไว้ในตัวแปร

      if(!$setfood){//ถ้าไม่มีข้อมูลใน user
        echo "<tr><td colspan='6' clas='text-center'>No Uer Found</td></tr>";
      } else {
        foreach ($setfood as $setfood){ // loop ข้อมูล 

     
    ?>
    <tr>
    <th scope="row">
        <?php echo $setfood['Idset']; ?></th>
        <td><?php echo $setfood['VillageSet']; ?></td>
        <td><?php   echo '<img src="data:image/jpeg;base64,'.base64_encode($setfood['ImgSet']).'" alt="Upload Image"  style="width: 150px;"/>'  ?></td>
        <td><?php echo $setfood['SetName']; ?></td>
        <td><?php echo $setfood['FoodName']; ?></td>
        
        <td>
            
            <a href="editSetFood.php?id=<?php echo $setfood['Idset']; ?>" class="btn btn-warning">จัดการข้อมูลสำรับอาหาร</a>
            <a onclick="return confirm('Are you sure you want to delete?');" href="?delete=<?php echo $user['Id']; ?>" class="btn btn-outline-danger">Delete</a>
        </td>
        <td>
            
            
            
        </td>
    </tr>
    <?php   }
      }
    ?>

  </tbody>
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