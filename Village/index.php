<?php

session_start();
include ("../Config/DB.php");
include '../Navbar/Navbar.php';

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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
    
<!-- Modal -->
<div id="userModal" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="userModal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="px-6 py-6 lg:px-8">
                <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">เพิ่มหมูบ้าน</h3>
                <hr>
                <form class="space-y-6" action="insert.php" method="post" enctype="multipart/form-data">
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">รูปภาพของหมู่บ้าน</label>
                        <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="imgInput" type="file" name="img">
                        <img class="h-auto max-w-lg rounded-lg" width="100%" id="previewImg" alt="">
                    </div>
                    <div>
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ชื่อหมู่บ้าน</label>
                        <input type="text" name="name" id="text"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                    <div>
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">จังหวัด</label>
                        <input type="text" name="province" id="text"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                    <div>
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">อำเภอ</label>
                        <input type="text" name="District" id="text"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                    <div>
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ตำบล</label>
                        <input type="text" name="subdistrict" id="text"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                    <div>
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">รหัสไปรษณี</label>
                        <input type="text" name="postalCode" id="text"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                    <div>
                    <button type="submit" name="submit" class=" right-0 h-12 px-6 m-2 text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm py-2.5 text-center mr-2 mb-2" >Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> 

    <!-- Modal -->
<div class="container">
<div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-body1">
            <form action="index.php" method="post" enctype="multipart/form-data">
            </form>
        </div>
        </div>
    </div>
    </div>
    </div>
    
    <div class="container mt-5">
        <div class="row row-cols-2">
            <div class="col-md-10">
                <h1>รายการหมู่บ้าน</h1>
            </div>
            <div class="col-2 d-flex justufly-content-end">
                <button type="button" class="h-12 px-6 m-2 text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm py-2.5 text-center mr-2 mb-2" data-modal-target="userModal" data-modal-toggle="userModal">เพิ่มหมูบ้าน</button>
            </div>
        </div>
        <hr class="mx-auto">
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
    <div class=" min-w-full sm:px-10 lg:px-11  ">
    <table class="w-5/6 h-32 mx-auto text-sm text-left text-gray-500 dark:text-gray-400 ">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <div class="">
            <tr>
    <th scope="col" class="px-6 py-3">Id</th>
      <th scope="col" class="px-6 py-3">รูปภาพของหมู่บ้าน</th>
      <th scope="col" class="px-6 py-3">ชื่อหมู่บ้าน</th>
      <th scope="col" class="px-6 py-3">จังหวัด</th>
      <th scope="col" class="px-6 py-3">อำเภอ</th>
      <th scope="col" class="px-6 py-3">ตำบล</th>
      <th scope="col" class="px-6 py-3">รหัสไปรษณี</th>
      <th></th>
     
    </tr>
    </div>
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
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
      
        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"><?php echo $user['Id']; ?></td>
        <td><?php   echo '<img src="data:image/jpeg;base64,'.base64_encode($user['Img']).'" alt="Upload Image"  style="width: 150px;"/>'  ?></td>
        <td class="px-6 py-4"><?php echo $user['Name']; ?></td>
        <td class="px-6 py-4"><?php echo $user['Province']; ?></td>
        <td class="px-6 py-4"><?php echo $user['District']; ?></td>
        <td class="px-6 py-4"><?php echo $user['Subdistrict']; ?></td>
        <td class="px-6 py-4"><?php echo $user['PostalCode']; ?></td>
        
        <td >
        <button data-id="<?php echo $user['Id']; ?>" class="userinfo text-white bg-gradient-to-r from-yellow-300  to-yellow-500 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-yellow-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 "><i class="bi bi-house-gear-fill" style="color: #ffffff;"></i></button> 
        <a href="edit.php?id=<?php echo $user['Id']; ?>" class="btn btn-warning "><i class="fa-solid fa-utensils" style="color: #ffffff;"></i></i></a>
        <a href="?delete=<?= $user['Id']; ?>" class="btn btn-danger" onclick="return confirm('ยืนยันการลบข้อมูล');">
        <i class="fa-solid fa-trash"></i>
        </a>
        </td>
    </tr>
    <?php   }
      }
    ?>
</tbody>

                    </tbody>
                  </table>
                </div>
  



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
<script src="https://cdn.tailwindcss.com"></script>
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
                        url: 'edit.php',
                        type: 'post',
                        data: {userid: userid},
                        success: function(response){ 
                            $('.modal-body1').html(response); 
                            $('#EditModal').modal('show'); 
                        }
                    });
                });
            });

</script>

</body>
</html>