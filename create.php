<?php
session_start();
$conn = new mysqli("localhost", "root", "", "medpoint");
if (isset($_GET["username"])) {
    $username = $_GET["username"];
    $qry = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $qry);
    if (mysqli_num_rows($result) > 0) {
        echo "taken";
    } else {
        echo "available";
    }
    mysqli_close($conn);
    exit();
}
if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $fullname = $_POST["fullname"];
    $password = $_POST["password"];
    $phone = $_POST["phone"];
    $confirmpassword = $_POST["confirmpassword"];
    $qry = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $qry);
    if (mysqli_num_rows($result) > 0) {
        echo "<script>
  document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('title').innerText='Username not avaliable!';
    document.getElementById('usernameBox').classList.add('border-red-500');
  });
</script>
";
    } else {
        $sql = "INSERT INTO users (username, full_name, phone_number, password) VALUES ('$username', '$fullname','$phone' ,'$password')";
        if (mysqli_query($conn, $sql)) {
            $_SESSION["username"] = $username;
            $_SESSION["fullname"] = $fullname;
            $_SESSION["level"] = 3;
            $_SESSION["user_id"] = mysqli_insert_id($conn);
            echo "<script>window.location.href = '/medpoint'</script>";
        } else {
            echo "<script>
  document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('title').innerText='error';
  });
</script>
";
        }
    }
    mysqli_close($conn);
}
?>

<!-- form body -->

<?php include "header.php"; ?>
<body>
  <section class=" w-screen h-screen flex flex-col justify-center items-center ">
    <div class="flex h-fit w-fit justify-center m-auto items-center shadow-lg rounded-2xl overflow-hidden ">
      <div class="w-fit p-4 flex flex-col justify-center items-center ">
        <img src="./public/med-logo.png" class="-rotate-15 aspect-auto max-w-30 " alt="logo">
        <h2 class="font-heading font-bold text-2xl text-main-black mt-4 ">Connect with us</h2>
        <p>MedPoint — Your Trusted Pharmacy, Online.</p>
      </div>
      <div class="p-4 border-l-2 w-[30vw] border-main-gray ">
        <h3 id="title" class="self-start font-heading font-bold text-lg text-main-black ">Create:</h3>
        <form action="" method="post" class="flex flex-col justify-start  p-2 ">
          <fieldset id="usernameBox" class="rounded-lg border-main-gray h-15 pl-3 border-2">
            <legend class="text-main-black ml-2 font-heading font-semibold ">UserName*</legend>
            <label  class=" flex text-main-gray items-center gap-1.5">
              <img src="./public/person.svg" class="h-4 w-4" alt="person icon" /> |
              <input id="username" type="text" name="username" class=" w-full focus:outline-0 font-semibold focus:text-main-black placeholder-main-gray placeholder:font-heading placeholder:font-semibold " required placeholder="Enter your user name" />
            </label>
          </fieldset>
          <p class="text-red-500 " id="userError" ></p>
          <fieldset id="fullnameBox" class="rounded-lg border-main-gray h-15 pl-3 border-2">
            <legend class="text-main-black ml-2 font-heading font-semibold ">FullName*</legend>
            <label class=" flex text-main-gray items-center gap-1.5">
              <img src="./public/person.svg" class="h-4 w-4" alt="person icon" /> |
              <input id="fullname" type="text" name="fullname" class=" w-full focus:outline-0 font-semibold focus:text-main-black placeholder-main-gray placeholder:font-heading placeholder:font-semibold " required placeholder="Enter your full name" />
            </label>
          </fieldset>
          <p class="text-red-500" id="nameError" ></p>
          <fieldset id="phoneBox" class="rounded-lg border-main-gray h-15 pl-3 border-2">
            <legend class="text-main-black ml-2 font-heading font-semibold ">Phone*</legend>
            <label  class=" flex text-main-gray items-center gap-1.5">
              <img src="./public/person.svg" class="h-4 w-4" alt="person icon" /> |
              <input id="phone" type="text" name="phone" class=" w-full focus:outline-0 font-semibold focus:text-main-black placeholder-main-gray placeholder:font-heading placeholder:font-semibold " required placeholder="Enter your phone number" />
            </label>
          </fieldset>
          <p class="text-red-500" id="phoneError" ></p>
          <fieldset id="passwordBox" class="rounded-lg border-main-gray h-15 pl-3 border-2">
            <legend class="text-main-black ml-2 font-heading font-semibold ">Password*</legend>
            <label class="flex text-main-gray items-center gap-1.5">
              <img src="./public/person.svg" class="h-4 w-4" alt="person icon" /> |
              <input id="password" type="password" name="password" class=" w-full focus:outline-0 font-semibold focus:text-main-black placeholder-main-gray placeholder:font-heading placeholder:font-semibold " required placeholder="password" />
              <button type="button" onclick="document.getElementById('password').type = document.getElementById('password').type === 'password' ? 'text' : 'password'" class="mr-4">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                    <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z" clip-rule="evenodd" />
                  </svg>
              </button>
            </label>
          </fieldset>
          <p class="text-red-500" id="passError"></p>
          <fieldset id="confirmpasswordBox" class="rounded-lg border-main-gray h-15 pl-3 border-2">
            <legend class="text-main-black ml-2 font-heading font-semibold ">ConfirmPassword*</legend>
            <label class=" flex text-main-gray items-center gap-1.5">
              <img src="./public/person.svg" class="h-4 w-4" alt="person icon" /> |
              <input id="confirmpassword" type="password" name="confirmpassword" class=" w-full focus:outline-0 font-semibold focus:text-main-black placeholder-main-gray placeholder:font-heading placeholder:font-semibold " required placeholder="confirm password" />
              <button type="button" onclick="document.getElementById('confirmpassword').type = document.getElementById('confirmpassword').type === 'password' ? 'text' : 'password'" class="mr-4">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                    <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z" clip-rule="evenodd" />
                  </svg>
              </button>
            </label>
          </fieldset>
          <hr class=" border-1 my-6 border-main-gray">
          <button
            type="submit"
            id="submit"
            name="submit"
            class="w-full hover:cursor-pointer p-2 font-semibold rounded-md bg-blue-500 text-white text-center ">
            create an account
          </button>
        </form>
      </div>
    </div>
  </section>
  <script src="public/js/create.js"></script>
</body>
