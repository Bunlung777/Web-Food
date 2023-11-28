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
  <link rel="stylesheet" href="../css/home.css" />
  <link rel="stylesheet" href="../css/tailwind.css" />
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
      <h1 class="text-content">หมู่บ้านในโครงการ</h1>
    </div>
  </div>
  <!--  -->
  <div class="container-main">
      <div class="box-main">
        <div class="image-main">
          <div>
            <div class="img-main"> 
              <img
              <?php echo 'src="data:image/jpeg;base64,'.base64_encode($data['Img1']).'" ' ?>
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
            <div class="">
              <h1 class=" mt-3 text_h1"><b>ชื่อหมู่บ้าน</b> :<?php echo $data['Name']; ?></h1>
            </div>
            <h1 class="h1-respon mt-3 text_h1"><b>ประวัติศาสตร์</b></h1>
            <p class="text-respon">
            <?php echo $data['Detail']; ?>
            </p>
            <h1 class="h1-respon mt-3"><b>ความหมายของชื่อหมู่บ้าน</b></h1>
            <p class="text-respon">
            <?php echo $data['meaning']; ?>
            </p>
            <h1 class=" mt-3"><b>ลักษณะที่ตั้งของหมู่บ้าน</b></h1>
            <p class="text-respon">
            <?php echo $data['Location']; ?>
            </p>
            <h1 class="fs-4 mt-2"><b>แผนที่ตั้ง</b></h1>
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d60693.436276518485!2d101.72303655059622!3d18.05581904876049!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3126bdfd8a9645a5%3A0xd47507d089c977bd!2z4Lir4Liy4LiU4LmA4Lia4Li14LmJ4LiiIOC4leC4s-C4muC4pSDguJvguLLguIHguIrguKEg4Lit4Liz4LmA4Lig4LitIOC4m-C4suC4geC4iuC4oSDguYDguKXguKI!5e0!3m2!1sth!2sth!4v1696868529644!5m2!1sth!2sth"
              width="400" height="300" style="border: 0" allowfullscreen="" loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"></iframe>
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