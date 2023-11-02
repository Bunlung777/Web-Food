<!DOCTYPE html>
<html lang="en">
<?php
include (".../Config/DB.php");
include '../include/navbar_2.php' ;
$id = $_GET['id'];
$village = $conn->query("SELECT S.Idset, S.ImgSet, V.Name, S.SetName,V.Id,
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
F6.FoodName AS FoodName6 
FROM setfood AS S 
LEFT JOIN village AS V ON S.VillageSet = V.Id 
LEFT JOIN food AS F ON S.FoodName0 = F.IdFood 
LEFT JOIN food AS F1 ON S.FoodName1 = F1.IdFood 
LEFT JOIN food AS F2 ON S.FoodName2 = F2.IdFood 
LEFT JOIN food AS F3 ON S.FoodName3 = F3.IdFood 
LEFT JOIN food AS F4 ON S.FoodName4 = F4.IdFood 
LEFT JOIN food AS F5 ON S.FoodName5 = F5.IdFood 
LEFT JOIN food AS F6 ON S.FoodName6 = F6.IdFood 
WHERE S.VillageSet = $id;
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
  <link rel="stylesheet" href="../css/page3.css">
  <link rel="stylesheet" href="../css/responsive3.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Taviraj:ital,wght@1,200&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Niramit:wght@500&family=Taviraj&display=swap" rel="stylesheet">
</head>

<body>
  <div class="content">
    <div class="content_village">
      <h1>สำรับอาหาร หมู่บ้านหาดเบี้ย</h1>
    </div>
  </div>
  <div class="main-village">
    <div class="control_village">
      <div class="image-village">
        <img
        <?php echo 'src="data:image/jpeg;base64,'.base64_encode($setfood['ImgSet']).'" ' ?> 
          onclick="mainopenPopup()" class="flex1"
          />
          <div id="mainopenPopup" class="popup">
            <span class="close-button" onclick="mainclosePopup()">&times;</span>
            <img
            <?php echo 'src="data:image/jpeg;base64,'.base64_encode($setfood['ImgSet']).'" ' ?> 
          onclick="mainopenPopup()" class="flex1"
              alt="Image" />
          </div>
        <div class="flex_village">
          <div class="Vill-flex">
            <img
              src="https://images.unsplash.com/photo-1682686580391-615b1f28e5ee?ixlib=rb-4.0.3&ixid=M3wxMjA3fDF8MHxlZGl0b3JpYWwtZmVlZHwxfHx8ZW58MHx8fHx8&auto=format&fit=crop&w=600&q=60"
              alt="" onclick="openPopup()" class="flex1">
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
              alt="" onclick="openPopup1()" class="flex1">
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
              alt="" onclick="openPopup2()" class="flex1">
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
              alt="" onclick="openPopup3()" class="flex1">
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
            <h1 class="text-left mt-1 text_h1">สำรับอาหารชุดที่ 1</h1>
            <!-- <p class="text_v">Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia ipsa saepe nesciunt exercitationem
              soluta
              consequatur optio assumenda excepturi, reprehenderit eum totam sit commodi magnam aliquam doloremque aut
              reiciendis! Ipsum, quia.
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis, itaque? Vitae incidunt reiciendis
              optio vero. Id suscipit eaque officiis hic ut autem, ad iusto dolore maiores repellendus, sed dolorem
            </p> -->
            <h1 class="text_h1 text-left mt-3">มีตำรับอาหารดังนี้</h1>
            <p class="text_v">  
              1. <?php echo $setfood['FoodName0']; ?><br>
              2. <?php echo $setfood['FoodName1']; ?><br>
              3. <?php echo $setfood['FoodName2']; ?><br>
              4. <?php echo $setfood['FoodName3']; ?><br>
              5. <?php echo $setfood['FoodName4']; ?><br>
              6. <?php echo $setfood['FoodName5']; ?><br>
              7. <?php echo $setfood['FoodName6']; ?><br>
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="food-village" id="food-table">
      <h1 class="text-2xl text-left text-slate-700">ตำรับอาหาร</h1>
      <div class="food-item">
        <div class="food-image">
          <img
            src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8Zm9vZHxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=600&q=60"
            alt=""
            >
        </div>
        <div class="food-text">
          <h1 class="text-left text-xl mt-2">ตำรับอาหารที่ 1 <?php echo $setfood['FoodName0']; ?></h1>
          <h1 class="text-l mt-2">ส่วนผสม</h1>
          <p class="text_v">ข้าวเหนียวขัดขาวดิบ (ข้าวสาร)</p>
          <h1 class="text-l mt-2">หน่วยนับ</h1>
          <p>-</p>
          <h1 class="text-l mt-2">น้ำหนัก</h1>
          <p>-</p>
          <h1 class="text-l mt-2">วิธีการทำ</h1>
          <p class="text_v">
          <?php echo $setfood['FoodDetail0']; ?>
          </p>
        </div>
      </div>
      <div class="food-item">
        <div class="food-image">
          <img
            src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8Zm9vZHxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=600&q=60"
            alt="">
        </div>
        <div class="food-text">
          <h1 class="text-left text-xl mt-2">ตำรับอาหารที่  2 <?php echo $setfood['FoodName1']; ?></h1>
          <h1 class="text-l mt-2">ส่วนผสม</h1>
          <p class="text_v">ปลาน้ำโขง ตะไคร้ ข่า หอมแดง กระเทียม ใบมะกรูด ใบกะเพรา ใบส้มป่อย
            เกลือ น้ำปลา น้ำเปล่า
          </p>
          <h1 class="text-l mt-2">หน่วยนับ</h1>
          <p>-</p>
          <h1 class="text-l mt-2">น้ำหนัก</h1>
          <p>-</p>
          <h1 class="text-l mt-2">วิธีการทำ</h1>
          <p class="text_v">
          <?php echo $setfood['FoodDetail1']; ?>
          </p>
        </div>
      </div>
      <div class="food-item">
        <div class="food-image">
          <img
            src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8Zm9vZHxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=600&q=60"
            alt="">
        </div>
        <div class="food-text">
          <h1 class="text-left text-xl mt-2">ตำรับอาหารที่  3 <?php echo $setfood['FoodName2']; ?></h1>
          <h1 class="text-l mt-2">ส่วนผสม</h1>
          <p class="text_v">กุ้งฝอย หัวปลี หอมแดง ต้นหอม มะนาว พริกป่น ข้าวคั่ว น้ำปลาร้า น้ำปลา</p>
          <h1 class="text-l mt-2">หน่วยนับ</h1>
          <p>-</p>
          <h1 class="text-l mt-2">น้ำหนัก</h1>
          <p>-</p>
          <h1 class="text-l mt-2">วิธีการทำ</h1>
          <p class="text_v">
          <?php echo $setfood['FoodDetail2']; ?>
          </p>
        </div>
      </div>
      <div class="food-item">
        <div class="food-image">
          <img
            src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8Zm9vZHxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=600&q=60"
            alt="">
        </div>
        <div class="food-text">
          <h1 class="text-left text-xl mt-2">ตำรับอาหารที่  4 <?php echo $setfood['FoodName3']; ?></h1>
          <h1 class="text-l mt-2">ส่วนผสม</h1>
          <p class="text_v">ปลีกล้วย หมูสับ หอมแดง ตะไคร้ พริกสด ใบมะกรูด ใบแมงลัก เกลือ น้ำปลา น้ำปลาร้า</p>
          <h1 class="text-l mt-2">หน่วยนับ</h1>
          <p>-</p>
          <h1 class="text-l mt-2">น้ำหนัก</h1>
          <p>-</p>
          <h1 class="text-l mt-2">วิธีการทำ</h1>
          <p class="text_v">
          <?php echo $setfood['FoodDetail3']; ?>
          </p>
        </div>
      </div>
      <div class="food-item">
        <div class="food-image">
          <img
            src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8Zm9vZHxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=600&q=60"
            alt="">
        </div>
        <div class="food-text">
          <h1 class="text-left text-xl mt-2">ตำรับอาหารที่  5 <?php echo $setfood['FoodName4']; ?></h1>
          <h1 class="text-l mt-2">ส่วนผสม</h1>
          <p class="text_v">ปลาน้ำโขง เกลือ</p>
          <h1 class="text-l mt-2">หน่วยนับ</h1>
          <p>-</p>
          <h1 class="text-l mt-2">น้ำหนัก</h1>
          <p>-</p>
          <h1 class="text-l mt-2">วิธีการทำ</h1>
          <p class="text_v">
          <?php echo $setfood['FoodDetail4']; ?>
          </p>
        </div>
      </div>
      <div class="food-item">
        <div class="food-image">
          <img
            src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8Zm9vZHxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=600&q=60"
            alt="">
        </div>
        <div class="food-text">
          <h1 class="text-left text-xl mt-2">ตำรับอาหารที่  6 <?php echo $setfood['FoodName5']; ?></h1>
          <h1 class="text-l mt-2">ส่วนผสม</h1>
          <p class="text_v" >เห็ดไค พริกสด กระเทียม น้ำปลาร้า น้ำปลา</p>
          <h1 class="text-l mt-2">หน่วยนับ</h1>
          <p>-</p>
          <h1 class="text-l mt-2">น้ำหนัก</h1>
          <p>-</p>
          <h1 class="text-l mt-2">วิธีการทำ</h1>
          <p class="text_v">
          <?php echo $setfood['FoodDetail5']; ?>
          </p>
        </div>
      </div>
      <div class="food-item">
        <div class="food-image">
          <img
            src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8Zm9vZHxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=600&q=60"
            alt="">
        </div>
        <div class="food-text">
          <h1 class="text-left text-xl mt-2">ตำรับอาหารที่  7 <?php echo $setfood['FoodName6']; ?></h1>
          <h1 class="text-l mt-2">ส่วนผสม</h1>
          <p>-</p>
          <h1 class="text-l mt-2">หน่วยนับ</h1>
          <p>-</p>
          <h1 class="text-l mt-2">น้ำหนัก</h1>
          <p>-</p>
          <h1 class="text-l mt-2">วิธีการทำ</h1>
          <p> <?php echo $setfood['FoodDetail6']; ?></p>
        </div>
      </div>

    </div>
  </div>
  <?php include '../include/footer.php' ?>
  <script src="../js/page3.js"></script>
</body>

</html>