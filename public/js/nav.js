const userMenu = document.getElementById("user-menu-button");
const dropdownMenu = document.getElementById("user-dropdown");
let timeout;
userMenu.addEventListener("click", () => {
  dropdownMenu.classList.toggle("hidden");
});
dropdownMenu.addEventListener("mouseleave", () => {
  dropdownMenu.classList.toggle("hidden");
});
