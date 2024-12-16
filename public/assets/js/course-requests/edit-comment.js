document.querySelectorAll(".edit-comment-button").forEach((button) => {
  button.addEventListener("click", (event) => {
    event.preventDefault();
    const commentId = button.getAttribute("data-comment-id");
    const commentElement = document.getElementById(`comment-${commentId}`);
    const commentText = commentElement.querySelector(".comment-text");
    const editForm = commentElement.querySelector(".edit-comment-form");

    commentText.classList.toggle("hidden");
    editForm.classList.toggle("hidden");
  });
});

document.querySelectorAll(".cancel-edit").forEach((button) => {
  button.addEventListener("click", (e) => {
    const editForm = button.closest(".edit-comment-form");
    const commentText = editForm.previousElementSibling;

    commentText.classList.remove("hidden");
    editForm.classList.add("hidden");

    // Reset the textarea to its original value
    const editingTextArea = editForm.querySelector("textarea");
    editingTextArea.value = editingTextArea.getAttribute("data-comment");
  });
});
