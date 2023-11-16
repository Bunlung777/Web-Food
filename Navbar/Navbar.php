<?php
include("../Config/DB.php");

if (isset($_SESSION['user_id'])) {
    $id = $_SESSION['user_id'];
      $stmt = $conn->query("SELECT * FROM user WHERE Iduser = $id ");
      $stmt->execute();
      $user = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Navbar</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet" />
  <link href="navbar.css" rel="stylesheet" />
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
<body>
  
  
<nav class="bg-gray-800" id="navbar">
  <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
    <div class="relative flex h-16 items-center justify-between">
      <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
        <!-- Mobile menu button-->
        <button type="button" class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
          <span class="absolute -inset-0.5"></span>
          <span class="sr-only">Open main menu</span>
          <!--
            Icon when menu is closed.

            Menu open: "hidden", Menu closed: "block"
          -->
          <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
          <!--
            Icon when menu is open.

            Menu open: "block", Menu closed: "hidden"
          -->
          <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
      <div class="flex flex-1 items-center sm:items-stretch sm:justify-start">
        <div class="flex flex-shrink-0 items-center">
          <!-- <a href="/Web-Food/Village/">
          <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company" >
          </a> -->
        </div>
        <div class="hidden sm:ml-6 sm:block">
          <div class="flex space-x-4">
            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
            <a id="link1" href="/Web-Food/Village/" class=" text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium no-underline z-10" onclick="changeBackgroundColor(event)">เพิ่มหมูบ้าน</a>
            <a href="/Web-Food/SetFood/indexsetFood.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium no-underline z-10">เพิ่มสำรับอาหาร</a>
            <a href="/Web-Food/Food/Foodindex.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium no-underline z-10">เพิ่มตำรับอาหาร</a>
            <a href="/Web-Food/ingredients/indexingre.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium no-underline ">เพิ่มส่วนประกอบ</a>
          </div>
        </div>
      </div>

        <div class="flex items-center md:order-2">
      <button type="button" class="flex mr-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
        <span class="sr-only">Open user menu</span>
        <img class="w-8 h-8 rounded-full" src="https://media.istockphoto.com/id/1130884625/vector/user-member-vector-icon-for-ui-user-interface-or-profile-face-avatar-app-in-circle-design.jpg?s=612x612&w=0&k=20&c=1ky-gNHiS2iyLsUPQkxAtPBWH1BZt0PKBB1WBtxQJRE= " alt="user photo">
      </button>
      <!-- Dropdown menu -->
      <div class="z-50 w-[200px] hidden text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown">
        <div class="px-4 py-3">
          <span class="block text-sm text-gray-900 dark:text-white"><?php echo $user['username']; ?></span>
          <span class="block text-sm  text-gray-500 truncate dark:text-gray-400"><?php echo $user['Email']; ?></span>
        </div>
        <!-- <ul class="py-2 mr-5" aria-labelledby="user-menu-button"> -->
          <li>
            <a href="/Web-Food/Login/detail.php" class="no-underline block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Your Profile</a>
          </li>
          <li>
            <a href="#" class="no-underline block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign out</a>
          </li>
        <!-- </ul> -->
      </div>

  <!-- Mobile menu, show/hide based on menu state. -->
  <div class="sm:hidden" id="mobile-menu">
    <div class="space-y-1 px-2 pb-3 pt-2">
      <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
      <a href="/Web-Food/Login/detail.php" class="bg-gray-900 text-white block rounded-md px-3 py-2 text-base font-medium" aria-current="page">Your Profile</a>
      <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Team</a>
      <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Projects</a>
      <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Calendar</a>
    </div>
  </div>
</nav>


  <script>
        // JavaScript function to reset the URL
        function resetURL(newURL) {
            // Replace the current URL with the desired URL
            window.location.href = newURL; // Replace with your desired URL
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
    <script>
// Get a reference to the link with the id "link1"
function changeBackgroundColor(event) {
    // Prevent the default link behavior (e.g., navigating to a new page)
    event.preventDefault();

    // Get a reference to the link that was clicked
    const link = event.currentTarget;

    // Change the background color of the link when it's clicked
    link.classList.toggle('bg-red-500'); // Change to your desired background color class

    window.location.href = link.getAttribute('href');
}


    </script>
</body>
</html>