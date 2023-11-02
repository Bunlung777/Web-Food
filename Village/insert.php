<?php 

session_start();
include ("../Config/DB.php");

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $Datail = $_POST['Detail'];
    $meaning = $_POST['Meaning'];
    $Location = $_POST['Location'];
    $img = file_get_contents($_FILES['img']['tmp_name']);
    
                    $sql = $conn->prepare("INSERT INTO village(Name, Img, Detail, meaning , Location) VALUES(:name, :img, :Datail, :meaning ,:Location)");
                    $sql->bindParam(":name", $name);
                    $sql->bindParam(":img", $img, PDO::PARAM_LOB);
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