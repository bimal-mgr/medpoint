function getCookie(name) {
  const value = `; ${document.cookie}`;
  const parts = value.split(`; ${name}=`);
  if (parts.length === 2) return parts.pop().split(";").shift();
}

const quantity = document.getElementById("quantity");
const stock = document.getElementById("stock");
const remove = document.getElementById("remove");
const add = document.getElementById("add");
const share = document.getElementById("share");
const cartNum = document.getElementById("cart");

remove.addEventListener("click", () => {
  let currentQuantity = parseInt(quantity.innerText);
  if (currentQuantity > 1) {
    quantity.innerText = currentQuantity - 1;
  }
});

add.addEventListener("click", () => {
  let currentQuantity = parseInt(quantity.innerText);
  let currentStock = stock.getAttribute("data-stock");
  if (currentQuantity < currentStock) {
    quantity.innerText = currentQuantity + 1;
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

const cart = (id, username, button) => {
  let request = new XMLHttpRequest();
  request.open("GET", "cart.php?user=" + username + "&id=" + id);
  request.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      clearTimeout(timeout);
      button.innerText = "Added!!";
      updateCartNum(username);
      timeout = setTimeout(() => {
        button.innerText = "Add to cart";
      }, 500);
    }
  };
  request.send();
};

const updateCartNum = (username) => {
  let request = new XMLHttpRequest();
  request.open("GET", "cart.php?user=" + username);
  request.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      cartNum.innerText = this.responseText;
    }
  };
  request.send();
};
updateCartNum(getCookie("username"));

function addToCart(event) {
  const button = event.target;
  const id = button.getAttribute("data-id");
  const who = getCookie("username");
  cart(id, who, button);
}
