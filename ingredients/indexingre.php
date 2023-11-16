<?php

session_start();

include("../Config/DB.php");
include '../Navbar/Navbar.php';

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delestmt = $conn->query("DELETE FROM ingredients WHERE Idingre = $delete_id");

    if ($delestmt) {

        $_SESSION['deletedata'] = "";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ingre.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Niramit:wght@500&family=Taviraj&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Taviraj:ital,wght@1,200&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>

    <!-- Modal -->
    <div id="FoodModal" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-lg max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 mt-4 -mb-3">
                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="FoodModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="px-6 py-6 lg:px-8">
                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white font">เพิ่มส่วนประกอบ</h3>
                    <hr>
                    <form class="space-y-6" action="insertingre.php" method="post" enctype="multipart/form-data">
                        <div>
                            <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font">รูปภาพส่วนประกอบ : </label>
                            <input multiple class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="imgInput" type="file" name="imgIngre[]">
                            <div id="previewContainer" class="mt-4 grid grid-cols-2 gap-2"></div>
                        </div>
                        <div>
                            <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font">ชื่อส่วนประกอบ : </label>
                            <input type="text" name="Ingrename" id="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                        </div>
                        <div class="flex justify-end space-x-4">
                            <div>
                                <button type="submit" name="submit" class="h-12 px-6 text-white bg-gradient-to-r from-gray-400 via-Neutral-500 to-gray-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-gray-300 dark:focus:ring-gray-800 font-medium rounded-lg text-sm py-2.5 text-center" data-modal-hide="FoodModal">ยกเลิก</button>
                            </div>
                            <div>
                                <button type="submit" name="submitingre" class=" h-12 px-6 text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm py-2.5 text-center">บันทึก</button>
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
                        <h5 class="modal-title" id="exampleModalLabel font">แก้ไขส่วนประกอบ</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body4">
                        <form action="indexingre.php" method="post" enctype="multipart/form-data">
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

        </div>
        <div class="flex justify-center absolute inset-x-0 top-0 " >
        <?php if(isset($_SESSION['success'])) {?>
            <div id="notification" class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800 noti" role="alert">
    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
        </svg>
        <span class="sr-only">Check icon</span>
    </div>
    <div class="ml-3 text-sm font-normal">เพิ่มข้อมูลเรียบร้อยแล้ว</div>
    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#notification" aria-label="Close">
        <span class="sr-only">Close</span>
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
        </svg>
    </button>

            <?php 
                  unset($_SESSION['success']);
            ?>
           
        <?php }?>
        </div>
        </div>
        <div class="flex justify-center absolute inset-x-0 top-0 " >
        <?php if(isset($_SESSION['editsuccess'])) {?>
            <div id="notification" class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white  rounded-lg shadow dark:text-gray-400 dark:bg-gray-800 noti " role="alert">
    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
        </svg>
        <span class="sr-only">Check icon</span>
    </div>
    <div class="ml-3 text-sm font-normal">แก้ไขข้อมูลเรียบร้อยแล้ว</div>
    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#notification" aria-label="Close">
        <span class="sr-only">Close</span>
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
        </svg>
    </button>
    <div class="progress"></div>
            <?php unset($_SESSION['editsuccess']);?>
            <?php }?>
            </div>
            </div>
    <div class="flex justify-center absolute inset-x-0 top-0 " >  
        <?php if(isset($_SESSION['deletedata'])) {?>
            <div id="notification" class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800 notired" role="alert">
    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-green-800 dark:text-green-200">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
        </svg>
        <span class="sr-only">Check icon</span>
    </div>
    <div class="ml-3 text-sm font-normal">ลบเรียบร้อยแล้ว</div>
    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#notification" aria-label="Close">
        <span class="sr-only">Close</span>
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
        </svg>
    </button>

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
           
        <?php }?>
        </div>
        </div>
<!-- ตารางข้อมูล -->
<div class="flex flex-col mt-6 container ">
<div class="-mx-4 -my-2  sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8 ">
                <div class="overflow-hidden md:rounded-lg shadow p-3">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    
                    
    <div class="container ">
        <div class="py-2  ">
        <div style="float:left" class="mt-1">
            <p class="text-[30px] font">รายการส่วนประกอบ</p>
        </div>
        <div class="flex justify-end ">
            <button type="button" class="font h-12 px-8 m-2 text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm py-2.5 text-center mr-2 mb-2" data-modal-target="FoodModal" data-modal-toggle="FoodModal">เพิ่มส่วนประกอบ</button>
        </div>
        </div>
    </div>
        <hr>
                        <div class="grid grid-cols-2 gap-4 ">
        <div class="flex">
                            <label for="text" class="block mb-2 text-l text-gray-500 dark:text-white mr-3 mt-8">Show  </label>
                            <select class=" mt-6 h-10 mb-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="village" id="options">
                                <option>10</option>
                                <option>20</option>
                                <option>30</option>
                                <option>40</option>
                            </select>
                            <label for="text" class="block mb-2 text-l  text-gray-500 dark:text-white ml-3 mt-8">entries  </label>
                        </div>
                        
                        <div>
                        <form method="post">
            <div class="flex justify-end mt-3 mb-4 ">
            <div class="relative flex items-center ">
            <div class="mr-4 text-l font-medium  text-gray-500 dark:text-gray-400">
                <label for="">Seach: </label>
            </div>
            <input type="text" placeholder="" class="shadow-md block w-[15rem] py-2 text-gray-700 bg-white border border-gray-300 rounded-lg placeholder-gray-400  dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-blue-500 focus:outline-none focus:ring-2 focus:ring-opacity-40" name="search">
        </div>
        </div>
        </form>
        </div>
          </div>

                    <thead class=" bg-gray-100 dark:bg-gray-900">
    <tr>
        <th scope="col" class="px-6 py-3  text-l font-normal  text-gray-500 dark:text-gray-400 font">ลำดับ</th>
        <th scope="col" class="px-6 py-3  text-l font-normal  text-gray-500 dark:text-gray-400 font">รูปภาพส่วนประกอบ</th>
        <th scope="col" class="px-6 py-3  text-l font-normal  text-gray-500 dark:text-gray-400 font">ชื่อส่วนประกอบ</th>
        <th></th>
        <th></th>
        </div>
    </tr>
</thead>

        <tbody>
            <?php
            $stmt = $conn->query("SELECT * FROM food ");
            $stmt->execute();
            $food = $stmt->fetchAll(); // Fetch ข้อมูลทั้งหมดมาเก็บไว้ในตัวแปร
            //หน้า page
            $page = isset($_GET['page']) ? $_GET['page'] : 1;
            $displayLimit = 15;
            $offset = ($page - 1) * $displayLimit;

            if(isset($_GET['page'])){
                $_SESSION['page'] = $_GET['page'];
                }
                
            $stmt = $conn->prepare("SELECT * FROM ingredients  LIMIT :limit OFFSET :offset");
            $stmt->bindParam(':limit', $displayLimit, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            $ingredients = $stmt->fetchAll();
            
            $stmt = $conn->query("SELECT COUNT(*) as total FROM ingredients");
            $stmt->execute();
            $totalRows = $stmt->fetch()['total'];
            
            $totalPages = ceil($totalRows / $displayLimit);
            $startRowNumber = ($page - 1) * $displayLimit + 1;

            if (isset($_POST['search'])){//ถ้าไม่มีข้อมูลใน user
                $search = $_POST['search'];
                $query = $conn->query("SELECT * FROM ingredients WHERE ingredientsName LIKE '%$search%' ");
                $query -> execute();
                $result = $query->fetchAll(PDO::FETCH_ASSOC);

        //ถ้าไม่มีข้อมูลใน user
                if ($result > 0){
                    foreach($result as $row => $result){
                        ?>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">

                        <td scope="row" class="px-6 py-4 font-normal text-gray-600 font-medium text-gray-900 whitespace-nowrap dark:text-white font"><?php echo $row +1 ?></td>
                        <div>
                            <td class="p-2"><?php echo '<img src="data:image/jpeg;base64,' . base64_encode($result['ImgIngre1']) . '" alt="Upload Image"  style="width: 150px; height: 100px" class="rounded-lg thumbnail "  "/>' ?></td>
                        </div>
                        <td class="px-6 py-4 font-normal text-gray-600 font"><?php echo $result['ingredientsName']; ?></td>
                        <td>
                            <button data-id="<?php echo $result['Idingre']; ?>" class="userinfo text-white bg-gradient-to-r from-yellow-300  to-amber-400 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-yellow-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-3 py-2.5 text-center mr-1 mb-2 ">
                            <i class="fa-solid fa-utensils" style="color: #ffffff;"></i></button>

                            <a href="?delete=<?= $result['Idingre']; ?>" class="text-white bg-gradient-to-r from-red-400  to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-3 py-2.5 text-center mr-2 mb-2" onclick="return confirm('ยืนยันการลบข้อมูล');">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php }
                } 
            } else {
                foreach ($ingredients as $row => $ingredients) { // loop ข้อมูล 
            ?> <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">

            <td scope="row" class="px-6 py-4 font-normal text-gray-600 font-medium text-gray-900 whitespace-nowrap dark:text-white font"><?php echo $startRowNumber + $row ?></td>
            <div>
                <td class="p-2"><?php echo '<img src="data:image/jpeg;base64,' . base64_encode($ingredients['ImgIngre1']) . '" alt="Upload Image"  style="width: 150px; height: 100px" class="rounded-lg thumbnail "  "/>' ?></td>
            </div>
            <td class="px-6 py-4 font-normal text-gray-600 font"><?php echo $ingredients['ingredientsName']; ?></td>
            <td>
                <button data-id="<?php echo $ingredients['Idingre']; ?>" class="userinfo text-white bg-gradient-to-r from-yellow-300  to-amber-400 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-yellow-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-3 py-2.5 text-center mr-1 mb-2 ">
                <i class="fa-solid fa-utensils" style="color: #ffffff;"></i></button>

                <a href="?delete=<?= $ingredients['Idingre']; ?>" class="text-white bg-gradient-to-r from-red-400  to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-3 py-2.5 text-center mr-2 mb-2" onclick="return confirm('ยืนยันการลบข้อมูล');">
                    <i class="fa-solid fa-trash"></i>
                </a>
            </td>
        </tr>
        <?php } } ?>

        </tbody>
    </table>
    <div class="grid grid-cols-2 gap-4 ">
        <div class="flex">
        <div class="mt-4 mb-3 ml-5">
        <label class="font-[500]   text-gray-400 dark:text-gray-400"><?php echo "Showing 1 to 10 entries"  ?></label>
        </div>
        </div>
                        
            <div>
            <div class="relative z-0 flex justify-end mt-3  ">
                <div class="border flex rounded-full w-[19rem] bg-gray-200">
                <div class=" px-4 py-2  text-sm leading ">
                <?php  
                    echo "<a href='?page=1' class='  no-underline text-gray-700 '>First</a>";
                
                ?>
                </div>
                <div class="">
                    <a href="#" class="inline-flex items-center  px-2 py-2  text-sm leading-5 font-medium text-gray-500 hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150" aria-label="Previous" v-on:click.prevent="changePage(pagination.current_page - 1)">
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
                <div class="items-center px-4 py-2  text-sm leading-5 font-medium  -mr-4 -ml-4">
                <?php 
                for ($i = 1; $i <= $totalPages; $i++) {
                    echo "<a href='?page=$i' class='mr-[10px] ml-[10px] no-underline text-gray-700  '>$i</a>";
                }
                ?>
                </div>
                <div v-if="pagination.current_page < pagination.last_page ">
                    <a href="#" class=" relative inline-flex items-center px-2 py-2  text-sm leading-5 font-medium text-gray-500 hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150" aria-label="Next">
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
                <div class=" px-4 py-2  text-sm leading-5 ">
                <?php  
                    echo "<a href='?page=$totalPages' class='  no-underline text-gray-700  '>Last</a>";
                
                ?>
                </div>
                </div>
            </div>
        </div>
          </div>
          
    <div class="popup-image">
        <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($ingredients['ImgIngre1']) . '" alt="img" " class="rounded-lg " "/>'  ?>
        <button type="button" class="absolute top-6 right-6 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white ">
            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
        </button>
    </div>
    </div>
                </div>
            </div>
            </div>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.rawgit.com/prashantchaudhary/ddslick/master/jquery.ddslick.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
<script src="https://cdn.tailwindcss.com"></script>
<script>
  let imgInput = document.getElementById('imgInput');
  let previewContainer = document.getElementById('previewContainer');

  imgInput.onchange = evt => {
    // Clear previous previews
    previewContainer.innerHTML = '';

    const files = imgInput.files;

    for (const file of files) {
      const imgElement = document.createElement('img');
      imgElement.src = URL.createObjectURL(file);
      imgElement.className = 'w-full h-full rounded';
      previewContainer.appendChild(imgElement);
    }
  }
</script>

<script type='text/javascript'>
    $(document).ready(function() {
        $('.userinfo').click(function() {
            var userid = $(this).data('id');
            $.ajax({
                url: 'editingre.php',
                type: 'post',
                data: {
                    userid: userid
                },
                success: function(response) {
                    $('.modal-body4').html(response);
                    $('#EditModal').modal('show');
                }
            });
        });
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
<script>
    document.querySelectorAll('.thumbnail').forEach(image => {
        image.onclick = () => {
            document.querySelector('.popup-image').style.display = 'block';
            document.querySelector('.popup-image img').src = image.getAttribute('src');
        }
    })
    document.querySelector('.popup-image button').onclick = () => {
        document.querySelector('.popup-image').style.display = 'none';
    }
    document.querySelector('.popup-image').addEventListener('click', (e) => {
        if (e.target === document.querySelector('.popup-image')) {
            document.querySelector('.popup-image').style.display = 'none';
        }
    });
</script>
<script>
        function hideNotification() {
            const notification = document.getElementById('notification');
            notification.classList.add('fadeout');
        }
        setTimeout(hideNotification, 4000);
    </script>
    
</body>

</html>