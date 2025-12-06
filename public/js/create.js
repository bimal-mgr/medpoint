// constants defination
const username = document.getElementById("username");
const usernameBox = document.getElementById("usernameBox");
const userError = document.getElementById("userError");
const fullname = document.getElementById("fullname");
const fullnameBox = document.getElementById("fullnameBox");
const nameError = document.getElementById("nameError");
const phone = document.getElementById("phone");
const phoneBox = document.getElementById("phoneBox");
const phoneError = document.getElementById("phoneError");
const password = document.getElementById("password");
const passwordBox = document.getElementById("passwordBox");
const passError = document.getElementById("passError");
const confirmpassword = document.getElementById("confirmpassword");
const confirmpasswordBox = document.getElementById("confirmpasswordBox");
const submit = document.getElementById("submit");
let timeout;
// regex patterns
let userPattern = /^([A-Z]|[a-z])[A-Za-z0-9_]{1,10}$/;
let namePattern = /^(?=.*\s)[A-Za-z\s]+$/;
let phPattern = /^(97|98)\d{8}$/;
let passwordPattern =
  /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

// functions to enable/disable
const disableSubmit = () => {
  submit.disabled = true;
  submit.classList.add("bg-blue-100");
  submit.classList.remove("bg-blue-500");
};
const enableSubmit = () => {
  submit.disabled = false;
  submit.classList.remove("bg-blue-100");
  submit.classList.add("bg-blue-500");
};
const disablePasswords = (message) => {
  passwordBox.classList.add("border-red-500");
  confirmpasswordBox.classList.add("border-red-500");
  passError.innerText = message;
};
const enablePasswords = () => {
  passwordBox.classList.remove("border-red-500");
  confirmpasswordBox.classList.remove("border-red-500");
  passError.innerText = "";
};
const disableUsername = (message) => {
  usernameBox.classList.add("border-red-500");
  userError.innerText = message;
};
const enableUsername = () => {
  usernameBox.classList.remove("border-red-500");
  userError.innerText = "";
};
const disableFullname = (message) => {
  fullnameBox.classList.add("border-red-500");
  nameError.innerText = message;
};
const enableFullname = () => {
  fullnameBox.classList.remove("border-red-500");
  nameError.innerText = "";
};
const disablePhone = (message) => {
  phoneBox.classList.add("border-red-500");
  phoneError.innerText = message;
};
const enablePhone = () => {
  phoneBox.classList.remove("border-red-500");
  phoneError.innerText = "";
};

// validation functions
const checkUsername = () => {
  if (!userPattern.test(username.value)) {
    disableUsername("Invalid username format.");
    disableSubmit();
    return;
  }
  let request = new XMLHttpRequest();
  request.open("GET", "create.php?username=" + username.value);
  request.onreadystatechange = function () {
    if (this.readyState === 4 && this.status === 200) {
      if (this.responseText === "taken") {
        disableUsername("Username is already taken.");
        disableSubmit();
      } else {
        enableUsername();
        enableSubmit();
      }
    }
  };
  request.send();
};

const checkFullname = () => {
  clearTimeout(timeout);
  timeout = setTimeout(() => {
    if (fullname.value.length > 0) {
      if (namePattern.test(fullname.value)) {
        enableFullname();
        enableSubmit();
      } else {
        disableFullname("Full name must contain at least first and last name.");
        disableSubmit();
      }
    } else {
      enableFullname();
      enableSubmit();
    }
  }, 1000);
};
const checkPhone = () => {
  clearTimeout(timeout);
  timeout = setTimeout(() => {
    if (phone.value.length > 0) {
      if (phPattern.test(phone.value)) {
        enablePhone();
        enableSubmit();
      } else {
        disablePhone("invalid phone number format.");
        disableSubmit();
      }
    } else {
      enablePhone();
      enableSubmit();
    }
  }, 500);
};
const checkPasswords = () => {
  clearTimeout(timeout);
  timeout = setTimeout(() => {
    if (password.value.length > 0 && confirmpassword.value.length > 0) {
      if (!passwordCheck()) disableSubmit();
      else enableSubmit();
    } else {
      enableSubmit();
      enablePasswords();
    }
  }, 500);
};
const passwordCheck = () => {
  if (password.value !== confirmpassword.value) {
    disablePasswords("passwords do not match");
    return false;
  }
  if (passwordPattern.test(password.value)) {
    enablePasswords();
    return true;
  } else {
    disablePasswords(
      "Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one digit, and one special character.",
    );
    return false;
  }
};

// event listeners
username.addEventListener("focusout", checkUsername);
fullname.addEventListener("input", checkFullname);
phone.addEventListener("input", checkPhone);
password.addEventListener("input", checkPasswords);
confirmpassword.addEventListener("input", checkPasswords);
