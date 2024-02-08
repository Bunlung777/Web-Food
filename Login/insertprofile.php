<?php 

session_start();
include ("../Config/DB.php");

if (isset($_POST['submituser'])) {
    $id = $_POST['Iduser'];
    $username = $_POST['Username'];
    $NameTh = $_POST['NameTh'];
    $SurnameTh = $_POST['SurnameTh'];
    $NameEng = $_POST['NameEng'];
    $SurenameEng = $_POST['SurenameEng'];
    $Email = $_POST['Email'];
    $Phone = $_POST['Phone'];
    $img2 = $_FILES['img']['name'];

    if($img2 != ''){  
                    $img = file_get_contents($_FILES['img']['tmp_name']);
                    $sql = $conn->prepare("UPDATE user SET username = :username, NameThai = :NameThai, SurenameThai = :SurenameThai , 
                    NameEng = :NameEng , SurenameEng = :SurenameEng, Email = :Email , Tel = :Tel, ImgProfile = :Img WHERE Iduser = :id");  
                    $sql->bindParam(":username", $username);
                    $sql->bindParam(":NameThai", $NameTh);
                    $sql->bindParam(":SurenameThai", $SurnameTh);
                    $sql->bindParam(":NameEng", $NameEng);
                    $sql->bindParam(":SurenameEng", $SurenameEng);
                    $sql->bindParam(":Email", $Email);
                    $sql->bindParam(":Tel", $Phone);
                    $sql->bindParam(":Img", $img, PDO::PARAM_LOB);
                    $sql->bindParam(":id", $id);
                    $sql->execute();

                    if ($sql) {
                        $_SESSION['success'] = "";
                        header("location: detail.php");
                    } else {
                        $_SESSION['error'] = "Data has not been inserted successfully";
                        header("location: detail.php");
                    }
                }else{
                    $sql = $conn->prepare("UPDATE user SET username = :username, NameThai = :NameThai, SurenameThai = :SurenameThai , 
                    NameEng = :NameEng , SurenameEng = :SurenameEng, Email = :Email , Tel = :Tel WHERE Iduser = :id");  
                    $sql->bindParam(":username", $username);
                    $sql->bindParam(":NameThai", $NameTh);
                    $sql->bindParam(":SurenameThai", $SurnameTh);
                    $sql->bindParam(":NameEng", $NameEng);
                    $sql->bindParam(":SurenameEng", $SurenameEng);
                    $sql->bindParam(":Email", $Email);
                    $sql->bindParam(":Tel", $Phone);
                    $sql->bindParam(":id", $id);
                    $sql->execute();

                    if ($sql) {
                        $_SESSION['successedit'] = "";
                        header("location: detail.php");
                    } else {
                        $_SESSION['erroredit'] = "Data has not been inserted successfully";
                        header("location: detail.php");
                    }
                }
            }
        



?>