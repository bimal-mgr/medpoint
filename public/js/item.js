const domQuantity = document.getElementById("quantity");
const stock = document.getElementById("stock");
const remove = document.getElementById("remove");
const add = document.getElementById("add");
const buy = document.getElementById("buy");
const share = document.getElementById("share");
const cartNum = document.getElementById("cartNum");

remove.addEventListener("click", () => {
  let currentQuantity = parseInt(domQuantity.innerText);
  if (currentQuantity > 1) {
    domQuantity.innerText = currentQuantity - 1;
  }
});

add.addEventListener("click", () => {
  let currentQuantity = parseInt(domQuantity.innerText);
  let currentStock = stock.getAttribute("data-stock");
  if (currentQuantity < currentStock) {
    domQuantity.innerText = currentQuantity + 1;
  }
});

async function shareItem() {
  try {
    await navigator.clipboard.writeText(window.location.href);
    share.classList.remove("border-transparent");
    share.classList.add("share");
  } catch (err) {
    console.error("Could not write to clipboard", err);
  }
}

const cart = (id, button, quantity) => {
  let request = new XMLHttpRequest();
  request.open("GET", "cart.php?id=" + id + "&quantity=" + quantity);
  request.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      stock.innerText = this.responseText;
      clearTimeout(timeout);
      button.innerText = "Added!!";
      updateCartIcon();
      domQuantity.innerText = 1;
      timeout = setTimeout(() => {
        button.innerText = "Add to cart";
      }, 500);
    }
  };
  request.send();
};

function deliverComponent(query, button) {
  let request = new XMLHttpRequest();
  let url = "deliver.php" + query;
  request.open("GET", url);
  request.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      stock.innerText = this.responseText;
      updateCartIcon();
      clearTimeout(timeout);
      button.innerText = "bought!!";
      domQuantity.innerText = 1;
      timeout = setTimeout(() => {
        button.innerText = "Buy now";
      }, 500);
    }
  };
  request.send();
}

function updateCartIcon() {
  let request = new XMLHttpRequest();
  let url = "carticon.php?number";
  request.open("GET", url);
  request.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      cartNum.innerText = this.responseText;
    }
  };
  request.send();
}
updateCartIcon();

function addToCart(event) {
  const button = event.target;
  const id = button.getAttribute("data-id");
  const count = parseInt(domQuantity.innerText);
  cart(id, button, count);
}

function buyNow(event) {
  const button = event.target;
  const id = button.getAttribute("data-id");
  const count = parseInt(domQuantity.innerText);
  deliverComponent("?q=one&id=" + id + "&quantity=" + count, button);
}
