<?php
include ("../Config/DB.php");

$id = $_GET['id'];
$stmt = $conn->query("SELECT * FROM village WHERE Id = $id");
$stmt->execute();
$data = $stmt->fetch();

$village = $conn->query("SELECT * FROM setfood WHERE VillageSet = $id");
$village->execute();
$setfood = $village->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>หมู่บ้าน</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="../css/deck.css" />
  <link rel="stylesheet" href="../css/tailwind.css" />
  <link rel="stylesheet" href="../css/deckrespon.css" />

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
<?php include '../include/navbar.php' ?>
  <div class="content">
    <div class="content_village">
      <h1>หมู่บ้านในโครงการ</h1>
    </div>
  </div>
  <div class="main-village">
    <div class="control_village">
      <div class="image-village">
        <img
        <?php echo 'src="data:image/jpeg;base64,'.base64_encode($data['Img']).'" ' ?>
          alt="" 
          onclick="mainopenPopup()" class="flex1"
          />
          <div id="mainopenPopup" class="popup">
            <span class="close-button" onclick="mainclosePopup()">&times;</span>
            <img
            <?php echo 'src="data:image/jpeg;base64,'.base64_encode($data['Img']).'" ' ?>
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
          <h1 class=" mt-3 text_h1">ชื่อหมู่บ้าน :<?php echo $data['Name']; ?> </h1>
            <h1 class=" mt-3 text_h1">ประวัติศาสตร์</h1>
            <p class="text_v">
            <?php echo $data['Detail']; ?>
            </p>
            <h1 class=" mt-3 text_h1">ความหมายของชื่อหมู่บ้าน</h1>
            <p class="text_v">
            <?php echo $data['meaning']; ?>
            </p>
            <h1 class=" mt-3  text_h1">ลักษณะที่ตั้งของหมู่บ้าน</h1>
            <p class="text_v">
            <?php echo $data['Location']; ?>
          </p>
            <h1 class="fs-4 mt-2 text_h1">แผนที่ตั้ง</h1>
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d60693.436276518485!2d101.72303655059622!3d18.05581904876049!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3126bdfd8a9645a5%3A0xd47507d089c977bd!2z4Lir4Liy4LiU4LmA4Lia4Li14LmJ4LiiIOC4leC4s-C4muC4pSDguJvguLLguIHguIrguKEg4Lit4Liz4LmA4Lig4LitIOC4m-C4suC4geC4iuC4oSDguYDguKXguKI!5e0!3m2!1sth!2sth!4v1696868529644!5m2!1sth!2sth"
              width="400" height="300" style="border: 0" allowfullscreen="" loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
        </div>
      </div>
    </div>
  </div>
 <?php include '../include/footer.php' ?>
  <script src="../js/page2.js"></script>
</body>

</html>