// JavaScript for handling the dlete modal behavior

const modal = document.getElementById("deleteModal");
function showModal(deleteUrl) {
  // Set the form's action to the delete URL passed in
  const deleteForm = document.getElementById("deleteForm");
  deleteForm.action = deleteUrl;

  // Show the modal
  modal.style.display = "block";
  document.body.style.overflow = "hidden";
}

function hideModal() {
  modal.style.display = "none";
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
  if (event.key === "Escape" && modal.style.display === "block") {
    hideModal();
  }
});
