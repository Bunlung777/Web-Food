<?php
session_start();
include("../Config/DB.php");

if (isset($_POST['submitingre'])) {
    $ingreName = $_POST['Ingrename'];

    $images = array();

    foreach ($_FILES['imgIngre']['tmp_name'] as $key => $imgTmpName) {
        if ($_FILES['imgIngre']['error'][$key] === UPLOAD_ERR_OK) {
            $img = file_get_contents($imgTmpName);
            $images[] = $img;
        } else {
            $_SESSION['error'] = "Error uploading file " . $key;
            header("location: indexingre.php");
            exit();
        }
    }

    $numImages = count($images);

    $sqlParams = array_fill(0, $numImages, '?');
    $placeholders = implode(', ', $sqlParams);
    $imgColumns = implode(', ', array_map(function ($index) {
        return "ImgIngre$index";
    }, range(1, $numImages)));

    $sql = $conn->prepare("INSERT INTO ingredients ($imgColumns, ingredientsName) VALUES ($placeholders, ?)");

    for ($i = 1; $i <= $numImages; $i++) {
        $sql->bindParam($i, $images[$i - 1], PDO::PARAM_LOB);
    }

    $sql->bindParam($numImages + 1, $ingreName);

    $sql->execute();

    if ($sql) {
        $_SESSION['success'] = "Data has been inserted successfully";
        header("location: indexingre.php");
    } else {
        $_SESSION['error'] = "Data has not been inserted successfully";
        header("location: indexingre.php");
    }
}
?>
