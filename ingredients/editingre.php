<?php

session_start();
include("../Config/DB.php");

if (isset($_POST['UpdateIngre'])) {
    $id = $_POST['idd'];
    $ingreName = $_POST['Ingrename'];
    $img2 = $_FILES['imgIngre']['name'];

    $images = array();

    foreach ($_FILES['imgIngre']['tmp_name'] as $key => $imgTmpName) {
        if ($_FILES['imgIngre']['error'][$key] === UPLOAD_ERR_OK) {
            // Read the file content
            $img = file_get_contents($imgTmpName);
            $images[] = $img;
        } else {
            $_SESSION['editsuccess'] = "Error uploading file " . $key;
            header("location: indexingre.php");
            exit();
        }
    }
    $numImages = count($images);
    $maxImg = 4;

        $sql = $conn->prepare("UPDATE ingredients SET ImgIngre1 = :ImgIngre1, ImgIngre2 = :ImgIngre2, ImgIngre3 = :ImgIngre3, ImgIngre4 = :ImgIngre4, ingredientsName = :ingredientsName 
        WHERE Idingre = :Idingre");
        for ($g = 1; $g <= $maxImg; $g++) {
            for ($iii = 1; $iii <= $numImages; $iii++) {
                $ImgFood = 'ImgIngre'.$iii;
                $sql->bindParam(":".$ImgFood, $images[$iii-1], PDO::PARAM_LOB);
            }
            for ($a = $g+1 ; $a <= $maxImg; $a++) {
                $ImgFood = 'ImgIngre'.$a;
                $emptyValue = "";
                $sql->bindParam(":".$ImgFood,$emptyValue);
            }
            }
        $sql->bindParam(":ingredientsName", $ingreName);
        $sql->bindParam(":Idingre", $id);
    
    $sql->execute();

    if ($sql && (isset($_SESSION['page']))) {
        $i = $_SESSION['page'];
        $_SESSION['editsuccess'] = "Data has been updated successfully";
        header("location: indexingre.php?page=$i");
    } else {
        $_SESSION['error'] = "Data has not been updated successfully";
        header("location: indexingre.php");
    }
}
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
                <form class="space-y-6" action="editingre.php" method="post" enctype="multipart/form-data">
            <?php 
                if(isset($_POST['userid'])){ //รับค่าจาก id มาจาก index     ฟังก์ชั่น isset เป็นฟังก์ชั่นที่ใช้ในการตรวจสอบว่าตัวแปรนั้นมีการกำหนดค่าไว้หรือไม่
                    $Id = $_POST['userid'];
                    $stmt = $conn->query("SELECT * FROM ingredients WHERE Idingre = $Id");
                    $stmt->execute();
                    $data = $stmt->fetch();
                }
            ?>
                 <div>
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ID :</label>
                        <input type="text" readonly value ="<?php echo $data['Idingre']; ?>" required name="idd" id="text"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                    <div>
                    <?php  $totalImg = 1;
                    for ($i = 1; $i < 5; $i++) { 
                        if ($data['ImgIngre' . $i] != null) {
                            $totalImg++;
                        } else {
                            break; 
                        }
                    } ?>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">รูปภาพอาหาร :</label>
                        <input multiple class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="imgInput2" type="file" name="imgIngre[]" >
                        <div id="previewContainer2" class="mt-4 grid grid-cols-2 gap-4">
                        <?php for ($i = 1; $i < $totalImg; $i++) {
                        $Imgingre = $data['ImgIngre' . $i];
                    ?>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($Imgingre); ?>" alt="" width="100%" id="previewImg2" class="w-full h-[200px] rounded-lg"/>
                        <?php } ?>
                        </div>
                    </div>
                    <div>
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ชื่อส่วนประกอบ</label>
                        <input type="text" value="<?php echo $data['ingredientsName']; ?>" name="Ingrename" id="text"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                    <div class="flex justify-end space-x-4">
                        <div>
                     <a  type="submit" name="close" class="no-underline h-12 px-6 text-white bg-gradient-to-r from-gray-400 via-Neutral-500 to-gray-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-gray-300 dark:focus:ring-gray-800 font-medium rounded-lg py-2.5 text-center" href="index.php" >ยกเลิก</a>
                    </div> 
                    <div>
                    <button type="submit" name="UpdateIngre" class=" h-12 px-6 text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg py-2.5 text-center" >บันทึก</button>
                    </div>   
                </div>
                </form>
            </div>
        </div>

    
</table>
</div>
     
  



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>  
<script>
  let imgInput = document.getElementById('imgInput2');
  let previewContainer = document.getElementById('previewContainer2');

  imgInput.onchange = evt => {
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
</body>
</html>