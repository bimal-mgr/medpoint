const searchBar = document.getElementById("searchBar");
const searchButton = document.getElementById("searchButton");
const clear = document.getElementById("clear");
const cartNum = document.getElementById("cartNum");

const performSearch = () => {
  if (searchBar.value !== "") {
    let request = new XMLHttpRequest();
    request.open("GET", "search.php?query=" + searchBar.value);
    request.onreadystatechange = function () {
      if (this.readyState === 4 && this.status === 200) {
        document.getElementById("searchResult").innerHTML = this.responseText;
      }
    };
    request.send();
  } else {
    document.getElementById("searchResult").innerHTML = "";
  }
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
  document.getElementById("searchResult").innerHTML = "";
});
searchButton.addEventListener("click", performSearch);
searchBar.addEventListener("keydown", (e) => {
  if (e.key === "Enter") {
    performSearch();
  }
});
