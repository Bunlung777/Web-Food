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
       
        $_SESSION['success'] = "";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud_PHP</title>
    <link rel="stylesheet" href="setfood.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
    
<!-- Modal -->
<div id="userModal" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-lg max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 mt-4 -mb-3">
            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="userModal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="px-6 py-6 lg:px-8">
                <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">เพิ่มสำรับอาหาร</h3>
                <hr>
                <form class="space-y-6" action="insert.php" method="post" enctype="multipart/form-data">
                    <div>
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ชื่อหมู่บ้าน</label>
                        <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="village" id="options">
                
                <?php
                // Generate the dropdown options
                foreach ($options as $options) {
                    ?>
                    <option><?php echo $options ?></option>
                <?php } ?>
                
                </select>
                    </div>
                    <div>
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">รูปภาพสำรับอาหาร</label>
                        <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="imgInput" type="file" name="img">
                        <img class="h-auto max-w-lg rounded-lg" width="100%" id="previewImg" alt="">
                    </div>
                    <div>
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ชื่อสำรับ</label>
                        <input type="text" name="province" id="text"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                    <div>
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">อาหาร</label>
                        <input type="text" name="District" id="text"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                    <div class="flex justify-end space-x-4">
                        <div>
                     <button type="submit" name="submit" class="h-12 px-6 text-white bg-gradient-to-r from-gray-400 via-Neutral-500 to-gray-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-gray-300 dark:focus:ring-gray-800 font-medium rounded-lg text-sm py-2.5 text-center" data-modal-hide="userModal" >Close</button>
                    </div> 
                    <div>
                    <button type="submit" name="submit" class=" h-12 px-6 text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm py-2.5 text-center" >Submit</button>
                    </div>   
                </div>
                </form>
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

<div style="float:left">
    <h1>รายการหมู่บ้าน</h1>
</div>
<div class="flex justify-end " >
    <button type="button" class="h-12 px-8 m-2 text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm py-2.5 text-center mr-2 mb-2" data-modal-target="userModal" data-modal-toggle="userModal">เพิ่มรายการอาหาร</button>
</div>

