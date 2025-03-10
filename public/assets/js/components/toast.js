function showToast(title, message, type) {
  // Check if the toast container already exists
  let toastContainer = document.querySelector(".toast-container");

  // If it doesn’t exist, create it dynamically
  if (!toastContainer) {
    toastContainer = document.createElement("div");
    toastContainer.className = "toast-container";
    document.body.appendChild(toastContainer);
  }

  // Create the toast element
  const toast = document.createElement("div");
  toast.className = `toast toast-${type}`;

  // Set the appropriate icon based on the toast type
  let iconClass;
  if (type === "success") {
    iconClass = "fa-check";
  } else if (type === "error") {
    iconClass = "fa-exclamation-circle";
  } else {
    iconClass = "fa-info-circle"; // Default fallback
  }

  // Set the toast content
  toast.innerHTML = `
        <div class="toast-icon">
            <i class="fas ${iconClass}"></i>
        </div>
        <div class="toast-content">
            <div class="toast-title">${title}</div>
            <div class="toast-message">${message}</div>
        </div>
        <div class="toast-close">
            <i class="fas fa-times"></i>
        </div>
    `;

  // Append the toast to the container
  toastContainer.appendChild(toast);

  // Automatically remove the toast after 3.5 seconds
  setTimeout(() => {
    toast.remove();
  }, 3500);
}

// Add event listener to close toasts manually
document.addEventListener("click", (e) => {
  if (e.target.closest(".toast-close")) {
    e.target.closest(".toast").remove();
  }
});
