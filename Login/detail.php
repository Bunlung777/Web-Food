<?php
session_start();
include '../Navbar/Navbar.php';
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet" />
    <link href="log.css" rel="stylesheet" />
</head>
<body>
<div class="flex justify-center absolute inset-x-0 top-0 " >
        <?php if(isset($_SESSION['successedit'])) {?>
            <div id="notification" class="flex items-center w-full max-w-xs p-6 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800 noti" role="alert">
    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
        </svg>
        <span class="sr-only">Check icon</span>
    </div>
    <div class="ml-3 text-sm font-normal">เพิ่มข้อมูลเรียบร้อยแล้ว</div>
    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#notification" aria-label="Close">
        <span class="sr-only">Close</span>
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
        </svg>
    </button>

            <?php 
                  unset($_SESSION['success']);
            ?>
           
        <?php }?>
        </div>
        </div>
<div class="flex justify-center absolute inset-x-0 top-0"> 
<?php if(isset($_SESSION['error'])) {?>
        <div id="notification" class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800 noti" role="alert">
    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-green-800 dark:text-green-200">
    <svg class="w-[18px] h-[18px] text-red-700 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
  </svg>
    </div>
    <div class="ml-3 text-sm font-normal">ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง</div>
    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#notification" aria-label="Close">
        <span class="sr-only">Close</span>
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
        </svg>
    </button>
</div>

            <?php 
                  unset($_SESSION['error']);
            ?>
        <?php }?>
</div>

<form action="insertprofile.php" method="post" enctype="multipart/form-data">
  <div class="mx-auto max-w-7xl px-4 py-[60px]  lg:px-8 border rounded shadow-lg ">
  <div class="border-b border-gray-900 pb-12">
    <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="col-span-full">
            <label for="photo" class="block text-sm font-medium flex justify-center text-gray-900">Profile</label>
            <div class="relative group flex justify-center">
                <label for="dropzone-file" class="cursor-pointer dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600 relative rounded-full w-[152px] h-[150px] profileimage" style="pointer-events: auto;">
                    <img id="profile-image" <?php echo 'src="data:image/jpeg;base64,'.base64_encode($user['ImgProfile']).'" ' ?> alt="image description" class="rounded-full w-[152px] h-[150px] profileimage">
                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-10 bg-black bg-opacity-50 text-white rounded-full w-[150px] h-full opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                        อัปโหลดรูปภาพ
                    </div>
                </label>
                <input name="img" id="dropzone-file" type="file" class="hidden" onchange="displayImage(event)" style="pointer-events: auto;">
            </div>
        </div>
    </div>
</div>



    <div class="border-b border-gray-900/10 pb-12">
    <div class="p-8 col-span-3 p-12">
        <form action="" class="space-y-4">
          <div>
          <label for="username" class=" text-sm font-medium text-gray-900">Username</label>
            <input
              class="w-full rounded-lg border-gray-200 p-3 text-sm hidden"
              type="text"
              name="Iduser"
              value="<?php echo $user['Iduser']; ?>"
            />
            <input
              class="w-full rounded-lg border-gray-200 p-3 text-sm"
              type="text"
              name="Username"
              value="<?php echo $user['username']; ?>"
            />
          </div>

          <div class="grid grid-cols-2 gap-4 mt-5">
            <div>
            <label for="username" class=" text-sm font-medium text-gray-900">ชื่อภาษาไทย</label>
              <input
                class="w-full rounded-lg border-gray-200 p-3 text-sm"
                placeholder=""
                type="text"
                name="NameTh"
                value="<?php echo $user['NameThai']; ?>"
              />
            </div>

            <div>
            <label for="username" class=" text-sm font-medium text-gray-900">นามสกุลภาษาไทย</label>
              <input
                class="w-full rounded-lg border-gray-200 p-3 text-sm"
                placeholder=""
                type="text"
                name="SurnameTh"
                value="<?php echo $user['SurenameThai']; ?>"
              />
            </div>
          </div>
          <div class="grid grid-cols-2 gap-4 mt-5">
            <div>
            <label for="username" class=" text-sm font-medium text-gray-900">ชื่อภาษาอังกฤษ</label>
              <input
                class="w-full rounded-lg border-gray-200 p-3 text-sm"
                placeholder=""
                type="text"
                name="NameEng"
                value="<?php echo $user['NameEng']; ?>"
              />
            </div>

            <div>
            <label for="username" class=" text-sm font-medium text-gray-900">นามสกุลภาษาอังกฤษ</label>
              <input
                class="w-full rounded-lg border-gray-200 p-3 text-sm"
                placeholder=""
                type="tel"
                name="SurenameEng"
                value="<?php echo $user['SurenameEng']; ?>"
              />
            </div>
          </div>
          <div class="grid grid-cols-2 gap-4 mt-5">
            <div>
            <label for="username" class=" text-sm font-medium text-gray-900">อีเมล</label>
              <input
                class="w-full rounded-lg border-gray-200 p-3 text-sm"
                placeholder=""
                type="email"
                name="Email"
                value="<?php echo $user['Email']; ?>"
              />
            </div>

            <div>
            <label for="username" class=" text-sm font-medium text-gray-900">เบอร์โทรศัพท์</label>
              <input
                class="w-full rounded-lg border-gray-200 p-3 text-sm"
                placeholder=""
                type="tel"
                name="Phone"
                value="<?php echo $user['Tel']; ?>"
              />
            </div>
          </div>
    </div>
  </div>

  <div class="mt-6 flex items-center justify-end gap-x-6">
    <button type="button" class="w-[100px] h-[40px] rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Cancel</button>
    <button type="submit" name="submituser" class="w-[100px] h-[40px] rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
  </div>
</form>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
<script src="https://cdn.tailwindcss.com"></script>
<script>
    function displayImage(event) {
        var image = document.getElementById('profile-image');
        image.src = URL.createObjectURL(event.target.files[0]);
    }
</script>
<script>
        function hideNotification() {
            const notification = document.getElementById('notification');
            notification.classList.add('fadeout');
        }

        setTimeout(hideNotification, 4000);
    </script>
</body>
</html>