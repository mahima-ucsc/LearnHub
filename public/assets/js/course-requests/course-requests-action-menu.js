document.querySelectorAll(".menu-button").forEach((button) => {
  button.addEventListener("click", (e) => {
    const dropdown = button.nextElementSibling;
    dropdown.style.display =
      dropdown.style.display === "block" ? "none" : "block";
    e.stopPropagation();
  });
});

document.addEventListener("click", () => {
  document.querySelectorAll(".menu-dropdown").forEach((dropdown) => {
    dropdown.style.display = "none";
  });
});
