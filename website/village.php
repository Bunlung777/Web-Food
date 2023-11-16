<?php
include "../Config/DB.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>หมู่บ้านในโครงการ</title>
  <link rel="stylesheet" href="../css/page1.css">
  <link rel="stylesheet" href="../css/tailwind.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="../css/responsive1.css">
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
  <!-- Slideshow container -->
  <div class="bg_slide">
    <div class="slide-showbg">
      <div class="slideshow-container">
        <!-- Full-width images with number and caption text -->
        <div class="mySlides fade">
          <img src="../img/pawel-czerwinski-MJaOfyffXSw-unsplash.jpg">
          <div class="text">
            <div class="text-respon">
              <h1>โครงการ</h1>
              <h1 class="css-style">พลิกโฉมมหาวิทยาลัย</h1>
              <!-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi quos sit fuga minus reiciendis
                accusamus dignissimos dolores consectetur error vero.</p> -->
            </div>
          </div>
        </div>

        <div class="mySlides fade">
          <img src="../img/martin-martz-zEa54wu6IYY-unsplash.jpg">
          <div class="text">
            <div class="text-respon">
              <h1>โครงการ</h1>
              <h1 class="css-style">พลิกโฉมมหาวิทยาลัย</h1>
              <!-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi quos sit fuga minus reiciendis
                accusamus dignissimos dolores consectetur error vero.</p> -->
            </div>
          </div>
        </div>

        <div class="mySlides fade">
          <img src="../img/boliviainteligente-beCUr7D24Vs-unsplash.jpg">
          <div class="text">
            <div class="text-respon">
              <h1>โครงการ</h1>
              <h1 class="css-style">พลิกโฉมมหาวิทยาลัย</h1>
              <!-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi quos sit fuga minus reiciendis
                accusamus dignissimos dolores consectetur error vero.</p> -->
            </div>
          </div>
        </div>

        <!-- Next and previous buttons -->
        <a class="btn-prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="btn-next" onclick="plusSlides(1)">&#10095;</a>
        <!-- The dots/circles -->
        <div class="slide-dot">
          <div style="text-align:center">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <section class="slide-main" id="home">
    <div class="slide-Lmain">
      <h1 class="text-left text-2xl p-2 text-slate-600 font-bold">หมู่บ้านในโครงการ</h1>
      <div class="slider_slide">
<?php
 $stmt = $conn->query("SELECT * FROM village");
 $stmt -> execute();
 $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach($user as $user){  
?>
   <div class="slide">
          <div class="image">
            <a href=""><img
            <?php echo 'src="data:image/jpeg;base64,'.base64_encode($user['Img']).'" ' ?>
                alt="Image 1" /></a>
          </div>
          <div class="text_slide">
            <h1>ชื่อหมู่บ้าน :<?php echo $user['Name']; ?> </h1>
            <p>ที่อยู่ : <?php echo $user['Location']; ?></p>
            <a href="/Web-Food/website/deck.php?id=<?php echo $user['Id']; ?>" type="button" class="bg-white text-white font-bold py-2 px-4 rounded">
    ข้อมูลเพิ่มเติม
</a>

          </div>
        </div>     
<?php
}

?>
     </div>
      <div class="btn">
        <div class="btn-space1">
          <button id="prev" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
            ย้อนกลับ
          </button>
        </div>
        <div class="btn-space1">
          <button id="next" style="background-color: #053da3;"
            class=" hover:bg-orange-900 text-white font-bold py-2 px-4 rounded">
            ถัดไป
          </button>
        </div>
      </div>
      <hr>
    </div>
  </section>
  <section id="about">
    <div class="bg-main">
      <div class="about-main">
        <h1 class="text-left text-2xl p-2  text-slate-200">เกี่ยวกับเรา</h1>
        <div class="about-flex">
          <div class="about">
            <img
              src="https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8cGVyc29ufGVufDB8fDB8fHww&auto=format&fit=crop&w=600&q=60"
              alt="" />
            <div class="text-about">
              <h1>David</h1>
              <p>
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nesciunt
                mollitia inventore quibusdam quod consequatur itaque fugiat illo,
                molestiae ea. Repudiandae.
              </p>
            </div>
          </div>
          <div class="about">
            <img
              src="https://images.unsplash.com/photo-1499952127939-9bbf5af6c51c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTJ8fHBlcnNvbnxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=600&q=60"
              alt="" />
            <div class="text-about">
              <h1>David</h1>
              <p>
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nesciunt
                mollitia inventore quibusdam quod consequatur itaque fugiat illo,
                molestiae ea. Repudiandae.
              </p>
            </div>
          </div>
          <div class="about">
            <img
              src="https://images.unsplash.com/photo-1500048993953-d23a436266cf?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTZ8fHBlcnNvbnxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=600&q=60"
              alt="" />
            <div class="text-about">
              <h1>David</h1>
              <p>
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nesciunt
                mollitia inventore quibusdam quod consequatur itaque fugiat illo,
                molestiae ea. Repudiandae.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php include '../include/footer.php' ?>
  <script src="../js/page1.js"></script>
  <script>
    let slideIndex = 1;
    showSlides(slideIndex);

    // Next/previous controls
    function plusSlides(n) {
      showSlides(slideIndex += n);
    }

    // Thumbnail image controls
    function currentSlide(n) {
      showSlides(slideIndex = n);
    }

    function showSlides(n) {
      let i;
      let slides = document.getElementsByClassName("mySlides");
      let dots = document.getElementsByClassName("dot");
      if (n > slides.length) { slideIndex = 1 }
      if (n < 1) { slideIndex = slides.length }
      for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
      }
      for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
      }
      slides[slideIndex - 1].style.display = "block";
      dots[slideIndex - 1].className += " active";
    }

    // navbar
    const navLinks = document.getElementById('navLinks');
    const hamburgerMenu = document.getElementById('hamburgerMenu');

    hamburgerMenu.addEventListener('click', () => {
      navLinks.classList.toggle('active');

    });
  </script>
</body>

</html>