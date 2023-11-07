<?php

session_start();
include ("../Config/DB.php");

if (isset($_POST['UpdateFood'])) {
    $id = $_POST['idd'];
    $name = $_POST['FoodName'];
    $detail = $_POST['detail'];
    $img2 = $_FILES['imgfood']['name'];
    
    
    if($img2 != ''){
        $img = file_get_contents($_FILES['imgfood']['tmp_name']);
        $sql = $conn->prepare("UPDATE food SET FoodName = :FoodName, Detail= :Detail, ImgFood = :ImgFood , Ingredients0 = :Ingredients0, 
        Ingredients1 = :Ingredients1, Ingredients2 = :Ingredients2, Ingredients3 = :Ingredients3, Ingredients4 = :Ingredients4, 
        Ingredients5 = :Ingredients5, Ingredients6 = :Ingredients6 , Ingredients7 = :Ingredients7, 
        Ingredients8 = :Ingredients8, Ingredients9 = :Ingredients9, Ingredients10 = :Ingredients10, Ingredients11 = :Ingredients11 
         WHERE IdFood = :id");
        $sql->bindParam(":ImgFood", $img);
        $sql->bindParam(":FoodName", $name);
        $sql->bindParam(":Detail", $detail);
        $sql->bindParam(":id", $id);
        
        for ($i = 0; $i < 12; $i++) {
            $Ingredients = 'Ingredients' . $i;
            if (isset($_POST[$Ingredients])) {
                $sql->bindValue(":Ingredients" . $i, $_POST[$Ingredients]);
            } else {
                $sql->bindValue(":Ingredients" . $i, null, PDO::PARAM_NULL);
            }
        }
        $executeResult = $sql->execute();
    
        if ($executeResult) {
            $_SESSION['success'] = "เพิ่มข้อมูลเรียบร้อย";
        } else {
            $_SESSION['error'] = "Data has not been updated successfully";
        }
        header("location: Foodindex.php");
        exit();
    }else{
        $sql = $conn->prepare("UPDATE food SET FoodName = :FoodName, Detail= :Detail, Ingredients0 = :Ingredients0, 
        Ingredients1 = :Ingredients1, Ingredients2 = :Ingredients2, Ingredients3 = :Ingredients3, Ingredients4 = :Ingredients4, 
        Ingredients5 = :Ingredients5, Ingredients6 = :Ingredients6 , Ingredients7 = :Ingredients7, 
        Ingredients8 = :Ingredients8, Ingredients9 = :Ingredients9, Ingredients10 = :Ingredients10, Ingredients11 = :Ingredients11  WHERE IdFood = :id");
    
        $sql->bindParam(":FoodName", $name);
        $sql->bindParam(":Detail", $detail);
        $sql->bindParam(":id", $id);
        
        for ($i = 0; $i < 12; $i++) {
            $Ingredients = 'Ingredients' . $i;
            if (isset($_POST[$Ingredients])) {
                $sql->bindValue(":Ingredients" . $i, $_POST[$Ingredients]);
            } else {
                $sql->bindValue(":Ingredients" . $i, null, PDO::PARAM_NULL);
            }
        }
        $executeResult = $sql->execute();
    
        if ($executeResult) {
            $_SESSION['success'] = "เพิ่มข้อมูลเรียบร้อย";
        } else {
            $_SESSION['error'] = "Data has not been updated successfully";
        }
        header("location: Foodindex.php");
        exit();
    }
    }

    $sql = "SELECT ingredientsName	FROM ingredients";
    $foodName = $conn->prepare($sql);
    $foodName->execute();
    $ingredient = $foodName->fetchAll(PDO::FETCH_COLUMN);
    
    $sqlFood = "SELECT Idingre FROM ingredients";
    $IdFood = $conn->prepare($sqlFood);
    $IdFood->execute();
    $Idingre = $IdFood->fetchAll(PDO::FETCH_COLUMN);

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
    <!-- Modal content -->
    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="px-6 py-6 lg:px-8">
                <form class="space-y-6" action="editFood.php" method="post" enctype="multipart/form-data">
            <?php 
                if(isset($_POST['userid'])){ //รับค่าจาก id มาจาก index     ฟังก์ชั่น isset เป็นฟังก์ชั่นที่ใช้ในการตรวจสอบว่าตัวแปรนั้นมีการกำหนดค่าไว้หรือไม่
                    $Id = $_POST['userid'];
                    $stmt = $conn->query("SELECT F.IdFood,F.ImgFood,F.FoodName,F.Detail,
                    F.Ingredients0 AS Ingredients0,	
                    F.Ingredients1 AS Ingredients1,	
                    F.Ingredients2 AS Ingredients2,	
                    F.Ingredients3 AS Ingredients3,	
                    F.Ingredients4 AS Ingredients4,	
                    F.Ingredients5 AS Ingredients5,	
                    F.Ingredients6 AS Ingredients6,	
                    F.Ingredients7 AS Ingredients7,	
                    F.Ingredients8 AS Ingredients8,	
                    F.Ingredients9 AS Ingredients9,	
                    F.Ingredients10 AS Ingredients10,	
                    F.Ingredients11 AS Ingredients11,	
                    F.Ingredients12 AS Ingredients12,
                    I.ingredientsName AS IngredientsName0, 
                    I1.ingredientsName AS IngredientsName1, 
                    I2.ingredientsName AS IngredientsName2, 
                    I3.ingredientsName AS IngredientsName3, 
                    I4.ingredientsName AS IngredientsName4, 
                    I5.ingredientsName AS IngredientsName5, 
                    I6.ingredientsName AS IngredientsName6, 
                    I7.ingredientsName AS IngredientsName7, 
                    I8.ingredientsName AS IngredientsName8, 
                    I9.ingredientsName AS IngredientsName9, 
                    I10.ingredientsName AS IngredientsName10, 
                    I11.ingredientsName AS IngredientsName11,
                    I11.ingredientsName AS IngredientsName12
                    FROM food AS F 
             LEFT JOIN Ingredients AS I ON F.Ingredients0 = I.Idingre
             LEFT JOIN Ingredients AS I1 ON F.Ingredients1 = I1.Idingre
             LEFT JOIN Ingredients AS I2 ON F.Ingredients2 = I2.Idingre 
             LEFT JOIN Ingredients AS I3 ON F.Ingredients3 = I3.Idingre
             LEFT JOIN Ingredients AS I4 ON F.Ingredients4 = I4.Idingre
             LEFT JOIN Ingredients AS I5 ON F.Ingredients5 = I5.Idingre 
             LEFT JOIN Ingredients AS I6 ON F.Ingredients6 = I6.Idingre 
             LEFT JOIN Ingredients AS I7 ON F.Ingredients7 = I7.Idingre 
             LEFT JOIN Ingredients AS I8 ON F.Ingredients8 = I8.Idingre 
             LEFT JOIN Ingredients AS I9 ON F.Ingredients9 = I9.Idingre 
             LEFT JOIN Ingredients AS I10 ON F.Ingredients10 = I10.Idingre 
             LEFT JOIN Ingredients AS I11 ON F.Ingredients11 = I11.Idingre 
             LEFT JOIN Ingredients AS I12 ON F.Ingredients12 = I12.Idingre 
             WHERE IdFood = $Id");
                    $stmt->execute();
                    $data = $stmt->fetch();
                }
            ?>
                 <div>
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font">ID :</label>
                        <input type="text" readonly value ="<?php echo $data['IdFood']; ?>" required name="idd" id="text"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font">รูปภาพอาหาร :</label>
                        <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="imgInput2" type="file" name="imgfood" >
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($data['ImgFood']); ?>" alt="" width="100%" id="previewImg2" class="rounded-lg"/>
                    </div>
                    <div>
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font">ชื่อสำรับ</label>
                        <input type="text" value="<?php echo $data['FoodName']; ?>" name="FoodName" id="text"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                    <div>
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font">รายละเอียดอาหาร</label>
                        <textarea name="detail" id="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 h-[100px]" required><?php echo $data['Detail']; ?></textarea>
                    </div>
                     <div class="field">
                                        <?php
                    $totalIngredients = 0;
                    for ($i = 0; $i < 13; $i++) { 
                        if ($data['IngredientsName' . $i] != null) {
                            $totalIngredients++;
                        } else {
                            break; 
                        }
                    }

                    for ($i = 0; $i < $totalIngredients; $i++) {
                        $ingredientName = $data['IngredientsName' . $i];
                        $selectedIngredient = $data['Ingredients' . $i];
                    ?>
                    
                        <div class="ingredient-select-<?php echo $i; ?>">
                            <label for="Ingredients<?php echo $i; ?>" class="block mb-2 mt-3 text-sm font-medium text-gray-900 dark:text-white font">
                                ส่วนประกอบที่ <?php echo $i + 1 ?>
                            </label>
                            <select class="flex bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="Ingredients<?php echo $i; ?>">
                                <option value="<?php echo $selectedIngredient; ?>"><?php echo $ingredientName; ?></option>
                                <?php foreach ($ingredient as $index => $IngreName) { ?>
                                    <option value="<?php echo $Idingre[$index]; ?>">
                                        <?php echo ($index + 1), ". ", $IngreName; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
        <?php } ?>
    </div>

    <div class="flex justify-end">
    <input type="button" name="add" id="add" value="Add" class="inline-block h-12 px-6 text-white bg-gradient-to-r from-gray-400 via-Neutral-500 to-gray-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-gray-300 dark:focus:ring-gray-800 font-medium rounded-lg text-sm py-2.5 text-center">
</div>


                    <div class="flex justify-end space-x-4">
                        <div>
                     <a  type="submit" name="close" class="no-underline h-12 px-6 text-white bg-gradient-to-r from-gray-400 via-Neutral-500 to-gray-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-gray-300 dark:focus:ring-gray-800 font-medium rounded-lg py-2.5 text-center" href="Foodindex.php" >ยกเลิก</a>
                    </div> 
                    <div>
                    <button type="submit" name="UpdateFood" class=" h-12 px-6 text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg py-2.5 text-center" >บันทึก</button>
                    </div>   
                </div>
                </form>
            </div>
        </div>

    
</table>
</div>
     
  


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>  
<script>
        let imgInput = document.getElementById('imgInput2');
        let previewImg = document.getElementById('previewImg2');

        imgInput.onchange = evt => {
            const [file] = imgInput.files;
                if (file) {
                    previewImg.src = URL.createObjectURL(file)
            }
        }
        
</script>
<script>
    $(document).ready(function () {
        var counterIngredients = <?php echo $totalIngredients; ?>;
        var timesToCloneIngredients = 13;

        $("#add").click(function () {
            if (counterIngredients < timesToCloneIngredients) {
                var clonedContainer = $(".ingredient-select-0").first().clone();

                clonedContainer.find("label").text("ส่วนประกอบที่ " + (counterIngredients + 1));
                clonedContainer.find("select").attr("name", "Ingredients" + counterIngredients);

                counterIngredients++;
                $(".field").append(clonedContainer);
            }
        });
    });
</script>

<!-- <script>
    var i = <?php echo $totalIngredients; ?>-1 ;

    function deleteIngredientSelect(element) {
        if (i > 0) {
            $(element).closest(".ingredient-select-" + i).remove();
            console.log(<?php echo $totalIngredients ?>);
            i--;
        }
    }
</script> -->
</body>
</html>