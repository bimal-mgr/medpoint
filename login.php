<?php include "header.php"; ?>

<?php
$conn = new mysqli("localhost", "root", "", "medpoint");
session_start();
if (isset($_POST["login"])) {
    $type = $_GET["type"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $sql = "";
    $type;
    switch ($type) {
        case "user":
            $sql = "SELECT * from users WHERE username='$username'";
            $type = 3;
            break;
        case "seller":
            $sql = "SELECT * from users inner join seller on users.user_id = seller.user_id WHERE username='$username'";
            $type = 2;
            break;
        case "admin":
            $sql = "SELECT * from users inner join admin on users.user_id = admin.user_id WHERE username='$username'";
            $type = 1;
            break;
    }
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($password === $row["password"]) {
            $_SESSION["username"] = $username;
            $_SESSION["fullname"] = $row["full_name"];
            $_SESSION["user_id"] = $row["user_id"];
            $_SESSION["level"] = $type;
            echo "<script>window.location.href = '/medpoint'</script>";
        } else {
            echo "<script>
  document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('passwordBox').classList.add('border-red-500');
    document.getElementById('passError').innerText = 'Incorrect password';
  });
</script>
";
        }
    } else {
        echo "<script>
  document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('usernameBox').classList.add('border-red-500');
    document.getElementById('userError').innerText = 'Username not found';
  });
</script>
";
    }
    mysqli_close($conn);
}
?>

<body>
  <section class=" w-screen h-screen flex justify-center items-center ">
    <div class="flex h-fit w-fit justify-center m-auto items-center shadow-lg rounded-2xl overflow-hidden ">
      <div class="w-fit p-4 flex flex-col justify-center items-center ">
        <img src="./public/med-logo.png" class="-rotate-15 aspect-auto max-w-30 " alt="logo">
        <h2 class="font-heading font-bold text-2xl text-main-black mt-4 ">Connect with us</h2>
        <p>MedPoint — Your Trusted Pharmacy, Online.</p>
      </div>
      <div class="p-4 border-l-2 border-main-gray ">
        <form action="" method="post" class="flex flex-col gap-1 p-2 ">
          <h3 class="self-start font-heading font-bold text-lg text-main-black ">Login:</h3>
          <fieldset id="usernameBox" class="rounded-lg border-main-gray h-15 pl-3 border-2">
            <legend class="text-main-black ml-2 font-heading font-semibold ">UserName*</legend>
            <label  class=" flex text-main-gray items-center gap-1.5">
              <img src="public/person.svg" class="h-4 w-4" alt="person icon" /> |
              <input id="username" type="text" name="username" class=" w-full focus:outline-0 font-semibold focus:text-main-black placeholder-main-gray placeholder:font-heading placeholder:font-semibold " required placeholder="Enter your user name" />
            </label>
          </fieldset>
          <p class="text-red-500 " id="userError" ></p>
          <fieldset id="passwordBox" class="rounded-lg border-main-gray h-15 pl-3 border-2">
            <legend class="text-main-black ml-2 font-heading font-semibold ">Password*</legend>
            <label class=" flex text-main-gray items-center gap-1.5">
              <img src="public/person.svg" class="h-4 w-4" alt="person icon" /> |
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
          <button name="login" class="w-full bg-med-lime p-1 text-white font-semibold rounded-md ">login</button>
        </form>
        <hr class=" border-1 border-main-gray">
        <a href="/medpoint/create.php" class="w-full p-2 mt-2 font-semibold rounded-md bg-blue-500 text-white text-center inline-block ">create an account</a>
      </div>
    </div>
  </section>
</body>
