<?php

session_start();
include ("../Config/DB.php");

if (isset($_POST['UpdateSet'])) {
    $id = $_POST['idd'];
    $Village = $_POST['villageName'];
    $set = $_POST['setName'];
    $FoodName = $_POST['foodName'];

    $img2 = $_FILES['imgSet']['name'];
    
    if($img2 != ''){

    $img = file_get_contents($_FILES['imgSet']['tmp_name']);
    $sql = $conn->prepare("UPDATE setfood SET VillageSet = :villageSet , ImgSet = :imgSet , SetName = :setName , FoodName = :foodName WHERE Idset = :id");
    $sql->bindParam(":id", $id  );
    $sql->bindParam(":villageSet", $Village);
    $sql->bindParam(":imgSet", $img);
    $sql->bindParam(":setName", $set);
    $sql->bindParam(":foodName", $FoodName);
    $sql->execute();
    if ($sql) {
        $_SESSION['editsuccess'] = "";
        header("location: indexSetFood.php");
    } else {
        $_SESSION['error'] = "";
        header("location: indexSetFood.php");
    }
    }else{
        $sql = $conn->prepare("UPDATE setfood SET VillageSet = :villageSet , SetName = :setName , FoodName = :foodName WHERE Idset = :id");
        $sql->bindParam(":id", $id  );
        $sql->bindParam(":villageSet", $Village);
        $sql->bindParam(":setName", $set);
        $sql->bindParam(":foodName", $FoodName);
        $sql->execute();
        if ($sql) {
            $_SESSION['editsuccess'] = "";
            header("location: indexSetFood.php");
        } else {
            $_SESSION['error'] = "";
            header("location: indexSetFood.php");
        }
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
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

    
     <!-- Modal content -->
     <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="px-6 py-6 lg:px-8">
                <form class="space-y-6" action="editSetFood.php" method="post" enctype="multipart/form-data">
            <?php 
                if(isset($_POST['userid'])){ //รับค่าจาก id มาจาก index     ฟังก์ชั่น isset เป็นฟังก์ชั่นที่ใช้ในการตรวจสอบว่าตัวแปรนั้นมีการกำหนดค่าไว้หรือไม่
                    $Id = $_POST['userid'];
                    $stmt = $conn->query("SELECT * FROM setfood WHERE Idset = $Id");
                    $stmt->execute();
                    $data = $stmt->fetch();
                }
            ?>
                 <div>
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ID :</label>
                        <input type="text" readonly value ="<?php echo $data['Idset']; ?>" required name="idd" id="text"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                    <div>
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ชื่อหมู่บ้าน</label>
                        <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="villageName" id="options">
                    <option><?php echo $data['VillageSet']; ?></option>"; 
                <?php
                // Generate the dropdown options
                foreach ($options as $option) {
                    echo "<option>$option</option>";
                }
                ?>
                
                </select>
                    </div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">รูปภาพของหมู่บ้าน :</label>
                        <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="imgInput1" type="file" name="imgSet">
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($data['ImgSet']); ?>" alt="" width="100%" id="previewImg1" class="rounded-lg"/>
                    </div>
                    <div>
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ชื่อสำรับ</label>
                        <input type="text" value="<?php echo $data['SetName']; ?>" name="setName" id="text"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                    <div>
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">อาหาร</label>
                        <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="foodName" id="options">
                    <option><?php echo $data['FoodName']; ?></option>"; 
                <?php
                // Generate the dropdown options
                foreach ($food as $food) {
                    echo "<option>$food</option>";
                }
                ?>
                
                </select>
                    </div>
                    <div class="flex justify-end space-x-4">
                        <div>
                     <a  type="submit" name="close" class="no-underline h-12 px-6 text-white bg-gradient-to-r from-gray-400 via-Neutral-500 to-gray-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-gray-300 dark:focus:ring-gray-800 font-medium rounded-lg py-2.5 text-center" href="index.php" >Close</a>
                    </div> 
                    <div>
                    <button type="submit" name="UpdateSet" class=" h-12 px-6 text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg py-2.5 text-center" >Submit</button>
                    </div>   
                </div>
                </form>
            </div>
        </div>
    </div>
</div> 
     
  



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
<script src="https://cdn.tailwindcss.com"></script>
<script>
        let imgInput = document.getElementById('imgInput1');
        let previewImg = document.getElementById('previewImg1');

        imgInput.onchange = evt => {
            const [file] = imgInput.files;
                if (file) {
                    previewImg.src = URL.createObjectURL(file)
            }
        }
        
</script>


</body>
</html>