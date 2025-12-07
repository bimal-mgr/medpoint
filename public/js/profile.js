const content = document.getElementById("profileContent");
const emptyElement = `<div class='bg-white shadow-md rounded-2xl w-full'>
    <div class="p-7 border-b border-[#eee] flex justify-between items-center">
        <h1 class="text-2xl font-bold text-[#333]">Shopping Cart</h1>
        <button class="px-5 py-2 rounded-lg text-sm font-semibold cursor-pointer transition-all bg-[#f5f5f5] hover:bg-[#e0e0e0] text-[#555]" onclick="window.location.href='index.php'">🏠 Continue Shopping</button>
    </div>
    <div class="p-8">
        <div class="text-center p-y[80px] px-5" >
            <p class="text-3xl text-[#333] font-semibold" >No orders Yet</p>
        </div>
    </div>
    </div>`;

// initial load
window.onload = ajaxComponent("profile");

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

function removeFromCart(cartid) {
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

function rerender() {
  ajaxComponent("profile");
}
