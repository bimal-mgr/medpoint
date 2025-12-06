<?php
define("BASE_URL", "http://localhost/medpoint"); ?>

<nav class="z-[40] bg-ash shadow-md sticky top-0">
  <div class="flex max-w-[1200px] mx-auto w-full inherit flex-wrap items-center justify-between p-3">
    <a href="<?php echo BASE_URL; ?>/index.php" class="flex items-center space-x-3 rtl:space-x-reverse">
      <img src="<?php echo BASE_URL; ?>/public/med-logo.png" class="h-8" alt="Logo" />
      <h1 class="self-center whitespace-nowrap font-bold text-2xl text-[#00bfa5] ">med<bold class="text-[#00796b]" >point</bold></h1>
    </a>

    <div class="relative flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
        <?php
        session_start();
        if (isset($_SESSION["username"])) {
            echo "<span class='mr-4'>HOWDEY, " .
                $_SESSION["username"] .
                "</span>";
        }
        ?>
      <button type="button" class="text-white bg-[#00bfa5] rounded-full p-1 hover:bg-white hover:text-[#00bfa5]" id="user-menu-button" aria-expanded="false">
          <svg class="h-8 w-8 stroke-current stroke-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
        </svg>
      </button>
      <!-- Dropdown menu -->
      <div class="z-50 hidden min-w-32 text-start absolute top-5 right-0  my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow-sm dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown">
        <div class="px-4 py-3">
          <span class="block text-sm text-gray-900 dark:text-white">
            <?php
            session_start();
            if (isset($_SESSION["username"])) {
                echo $_SESSION["username"];
            } else {
                echo "Guest";
            }
            ?>
          </span>
          <span class="block text-sm  text-gray-500 truncate dark:text-gray-400">
            <?php if (isset($_SESSION["fullname"])) {
                echo $_SESSION["fullname"];
            } else {
                echo "Welcome to MedPoint";
            } ?>
          </span>
        </div>
        <ul class="py-2" aria-labelledby="user-menu-button">
            <?php if (isset($_SESSION["username"])) {
                echo "<li>
                <a href='" .
                    BASE_URL .
                    "/profile.php' class='block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white'>cart</a>
          </li>";
                echo "<li>
                <a href='/medpoint/logout.php' class='block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white'>
                  sign out
              </a>";
            } else {
                echo "<a href='/medpoint/login.php?type=user' class='block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white'>
                sign in
            </a>";
            } ?>
          </li>
        </ul>
      </div>

    </div>
  </div>
</nav>
