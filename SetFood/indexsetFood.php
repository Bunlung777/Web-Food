<?php

session_start();

include ("../Config/DB.php");
include '../Navbar/Navbar.php';

$sqla = "SELECT Name FROM user";
$userVillage = $conn->prepare($sqla);
$userVillage->execute();

// Store options in an array
$options = $userVillage->fetchAll(PDO::FETCH_COLUMN);

$sql = "SELECT FoodName FROM food";
$foodName = $conn->prepare($sql);
$foodName->execute();

// Store options in an array
$food = $foodName->fetchAll(PDO::FETCH_COLUMN);

$sqls = "SELECT ImgFood FROM food";
$foodimg = $conn->prepare($sqls);
$foodimg->execute();

// Store options in an array
$imgFood = $foodimg->fetchAll(PDO::FETCH_COLUMN);

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    $delestmt = $conn->query("DELETE FROM setfood WHERE Idset = $delete_id");

    if($delestmt){
       
        $_SESSION['success'] = "ลบข้อมูลเรียบร้อยแล้ว";
        header("refresh:1;url=indexsetFood.php");
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud_PHP</title>
    <link rel="stylesheet" href="css.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
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
            <h5 class="modal-title" id="exampleModalLabel">เพิ่มสำรับอาหาร</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="insertSetFood.php" method="post"  enctype="multipart/form-data">
            <div class="mb-3">
            <label for="firstname" class="col-form-label">ชื่อหมู่บ้าน :</label>
            <select class="form-control form-control-lg" name="village" id="options">
                
            <?php
            // Generate the dropdown options
            foreach ($options as $options) {
                ?>
                <option><?php echo $options ?></option>
            <?php } ?>
            
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
                    <select class="form-control form-control-lg" name="foodName" id="imageSelect">
                    <option value="en" class="test" data-thumbnail="https://upload.wikimedia.org/wikipedia/commons/thumb/3/3e/LetterA.svg/2000px-LetterA.svg.png">English</option>
                </select>
                
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

    <div class="container">
<div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูลหมู่บ้าน</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body2">
            <form action="index.php" method="post" enctype="multipart/form-data">
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
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
    <tr>
    <th scope="col" class="px-6 py-3">Id</th>
      <th scope="col" class="px-6 py-3">ชื่อหมู่บ้าน</th>
      <th scope="col" class="px-6 py-3">รูปภาพสำรับอาหาร</th>
      <th scope="col" class="px-6 py-3">ชื่อสำรับ</th>
      <th scope="col" class="px-6 py-3">อาหาร</th>
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
            
        <button data-id="<?php echo $setfood['Idset']; ?>" class="userinfo btn btn-warning "><i class="fa-solid fa-utensils" style="color: #ffffff;"     ></i></button> 
            <a onclick="return confirm('ยืนยันการลบข้อมูล');" href="?delete=<?php echo $setfood['Idset']; ?>" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.rawgit.com/prashantchaudhary/ddslick/master/jquery.ddslick.min.js" ></script>
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

<script type='text/javascript'>
            $(document).ready(function(){
                $('.userinfo').click(function(){
                    var userid = $(this).data('id');
                    $.ajax({
                        url: 'editSetFood.php',
                        type: 'post',
                        data: {userid: userid},
                        success: function(response){ 
                            $('.modal-body2').html(response); 
                            $('#EditModal').modal('show'); 
                        }
                    });
                });
            });

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
</body>
</html>