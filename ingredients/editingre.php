<?php

session_start();
include ("../Config/DB.php");

if (isset($_POST['UpdateIngre'])) {
    $id = $_POST['idd'];
    $ingreName = $_POST['Ingrename'];
    $img2 = $_FILES['imgIngre']['name'];
    
    
    if($img2 != ''){
        $img = file_get_contents($_FILES['imgIngre']['tmp_name']);
        $sql = $conn->prepare("UPDATE ingredients SET ImgIngre = :ImgIngre, ingredientsName	 = :ingredient WHERE Idingre = :id");
        $sql->bindParam(":id", $id);
        $sql->bindParam(":ImgIngre", $img, PDO::PARAM_LOB);
        $sql->bindParam(":ingredient", $ingreName);
        $sql->execute();
        if ($sql) {
            $_SESSION['editsuccess'] = "";
            header("location: indexingre.php");
        } else {
            $_SESSION['error'] = "";
            header("location: indexingre.php");
        }
    }else{
        $sql = $conn->prepare("UPDATE ingredients SET  ingredientsName = :ingredient WHERE Idingre = :id");
        $sql->bindParam(":id", $id);
        $sql->bindParam(":ingredient", $ingreName);
        $sql->execute();
        if ($sql) {
            $_SESSION['editsuccess'] = "";
            header("location: indexingre.php");
        } else {
            $_SESSION['error'] = "";
            header("location: indexingre.php");
        }
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
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">รูปภาพอาหาร :</label>
                        <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="imgInput2" type="file" name="imgIngre" >
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($data['ImgIngre']); ?>" alt="" width="100%" id="previewImg2" class="rounded-lg"/>
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
        let previewImg = document.getElementById('previewImg2');

        imgInput.onchange = evt => {
            const [file] = imgInput.files;
                if (file) {
                    previewImg.src = URL.createObjectURL(file)
            }
        }
        
</script>
</body>
</html>