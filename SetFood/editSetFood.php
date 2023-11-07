<?php

session_start();
include ("../Config/DB.php");

if (isset($_POST['UpdateSet'])) {
    $id = $_POST['idd'];
    $Village = $_POST['villageName'];
    $set = $_POST['setName'];
    $img2 = $_FILES['imgfood']['name'];
    
    if($img2 != ''){
    $img = file_get_contents($_FILES['imgfood']['tmp_name']);
    $sql = $conn->prepare("UPDATE setfood SET VillageSet = :village, ImgSet = :img , SetName = :setName, FoodName0 = :foodName0, FoodName1 = :foodName1, FoodName2 = :foodName2, FoodName3 = :foodName3, FoodName4 = :foodName4, FoodName5 = :foodName5, FoodName6 = :foodName6 WHERE Idset = :id");
    
        // Bind parameters
        $sql->bindParam(":village", $Village);
        $sql->bindParam(":img", $img, PDO::PARAM_LOB);
        $sql->bindParam(":setName", $set);
        $sql->bindParam(":id", $id);
        
        // Bind the food names dynamically
        for ($i = 0; $i < 7; $i++) {
            $foodNameKey = 'foodName' . $i;
            if (isset($_POST[$foodNameKey])) {
                $sql->bindValue(":foodName" . $i, $_POST[$foodNameKey]);
            } else {
                $sql->bindValue(":foodName" . $i, null, PDO::PARAM_NULL);
            }
        }
    
        // Execute the SQL statement
        $executeResult = $sql->execute();
    
        if ($executeResult) {
            $_SESSION['success'] = "เพิ่มข้อมูลเรียบร้อย";
        } else {
            $_SESSION['error'] = "Data has not been updated successfully";
        }
        header("location: indexSetFood.php");
        exit();
    }else {
        $sql = $conn->prepare("UPDATE setfood SET VillageSet = :village, SetName = :setName, FoodName0 = :foodName0, FoodName1 = :foodName1, FoodName2 = :foodName2, FoodName3 = :foodName3, FoodName4 = :foodName4, FoodName5 = :foodName5, FoodName6 = :foodName6 WHERE Idset = :id");
    
        // Bind parameters
        $sql->bindParam(":village", $Village);
        $sql->bindParam(":setName", $set);
        $sql->bindParam(":id", $id);
        
        // Bind the food names dynamically
        for ($i = 0; $i < 7; $i++) {
            $foodNameKey = 'foodName' . $i;
            if (isset($_POST[$foodNameKey])) {
                $sql->bindValue(":foodName" . $i, $_POST[$foodNameKey]);
            } else {
                $sql->bindValue(":foodName" . $i, null, PDO::PARAM_NULL);
            }
        }
    
        // Execute the SQL statement
        $executeResult = $sql->execute();
    
        if ($executeResult) {
            $_SESSION['success'] = "เพิ่มข้อมูลเรียบร้อย";
        } else {
            $_SESSION['error'] = "Data has not been updated successfully";
        }
        header("location: indexSetFood.php");
        exit();
    
    
    }   
}
$sql1 = "SELECT Name FROM village ";
$userVillage = $conn->prepare($sql1);
$userVillage->execute();
$options = $userVillage->fetchAll(PDO::FETCH_COLUMN);

$sql2 = "SELECT Id FROM village ";
$userId = $conn->prepare($sql2);
$userId->execute();
$Idvi = $userId->fetchAll(PDO::FETCH_COLUMN);

$sql3 = "SELECT FoodName FROM food";
$foodName = $conn->prepare($sql3);
$foodName->execute();
$food = $foodName->fetchAll(PDO::FETCH_COLUMN);


