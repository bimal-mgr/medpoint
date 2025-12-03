<?php include "header.php"; ?>
<body>
  <?php include "navbar.php"; ?>
  <section class="bg-[url('./public/background.jpg')] bg-cover bg-center h-64 flex flex-col justify-center items-center text-white font-bold text-3xl">
    <h1 class="w-full pl-[10%] text-start">Nepal largest <br>e-pharmaceutical company </h1>
  </section>
  <main class=" m-4 h-fit flex flex-col items-center">
    <div id="searchResult"></div>
    <?php
    include "items.php";
    include "carticon.php";
    ?>
  </main>
  <footer class=" w-full bg-med-drklime text-white">
    <div class="w-full p-4 flex justify-around">
      <div>
        <h3 class="font-semibold  mb-3.5">Contact</h3>
        <p class=" gap-2.5 mb-2">
          <img src="./public/location.svg" class="h-4 w-4 inline-block " alt="location"> Ramailo-Chowk, Chitwan
        </p>
        <p class="gap-2.5 mb-2">
          <img src="./public/mail.svg" class="h-4 w-4 inline-block " alt="mail"> sumitpoudel@gmail.com
        </p>
        <p class="gap-2.5 mb-2">
          <img src="./public/mail.svg" class="h-4 w-4 inline-block " alt="mail"> bimalmagar@gmail.com
        </p>
      </div>
      <div>
        <h3 class="font-semibold  mb-3.5">Social Media</h3>
        <div class="flex gap-4 text-2xl">
          <a href="#" class="hover:text-blue-400">🌐</a>
          <a href="#" class="hover:text-pink-500">📸</a>
          <a href="#" class="hover:text-blue-400"> 💼</a>
          <a href="#" class="hover:text-red-600"> ▶</a>
        </div>
      </div>
    </div>
    <div class="w-full p-2 flex justify-around">
      <p>© 2025 SUMIT. All rights reserved.</p>
      <div class="flex gap-4">
        <p>
          Terms and Conditions
        </p>
        <p>
          Privacy Policy
        </p>
      </div>
    </div>
  </footer>
  <script src="public/js/index.js"></script>
  <script src="public/js/nav.js"></script>
  </body>
  </html>
