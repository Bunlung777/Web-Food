<?php

session_start();
include ("Config/DB.php");
include './Navbar/Navbar.php';

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    $delestmt = $conn->query("DELETE FROM user WHERE id = $delete_id");

    if($delestmt){
        echo "<script>alert('ลบข้อมูลเรียบร้อยแล้ว');</script>";
        $_SESSION['success'] = "ลบข้อมูลเรียบร้อยแล้ว";
        header("refresh:1;url=index.php");
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="Table.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud_PHP</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
    
<!-- Modal -->
<div class="container">
<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">เพิ่มหมูบ้าน</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="insert.php" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="firstname" class="col-form-label">รูปภาพของหมู่บ้าน11 :</label>
                    <input type="file" required class="form-control" name="img" id="imgInput" accept="image/*">
                    <img loading="lazy" width="100%" id="previewImg" alt="">
                </div>
                <div class="mb-3">
                    <label for="firstname" class="col-form-label">ชื่อหมู่บ้าน :</label>
                    <input type="text" required class="form-control" name="name">
                </div>
                <div class="mb-3">
                    <label for="firstname" class="col-form-label">จังหวัด :</label>
                    <input type="text" required class="form-control" name="province">
                </div>
                <div class="mb-3">
                    <label for="firstname" class="col-form-label">อำเภอ :</label>
                    <input type="text" required class="form-control" name="district">
                </div>
                <div class="mb-3">
                    <label for="firstname" class="col-form-label">ตำบล :</label>
                    <input type="text" required class="form-control" name="subdistrict">
                </div>
                <div class="mb-3">
                    <label for="firstname" class="col-form-label">รหัสไปรษณี :</label>
                    <input type="text" required class="form-control" name="postalCode">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="submit" class="btn btn-success" value="Upload">Submit</button>
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
                <h1>รายการหมู่บ้าน</h1>
            </div>
            <div class="col-4 d-flex justufly-content-end">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal">Add User</button>
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
    <section class="intro">
  <div class="bg-image h-100" style="background-color: #f5f7fa;">
    <div class="mask d-flex align-items-center h-100">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12">
            <div class="card">
              <div class="card-body p-0">
                <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative; height: 700px">
                  <table class="table table-striped mb-0">
                    <thead style="background-color: #002d72;" class="table-primary">
                      <tr>
                        
    <th scope="col">Id</th>
      <th scope="col">รูปภาพของหมู่บ้าน</th>
      <th scope="col">ชื่อหมู่บ้าน</th>
      <th scope="col">จังหวัด</th>
      <th scope="col">อำเภอ</th>
      <th scope="col">ตำบล</th>
      <th scope="col">รหัสไปรษณี</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php
      $stmt = $conn->query("SELECT * FROM user ");
      $stmt -> execute();
      $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
       
       // Fetch ข้อมูลทั้งหมดมาเก็บไว้ในตัวแปร

      if(!$user){//ถ้าไม่มีข้อมูลใน user
        echo 'No Data';

      } else {
        
         foreach ($user as $user){ // loop ข้อมูล 
           
    ?>
        <tr>
            <th scope="row">
        <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault1" checked/>
        </div>
        </th>
        
        <td><?php echo $user['Id']; ?></td>
        <td><?php   echo '<img src="data:image/jpeg;base64,'.base64_encode($user['Img']).'" alt="Upload Image"  style="width: 150px;"/>'  ?></td>
        
        <td><?php echo $user['Province']; ?></td>
        <td><?php echo $user['District']; ?></td>
        <td><?php echo $user['Subdistrict']; ?></td>
        <td><?php echo $user['PostalCode']; ?></td>
        
        <td>
            <a href="edit.php?id=<?php echo $user['Id']; ?>" class="btn btn-warning "><i class="bi bi-house-gear-fill"></i></a> 
        <a href="edit.php?id=<?php echo $user['Id']; ?>" class="btn btn-warning "><i class="fa-solid fa-utensils"></i></a>
        <button type="button" class="btn btn-danger ">
        <i class="fa-solid fa-xmark " style="color: #ffffff;"></i>
                </button>
        </td>
    </tr>
    <?php   }
      }
    ?>
</tbody>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
  



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