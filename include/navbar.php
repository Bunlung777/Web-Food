<?php 

$stmt = $conn->query("SELECT * FROM village");
$stmt->execute();
$village = $stmt->fetchAll();            
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
        <div class="logo text-xl">โครงการหมู่บ้าน</div>
        <ul class="nav-main">
          <li>
            <a href="../website/village.php">หน้าหลัก</a>
          </li>
          <li>
            <div class="dropdown">
              <div >
              <a  class="dropbtn">หมู่บ้าน<i class="ml-2 fa-solid fa-caret-down"></i></a>
              </div>
              <div class="dropdown-content" >
                <div class="drop-menu">
                <?php        
                  foreach($village as $village) { ?>
                  <a href="/Web-Food/website/deck.php?id=<?php echo $village['Id']; ?>"><?php echo $village['Name'] ?></a>
                   <?php } ?>
                </div>
              </div>
            </div>
          </li>
          <li>
            <div class="dropdown">
              <a class="dropbtn">สำรับอาหาร</a>
              <div class="dropdown-content">
                <div class="drop-menu">
                 <div>
                 <?php        
                 $stmt = $conn->query("SELECT * FROM village WHERE Id = 64");
                 $stmt->execute();
                 $village = $stmt->fetch();?>
                 <a><?php echo $village['Name'] ?><i class="ml-2 fa-solid fa-caret-right"></i></a>
                 </div>
                  <div class="drop-item" >
                  <?php 
                    if($village['Id'] = 64){
                    $stmt = $conn->query("SELECT * FROM setfood WHERE VillageSet = 64");
                    $stmt->execute();
                    $setfood = $stmt->fetchAll(); 
                  foreach($setfood as $setfood) { ?>
                  <a href="/Web-Food/website/deck.php?id=<?php echo $setfood['Idset']; ?>"><?php echo $setfood['SetName'] ?></a>
                  <?php }} ?> 
                  </div>
                </div>
              </div>
            </div>
          </li>
          <li>
            <div class="dropdown">
              <a class="dropbtn">ตำรับอาหาร</a>
              <div class="dropdown-content">
                <div class="drop-menu">
                 <div>
                  <a >บ้านหาดเบี้ย <i class="ml-2 fa-solid fa-caret-right"></i></a>
                 </div>
                  <div class="drop-item" >
                   <div class="drop-menu">
                    <?php                    
                    $stmt = $conn->query("SELECT * FROM food");
                    $stmt->execute();
                    $setfood = $stmt->fetchAll(); 
                  foreach($setfood as $setfood) { ?>
                  <a href="/Web-Food/website/deck.php?id=<?php echo $setfood['IdFood']; ?>"><?php echo $setfood['FoodName'] ?></a>
                  <?php } ?> 
                      <div class="drop-item" >
                       </div>
                   </div>
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
      document.getElementById('mobile-menu').addEventListener('click', function() {
      var navList = document.querySelector('.nav-main');
      navList.classList.toggle('show');
    });


       // เลือกทุกองค์ประกอบที่มี class "drop-menu"
      var dropMenus = document.querySelectorAll(".drop-menu");

        // Iterate ผ่านทุก drop menu
        dropMenus.forEach(function(dropMenu) {
          // เพิ่ม event listener สำหรับคลิกที่ drop menu
          dropMenu.addEventListener("click", function() {
            // หากมี dropdown content ที่เกี่ยวข้อง
            var dropdownContent = this.querySelector(".drop-item");
            if (dropdownContent) {
              // เพิ่มหรือลบ class "show" ที่ dropdown content
              dropdownContent.classList.toggle("show");

              // ตรวจสอบ class "show" เพื่อปรับ display
              if (dropdownContent.classList.contains("show")) {
                dropdownContent.style.display = "block";
                
              } else {
                dropdownContent.style.display = "none";

              }
            }
          });
        }); 
    </script>
  </body>
</html>