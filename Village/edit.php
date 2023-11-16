<?php

session_start();
include ("../Config/DB.php");

if (isset($_POST['Update'])) {
    $id = $_POST['idd'];
    $name = $_POST['name'];
    $Detail = $_POST['Detail'];
    $Meaning = $_POST['Meaning'];
    $Location = $_POST['Location'];
    $img2 = $_FILES['img']['name'];

    foreach ($_FILES['img']['tmp_name'] as $key => $imgTmpName) {
        if ($_FILES['img']['error'][$key] === UPLOAD_ERR_OK) {
            // Read the file content
            $img = file_get_contents($imgTmpName);
            $images[] = $img;
        } else {
            $_SESSION['error'] = "Error uploading file " . $key;
            header("location: indexingre.php");
            exit();
        }
    }
    $numImages = count($images);
    $maxImg = 4;

        $sql = $conn->prepare("UPDATE village SET Name = :name, Img1 = :img1, Img2 = :img2, Img3 = :img3, Img4 = :img4, Detail = :Detail, Meaning = :Meaning, Location = :Location WHERE id = :id");
        $sql->bindParam(":id", $id);
        $sql->bindParam(":name", $name);
        for ($g = 1; $g <= $maxImg; $g++) {
            for ($iii = 1; $iii <= $numImages; $iii++) {
                $ImgSet = 'img'.$iii;
                $sql->bindParam(":".$ImgSet, $images[$iii-1], PDO::PARAM_LOB);
            }
            for ($a = $g+1 ; $a <= $maxImg; $a++) {
                $ImgSet = 'img'.$a;
                $emptyValue = "";
                $sql->bindParam(":".$ImgSet,$emptyValue);
            }
        }
        $sql->bindParam(":Detail", $Detail);
        $sql->bindParam(":Meaning", $Meaning);
        $sql->bindParam(":Location", $Location);
        $sql->execute();
        if ($sql) {
            $_SESSION['editsuccess'] = "";
            header("location: index.php");
        } else {
            $_SESSION['error'] = "";
            header("location: index.php");
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
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font">ชื่อหมู่บ้าน</label>
                        <input type="text" value="<?php echo $data['Name']; ?>" required name="name" id="text"  class="font block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" required>
                        <input type="text" hidden value="<?php echo $data['Id']; ?>" required name="idd" id="text"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                    <div>
                    <?php  $totalImg = 1;
                    for ($i = 1; $i < 5; $i++) { 
                        if ($data['Img' . $i] != null) {
                            $totalImg++;
                        } else {
                            break; 
                        }
                    } ?>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font">รูปภาพของหมู่บ้าน</label>
                        <input multiple class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="imgInputs" type="file" name="img[]">
                        <div id="previewContainer3" class="mt-4 grid grid-cols-2 gap-2">
                       <?php for ($i = 1; $i < $totalImg; $i++) {
                        $Imgvillage = $data['Img' . $i];
                    ?>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($Imgvillage); ?>" alt="" width="100%" id="previewImgs" class="rounded-lg" name="img2" />
                        <?php } ?>
                        </div>
                    </div>
                    <div>
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font">รายละเอียด</label>
                        <textarea type="text" value="" name="Detail" id="text"  class="h-[150px] font bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required><?php echo $data['Detail']; ?></textarea>
                    </div>
                    <div>
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font">ความหมาย</label>
                        <textarea type="text" value="" name="Meaning" id="text"  class="h-[150px] font bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required><?php echo $data['meaning']; ?></textarea>
                    </div>
                    <div>
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font">ที่อยู่</label>
                        <input type="text" value="<?php echo $data['Location']; ?>" name="Location" id="text"  class="font bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                    <div class="flex justify-end space-x-4">
                        <div>
                     <a  type="submit" name="close" class="no-underline h-12 px-6 text-white bg-gradient-to-r from-gray-400 via-Neutral-500 to-gray-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-gray-300 dark:focus:ring-gray-800 font-medium rounded-lg py-2.5 text-center" href="index.php" >ยกเลิก</a>
                    </div> 
                    <div>
                    <button type="submit" name="Update" class=" h-12 px-6 text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg py-2.5 text-center" >บันทึก</button>
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
  let previewContainer = document.getElementById('previewContainer3');

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

</body>
</html>