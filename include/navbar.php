<?php 
$stmt = $conn->query("SELECT * FROM setfood");
$stmt->execute();
$setfood = $stmt->fetchAll(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href = "../include/nav.css">
    <link rel="stylesheet" href = "../include/tailwind.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <header class="container-main">
      <nav class="nav-head">
        <a href="/Web-Food/website/village.php" class="logo text-xl">โครงการหมู่บ้าน</a>
        <ul class="nav-main">
          <li>
            <a href="../website/village.php">หน้าหลัก</a>
          </li>
          <li>
            <div class="dropdown">
              <a class="dropbtn">หมู่บ้าน<i class="ml-2 fa-solid fa-caret-right"></i></a>
              <div class="dropdown-content">
                <div class="drop-menu">
                  <?php 
                  $stmt = $conn->query("SELECT * FROM village");
                  $stmt->execute();
                  $village = $stmt->fetchAll();                   
                  foreach($village as $village) { ?>
                  <a href="/Web-Food/website/deck.php?id=<?php echo $village['Id']; ?>"><?php echo $village['Name'] ?></a>
                  <?php } ?> 
                </div>
              </div>
            </div>
          </li>
          <li>
            <div class="dropdown">
              <a  class="dropbtn">สำรับอาหาร</a>
              <div class="dropdown-content">
                <div class="drop-menu">
                <?php 
                  $stmt = $conn->query("SELECT * FROM village");
                  $stmt->execute();
                  $village = $stmt->fetchAll(); 
                   foreach($village as $village) {?>
                  
                  <a onmouseover="handleMouseOver('<?php echo $village['Id']; ?>')">
                  <?php echo $village['Name']; ?>
                  <i class="ml-2 fa-solid fa-caret-right"></i>
                </a>

                  <?php } ?> 
                  <div class="drop-item">
                    <?php foreach($setfood as $setfood) { ?>
                    <a href=""><?php echo $setfood['SetName'] ?></a>
                      <?php } ?>
                  </div>
                </div>
              </div>
            </div>
          </li>
          <li>
            <div class="dropdown">
              <a  class="dropbtn">ตำรับอาหาร</a>
              <div class="dropdown-content">
                <div class="drop-menu">
                  <a >บ้านหาดเบี้ย<i class="ml-2 fa-solid fa-caret-right"></i></a>
                  <div class="drop-item">
                    <a href="">ตำรับอาหารชุดที่ 1</a>
                    <a href="">ตำรับอาหารชุดที่ 2</a>
                    <a href="">ตำรับอาหารชุดที่ 3</a>
                    <a href="">ตำรับอาหารชุดที่ 4</a>
                    <a href="">ตำรับอาหารชุดที่ 5</a>
                    <a href="">ตำรับอาหารชุดที่ 6</a>
                    <a href="">ตำรับอาหารชุดที่ 7</a>
                  </div>
                </div>
                <div class="drop-menu">
                  <a >บ้านกกคู้<i class="ml-2 fa-solid fa-caret-right"></i></a>
                  <div class="drop-item">
                    <a href="">ตำรับอาหารชุดที่ 4</a>
                    <a href="">ตำรับอาหารชุดที่ 5</a>
                    <a href="">ตำรับอาหารชุดที่ 6</a>
                  </div>
                </div>
                <div class="drop-menu">
                  <a>บ้านกุดป่อง<i class="ml-2 fa-solid fa-caret-right"></i></a>
                  <div class="drop-item">
                    <a href="">ตำรับอาหารชุดที่ 7</a>
                    <a href="">ตำรับอาหารชุดที่ 8</a>
                    <a href="">ตำรับอาหารชุดที่ 9</a>
                  </div>
                </div>
              </div>
            </div>
          </li>
          <li>
            <div class="dropdown">
              <a  class="dropbtn"><i class="fa-solid fa-caret-down"></i></a>
              <div class="dropdown-content">
                <div class="drop-menu">
                  <a href="#">เข้าสู่ระบบ</a>
                </div>
              </div>
            </div>
          </li>
        </ul>
        <div class="menu-toggle" id="mobile-menu">
          <span class="bar"></span>
          <span class="bar"></span>
          <span class="bar"></span>
          <span class="bar"></span>
        </div>
      </nav>
    </header>
    <script>

  function handleMouseOver(villageID) {
    console.log("Mouse over village: " + villageID);
  }
</script>
    <script>
      document
        .getElementById("mobile-menu")
        .addEventListener("click", function () {
          var navList = document.querySelector(".nav-main");
          navList.classList.toggle("show");
        });
    </script>
  </body>
</html>