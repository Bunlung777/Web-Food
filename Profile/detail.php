<?php
session_start();
include '../Navbar/Navbar.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet" />

</head>
<body>

<form>
  <div class="mx-auto max-w-7xl px-4 py-24 sm:px-6 sm:py-32 lg:px-8 border rounded shadow-lg ">
    <div class="border-b border-gray-900 pb-12">
      <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

        <div class="col-span-full  ">
          <label for="photo" class="block text-sm font-medium flex justify-center text-gray-900">Photo</label>
          <div class="mt-5 flex justify-center  gap-x-3">
            <svg class="h-12 w-[100px] text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" clip-rule="evenodd" />
            </svg>
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
              class="w-full rounded-lg border-gray-200 p-3 text-sm"
              type="text"
              id="name"
            />
          </div>

          <div class="grid grid-cols-2 gap-4 mt-5">
            <div>
            <label for="username" class=" text-sm font-medium text-gray-900">ชื่อภาษาไทย</label>
              <input
                class="w-full rounded-lg border-gray-200 p-3 text-sm"
                placeholder=""
                type="email"
                id="email"
              />
            </div>

            <div>
            <label for="username" class=" text-sm font-medium text-gray-900">นามสกุลภาษาไทย</label>
              <input
                class="w-full rounded-lg border-gray-200 p-3 text-sm"
                placeholder=""
                type="tel"
                id="phone"
              />
            </div>
          </div>
          <div class="grid grid-cols-2 gap-4 mt-5">
            <div>
            <label for="username" class=" text-sm font-medium text-gray-900">ชื่อภาษาอังกฤษ</label>
              <input
                class="w-full rounded-lg border-gray-200 p-3 text-sm"
                placeholder=""
                type="email"
                id="email"
              />
            </div>

            <div>
            <label for="username" class=" text-sm font-medium text-gray-900">นามสกุลภาษาอังกฤษ</label>
              <input
                class="w-full rounded-lg border-gray-200 p-3 text-sm"
                placeholder=""
                type="tel"
                id="phone"
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
                id="email"
              />
            </div>

            <div>
            <label for="username" class=" text-sm font-medium text-gray-900">เบอร์โทรศัพท์</label>
              <input
                class="w-full rounded-lg border-gray-200 p-3 text-sm"
                placeholder=""
                type="tel"
                id="phone"
              />
            </div>
          </div>
    </div>
  </div>

  <div class="mt-6 flex items-center justify-end gap-x-6">
    <button type="button" class="rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Cancel</button>
    <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
  </div>
</form>











<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
<script src="https://cdn.tailwindcss.com"></script>
</body>
</html>