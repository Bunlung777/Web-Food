<?php

session_start();
include ("../Config/DB.php");

if (isset($_POST['UpdateFood'])) {
    $id = $_POST['idd'];
    $name = $_POST['FoodName'];
    $detail = $_POST['detail'];
    $DetailSp = $_POST['DetailSp'];
    $note = $_POST['note'];
    $img2 = $_FILES['imgfood']['name'];
    $images = array();

    if($_FILES['imgfood']['error'][0] !== UPLOAD_ERR_OK){
        $sql = $conn->prepare("UPDATE food SET FoodName = :FoodName, Detail= :Detail, DetailSp = :DetailSp, Ingredients0 = :Ingredients0, 
        Ingredients1 = :Ingredients1, Ingredients2 = :Ingredients2, Ingredients3 = :Ingredients3, Ingredients4 = :Ingredients4, 
        Ingredients5 = :Ingredients5, Ingredients6 = :Ingredients6 , Ingredients7 = :Ingredients7, 
        Ingredients8 = :Ingredients8, Ingredients9 = :Ingredients9, Ingredients10 = :Ingredients10, Ingredients11 = :Ingredients11, Ingredients12 = :Ingredients12, Ingredients13 = :Ingredients13, Volume0 = :Volume0, 
        Volume1 = :Volume1, Volume2 = :Volume2, Volume3 = :Volume3, Volume4 = :Volume4, 
        Volume5 = :Volume5, Volume6 = :Volume6 , Volume7 = :Volume7, 
        Volume8 = :Volume8, Volume9 = :Volume9, Volume10 = :Volume10, Volume11 = :Volume11, Volume12 = :Volume12, Volume13 = :Volume13, Unit0 = :Unit0, 
        Unit1 = :Unit1, Unit2 = :Unit2, Unit3 = :Unit3, Unit4 = :Unit4, 
        Unit5 = :Unit5, Unit6 = :Unit6 , Unit7 = :Unit7, 
        Unit8 = :Unit8, Unit9 = :Unit9, Unit10 = :Unit10, Unit11 = :Unit11, Unit12 = :Unit12, Unit13 = :Unit13, note = :note
         WHERE IdFood = :id");
        $sql->bindParam(":FoodName", $name);
        $sql->bindParam(":Detail", $detail);
        $sql->bindParam(":DetailSp", $DetailSp);
        $sql->bindParam(":note", $note);
        $sql->bindParam(":id", $id);
        
        for ($i = 0; $i <= 13; $i++) {
            $Ingredients = 'Ingredients' . $i;
            if (isset($_POST[$Ingredients])) {
                $sql->bindValue(":Ingredients" . $i, $_POST[$Ingredients]);
            } else {
                $sql->bindValue(":Ingredients" . $i, null, PDO::PARAM_NULL);
            }
        }
        for ($i = 0; $i <= 13; $i++) {
            $Volume = 'Volume' . $i;
            if (isset($_POST[$Volume])) {
                $sql->bindValue(":Volume" . $i, $_POST[$Volume]);
            } else {
                $sql->bindValue(":Volume" . $i, null, PDO::PARAM_NULL);
            }
        }
        for ($i = 0; $i <= 13; $i++) {
            $Unit = 'Unit' . $i;
            if (isset($_POST[$Unit])) {
                $sql->bindValue(":Unit" . $i, $_POST[$Unit]);
            } else {
                $sql->bindValue(":Unit" . $i, null, PDO::PARAM_NULL);
            }
        }
        $executeResult = $sql->execute();
    
        if ($executeResult) {
            $i = $_SESSION['page'];
            $_SESSION['success'] = "เพิ่มข้อมูลเรียบร้อย";
        } else {
            $_SESSION['error'] = "Data has not been updated successfully";
        }
        header("location: Foodindex.php?page=$i");
        exit();
    }else{
    foreach ($_FILES['imgfood']['tmp_name'] as $key => $imgTmpName) {
        if ($_FILES['imgfood']['error'][$key] === UPLOAD_ERR_OK) {
            // Read the file content
            $img = file_get_contents($imgTmpName);
            $images[] = $img;
        } else {
            $_SESSION['error'] = "Error uploading file " . $key;
            header("location: Foodindex.php");
            exit();
        }
    }
    $numImages = count($images);
    $maxImg = 4;
        $sql = $conn->prepare("UPDATE food SET FoodName = :FoodName, Detail= :Detail, DetailSp = :DetailSp, ImgFood1 = :ImgFood1, ImgFood2 = :ImgFood2, ImgFood3 = :ImgFood3 
        , ImgFood4 = :ImgFood4, Ingredients0 = :Ingredients0, 
        Ingredients1 = :Ingredients1, Ingredients2 = :Ingredients2, Ingredients3 = :Ingredients3, Ingredients4 = :Ingredients4, 
        Ingredients5 = :Ingredients5, Ingredients6 = :Ingredients6 , Ingredients7 = :Ingredients7, 
        Ingredients8 = :Ingredients8, Ingredients9 = :Ingredients9, Ingredients10 = :Ingredients10, Ingredients11 = :Ingredients11, Ingredients12 = :Ingredients13, Ingredients13 = :Ingredients12, Volume0 = :Volume0, 
        Volume1 = :Volume1, Volume2 = :Volume2, Volume3 = :Volume3, Volume4 = :Volume4, 
        Volume5 = :Volume5, Volume6 = :Volume6 , Volume7 = :Volume7, 
        Volume8 = :Volume8, Volume9 = :Volume9, Volume10 = :Volume10, Volume11 = :Volume11, Volume12 = :Volume12, Volume13 = :Volume13, Unit0 = :Unit0, 
        Unit1 = :Unit1, Unit2 = :Unit2, Unit3 = :Unit3, Unit4 = :Unit4, 
        Unit5 = :Unit5, Unit6 = :Unit6 , Unit7 = :Unit7, 
        Unit8 = :Unit8, Unit9 = :Unit9, Unit10 = :Unit10, Unit11 = :Unit11, Unit12 = :Unit12, Unit13 = :Unit13
         WHERE IdFood = :id");
        for ($g = 1; $g <= $maxImg; $g++) {
            for ($iii = 1; $iii <= $numImages; $iii++) {
                $ImgFood = 'ImgFood'.$iii;
                $sql->bindParam(":".$ImgFood, $images[$iii-1], PDO::PARAM_LOB);
            }
            for ($a = $g+1 ; $a <= $maxImg; $a++) {
                $ImgFood = 'ImgFood'.$a;
                $emptyValue = "";
                $sql->bindParam(":".$ImgFood,$emptyValue);
            }
            }
        $sql->bindParam(":FoodName", $name);
        $sql->bindParam(":Detail", $detail);
        $sql->bindParam(":DetailSp", $DetailSp);
        $sql->bindParam(":id", $id);
        
        for ($i = 0; $i <= 13; $i++) {
            $Ingredients = 'Ingredients' . $i;
            if (isset($_POST[$Ingredients])) {
                $sql->bindValue(":Ingredients" . $i, $_POST[$Ingredients]);
            } else {
                $sql->bindValue(":Ingredients" . $i, null, PDO::PARAM_NULL);
            }
        }
        for ($i = 0; $i <= 13; $i++) {
            $Volume = 'Volume' . $i;
            if (isset($_POST[$Volume])) {
                $sql->bindValue(":Volume" . $i, $_POST[$Volume]);
            } else {
                $sql->bindValue(":Volume" . $i, null, PDO::PARAM_NULL);
            }
        }
        for ($i = 0; $i <= 13; $i++) {
            $Unit = 'Unit' . $i;
            if (isset($_POST[$Unit])) {
                $sql->bindValue(":Unit" . $i, $_POST[$Unit]);
            } else {
                $sql->bindValue(":Unit" . $i, null, PDO::PARAM_NULL);
            }
        }
        $executeResult = $sql->execute();
    
     if ($executeResult) {
        $i = $_SESSION['page'];
        $_SESSION['success'] = "เพิ่มข้อมูลเรียบร้อย";
    } else {
        $_SESSION['error'] = "Data has not been updated successfully";
    }
    header("location: Foodindex.php?page=$i");
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
                    $stmt = $conn->query("SELECT F.IdFood,F.ImgFood1,F.ImgFood2,F.ImgFood3,F.ImgFood4,F.FoodName,F.Detail,F.DetailSp,F.note,
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
                    F.Ingredients13 AS Ingredients13,
                    F.Volume0 AS Volume0,
                    F.Volume1 AS Volume1,
                    F.Volume2 AS Volume2,
                    F.Volume3 AS Volume3,
                    F.Volume4 AS Volume4,
                    F.Volume5 AS Volume5,
                    F.Volume6 AS Volume6,
                    F.Volume7 AS Volume7,
                    F.Volume8 AS Volume8,
                    F.Volume9 AS Volume9,
                    F.Volume10 AS Volume10,
                    F.Volume11 AS Volume11,
                    F.Volume12 AS Volume12,
                    F.Volume13 AS Volume13,
                    F.Unit0 AS Unit0,
                    F.Unit1 AS Unit1,
                    F.Unit2 AS Unit2,
                    F.Unit3 AS Unit3,
                    F.Unit4 AS Unit4,
                    F.Unit5 AS Unit5,
                    F.Unit6 AS Unit6,
                    F.Unit7 AS Unit7,
                    F.Unit8 AS Unit8,
                    F.Unit9 AS Unit9,
                    F.Unit10 AS Unit10,
                    F.Unit11 AS Unit11,
                    F.Unit12 AS Unit12,
                    F.Unit13 AS Unit13,
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
                    I12.ingredientsName AS IngredientsName12,
                    I13.ingredientsName AS IngredientsName13
                    FROM food AS F 
             LEFT JOIN ingredients AS I ON F.Ingredients0 = I.Idingre
             LEFT JOIN ingredients AS I1 ON F.Ingredients1 = I1.Idingre
             LEFT JOIN ingredients AS I2 ON F.Ingredients2 = I2.Idingre 
             LEFT JOIN ingredients AS I3 ON F.Ingredients3 = I3.Idingre
             LEFT JOIN ingredients AS I4 ON F.Ingredients4 = I4.Idingre
             LEFT JOIN ingredients AS I5 ON F.Ingredients5 = I5.Idingre 
             LEFT JOIN ingredients AS I6 ON F.Ingredients6 = I6.Idingre 
             LEFT JOIN ingredients AS I7 ON F.Ingredients7 = I7.Idingre 
             LEFT JOIN ingredients AS I8 ON F.Ingredients8 = I8.Idingre 
             LEFT JOIN ingredients AS I9 ON F.Ingredients9 = I9.Idingre 
             LEFT JOIN ingredients AS I10 ON F.Ingredients10 = I10.Idingre 
             LEFT JOIN ingredients AS I11 ON F.Ingredients11 = I11.Idingre 
             LEFT JOIN ingredients AS I12 ON F.Ingredients12 = I12.Idingre 
             LEFT JOIN ingredients AS I13 ON F.Ingredients13 = I13.Idingre 
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
                    <?php  $totalImg = 1;
                    for ($i = 1; $i < 5; $i++) { 
                        if ($data['ImgFood' . $i] != null) {
                            $totalImg++;
                        } else {
                            break; 
                        }
                    } ?>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font">รูปภาพอาหาร :</label>
                        <input multiple class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="imgInput2" type="file" name="imgfood[]" >
                        <div id="previewContainer2" class="mt-4 grid grid-cols-2 gap-2">
                        <?php for ($i = 1; $i < $totalImg; $i++) {
                        $ImgFood = $data['ImgFood' . $i];
                    ?>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($ImgFood); ?>" alt="" width="100%" id="previewImg2" class="rounded-lg"/>
                    <?php } ?>    
                    </div>
                    </div>
                    <div>
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font">ชื่อสำรับ</label>
                        <input type="text" value="<?php echo $data['FoodName']; ?>" name="FoodName" id="text"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                    </div>
                    <div>
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font">วิธีทำอาหาร</label>
                        <textarea name="detail" id="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 h-[100px]" ><?php echo $data['Detail']; ?></textarea>
                    </div>
                    <div>
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font">เทคนิคพิเศษ</label>
                        <textarea name="DetailSp" id="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 h-[100px]" ><?php echo $data['DetailSp']; ?></textarea>
                    </div>
                    <div>
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font">หมายเหตุ</label>
                        <input type="text" value="<?php echo $data['note']; ?>" name="note" id="text"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                    </div>
                    <div class="field">
                                        <?php
                    $totalIngredients = 0;
                    for ($i = 0; $i < 14; $i++) { 
                        if ($data['IngredientsName' . $i] != null) {
                            $totalIngredients++;
                        } else {
                            break; 
                        }
                    }

                    for ($i = 0; $i < $totalIngredients; $i++) {
                        $ingredientName = $data['IngredientsName' . $i];
                        $selectedIngredient = $data['Ingredients' . $i];
                        $Volume = $data['Volume' . $i];
                        $Unit = $data['Unit' . $i]
                    ?>
                     
                     <div class="ingredientid" >
                        <div class="ingredient-select-<?php echo $i; ?> ingredient-row-item">
                            <label id="IngreName" for="Ingredients<?php echo $i; ?>" class="block mb-2 mt-3 text-sm font-medium text-gray-900 dark:text-white font">
                                ส่วนประกอบที่ <?php echo $i + 1 ?>
                            </label>
                            <select id="SelectI" class="flex bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="Ingredients<?php echo $i; ?>">
                                <option value="<?php echo $selectedIngredient; ?>"><?php echo $ingredientName; ?></option>
                                <?php foreach ($ingredient as $index => $IngreName) { ?>
                                    <option value="<?php echo $Idingre[$index]; ?>">
                                        <?php echo ($index + 1), ". ", $IngreName; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div style="flex: 1; margin-top: 12px;">
                            <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font">ปริมาณ :</label>
                            <input value="<?php echo $Volume ?>" id="VolumeId1" class="mt-1 mb-1 additem w-full inline-block bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-blue-700 dark:border-blue-600 dark:placeholder-blue-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="Volume<?php echo $i; ?>">
                        </div>
                        <div style="flex: 1; margin-top: 12px;">
                            <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font">หน่วย :</label>
                            <select id="UnitId1" class="mt-1 mb-1 additem w-full inline-block bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="Unit<?php echo $i; ?>">
                                <option value="กรัม"><?php echo $Unit ?></option>
                                <option value="กรัม">กรัม</option>
                                <option value="กิโลกรัม">กิโลกรัม</option>
                                <option value="หัว">หัว</option>
                                <option value="เม็ด">เม็ด</option>
                                <option value="เม็ด">ลูก</option>
                                <option value="ช้อนโต๊ะ">ช้อนโต๊ะ</option>
                                <option value="ช้อนชา">ช้อนชา</option>
                                <option value="ต้น">ต้น</option>
                            </select>
                        </div>
                        </div>
        <?php } ?>
    </div>

    <div class="flex justify-end">
    <input type="button" name="add" id="add" value="เพิ่ม" class="inline-block h-12 px-6 text-white bg-gradient-to-r from-gray-400 via-Neutral-500 to-gray-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-gray-300 dark:focus:ring-gray-800 font-medium rounded-lg text-sm py-2.5 text-center">
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
  let previewContainer = document.getElementById('previewContainer2');

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
<script>
    $(document).ready(function () {
        var counterIngredients = <?php echo $totalIngredients; ?>;
        var timesToCloneIngredients = 14;

        $("#add").click(function () {
            if (counterIngredients < timesToCloneIngredients) {
                var clonedContainer = $(".ingredientid").first().clone();

                clonedContainer.find("#IngreName").text("ส่วนประกอบที่ " + (counterIngredients + 1));
                clonedContainer.find("#SelectI").attr("name", "Ingredients" + counterIngredients);
                clonedContainer.find("#VolumeId1").attr("name", "Volume" + counterIngredients);
                clonedContainer.find("#UnitId1").attr("name", "Unit" + counterIngredients);
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