<?php
include ("../Config/DB.php");
$id = $_GET['id'];
$village = $conn->query("SELECT F.Detail,
I.ImgIngre AS ImgIngre0,
I1.ImgIngre AS ImgIngre1,
I2.ImgIngre AS ImgIngre2,
I3.ImgIngre AS ImgIngre3,
I4.ImgIngre AS ImgIngre4,
I5.ImgIngre AS ImgIngre5,
I6.ImgIngre AS ImgIngre6,
I7.ImgIngre AS ImgIngre7,
I8.ImgIngre AS ImgIngre8,
I9.ImgIngre AS ImgIngre9,
I10.ImgIngre AS ImgIngre10,
I11.ImgIngre AS ImgIngre11,
I12.ImgIngre AS ImgIngre12,
I.ingredientsName AS IngreName0,
I1.ingredientsName AS IngreName1,
I2.ingredientsName AS IngreName2,
I3.ingredientsName AS IngreName3,
I4.ingredientsName AS IngreName4,
I5.ingredientsName AS IngreName5,
I6.ingredientsName AS IngreName6,
I7.ingredientsName AS IngreName7,
I8.ingredientsName AS IngreName8,
I9.ingredientsName AS IngreName9,
I10.ingredientsName AS IngreName10,
I11.ingredientsName AS IngreName11,
I12.ingredientsName AS IngreName12
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
WHERE F.IdFood = $id;
");
$village->execute();
$ingredients = $village->fetch();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ตำรับอาหาร</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="../css/recipe.css" />
  <link rel="stylesheet" href="../css/reciperespon.css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Taviraj:ital,wght@1,200&display=swap" rel="stylesheet" />
</head>

<body>
<?php include '../include/navbar.php' ?>
  <div class="content">
    <div class="content_village">
      <h1>ตำรับอาหาร</h1>
    </div>
  </div>
  <div class="main-village">
    <div class="control_village">
      <div class="image-village">
        <img
          src="https://static.thairath.co.th/media/Dtbezn3nNUxytg04aoZ9f77r0DH1c3am84CfR9LvDIvVHh.webp"
          alt="" 
          onclick="mainopenPopup()" class="flex1"
          />
          <div id="mainopenPopup" class="popup">
            <span class="close-button" onclick="mainclosePopup()">&times;</span>
            <img
              src="https://static.thairath.co.th/media/Dtbezn3nNUxytg04aoZ9f77r0DH1c3am84CfR9LvDIvVHh.webp"
              alt="Image" />
          </div>
        <div class="flex_village">
          <div class="Vill-flex">
            <img
              src="https://images.unsplash.com/photo-1682686580391-615b1f28e5ee?ixlib=rb-4.0.3&ixid=M3wxMjA3fDF8MHxlZGl0b3JpYWwtZmVlZHwxfHx8ZW58MHx8fHx8&auto=format&fit=crop&w=600&q=60"
              alt="" onclick="openPopup()" class="flex1" />
            <div id="image-popup" class="popup">
              <span class="close-button" onclick="closePopup()">&times;</span>
              <img
                src="https://images.unsplash.com/photo-1682686580391-615b1f28e5ee?ixlib=rb-4.0.3&ixid=M3wxMjA3fDF8MHxlZGl0b3JpYWwtZmVlZHwxfHx8ZW58MHx8fHx8&auto=format&fit=crop&w=600&q=60"
                alt="Image" />
            </div>
          </div>
          <div class="Vill-flex">
            <img
              src="https://images.unsplash.com/photo-1695418624968-d027093abdb9?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw3fHx8ZW58MHx8fHx8&auto=format&fit=crop&w=600&q=60"
              alt="" onclick="openPopup1()" class="flex1" />
            <div id="image-popup1" class="popup">
              <span class="close-button" onclick="closePopup1()">&times;</span>
              <img
                src="https://images.unsplash.com/photo-1695418624968-d027093abdb9?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw3fHx8ZW58MHx8fHx8&auto=format&fit=crop&w=600&q=60"
                alt="Image" />
            </div>
          </div>
          <div class="Vill-flex">
            <img
              src="https://images.unsplash.com/photo-1695751240056-c9aea1e799df?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHwxM3x8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=60"
              alt="" onclick="openPopup2()" class="flex1" />
            <div id="image-popup2" class="popup">
              <span class="close-button" onclick="closePopup2()">&times;</span>
              <img
                src="https://images.unsplash.com/photo-1695751240056-c9aea1e799df?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHwxM3x8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=60"
                alt="Image" />
            </div>
          </div>
          <div class="Vill-flex">
            <img
              src="https://images.unsplash.com/photo-1682685797660-3d847763208e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDF8MHxlZGl0b3JpYWwtZmVlZHwyMXx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=60"
              alt="" onclick="openPopup3()" class="flex1" />
            <div id="image-popup3" class="popup">
              <span class="close-button" onclick="closePopup3()">&times;</span>
              <img
                src="https://images.unsplash.com/photo-1682685797660-3d847763208e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDF8MHxlZGl0b3JpYWwtZmVlZHwyMXx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=60"
                alt="Image" />
            </div>
          </div>
        </div>
      </div>
      <div class="village-story">
        <div class="text-village">
          <div class="text_vill">
            <h1 class=" font-100 text-left mt-1 text_h1">ตำรับอาหารที่1. หมกหน่อไม้</h1>
            <h1 class="text-left mt-3  text_h1">ส่วนผสม</h1>
            <p class="text_v">-</p>
            <h1 class="text-left mt-3  text_h1">หน่วยนับ</h1>
            <p class="text_v">-</p>
            <h1 class="text-left mt-3  text_h1">น้ำหนัก</h1>
            <p class="text_v">-</p>
            <h1 class="text-left mt-3  text_h1">วิธีการทำ</h1>
            <p class="text_v"><?php echo $ingredients['Detail'] ?></p>
          </div>
        </div>
      </div>
    </div>
    
    <h1 class="text-2xl text-left text-slate-700">วัตถุดิบ</h1>
    <div class="food-village" id="food-table">
    <?php  $total = 0;
                    for ($i = 0; $i < 13; $i++) { 
                        if ($ingredients['ImgIngre' . $i] != null) {
                            $total++;
                        } else {
                            break; 
                        }
                    } 
                    for ($i = 0; $i < $total; $i++) {
                      $ImgIngre= $ingredients['ImgIngre' . $i];
                      $ImgName= $ingredients['IngreName' . $i];
                    ?>  
      <div class="food-item">
        <div class="food-image">
          <img
          <?php echo 'src="data:image/jpeg;base64,'.base64_encode($ImgIngre).'" ' ?>
              alt=""
              >
        </div>
        <div class="food-text">
          <h1 class="fs-4 text-center text-xl mt-2 text_h1"><?php echo $ImgName ?></h1>
        </div>
      </div>
      <?php } ?>
      </div>


 <?php include '../include/footer.php' ?>
  <script src="../js/recipe.js"></script>
</body>

</html>