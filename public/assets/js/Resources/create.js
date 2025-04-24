document.addEventListener("DOMContentLoaded", function () {
  // Toggle Free/Paid Resource
  const freeToggle = document.getElementById("free-toggle");
  const priceField = document.querySelector(".price-field");

  freeToggle.addEventListener("change", function () {
    if (this.checked) {
      priceField.classList.remove("active");
    } else {
      priceField.classList.add("active");
    }
  });

  // File Upload Preview
  const fileInput = document.getElementById("resource-file");
  let selectedFileName = "";

  fileInput.addEventListener("change", function () {
    if (this.files.length > 0) {
      selectedFileName = this.files[0].name;
      const fileSize = (this.files[0].size / (1024 * 1024)).toFixed(2);

      const uploadText = document.querySelector(".file-upload-text");
      const uploadSubtext = document.querySelector(".file-upload-subtext");

      uploadText.textContent = selectedFileName;
      uploadSubtext.textContent = `File size: ${fileSize} MB`;

      document.querySelector(".file-upload").style.borderColor =
        "var(--primary)";
    }
  });

  // Drag and Drop for file upload
  const fileUpload = document.querySelector(".file-upload");

  ["dragenter", "dragover", "dragleave", "drop"].forEach((eventName) => {
    fileUpload.addEventListener(eventName, preventDefaults, false);
  });

  function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
  }

  ["dragenter", "dragover"].forEach((eventName) => {
    fileUpload.addEventListener(eventName, highlight, false);
  });

  ["dragleave", "drop"].forEach((eventName) => {
    fileUpload.addEventListener(eventName, unhighlight, false);
  });

  function highlight() {
    fileUpload.style.backgroundColor = "var(--primary-light)";
    fileUpload.style.borderColor = "var(--primary)";
  }

  function unhighlight() {
    fileUpload.style.backgroundColor = "var(--gray-light)";
    fileUpload.style.borderColor = "var(--gray)";
  }

  fileUpload.addEventListener("drop", handleDrop, false);

  function handleDrop(e) {
    const dt = e.dataTransfer;
    const files = dt.files;
    fileInput.files = files;

    // Trigger change event
    const event = new Event("change");
    fileInput.dispatchEvent(event);
  }

  // // Form validation and submission
  // document
  //   .getElementById("resource-form")
  //   .addEventListener("submit", function (e) {
  //     e.preventDefault();

  //     // Validate form fields
  //     let isValid = true;

  //     const title = document.getElementById("resource-title");
  //     const description = document.getElementById("resource-description");
  //     const type = document.getElementById("resource-type");
  //     const category = document.getElementById("resource-category");

  //     if (!title.value.trim()) {
  //       title.classList.add("is-invalid");
  //       isValid = false;
  //     } else {
  //       title.classList.remove("is-invalid");
  //     }

  //     if (!description.value.trim()) {
  //       description.classList.add("is-invalid");
  //       isValid = false;
  //     } else {
  //       description.classList.remove("is-invalid");
  //     }

  //     if (!type.value) {
  //       type.classList.add("is-invalid");
  //       isValid = false;
  //     } else {
  //       type.classList.remove("is-invalid");
  //     }

  //     if (!category.value) {
  //       category.classList.add("is-invalid");
  //       isValid = false;
  //     } else {
  //       category.classList.remove("is-invalid");
  //     }

  //     // Check if pricing is valid when not free
  //     if (!document.getElementById("free-toggle").checked) {
  //       const price = document.getElementById("resource-price");
  //       if (!price.value || parseFloat(price.value) < 0.99) {
  //         price.classList.add("is-invalid");
  //         isValid = false;
  //       } else {
  //         price.classList.remove("is-invalid");
  //       }
  //     }

  // Form validation and submission
  document
    .getElementById("resource-form")
    .addEventListener("submit", function (e) {
      e.preventDefault();

      // Validate form fields
      let isValid = true;

      const title = document.getElementById("resource-title");
      const description = document.getElementById("resource-description");
      const type = document.getElementById("resource-type");
      const category = document.getElementById("resource-category");

      // Check if at least one resource option is provided
      const fileInput = document.getElementById("resource-file");
      const urlInput = document.getElementById("resource-url");

      if (
        (!fileInput.files || fileInput.files.length === 0) &&
        !urlInput.value.trim()
      ) {
        urlInput.classList.add("is-invalid");
        isValid = false;
      } else {
        urlInput.classList.remove("is-invalid");
      }

      if (isValid) {
        // Here you would typically submit the form data to your server
        this.submit();
        // alert('Resource submitted successfully! In a real implementation, this would be sent to the server.');

        // Reset form after submission
        this.reset();
        resetFormState();
      }
    });

  //     if (isValid) {
  //       // Here you would typically submit the form data to your server
  //       this.submit();
  //       // alert('Resource submitted successfully! In a real implementation, this would be sent to the server.');

  //       // Reset form after submission
  //       this.reset();
  //       resetFormState();
  //     }
  //   });
});
