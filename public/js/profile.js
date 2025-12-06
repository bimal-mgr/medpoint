const profile = document.getElementById("profile");
const address = document.getElementById("address");
const orders = document.getElementById("orders");
const delivered = document.getElementById("delivered");
const content = document.getElementById("profileContent");
const emptyElement =
  "<div class='bg-white flex items-center justify-center p-4 shadow-md rounded-md min-h-[40vh] w-full'><strong class='my-auto text-center text-xl items-center' >Nothing in cart</strong></div></div>";

// initial load
window.onload = ajaxComponent("profile");

// event listeners
profile.addEventListener("click", () => {
  ajaxComponent("profile");
});
address.addEventListener("click", () => {
  ajaxComponent("address");
});
orders.addEventListener("click", () => {
  ajaxComponent("orders");
});
delivered.addEventListener("click", () => {
  ajaxComponent("delivered");
});

// ajax component

function ajaxComponent(query) {
  var request = new XMLHttpRequest();
  let url = "profile.php?q=" + query;
  request.open("GET", url);
  request.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      content.innerHTML = this.responseText;
    }
  };
  request.send();
}

function deliverComponent() {
  let request = new XMLHttpRequest();
  let url = "deliver.php?q=all";
  request.open("GET", url);
  request.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      content.innerHTML = emptyElement;
    }
  };
  request.send();
}

function removeFromCart(event, cartid) {
  let request = new XMLHttpRequest();
  let url = "cart.php?cartid=" + cartid;
  request.open("GET", url);
  request.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      ajaxComponent("orders");
    }
  };
  request.send();
}
