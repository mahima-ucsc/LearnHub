// JavaScript for handling the dlete modal behavior

const modal = document.getElementById("deleteModal");
function showModal(deleteUrl) {
  // Set the form's action to the delete URL passed in
  const deleteForm = document.getElementById("deleteForm");
  deleteForm.action = deleteUrl;

  // Show the modal
  modal.classList.toggle("show");
  document.body.style.overflow = "hidden";
}

function hideModal() {
  modal.classList.toggle("show");
  document.body.style.overflow = "auto";
}

// Close modal when clicking outside
window.onclick = function (event) {
  if (event.target === modal) {
    hideModal();
  }
};

// Close modal on escape key press
document.addEventListener("keydown", function (event) {
  if (event.key === "Escape") {
    hideModal();
  }
});
