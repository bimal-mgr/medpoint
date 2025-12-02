function getCookie(name) {
  const value = `; ${document.cookie}`;
  const parts = value.split(`; ${name}=`);
  if (parts.length === 2) return parts.pop().split(";").shift();
}

const searchBar = document.getElementById("searchBar");
const searchButton = document.getElementById("searchButton");
const clear = document.getElementById("clear");
const cartNum = document.getElementById("cart");

const performSearch = () => {
  if (searchBar.value !== "") {
    let request = new XMLHttpRequest();
    request.open("GET", "search.php?query=" + searchBar.value);
    request.onreadystatechange = function () {
      if (this.readyState === 4 && this.status === 200) {
        document.getElementById("searchResult").innerHTML = this.responseText;
        addToCart("search-items", true);
      }
    };
    request.send();
  } else {
    document.getElementById("searchResult").innerHTML = "";
  }
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

// event listeners
clear.addEventListener("click", () => {
  addToCart("search-items", false);
  searchBar.value = "";
  document.getElementById("searchResult").innerHTML = "";
});
searchButton.addEventListener("click", performSearch);
searchBar.addEventListener("keydown", (e) => {
  if (e.key === "Enter") {
    performSearch();
  }
});
