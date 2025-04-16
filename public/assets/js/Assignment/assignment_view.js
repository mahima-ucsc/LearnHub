document.addEventListener("DOMContentLoaded", function () {
  const dropZone = document.getElementById("dropZone");
  const fileInput = document.getElementById("fileInput");
  const selectedFiles = document.getElementById("selectedFiles");
  const fileList = document.getElementById("fileList");
  const submitButton = document.getElementById("submitButton");
  const removeButtons = document.querySelectorAll(
    '.btn-danger[id="remove-attachment"]'
  );

  // Use DataTransfer to maintain a mutable list of files
  let dataTransfer = new DataTransfer();

  // Handle file selection via button
  dropZone.addEventListener("click", function () {
    fileInput.click();
  });

  // Handle file selection
  fileInput.addEventListener("change", function () {
    if (this.files.length > 0) {
      handleFiles(this.files);
    }
  });

  // Handle drag and drop
  dropZone.addEventListener("dragover", function (e) {
    e.preventDefault();
    dropZone.classList.add("dragover");
  });

  dropZone.addEventListener("dragleave", function () {
    dropZone.classList.remove("dragover");
  });

  dropZone.addEventListener("drop", function (e) {
    e.preventDefault();
    dropZone.classList.remove("dragover");

    if (e.dataTransfer.files.length > 0) {
      handleFiles(e.dataTransfer.files);
    }
  });

  function handleFiles(files) {
    for (let i = 0; i < files.length; i++) {
      dataTransfer.items.add(files[i]);
    }
    // Update the file input with our DataTransfer files
    fileInput.files = dataTransfer.files;
    updateFileList();
  }

  // Update file list display
  function updateFileList() {
    // Clear current list
    fileList.innerHTML = "";

    // Show selected files container if we have files
    if (dataTransfer.files.length > 0) {
      selectedFiles.style.display = "block";

      // Create list items for each file
      Array.from(dataTransfer.files).forEach((file, index) => {
        const li = document.createElement("li");
        li.style.display = "flex";
        li.style.justifyContent = "space-between";
        li.style.alignItems = "center";
        li.style.padding = "0.75rem 1rem";
        li.style.marginBottom = "0.5rem";
        li.style.backgroundColor = "rgba(99, 102, 241, 0.05)";
        li.style.borderRadius = "8px";
        li.style.border = "1px solid var(--primary-light)";

        // File info
        const fileInfo = document.createElement("div");
        fileInfo.style.display = "flex";
        fileInfo.style.alignItems = "center";
        fileInfo.style.gap = "10px";

        // File icon
        const fileIcon = document.createElement("i");
        fileIcon.className = "fas fa-file";
        fileIcon.style.color = "var(--primary)";

        // File name and size
        const fileDetails = document.createElement("div");
        const fileName = document.createElement("div");
        fileName.textContent = file.name;
        fileName.style.fontWeight = "500";
        fileName.style.color = "var(--text-primary)";

        const fileSize = document.createElement("div");
        fileSize.style.fontSize = "0.75rem";
        fileSize.style.color = "var(--text-light)";

        fileDetails.appendChild(fileName);
        fileDetails.appendChild(fileSize);

        fileInfo.appendChild(fileIcon);
        fileInfo.appendChild(fileDetails);

        // Remove button
        const removeBtn = document.createElement("button");
        removeBtn.innerHTML = '<i class="fas fa-times"></i>';
        removeBtn.style.background = "none";
        removeBtn.style.border = "none";
        removeBtn.style.color = "var(--danger)";
        removeBtn.style.cursor = "pointer";
        removeBtn.style.fontSize = "1rem";
        removeBtn.style.padding = "5px";
        removeBtn.title = "Remove file";

        removeBtn.addEventListener("click", function () {
          removeFile(index);
        });

        li.appendChild(fileInfo);
        li.appendChild(removeBtn);
        fileList.appendChild(li);
      });
    } else {
      selectedFiles.style.display = "none";
    }
  }

  // Remove a file from the DataTransfer list
  function removeFile(index) {
    // Create a new DataTransfer object and add back every file except the one to remove
    const newDataTransfer = new DataTransfer();
    Array.from(dataTransfer.files).forEach((file, i) => {
      if (i !== index) {
        newDataTransfer.items.add(file);
      }
    });
    // Update our global DataTransfer and file input
    dataTransfer = newDataTransfer;
    fileInput.files = dataTransfer.files;
    updateFileList();
  }

  removeButtons.forEach((button) => {
    button.addEventListener("click", function (e) {
      // Prevent default navigation
      e.preventDefault();

      // Get the attachment ID and submission ID from the button's data or the URL
      const attachmentId = this.getAttribute("data-attachment-id");
      const submissionId = this.getAttribute("data-submission-id") || "";

      if (!submissionId || !attachmentId) {
        console.error("Missing submission ID or attachment ID");
        return;
      }

      // Confirm before removing
      if (confirm("Are you sure you want to remove this file?")) {
        // Create and send the POST request
        fetch(`/submission/${submissionId}/attachment/${attachmentId}/remove`, {
          method: "POST",
        })
          .then((response) => {
            if (!response.ok) {
              throw new Error("Network response was not ok");
            }
            return response.text();
          })
          .then((data) => {
            console.log(data);
            showToast(
              "File removed",
              "The file has been removed successfully.",
              "success"
            );

            // Reload page to reflect changes
            setTimeout(() => {
              window.location.reload();
            }, 1000);
          })
          .catch((error) => {
            console.error("Error removing file:", error);
            showToast(
              "Error removing file",
              "There was a problem removing file. Please try again.",
              "error"
            );
            alert("Error removing file. Please try again.");
            setTimeout(() => {
              window.location.reload();
            }, 1000);
          });
      }
    });
  });
});
