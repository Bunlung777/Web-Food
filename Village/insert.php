<?php 

session_start();
include ("../Config/DB.php");

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $Datail = $_POST['Detail'];
    $meaning = $_POST['Meaning'];
    $Location = $_POST['Location'];
    // $img = file_get_contents($_FILES['img']['tmp_name']);
    $images = array();

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

                    $sql = $conn->prepare("INSERT INTO village(Name, Img1, Img2, Img3, Img4, Detail, meaning , Location) VALUES(:name, :img1, :img2, :img3, :img4, :Datail, :meaning ,:Location)");
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
                    $sql->bindParam(":Datail", $Datail);
                    $sql->bindParam(":meaning", $meaning);
                    $sql->bindParam(":Location", $Location);
                    $sql->execute();

                    if ($sql) {
                        $_SESSION['success'] = "";
                        header("location: index.php");
                    } else {
                        $_SESSION['error'] = "Data has not been inserted successfully";
                        header("location: index.php");
                    }
            
            }
        



?>