<?php include $this->resolve("partials/_header.php"); ?>

<style>
    .container {
        max-width: 1000px;
        margin: 0 auto;
        margin-top: 50px;
        background: white;
        padding: 1.5rem;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        color: #333;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 3px solid #ffc400;
        font-size: clamp(1.5rem, 4vw, 2rem);
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    label {
        display: block;
        margin-bottom: 0.5rem;
        color: #555;
        font-weight: 500;
    }

    input,
    textarea,
    select {
        width: 100%;
        padding: 0.8rem;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 1rem;
    }

    input:focus,
    textarea:focus,
    select:focus {
        outline: none;
        border-color: #ffc400;
        box-shadow: 0 0 0 2px rgba(255, 196, 0, 0.2);
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .col {
        flex: 1;
        min-width: 250px;
    }

    .tabs {
        display: flex;
        margin-bottom: 1.5rem;
        border-bottom: 2px solid #ddd;
    }

    .tab {
        padding: 1rem 2rem;
        cursor: pointer;
        border-bottom: 3px solid transparent;
        margin-bottom: -2px;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .tab.active {
        border-bottom-color: #ffc400;
        color: #333;
    }

    .tab:hover {
        background-color: #f5f5f5;
    }

    .tab-content {
        display: none;
    }

    .tab-content.active {
        display: block;
    }

    button {
        background-color: #ffc400;
        color: #000;
        border: none;
        padding: 1rem 2rem;
        border-radius: 5px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    button:hover {
        background-color: #ffb300;
        transform: translateY(-2px);
    }

    .button-group {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .secondary-button {
        background-color: #f5f5f5;
        border: 1px solid #ddd;
    }

    .points-input {
        max-width: 150px;
    }

    /* Styles for the drop zone and attachments preview */
    #attachments {
        border: 2px dashed #ddd;
        padding: 1.5rem;
        text-align: center;
        cursor: pointer;
        margin-bottom: 1rem;
        position: relative;
    }

    #attachments:hover {
        border-color: #ffc400;
    }

    #attachments p {
        margin: 0;
        font-size: 1rem;
        color: #666;
    }

    #attachmentsList {
        list-style: none;
        padding: 0;
    }

    #attachmentsList li {
        display: flex;
        align-items: center;
        margin: 0.5rem 0;
        background: #f9f9f9;
        padding: 0.5rem;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    #attachmentsList li img {
        max-width: 50px;
        max-height: 50px;
        margin-right: 10px;
    }

    .remove-file {
        margin-left: auto;
        background: transparent;
        border: none;
        color: #ff0000;
        font-size: 1.2rem;
        cursor: pointer;
    }

    @media (max-width: 768px) {
        .container {
            padding: 1rem;
        }

        .tab {
            padding: 0.8rem 1.2rem;
            font-size: 0.9rem;
        }

        button {
            padding: 0.8rem 1.5rem;
            width: 100%;
        }
    }

    @media (max-width: 480px) {
        body {
            padding: 0.5rem;
        }

        .container {
            padding: 0.8rem;
        }

        h1 {
            font-size: 1.5rem;
        }

        .tab {
            padding: 0.6rem 1rem;
            font-size: 0.85rem;
        }
    }
</style>

<div class="container">
    <h1>Create New Assignment</h1>

    <div class="tab-content active" id="edit">
        <form id="assignmentForm" method="post" enctype="multipart/form-data" action="create">
            <div class="form-group">
                <label for="title">Assignment Title</label>
                <input type="text" id="title" name="title" placeholder="Enter assignment title">
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group" style="width: 30%;">
                        <label for="dueDate">Due Date</label>
                        <input type="datetime-local" id="dueDate" name="deadline">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="description">Instructions</label>
                <textarea id="description" rows="6" name="instruction" placeholder="Enter detailed instructions for the assignment"></textarea>
            </div>

            <div class="form-group">
                <label for="attachments">Attachments</label>
                <div id="attachments" class="drop-zone">
                    <p>Drag files here or click to upload</p>
                    <!-- Hidden file input -->
                    <input type="file" id="fileInput" name="files[]" multiple style="display: none;">
                </div>
                <ul id="attachmentsList"></ul>
            </div>

            <div class="button-group">
                <button type="submit">Publish Assignment</button>
            </div>
        </form>
    </div>
</div>

<script>
    const dropZone = document.getElementById('attachments');
    const fileInput = document.getElementById('fileInput');
    const attachmentsList = document.getElementById('attachmentsList');

    // Use DataTransfer to maintain a mutable list of files
    let dataTransfer = new DataTransfer();

    // When user clicks on drop zone, trigger file input click
    dropZone.addEventListener('click', () => {
        fileInput.click();
    });

    // Handle drag & drop events for better UX
    dropZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropZone.style.borderColor = '#ffc400';
    });

    dropZone.addEventListener('dragleave', (e) => {
        e.preventDefault();
        dropZone.style.borderColor = '#ddd';
    });

    dropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropZone.style.borderColor = '#ddd';
        // Add the dropped files to our file input
        handleFiles(e.dataTransfer.files);
    });

    // When files are selected via the file input
    fileInput.addEventListener('change', (e) => {
        handleFiles(e.target.files);
    });

    // Add files to DataTransfer and update the preview
    function handleFiles(files) {
        for (let i = 0; i < files.length; i++) {
            dataTransfer.items.add(files[i]);
        }
        // Update the file input with our DataTransfer files
        fileInput.files = dataTransfer.files;
        renderPreview();
    }

    // Render the attachments preview
    function renderPreview() {
        // Clear the current list
        attachmentsList.innerHTML = '';

        // Create a preview for each
        Array.from(fileInput.files).forEach((file, index) => {
            const listItem = document.createElement('li');

            const fileName = document.createElement('span');
            fileName.textContent = file.name;
            listItem.appendChild(fileName);

            // Create a remove button for each file
            const removeBtn = document.createElement('button');
            removeBtn.innerHTML = '&times;';
            removeBtn.classList.add('remove-file');
            removeBtn.type = 'button';
            removeBtn.addEventListener('click', () => removeFile(index));
            listItem.appendChild(removeBtn);

            attachmentsList.appendChild(listItem);
        });
    }

    // Remove a file from the DataTransfer list
    function removeFile(index) {
        // Create a new DataTransfer object and add back every file except the one to remove
        const newDataTransfer = new DataTransfer();
        Array.from(fileInput.files).forEach((file, i) => {
            if (i !== index) {
                newDataTransfer.items.add(file);
            }
        });
        // Update our global DataTransfer and file input
        dataTransfer = newDataTransfer;
        fileInput.files = dataTransfer.files;
        renderPreview();
    }
</script>