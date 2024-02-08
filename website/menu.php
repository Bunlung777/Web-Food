<!DOCTYPE html>
<html lang="en">
<?php
include ("../Config/DB.php");
include '../include/navbar.php';
$id = $_GET['id'];
$village = $conn->query("SELECT S.Idset, S.ImgSet1, V.Name, S.SetName,V.Id,
F.ImgFood1 AS ImgFood0,
F1.ImgFood1 AS ImgFood1,
F2.ImgFood1 AS ImgFood2,
F3.ImgFood1 AS ImgFood3,
F4.ImgFood1 AS ImgFood4,
F5.ImgFood1 AS ImgFood5,
F6.ImgFood1 AS ImgFood6,
F.Detail AS FoodDetail0,
F1.Detail AS FoodDetail1,
F2.Detail AS FoodDetail2,
F3.Detail AS FoodDetail3,
F4.Detail AS FoodDetail4,
F5.Detail AS FoodDetail5,
F6.Detail AS FoodDetail6,
F.FoodName AS FoodName0, 
F1.FoodName AS FoodName1, 
F2.FoodName AS FoodName2, 
F3.FoodName AS FoodName3, 
F4.FoodName AS FoodName4, 
F5.FoodName AS FoodName5, 
F6.FoodName AS FoodName6,
F.IdFood AS IdFood0, 
F1.IdFood AS IdFood1, 
F2.IdFood AS IdFood2, 
F3.IdFood AS IdFood3, 
F4.IdFood AS IdFood4, 
F5.IdFood AS IdFood5,
F6.IdFood AS IdFood6
FROM setfood AS S 
LEFT JOIN village AS V ON S.VillageSet = V.Id 
LEFT JOIN food AS F ON S.FoodName0 = F.IdFood 
LEFT JOIN food AS F1 ON S.FoodName1 = F1.IdFood 
LEFT JOIN food AS F2 ON S.FoodName2 = F2.IdFood 
LEFT JOIN food AS F3 ON S.FoodName3 = F3.IdFood 
LEFT JOIN food AS F4 ON S.FoodName4 = F4.IdFood 
LEFT JOIN food AS F5 ON S.FoodName5 = F5.IdFood 
LEFT JOIN food AS F6 ON S.FoodName6 = F6.IdFood
WHERE S.Idset = $id;
");
$village->execute();
$setfood = $village->fetch();

?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>สำรับอาหาร</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="../css/menu.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Niramit:wght@500&family=Taviraj&display=swap" rel="stylesheet">
<style>
    .font-body{
      font-family: 'Taviraj', serif;
      font-family: 'Niramit', sans-serif;
    }
</style>
</head>

<body class="font-body">
  <div class="content">
    <div class="content_village">
      <h1 class="text-content">สำรับอาหาร <?php echo $setfood['Name'] ?></h1>
    </div>
  </div>
  <!--  -->
  <div class="container-main">
      <div class="box-main">
        <div class="image-main">
          <div>
            <div class="img-main"> 
              <img
              <?php echo 'src="data:image/jpeg;base64,'.base64_encode($setfood['ImgSet1']).'" ' ?> 
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
          <h1 class="text-left mt-1 "><b><?php echo $setfood['SetName'] ?></b></h1>
          <p class="">  
            <?php  $totalsetfood = 0;
                    for ($i = 0; $i < 7; $i++) { 
                        if ($setfood['FoodName' . $i] != null) {
                            $totalsetfood++;
                        } else {
                            break; 
                        }
                    } 
                    for ($i = 0; $i < $totalsetfood; $i++) {
                      $food = $setfood['FoodName' . $i];
                      $Idfood = $setfood['IdFood' . $i];
                    ?>
               <a class="text-respon" href="../website/recipe.php?id=<?php echo $Idfood ?>"><?php echo ($i+1),". ",$food; ?><i class="ml-1 fa-solid fa-caret-left"></i></a><br>
            </p>
            <?php } ?>
        </div>
      </div>
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