const content = document.getElementById("item-content");
const itemcontainer = document.getElementById("item");

itemcontainer.addEventListener("click", function (e) {
  if (!content.contains(e.target)) {
    closeModal();
  }
});
function openModal() {
  itemcontainer.classList.remove("hidden");
  itemcontainer.classList.add("flex");
  ajaxComponent();
}

function closeModal() {
  content.style.maxHeight = "0";
  clearTimeout(timeout);
  timeout = setTimeout(() => {
    itemcontainer.classList.remove("flex");
    itemcontainer.classList.add("hidden");
  }, 700);
}

function ajaxComponent() {
  let request = new XMLHttpRequest();
  request.open("GET", "product.php");
  request.onreadystatechange = function () {
    if (this.readyState === 4 && this.status === 200) {
      content.innerHTML = this.responseText;
      content.style.maxHeight = "900px";
    }
  };
  request.send();
}

const pricePattern = /^\d+(\.\d{2})?$/;
const namePattern = /^[a-zA-Z]+[a-zA-Z\s]+$/;
const descPattern = /^[a-zA-Z]+[a-zA-Z0-9\s]+$/;

function insert(event) {
  const element = event.target;
  // remove any previous input listener
  element.removeEventListener("input", element._inputListener);
  let pattern;
  switch (element.id) {
    case "medicine_name":
      pattern = namePattern;
      break;
    case "unit_price":
      pattern = pricePattern;
      break;
    case "description":
      pattern = descPattern;
      break;
    default:
      exit();
  }
  // create a new listener function
  element.inputListener = function () {
    if (!pattern.test(element.value)) {
      element.classList.add("focus:border-red-500", "border-red-500");
      document.getElementById("submit").disabled = true;
    } else {
      element.classList.remove("focus:border-red-500", "border-red-500");
      document.getElementById("submit").disabled = false;
    }
  };
  // attach the new listener
  element.addEventListener("input", element.inputListener);
}

function selectProduct(event) {
  const element = event.target;
  if (element.value == 0) {
    document.getElementById("optionalproductName").classList.remove("hidden");
    document.getElementById("optionalCategory").classList.remove("hidden");
    document.getElementById("optionalproductName").classList.add("flex");
    document.getElementById("medicineName").disabled = false;
  } else {
    document.getElementById("optionalproductName").classList.remove("flex");
    document.getElementById("optionalCategory").classList.remove("flex");
    document.getElementById("optionalproductName").classList.add("hidden");
    document.getElementById("optionalCategory").classList.add("hidden");
  }
}
function selectCategory(event) {
  const element = event.target;
  if (element.value == 0) {
    document
      .getElementById("optionalproductCategory")
      .classList.remove("hidden");
    document.getElementById("optionalproductCategory").classList.add("flex");
    document.getElementById("optionalCategory").classList.add("flex");
  } else {
    document.getElementById("optionalproductCategory").classList.remove("flex");
    document.getElementById("optionalproductCategory").classList.add("hidden");
  }
}