$sql4 = "SELECT IdFood FROM food";
$foodId = $conn->prepare($sql4);
$foodId->execute();
$foodId = $foodId->fetchAll(PDO::FETCH_COLUMN);

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
                if(isset($_POST['userid'])){ 
                    $Id = $_POST['userid'];
                    $stmt = $conn->query("SELECT S.Idset, S.ImgSet, V.Name, S.SetName,V.Id,
					S.FoodName0 AS FoodId0,
                    S.FoodName1 AS FoodId1,
                    S.FoodName2 AS FoodId2,
                    S.FoodName3 AS FoodId3,
                    S.FoodName4 AS FoodId4,
                    S.FoodName5 AS FoodId5,
                    S.FoodName6 AS FoodId6,
                    F.FoodName AS FoodName0, 
                    F1.FoodName AS FoodName1, 
                    F2.FoodName AS FoodName2,   
                    F3.FoodName AS FoodName3, 
                    F4.FoodName AS FoodName4, 
                    F5.FoodName AS FoodName5, 
                    F6.FoodName AS FoodName6 
             FROM setfood AS S 
             LEFT JOIN village AS V ON S.VillageSet = V.Id 
             LEFT JOIN food AS F ON S.FoodName0 = F.IdFood 
             LEFT JOIN food AS F1 ON S.FoodName1 = F1.IdFood 
             LEFT JOIN food AS F2 ON S.FoodName2 = F2.IdFood 
             LEFT JOIN food AS F3 ON S.FoodName3 = F3.IdFood 
             LEFT JOIN food AS F4 ON S.FoodName4 = F4.IdFood 
             LEFT JOIN food AS F5 ON S.FoodName5 = F5.IdFood 
             LEFT JOIN food AS F6 ON S.FoodName6 = F6.IdFood 
             WHERE S.Idset = $Id;
              ");
                    $stmt->execute();
                    $data = $stmt->fetch();  
                }
            ?>

                 <div>
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font">ID :</label>
                        <input type="text" readonly value ="<?php echo $data['Idset']; ?>" required name="idd" id="text"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                    <div>
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font">ชื่อหมู่บ้าน</label>
                        <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="villageName" id="options">
                    <option value="<?php echo $data['Id']; ?>"><?php echo $data['Name']; ?></option>"; 

                    <?php
                                foreach (array_combine($options, $Idvi) as $options => $idvi) {
                                ?>
                                    <option value="<?php echo $idvi; ?>"><?php echo $options ?></option>
                                <?php } ?>
                
                </select>
                    </div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font">รูปภาพอาหาร :</label>
                        <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="imgInput1" type="file" name="imgfood" >
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($data['ImgSet']); ?>" alt="" width="100%" id="previewImg1" class="rounded-lg" />
                    </div>
                    <div>
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font">ชื่อสำรับ</label>
                        <input type="text" value="<?php echo $data['SetName']; ?>" name="setName" id="text"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                    
                    <div class="field">               
                    <?php
$totalFoodNames = 0;
for ($i = 0; $i < 7; $i++) { 
    if ($data['FoodName' . $i] != null) {
        $totalFoodNames++;
    } else {
        break;
    }
}

for ($i = 0; $i < $totalFoodNames; $i++) {
    ?>
    <div class="food-select-<?php echo $i; ?>">
        <label for="text" class="block mb-2 mt-3 text-sm font-medium text-gray-900 dark:text-white font">ตำรับอาหาร <?php echo $i + 1 ?></label>
        <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="food" name="foodName<?php echo $i; ?>">
        <option value="<?php echo $data['FoodId'.$i]; ?>"><?php echo $data['FoodName'.$i]; ?></option>
          <?php
            foreach (array_combine($food, $foodId) as $foodItem => $foodid) {
                ?>
                <option value="<?php echo $foodid; ?>"><?php echo $foodItem ?></option>
                <?php
            }
            ?>
        </select>
        
    </div>
    <?php } ?>
</div>
<div class="flex justify-end">
    
<input type="button" name="add" id="add" value="Add" class="inline-block h-12 px-6 text-white bg-gradient-to-r from-gray-400 via-Neutral-500 to-gray-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-gray-300 dark:focus:ring-gray-800 font-medium rounded-lg text-sm py-2.5 text-center">
</div>              

                    <div class="flex justify-end space-x-4 mt-3">
                        <div>
                     <a  type="submit" name="close" class="no-underline h-12 px-6 text-white bg-gradient-to-r from-gray-400 via-Neutral-500 to-gray-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-gray-300 dark:focus:ring-gray-800 font-medium rounded-lg py-2.5 text-center" href="indexsetFood.php" >ยกเลิก</a>
                    </div> 
                    <div>
                    <button type="submit" name="UpdateSet" class=" h-12 px-6 text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg py-2.5 text-center" >บันทึก</button>
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
        let imgInput1 = document.getElementById('imgInput1');
        let previewImg1 = document.getElementById('previewImg1');

        imgInput1.onchange = evt => { //OnChange  การดำเนินการเพื่อดำเนินการเมื่อผู้ใช้เปลี่ยนแปลงค่าของตัวควบคุม ใช้กับตัวควบคุม เพิ่มรูปภาพ, ดรอปดาวน์
            const [file] = imgInput1.files;
                if (file) {
                    previewImg1.src = URL.createObjectURL(file)
            }
        }
</script>
<script>
    $(document).ready(function () {
        var counter = <?php echo $totalFoodNames; ?>;
        var timesToClone = 7; 

        $("#add").click(function () {
            if (counter < timesToClone) {
                var clonedContainer = $(".food-select-0").first().clone(); 

                clonedContainer.find("label").text("ตำรับอาหาร " + (counter + 1));
                clonedContainer.find("select").attr("name", "foodName" + counter);

                counter++;

                $(".field").append(clonedContainer); 
                console.log(counter)
            }
        });
    });
</script>


</body>
</html>