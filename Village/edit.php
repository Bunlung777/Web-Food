<?php

session_start();
include ("../Config/DB.php");

if (isset($_POST['Update'])) {
    $id = $_POST['idd'];
    $name = $_POST['name'];
    $province = $_POST['province'];
    $district = $_POST['district'];
    $subdistrict = $_POST['subdistrict'];
    $postalcode = $_POST['postalCode'];

    $img2 = $_FILES['img']['name'];

    if($img2 != ''){    
        $img = file_get_contents($_FILES['img']['tmp_name']);
        $sql = $conn->prepare("UPDATE village SET Name = :name, Img = :img, Province = :province, District = :district, Subdistrict = :subdistrict, PostalCode = :postalcode WHERE id = :id");
        $sql->bindParam(":id", $id);
        $sql->bindParam(":name", $name);
        $sql->bindParam(":img", $img);
        $sql->bindParam(":province", $province);
        $sql->bindParam(":district", $district);
        $sql->bindParam(":subdistrict", $subdistrict);
        $sql->bindParam(":postalcode", $postalcode);
        $sql->execute();
        if ($sql) {
            $_SESSION['editsuccess'] = "";
            header("location: index.php");
        } else {
            $_SESSION['error'] = "";
            header("location: index.php");
        }
    }else {

        $sql = $conn->prepare("UPDATE village SET Name = :name, Province = :province, District = :district, Subdistrict = :subdistrict, PostalCode = :postalcode WHERE id = :id");
        $sql->bindParam(":id", $id);
        $sql->bindParam(":name", $name);
        $sql->bindParam(":province", $province);
        $sql->bindParam(":district", $district);
        $sql->bindParam(":subdistrict", $subdistrict);
        $sql->bindParam(":postalcode", $postalcode);
        $sql->execute();
        if ($sql) {
            $_SESSION['editsuccess'] = "";
            header("location: index.php");
        } else {
            $_SESSION['error'] = "";
            header("location: index.php");
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
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
                <form class="space-y-6" action="edit.php" method="post" enctype="multipart/form-data">
                <?php 
                if(isset($_POST['userid'])){ //รับค่าจาก id มาจาก index     ฟังก์ชั่น isset เป็นฟังก์ชั่นที่ใช้ในการตรวจสอบว่าตัวแปรนั้นมีการกำหนดค่าไว้หรือไม่
                    $Id = $_POST['userid'];
                    $stmt = $conn->query("SELECT * FROM village WHERE Id = $Id");
                    $stmt->execute();
                    $data = $stmt->fetch();
                }
            ?>
                    <div>
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ชื่อหมู่บ้าน</label>
                        <input type="text" readonly value ="<?php echo $data['Id']; ?>" required name="idd" id="text"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">รูปภาพของหมู่บ้าน</label>
                        <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="imgInputs" type="file" name="img">
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($data['Img']); ?>" alt="" width="100%" id="previewImgs" class="rounded-lg" name="img2" />
                        
                    </div>
                    <div>
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ชื่อหมู่บ้าน</label>
                        <input type="text" value="<?php echo $data['Name']; ?>" name="name" id="text"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                    <div>
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">จังหวัด</label>
                        <input type="text" value="<?php echo $data['Province']; ?>" name="province" id="text"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                    <div>
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">อำเภอ</label>
                        <input type="text" value="<?php echo $data['District']; ?>" name="district" id="text"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                    <div>
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ตำบล</label>
                        <input type="text" value="<?php echo $data['Subdistrict']; ?>" name="subdistrict" id="text"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                    <div>
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">รหัสไปรษณี</label>
                        <input type="text" value="<?php echo $data['PostalCode']; ?>" name="postalCode" id="text"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                    <div class="flex justify-end space-x-4">
                        <div>
                     <a  type="submit" name="close" class="no-underline h-12 px-6 text-white bg-gradient-to-r from-gray-400 via-Neutral-500 to-gray-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-gray-300 dark:focus:ring-gray-800 font-medium rounded-lg py-2.5 text-center" href="index.php" >Close</a>
                    </div> 
                    <div>
                    <button type="submit" name="Update" class=" h-12 px-6 text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg py-2.5 text-center" >Submit</button>
                    </div>   
                </div>
                </form>
            </div>
        </div>
   

  



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
<script src="https://cdn.tailwindcss.com"></script>

<script>
        let imgInput = document.getElementById('imgInputs');
        let previewImg = document.getElementById('previewImgs');

        imgInput.onchange = evt => { //OnChange  การดำเนินการเพื่อดำเนินการเมื่อผู้ใช้เปลี่ยนแปลงค่าของตัวควบคุม ใช้กับตัวควบคุม เพิ่มรูปภาพ, ดรอปดาวน์
            const [file] = imgInput.files;
                if (file) {
                    previewImg.src = URL.createObjectURL(file)
            }
        }
</script>

</body>
</html>