<hr class="h-1 mx-auto my-3 bg-gray-700 border-0 rounded md:my-10 dark:bg-gray-700">
<?php if(isset($_SESSION['success'])) {?>
<div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
<svg class="w-6 h-6 mr-6 text-green-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
<path fill="currentColor" d="m18.774 8.245-.892-.893a1.5 1.5 0 0 1-.437-1.052V5.036a2.484 2.484 0 0 0-2.48-2.48H13.7a1.5 1.5 0 0 1-1.052-.438l-.893-.892a2.484 2.484 0 0 0-3.51 0l-.893.892a1.5 1.5 0 0 1-1.052.437H5.036a2.484 2.484 0 0 0-2.48 2.481V6.3a1.5 1.5 0 0 1-.438 1.052l-.892.893a2.484 2.484 0 0 0 0 3.51l.892.893a1.5 1.5 0 0 1 .437 1.052v1.264a2.484 2.484 0 0 0 2.481 2.481H6.3a1.5 1.5 0 0 1 1.052.437l.893.892a2.484 2.484 0 0 0 3.51 0l.893-.892a1.5 1.5 0 0 1 1.052-.437h1.264a2.484 2.484 0 0 0 2.481-2.48V13.7a1.5 1.5 0 0 1 .437-1.052l.892-.893a2.484 2.484 0 0 0 0-3.51Z"/>
<path fill="#fff" d="M8 13a1 1 0 0 1-.707-.293l-2-2a1 1 0 1 1 1.414-1.414l1.42 1.42 5.318-3.545a1 1 0 0 1 1.11 1.664l-6 4A1 1 0 0 1 8 13Z"/>
</svg>
<span class="sr-only">Info</span>
<div>
<span class="font-medium text-xl">เพิ่มข้อมูลเรียบร้อยแล้ว</span>
</div>
</div>
<?php echo$_SESSION['success'];  
      unset($_SESSION['success']);
?>

<?php }?>
<?php if(isset($_SESSION['editsuccess'])) {?>
<div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
<svg class="w-6 h-6 mr-6 text-green-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
<path fill="currentColor" d="m18.774 8.245-.892-.893a1.5 1.5 0 0 1-.437-1.052V5.036a2.484 2.484 0 0 0-2.48-2.48H13.7a1.5 1.5 0 0 1-1.052-.438l-.893-.892a2.484 2.484 0 0 0-3.51 0l-.893.892a1.5 1.5 0 0 1-1.052.437H5.036a2.484 2.484 0 0 0-2.48 2.481V6.3a1.5 1.5 0 0 1-.438 1.052l-.892.893a2.484 2.484 0 0 0 0 3.51l.892.893a1.5 1.5 0 0 1 .437 1.052v1.264a2.484 2.484 0 0 0 2.481 2.481H6.3a1.5 1.5 0 0 1 1.052.437l.893.892a2.484 2.484 0 0 0 3.51 0l.893-.892a1.5 1.5 0 0 1 1.052-.437h1.264a2.484 2.484 0 0 0 2.481-2.48V13.7a1.5 1.5 0 0 1 .437-1.052l.892-.893a2.484 2.484 0 0 0 0-3.51Z"/>
<path fill="#fff" d="M8 13a1 1 0 0 1-.707-.293l-2-2a1 1 0 1 1 1.414-1.414l1.42 1.42 5.318-3.545a1 1 0 0 1 1.11 1.664l-6 4A1 1 0 0 1 8 13Z"/>
</svg>
<span class="sr-only">Info</span>
<div>
<span class="font-medium text-xl">แก้ไขข้อมูลเรียบร้อยแล้ว</span>
</div>
</div>
<?php echo$_SESSION['editsuccess'];  
      unset($_SESSION['editsuccess']);
?>
</div>
<?php }?>
<?php if(isset($_SESSION['deletedata'])) {?>
<div class="flex items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-300 dark:bg-gray-800 dark:text-green-400" role="alert">
<svg class="w-6 h-6 mr-6 text-red-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
<path fill="currentColor" d="m18.774 8.245-.892-.893a1.5 1.5 0 0 1-.437-1.052V5.036a2.484 2.484 0 0 0-2.48-2.48H13.7a1.5 1.5 0 0 1-1.052-.438l-.893-.892a2.484 2.484 0 0 0-3.51 0l-.893.892a1.5 1.5 0 0 1-1.052.437H5.036a2.484 2.484 0 0 0-2.48 2.481V6.3a1.5 1.5 0 0 1-.438 1.052l-.892.893a2.484 2.484 0 0 0 0 3.51l.892.893a1.5 1.5 0 0 1 .437 1.052v1.264a2.484 2.484 0 0 0 2.481 2.481H6.3a1.5 1.5 0 0 1 1.052.437l.893.892a2.484 2.484 0 0 0 3.51 0l.893-.892a1.5 1.5 0 0 1 1.052-.437h1.264a2.484 2.484 0 0 0 2.481-2.48V13.7a1.5 1.5 0 0 1 .437-1.052l.892-.893a2.484 2.484 0 0 0 0-3.51Z"/>
<path fill="#fff" d="M8 13a1 1 0 0 1-.707-.293l-2-2a1 1 0 1 1 1.414-1.414l1.42 1.42 5.318-3.545a1 1 0 0 1 1.11 1.664l-6 4A1 1 0 0 1 8 13Z"/>
</svg>
<span class="sr-only">Info</span>
<div>
<span class="font-medium text-xl">ลบข้อมูลเรียบร้อยแล้ว</span>
</div>
</div>
<?php echo$_SESSION['deletedata'];  
      unset($_SESSION['deletedata']);
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
    <div class=" min-w-full sm:px-10 lg:px-11  ">
    <table class="w-5/6 h-32 mx-auto text-sm text-left text-gray-500 dark:text-gray-400 ">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <div class="">
            <tr>
    <th scope="col" class="px-6 py-3">Id</th>
      <th scope="col" class="px-6 py-3">ชื่อหมู่บ้าน</th>
      <th scope="col" class="px-6 py-3">รูปภาพสำรับอาหาร</th>
      <th scope="col" class="px-6 py-3">ชื่อสำรับ</th>
      <th scope="col" class="px-6 py-3">อาหาร</th>
      <th></th>
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
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
      
      <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"><?php echo $setfood['Idset']; ?></td>
      <td><?php   echo '<img src="data:image/jpeg;base64,'.base64_encode($setfood['ImgSet']).'" alt="Upload Image"  style="width: 150px;" class="rounded-lg thumbnail" "/>'  ?></td>
      <td class="px-6 py-4"><?php echo $setfood['VillageSet']; ?></td>
      <td class="px-6 py-4"><?php echo $setfood['SetName']; ?></td>
      <td class="px-6 py-4"><?php echo $setfood['FoodName']; ?></td>
      
      <td >
      <button data-id="<?php echo $user['Id']; ?>" class="userinfo text-white bg-gradient-to-r from-yellow-300  to-amber-400 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-yellow-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-3 py-2.5 text-center mr-1 mb-2 "><i class="bi bi-house-gear-fill" style="color: #ffffff;"></i></button> 
      <a href="edit.php?id=<?php echo $user['Id']; ?>" class="text-white bg-gradient-to-r from-yellow-300  to-amber-400 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-yellow-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-3 py-2.5 text-center mr-1 mb-2 "><i class="fa-solid fa-utensils" style="color: #ffffff;"></i></i></a>
      <a href="?delete=<?= $setfood['Idset']; ?>" class="text-white bg-gradient-to-r from-red-400  to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-3 py-2.5 text-center mr-2 mb-2" onclick="return confirm('ยืนยันการลบข้อมูล');">
      <i class="fa-solid fa-trash"></i>
      </a>
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