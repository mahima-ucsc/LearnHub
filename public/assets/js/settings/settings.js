document.addEventListener("DOMContentLoaded", function () {
  // Get all menu links
  const menuLinks = document.querySelectorAll(".settings-menu a");

  // Function to activate the saved section or default to "general"
  function activateSectionFromStorage() {
    const savedSectionId = localStorage.getItem("activeSection") || "general";
    menuLinks.forEach((link) => {
      link.classList.toggle(
        "active",
        link.getAttribute("href").substring(1) === savedSectionId
      );
    });
    document.querySelectorAll(".settings-section").forEach((section) => {
      section.classList.toggle("active", section.id === savedSectionId);
    });
  }

  // Initialize the page with the saved section
  activateSectionFromStorage();

  // Add click event listener to each link
  menuLinks.forEach((link) => {
    link.addEventListener("click", function (e) {
      e.preventDefault();

      // Save the active section ID to localStorage
      const sectionId = this.getAttribute("href").substring(1);
      localStorage.setItem("activeSection", sectionId);

      // Activate the selected section
      activateSectionFromStorage();
    });
  });

  // Profile Picture Preview
  const profilePictureInput = document.getElementById("profilePicture");
  const profileImagePreview = document.querySelector(
    ".profile-image-preview img"
  );

  profilePictureInput.addEventListener("change", function (event) {
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function (e) {
        profileImagePreview.src = e.target.result;
      };
      reader.readAsDataURL(file);
    }
  });

  // Cover Photo Preview
  const coverPhotoInput = document.getElementById("coverPhoto");
  const coverImagePreview = document.querySelector(".cover-image-preview img");

  coverPhotoInput.addEventListener("change", function (event) {
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function (e) {
        coverImagePreview.src = e.target.result;
      };
      reader.readAsDataURL(file);
    }
  });

  // Show toast on form submission
  if (window.serverErrors && Object.keys(window.serverErrors).length > 0) {
    Object.entries(window.serverErrors).forEach(([field, messages]) => {
      messages.forEach((msg) => {
        showToast("Error", msg, "error");
      });
    });
  }
});
