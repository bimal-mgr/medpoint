<?php
session_start();
include "header.php";
?>
<body>
  <?php include "navbar.php"; ?>
  <section class="bg-[linear-gradient(135deg,#00bfa5_0%,#00796b_100%)] hero relative overflow-hidden text-white px-[60px] py-[20px]">
       <div class="max-w-[1200px] mx-auto flex items-center justify-between relative z-10">
           <div class="flex-1">
               <h1 class="text-[48px]/[1.2] mb-4 " >Nepal's Largest<br>E-Pharmaceutical Company</h1>
               <p class="text-[20px] mb-[30px] opacity-95" >Trusted medicines delivered to your doorstep.<br>Licensed, authentic, and always available.</p>
               <div class="flex justify-start align-center gap-8">
                   <button onclick="document.getElementById('meds').scrollIntoView({ behavior: 'smooth' })" class="btn bg-white text-[#00796b] hover:-translate-x-1 hover:shadow-md ">Shop Now</button>
                   <button onclick="document.querySelector('footer').scrollIntoView({ behavior: 'smooth' })" class="btn bg-transparent text-white border-2 border-white hover:bg-white hover:text-[#00796b]">About Us</button>
               </div>
           </div>
       </div>
   </section>

   <div id="meds" class="max-w-[1200px] mt-[-35px] mb-14 p-5 z-20 grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 relative mx-auto">
       <div class="feature-card">
           <div class="feature-icon">✓</div>
           <h3>100% Authentic</h3>
           <p>icensed medicines from trusted manufacturers</p>
       </div>
       <div class="feature-card">
           <div class="feature-icon">🔲</div>
           <h3>Fast Delivery</h3>
           <p>1 sec delivery on button click</p>
       </div>
       <div class="feature-card">
           <div class="feature-icon">📱</div>
           <h3>Your companion</h3>
           <p>Available 20hrs on your device</p>
       </div>
       <div class="feature-card">
           <div class="feature-icon">🤙</div>
           <h3>Customer Support</h3>
           <p>Excellent customer service</p>
       </div>
   </div>
   <div id="item" class="fixed inset-0 justify-center items-center bg-black/40 hidden z-50">
       <div id="item-content" class="max-w-[1200px] max-h-0 transition-all duration-700 ease-in-out overflow-hidden">
           <!-- AJAX content -->
       </div>
   </div>
  <main class=" m-4 h-fit flex flex-col items-center">
    <section class="w-full" >
        <div class="max-w-[1200px] mx-auto flex flex-col gap-7 px-5" >
            <div id="searchResult" class="" ></div>
            <?php include "items.php"; ?>
        </div>
    </section>
    <?php include "carticon.php"; ?>
  </main>
  <footer class=" w-full bg-[#00796b] text-white">
    <div class="w-full p-4 flex justify-around">
      <div>
        <h3 class="font-bold  mb-3.5">Contact</h3>
        <p class="gap-2.5 font-semibold mb-2">
          <img src="./public/location.svg" class="h-4 w-4 inline-block " alt="location"> Ramailo-Chowk, Chitwan
        </p>
        <p class="gap-2.5 font-semibold mb-2">
          <img src="./public/mail.svg" class="h-4 w-4 inline-block " alt="mail"> sumitpoudel@gmail.com
        </p>
        <p class="gap-2.5 font-semibold mb-2">
          <img src="./public/mail.svg" class="h-4 w-4 inline-block " alt="mail"> bimalmagar@gmail.com
        </p>
      </div>
      <div>
        <h3 class="font-bold  mb-3.5">Social Media</h3>
        <div class="flex gap-4 text-2xl">
          <a href="https://www.facebook.com/bimal.ranamagar.161" class="text-white hover:text-blue-500">
              <svg class="fill-current w-8 h-8" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 50 50">
                  <path d="M25,3C12.85,3,3,12.85,3,25c0,11.03,8.125,20.137,18.712,21.728V30.831h-5.443v-5.783h5.443v-3.848 c0-6.371,3.104-9.168,8.399-9.168c2.536,0,3.877,0.188,4.512,0.274v5.048h-3.612c-2.248,0-3.033,2.131-3.033,4.533v3.161h6.588 l-0.894,5.783h-5.694v15.944C38.716,45.318,47,36.137,47,25C47,12.85,37.15,3,25,3z"></path>
              </svg>
          </a>
          <a href="https://instagram.com/goku_chann_" class="text-white hover:text-pink-500">
              <svg class="fill-current w-8 h-8" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 30 30">
                  <path d="M 9.9980469 3 C 6.1390469 3 3 6.1419531 3 10.001953 L 3 20.001953 C 3 23.860953 6.1419531 27 10.001953 27 L 20.001953 27 C 23.860953 27 27 23.858047 27 19.998047 L 27 9.9980469 C 27 6.1390469 23.858047 3 19.998047 3 L 9.9980469 3 z M 22 7 C 22.552 7 23 7.448 23 8 C 23 8.552 22.552 9 22 9 C 21.448 9 21 8.552 21 8 C 21 7.448 21.448 7 22 7 z M 15 9 C 18.309 9 21 11.691 21 15 C 21 18.309 18.309 21 15 21 C 11.691 21 9 18.309 9 15 C 9 11.691 11.691 9 15 9 z M 15 11 A 4 4 0 0 0 11 15 A 4 4 0 0 0 15 19 A 4 4 0 0 0 19 15 A 4 4 0 0 0 15 11 z"></path>
              </svg>
          </a>
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
