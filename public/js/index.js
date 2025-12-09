const searchBar = document.getElementById("searchBar");
const searchButton = document.getElementById("searchButton");
const clear = document.getElementById("clear");
const cartNum = document.getElementById("cartNum");
const itemcontainer = document.getElementById("item");
const content = document.getElementById("item-content");
const itemElement = {
  isRendered: false,
  sellerId: 0,
  productId: 0,
};

searchBar.addEventListener("input", () => {
  if (searchBar.value.trim() !== "") {
    clear.classList.remove("opacity-0", "pointer-events-none"); // fade in
    clear.classList.add("opacity-100");
  } else {
    clear.classList.remove("opacity-100"); // fade out
    clear.classList.add("opacity-0", "pointer-events-none");
  }
});

const performSearch = () => {
  if (searchBar.value !== "") {
    let request = new XMLHttpRequest();
    request.open("GET", "search.php?query=" + searchBar.value);
    request.onreadystatechange = function () {
      if (this.readyState === 4 && this.status === 200) {
        document.getElementById("searchResult").innerHTML = this.responseText;
        document.getElementById("meds").scrollIntoView({ behavior: "smooth" });
      }
    };
    request.send();
  } else {
    document.getElementById("searchResult").innerHTML = "";
  }
};

const item = (sellerId, productId) => {
  itemElement.sellerId = sellerId;
  itemElement.productId = productId;
  if (itemcontainer.classList.contains("hidden")) {
    itemcontainer.classList.remove("hidden");
    itemcontainer.classList.add("flex");
  }
  let request = new XMLHttpRequest();
  request.open("GET", "item.php?sid=" + sellerId + "&pid=" + productId);
  request.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      content.innerHTML = this.responseText;
      if (!itemElement.isRendered) {
        itemElement.isRendered = true;
        content.style.maxHeight = "900px";
      }
    }
  };
  request.send();
};

// updates cart icon number
const updateCartNum = () => {
  let request = new XMLHttpRequest();
  request.open("GET", "carticon.php?number");
  request.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      cartNum.innerText = this.responseText;
    }
  };
  request.send();
};
//initial load ma sets cart ma kati ota items xa
updateCartNum();
// event listeners
clear.addEventListener("click", () => {
  searchBar.value = "";
  clear.classList.add("opacity-0", "pointer-events-none");
  clear.classList.remove("opacity-100");
  search.focus();
  document.getElementById("searchResult").innerHTML = "";
});
searchButton.addEventListener("click", performSearch);
searchBar.addEventListener("keydown", (e) => {
  if (e.key === "Enter") {
    performSearch();
  }
});

// Close modal on outside click
itemcontainer.addEventListener("click", function (e) {
  if (!content.contains(e.target)) {
    closeItem();
  }
});

function closeItem() {
  content.style.maxHeight = 0;
  itemElement.isRendered = false;
  clearTimeout(timeout);
  timeout = setTimeout(() => {
    itemcontainer.classList.remove("flex");
    itemcontainer.classList.add("hidden");
    content.innerHTML = "";
  }, 700);
}

// events for item

function remove() {
  const domQuantity = document.getElementById("quantity");
  let currentQuantity = parseInt(domQuantity.innerText);
  if (currentQuantity > 1) {
    domQuantity.innerText = currentQuantity - 1;
  }
}

function add() {
  const domQuantity = document.getElementById("quantity");
  const stock = document.getElementById("stock");
  let currentQuantity = parseInt(domQuantity.innerText);
  let currentStock = stock.getAttribute("data-stock");
  if (currentQuantity < currentStock) {
    domQuantity.innerText = currentQuantity + 1;
  }
}

const cart = (id, button, quantity) => {
  let request = new XMLHttpRequest();
  const domQuantity = document.getElementById("quantity");
  request.open("GET", "cart.php?id=" + id + "&quantity=" + quantity);
  request.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      clearTimeout(timeout);
      button.innerText = "Added!!";
      updateCartIcon();
      domQuantity.innerText = 1;
      timeout = setTimeout(() => {
        item(itemElement.sellerId, itemElement.productId);
      }, 200);
    }
  };
  request.send();
};

function deliverComponent(query, button) {
  const domQuantity = document.getElementById("quantity");
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
        item(itemElement.sellerId, itemElement.productId);
      }, 200);
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
  const domQuantity = document.getElementById("quantity");
  const button = event.target;
  const id = button.getAttribute("data-id");
  const count = parseInt(domQuantity.innerText);
  cart(id, button, count);
}

function buyNow(event) {
  const domQuantity = document.getElementById("quantity");
  const button = event.target;
  const id = button.getAttribute("data-id");
  const count = parseInt(domQuantity.innerText);
  deliverComponent("?q=one&id=" + id + "&quantity=" + count, button);
}
