<?php
include ("../Config/DB.php");
$id = $_GET['id'];
$village = $conn->query("SELECT F.Detail,FoodName,F.ImgFood1,F.DetailSp,F.note, 
                    I.ImgIngre1 AS ImgIngre0, 
                    I1.ImgIngre1 AS ImgIngre1, 
                    I2.ImgIngre1 AS ImgIngre2, 
                    I3.ImgIngre1 AS ImgIngre3, 
                    I4.ImgIngre1 AS ImgIngre4, 
                    I5.ImgIngre1 AS ImgIngre5, 
                    I6.ImgIngre1 AS ImgIngre6, 
                    I7.ImgIngre1 AS ImgIngre7, 
                    I8.ImgIngre1 AS ImgIngre8, 
                    I9.ImgIngre1 AS ImgIngre9, 
                    I10.ImgIngre1 AS ImgIngre10, 
                    I11.ImgIngre1 AS ImgIngre11, 
                    I12.ImgIngre1 AS ImgIngre12,
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
                    I12.ingredientsName AS IngreName12 FROM food AS F 
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
                    LEFT JOIN ingredients AS I12 ON F.Ingredients12 = I12.Idingre WHERE F.IdFood = $id;");
$village->execute(); $ingredients = $village->fetch(); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ตำรับอาหาร</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
      integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="../css/recipe.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Niramit:wght@500&family=Taviraj&display=swap"
      rel="stylesheet"
    />
  </head>

  <body class="body-main">
    <?php include '../include/navbar.php' ?>
    <div class="content">
      <div class="content_village">
        <h1>ตำรับอาหาร</h1>
      </div>
    </div>
    <!--  -->
    <div class="container-main">
      <div class="box-main">
        <div class="image-main">
          <div>
            <div class="img-main"> 
              <img
              <?php echo 'src="data:image/jpeg;base64,'.base64_encode($ingredients['ImgFood1']).'" ' ?>
                alt=""
              />
            </div>
            <div class="image-flex">
              <div class="flex">
                <img
                  src="https://images.unsplash.com/photo-1684610525381-34b7e6a098ef?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHx0b3BpYy1mZWVkfDI0fENEd3V3WEpBYkV3fHxlbnwwfHx8fHw%3D"
                  alt=""
                />
              </div>
              <div class="flex">
                <img
                  src="https://images.unsplash.com/photo-1699614614449-d19235e38574?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                  alt=""
                />
              </div>
              <div class="flex">
                <img
                  src="https://images.unsplash.com/photo-1700578075560-ebacba6e5d22?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                  alt=""
                />
              </div>
              <div class="flex">
                <img
                  src="https://images.unsplash.com/photo-1700403748616-94e54842caf1?q=80&w=1933&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                  alt=""
                />
              </div>
            </div>
          </div>
        </div>
        <div class="popup-image">
          <span>&times;</span>
          <img
            src="https://images.unsplash.com/photo-1699614614449-d19235e38574?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
            alt=""
          />
        </div>
        <div class="text-main">
          <h1 class="text-left mt-1 "><b><?php echo $ingredients['FoodName'] ?></b></h1>
          <h1 class="text-left mt-3"><b>วิธีการทำ</b></h1>
          <p class="text-respon"><?php echo nl2br($ingredients['Detail']); ?></p>   
          <h1 class="text-left mt-3"><b>เทคนิคพิเศษในการปรุงประกอบ<?php echo $ingredients['FoodName'] ?></b></h1>
          <p class="text-respon"><?php echo nl2br($ingredients['DetailSp']); ?></p>
        </div>
      </div>
    </div>
    <!--  -->
    <div class="container-main mt-6">
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
                      $ImgIngre = $ingredients['ImgIngre' . $i];
                      $IngreName = $ingredients['IngreName' . $i];
                      $Volume = $ingredients['Volume' . $i];
                      $Unit = $ingredients['Unit' . $i];
                    ?>
        <div class="food-item">
          <div class="food-image">
            <img
            <?php echo 'src="data:image/jpeg;base64,'.base64_encode($ImgIngre).'" ' ?>
            alt="" >
          </div>
          <div class="food-text">
            <p class="fs-4 text-left text-respon mt-2">
              ชื่อ : <?php echo $IngreName ?>
            </p>
            <p class="fs-4 text-left text-respon mt-2">
              ปริมาณ : <?php echo $Volume ?>
            </p>
            <p class="fs-4 text-left text-respon mt-2">
              หน่วย : <?php echo $Unit ?>
            </p>
          </div>
        </div>
        <?php } ?>
      </div>
      <p><b>หมายเหตุ</b> <?php echo $ingredients['note'] ?></p>
    </div>
    <!--  -->
    <?php include '../include/footer.php' ?>
    <script>
      document.querySelectorAll(".image-main img").forEach((image) => {
        image.onclick = () => {
          document.querySelector(".popup-image").style.display = "block";
          document.querySelector(".popup-image img").src =
            image.getAttribute("src");
        };
      });
      document.querySelector(".popup-image span").onclick = () => {
        document.querySelector(".popup-image").style.display = "none";
      };
    </script>
  </body>
</html>
