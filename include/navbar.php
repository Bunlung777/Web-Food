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
<header>
        <a href="#" class="logo">โครงการหมู่บ้าน</a>

        <input type="checkbox" id="menu-bar">
        <label for="menu-bar"><i class="fa-solid fa-bars"></i></label>

        <nav class="navbar">
            <ul>
                <li><a href="../website/home.php">หน้าหลัก</a></li>
                <li><a href="#">หมู่บ้าน</a>
                    <ul>
                    <?php $stmt = $conn->query("SELECT * FROM village");
                                $village = $stmt->fetchAll();
                                foreach ($village as $village){ ?>
                        <li><a href="../website/village.php?id=<?php echo $village['Id']?>"><?php echo $village['Name'] ?></a></li>
                    <?php } ?>
                    </ul>
                </li>
                <li><a href="#">สำรับ <i class="fa-solid fa-caret-down"></i></a>
                    <ul>
                        <li><a href="../website/menu-all.php">สำรับอาหารทั้งหมด</a>
                        <?php $stmt = $conn->query("SELECT * FROM village");
                                $village = $stmt->fetchAll();
                                foreach ($village as $village){ ?>
                        <li><a href="#"><?php echo $village['Name'] ?> +</a>
                                        <?php
                $villageId = $village['Id'];
                $stmt = $conn->prepare("SELECT * FROM setfood WHERE VillageSet = :villageId");
                $stmt->bindParam(':villageId', $villageId);
                $stmt->execute();
                $navset = $stmt->fetchAll();
                ?>

                            <ul>
                                <?php foreach ($navset as $navset){ ?>
                                <li><a href="../website/menu.php?id=<?php echo $navset['Idset']?>"><?php echo $navset['SetName'] ?></a></li>
                                <?php } ?>
                            </ul>
                            <?php } ?>
                        </li>
                    </ul>
                </li>
                <li><a href="#">ตำรับ <i class="fa-solid fa-caret-down"></i></a>
                    <ul class="recipe">
                    <?php $stmt = $conn->query("SELECT * FROM food");
                                $food = $stmt->fetchAll();
                                foreach ($food as $food){ ?>
                        <li><a href="../website/recipe.php?id=<?php echo $food['IdFood']?>"><?php echo $food['FoodName'] ?></a></li>
                        <?php } ?>
                    </ul>
                </li>
                <li><a href="#"><i class="fa-solid fa-arrow-right-to-bracket"></i></i></a>
                    <ul>
                        <li><a href="#">เข้าสู่ระบบ</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>
  </body>
</html>