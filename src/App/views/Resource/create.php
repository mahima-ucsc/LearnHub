<?php include $this->resolve("partials/_header.php"); ?>

<style>
    :root {
        --primary: #FFC400;
        --primary-dark: #e6b000;
        --primary-light: #fff0c2;
        --accent: #FF7849;
        --dark: #1A1A2E;
        --dark-2: #16213E;
        --gray-light: #f8f9fa;
        --gray: #e9ecef;
        --gray-dark: #6c757d;
        --white: #ffffff;
        --shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        --shadow-hover: 0 15px 35px rgba(0, 0, 0, 0.1);
        --radius: 12px;
        --radius-sm: 8px;
        --transition: all 0.3s ease;
        --success: #28a745;
        --success-light: #e6f7e9;
        --danger: #dc3545;
        --danger-light: #f8d7da;
    }

    .container {
        max-width: 1280px;
        width: 100%;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* Hero Section */
    .share-hero {
        background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary) 100%);
        padding: 60px 0;
        position: relative;
        overflow: hidden;
    }

    .share-hero::before {
        content: '';
        position: absolute;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        top: -100px;
        right: -100px;
    }

    .share-hero::after {
        content: '';
        position: absolute;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        bottom: -50px;
        left: -50px;
    }

    .share-hero-content {
        position: relative;
        z-index: 1;
        text-align: center;
        max-width: 800px;
        margin: 0 auto;
    }

    .share-hero h1 {
        font-size: 2.5rem;
        margin-bottom: 20px;
        color: var(--dark);
        font-weight: 700;
        line-height: 1.2;
    }

    .share-hero p {
        font-size: 1.1rem;
        margin-bottom: 15px;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    /* Form Sections */
    .form-container {
        max-width: 900px;
        margin: -40px auto 60px;
        background: var(--white);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        position: relative;
        z-index: 2;
    }

    .form-content {
        padding: 30px;
    }

    .form-section {
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid var(--gray);
    }

    .form-section:last-child {
        border-bottom: none;
    }

    .form-section h3 {
        font-size: 1.3rem;
        margin-bottom: 20px;
        color: var(--dark);
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .form-section h3 i {
        color: var(--primary);
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: var(--dark);
    }

    .form-control {
        width: 100%;
        padding: 12px 15px;
        background-color: var(--white);
        border: 1px solid var(--gray);
        border-radius: var(--radius-sm);
        outline: none;
        transition: var(--transition);
        font-size: 15px;
    }

    .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(255, 196, 0, 0.2);
    }

    textarea.form-control {
        min-height: 120px;
        resize: vertical;
    }

    .form-row {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
    }

    .form-col {
        flex: 1;
    }

    /* Tags Input */
    .tags-input-container {
        border: 1px solid var(--gray);
        border-radius: var(--radius-sm);
        padding: 8px 12px;
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        min-height: 48px;
        transition: var(--transition);
    }

    .tags-input-container:focus-within {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(255, 196, 0, 0.2);
    }

    .tag {
        background-color: var(--primary-light);
        color: var(--primary-dark);
        padding: 4px 8px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 14px;
    }

    .tag-close {
        cursor: pointer;
        font-size: 12px;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background-color: rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .tags-input {
        flex: 1;
        min-width: 100px;
        padding: 8px 0;
        border: none;
        outline: none;
        font-size: 14px;
    }

    /* File Upload */
    .file-upload-container {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .file-upload {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 30px;
        border: 2px dashed var(--gray);
        border-radius: var(--radius-sm);
        transition: var(--transition);
        cursor: pointer;
        background-color: var(--gray-light);
    }

    .file-upload:hover {
        background-color: var(--primary-light);
        border-color: var(--primary);
    }

    .file-upload i {
        font-size: 2.5rem;
        margin-bottom: 15px;
        color: var(--primary);
    }

    .file-upload-text {
        font-size: 15px;
        margin-bottom: 5px;
        font-weight: 500;
    }

    .file-upload-subtext {
        font-size: 12px;
        color: var(--gray-dark);
    }

    .file-upload input {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }

    .or-divider {
        display: flex;
        align-items: center;
        text-align: center;
        color: var(--gray-dark);
        font-size: 14px;
    }

    .or-divider::before,
    .or-divider::after {
        content: '';
        flex: 1;
        border-bottom: 1px solid var(--gray);
    }

    .or-divider::before {
        margin-right: 15px;
    }

    .or-divider::after {
        margin-left: 15px;
    }

    /* Toggle Switch */
    .toggle-container {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .toggle-label {
        font-weight: 500;
    }

    .switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 24px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: var(--gray);
        transition: .4s;
        border-radius: 24px;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 18px;
        width: 18px;
        left: 3px;
        bottom: 3px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }

    input:checked+.slider {
        background-color: var(--primary);
    }

    input:checked+.slider:before {
        transform: translateX(26px);
    }

    .price-field {
        display: none;
    }

    .price-field.active {
        display: block;
    }

    /* Form validation */
    .invalid-feedback {
        display: none;
        color: var(--danger);
        font-size: 13px;
        margin-top: 5px;
    }

    .form-control.is-invalid {
        border-color: var(--danger);
    }

    .form-control.is-invalid+.invalid-feedback {
        display: block;
    }

    /* Form actions */
    .form-actions {
        display: flex;
        justify-content: space-between;
        margin-top: 40px;
        /* border-top: 1px solid var(--gray); */
        padding-top: 30px;
    }

    .btn {
        padding: 12px 24px;
        border-radius: var(--radius-sm);
        font-weight: 500;
        cursor: pointer;
        transition: var(--transition);
        border: none;
        font-size: 15px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        text-decoration: none;
    }

    .btn-primary {
        background-color: var(--primary);
        color: var(--dark);
        box-shadow: 0 5px 15px rgba(255, 196, 0, 0.3);
    }

    .btn-primary:hover {
        background-color: var(--primary-dark);
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(255, 196, 0, 0.4);
    }

    .btn-outline {
        background-color: transparent;
        border: 2px solid var(--gray);
        color: var(--dark);
    }

    .btn-outline:hover {
        border-color: var(--primary);
        color: var(--primary);
        transform: translateY(-3px);
    }

    /* Responsive styles */
    @media (max-width: 768px) {
        .share-hero h1 {
            font-size: 2rem;
        }

        .form-row {
            flex-direction: column;
            gap: 10px;
        }

        .form-content {
            padding: 20px;
        }

        .form-actions {
            flex-direction: column-reverse;
            gap: 15px;
        }

        .btn {
            width: 100%;
        }
    }
</style>
</head>

<body>
    <!-- Hero Section -->
    <section class="share-hero">
        <div class="container">
            <div class="share-hero-content">
                <h1>Share Your Knowledge</h1>
                <p>Contribute to our community by sharing valuable learning resources. Your contribution can help others succeed in their learning journey.</p>
            </div>
        </div>
    </section>

    <!-- Form Container -->
    <div class="container">
        <div class="form-container">
            <form id="resource-form" class="resource-form" method="post" enctype="multipart/form-data" action>
                <div class="form-content">
                    <!-- Basic Information Section -->
                    <div class="form-section">
                        <h3><i class="fas fa-info-circle"></i> Basic Information</h3>

                        <div class="form-group">
                            <label for="resource-title">Resource Title *</label>
                            <input type="text" id="resource-title" name="title" class="form-control" placeholder="Enter a descriptive title" required>
                            <div class="invalid-feedback">Please provide a title for your resource</div>
                        </div>

                        <div class="form-group">
                            <label for="resource-description">Description *</label>
                            <textarea id="resource-description" name="description" class="form-control" placeholder="Describe what users will learn from this resource" required></textarea>
                            <div class="invalid-feedback">Please provide a description</div>
                        </div>

                        <div class="form-row">
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="resource-type">Resource Type *</label>
                                    <select id="resource-type" name="type" class="form-control" required>
                                        <option value="">Select type</option>
                                        <option value="PDF">PDF</option>
                                        <option value="Video">Video</option>
                                        <option value="Code">Code Snippets</option>
                                        <option value="Template">Template</option>
                                        <option value="Ebook">Ebook</option>
                                        <option value="Tool">Tool</option>
                                    </select>
                                    <div class="invalid-feedback">Please select a resource type</div>
                                </div>
                            </div>

                            <div class="form-col">
                                <div class="form-group">
                                    <label for="resource-category">Category *</label>
                                    <select id="resource-category" name="category" class="form-control" required>
                                        <option value="">Select category</option>
                                        <option value="Programming">Programming</option>
                                        <option value="Design">Design</option>
                                        <option value="Marketing">Marketing</option>
                                        <option value="Data Science">Data Science</option>
                                        <option value="Business">Business</option>
                                        <option value="Academic">Academic</option>
                                    </select>
                                    <div class="invalid-feedback">Please select a category</div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tags-input">Tags (Press Enter after each tag)</label>
                            <div class="tags-input-container">
                                <input type="text" id="tags-input" class="tags-input" placeholder="Add relevant tags...">
                            </div>
                            <input type="hidden" id="tags-hidden" name="tags">
                        </div>
                    </div>

                    <!-- Pricing Section -->
                    <div class="form-section">
                        <h3><i class="fas fa-tag"></i> Pricing</h3>

                        <div class="toggle-container">
                            <span class="toggle-label">This is a free resource</span>
                            <label class="switch">
                                <input type="checkbox" id="free-toggle" name="is_free" checked>
                                <span class="slider"></span>
                            </label>
                        </div>

                        <div class="form-group price-field">
                            <label for="resource-price">Price (Rs.) *</label>
                            <input type="number" id="resource-price" name="price" class="form-control" placeholder="Enter price" min="0.99" step="0.01">
                            <div class="invalid-feedback">Please enter a valid price (minimum $0.99)</div>
                        </div>
                    </div>

                    <!-- Upload Resource Section -->
                    <div class="form-section">
                        <h3><i class="fas fa-file-upload"></i> Upload Resource</h3>

                        <div class="file-upload-container">
                            <div class="file-upload">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <div class="file-upload-text">Drag & drop your file or click to browse</div>
                                <div class="file-upload-subtext">Max file size: 50MB</div>
                                <input type="file" id="resource-file" name="resource_file">
                            </div>

                            <div class="or-divider">OR</div>

                            <div class="form-group">
                                <label for="resource-url">External Resource URL</label>
                                <input type="url" id="resource-url" name="resource_url" class="form-control" placeholder="https://">
                                <div class="invalid-feedback">Please enter a valid URL or upload a file</div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions">
                        <button type="button" class="btn btn-outline" id="reset-form">
                            <i class="fas fa-undo"></i> Reset Form
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-upload"></i> Submit Resource
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tags Input
            const tagsContainer = document.querySelector('.tags-input-container');
            const tagsInput = document.getElementById('tags-input');
            const tagsHidden = document.getElementById('tags-hidden');
            const tags = [];

            tagsInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ',') {
                    e.preventDefault();

                    const tagValue = this.value.trim();
                    if (tagValue && !tags.includes(tagValue)) {
                        addTag(tagValue);
                        this.value = '';
                        updateHiddenTagsField();
                    }
                } else if (e.key === 'Backspace' && !this.value && tags.length > 0) {
                    removeTag(tags.length - 1);
                    updateHiddenTagsField();
                }
            });

            function addTag(text) {
                const tag = document.createElement('div');
                tag.classList.add('tag');
                tag.innerHTML = `
                    <span>${text}</span>
                    <span class="tag-close">&times;</span>
                `;

                tag.querySelector('.tag-close').addEventListener('click', function() {
                    const index = tags.indexOf(text);
                    if (index !== -1) {
                        removeTag(index);
                        updateHiddenTagsField();
                    }
                });

                tagsContainer.insertBefore(tag, tagsInput);
                tags.push(text);
            }

            function removeTag(index) {
                const tagElements = tagsContainer.querySelectorAll('.tag');
                tagsContainer.removeChild(tagElements[index]);
                tags.splice(index, 1);
            }

            function updateHiddenTagsField() {
                tagsHidden.value = JSON.stringify(tags);
            }

            // Toggle Free/Paid Resource
            const freeToggle = document.getElementById('free-toggle');
            const priceField = document.querySelector('.price-field');

            freeToggle.addEventListener('change', function() {
                if (this.checked) {
                    priceField.classList.remove('active');
                } else {
                    priceField.classList.add('active');
                }
            });

            // File Upload Preview
            const fileInput = document.getElementById('resource-file');
            let selectedFileName = '';

            fileInput.addEventListener('change', function() {
                if (this.files.length > 0) {
                    selectedFileName = this.files[0].name;
                    const fileSize = (this.files[0].size / (1024 * 1024)).toFixed(2);

                    const uploadText = document.querySelector('.file-upload-text');
                    const uploadSubtext = document.querySelector('.file-upload-subtext');

                    uploadText.textContent = selectedFileName;
                    uploadSubtext.textContent = `File size: ${fileSize} MB`;

                    document.querySelector('.file-upload').style.borderColor = 'var(--primary)';
                }
            });

            // Drag and Drop for file upload
            const fileUpload = document.querySelector('.file-upload');

            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                fileUpload.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ['dragenter', 'dragover'].forEach(eventName => {
                fileUpload.addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                fileUpload.addEventListener(eventName, unhighlight, false);
            });

            function highlight() {
                fileUpload.style.backgroundColor = 'var(--primary-light)';
                fileUpload.style.borderColor = 'var(--primary)';
            }

            function unhighlight() {
                fileUpload.style.backgroundColor = 'var(--gray-light)';
                fileUpload.style.borderColor = 'var(--gray)';
            }

            fileUpload.addEventListener('drop', handleDrop, false);

            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                fileInput.files = files;

                // Trigger change event
                const event = new Event('change');
                fileInput.dispatchEvent(event);
            }

            // Form validation and submission
            document.getElementById('resource-form').addEventListener('submit', function(e) {
                e.preventDefault();

                // Validate form fields
                let isValid = true;

                const title = document.getElementById('resource-title');
                const description = document.getElementById('resource-description');
                const type = document.getElementById('resource-type');
                const category = document.getElementById('resource-category');

                if (!title.value.trim()) {
                    title.classList.add('is-invalid');
                    isValid = false;
                } else {
                    title.classList.remove('is-invalid');
                }

                if (!description.value.trim()) {
                    description.classList.add('is-invalid');
                    isValid = false;
                } else {
                    description.classList.remove('is-invalid');
                }

                if (!type.value) {
                    type.classList.add('is-invalid');
                    isValid = false;
                } else {
                    type.classList.remove('is-invalid');
                }

                if (!category.value) {
                    category.classList.add('is-invalid');
                    isValid = false;
                } else {
                    category.classList.remove('is-invalid');
                }

                // Check if pricing is valid when not free
                if (!document.getElementById('free-toggle').checked) {
                    const price = document.getElementById('resource-price');
                    if (!price.value || parseFloat(price.value) < 0.99) {
                        price.classList.add('is-invalid');
                        isValid = false;
                    } else {
                        price.classList.remove('is-invalid');
                    }
                }

                // Check if at least one resource option is provided
                const fileInput = document.getElementById('resource-file');
                const urlInput = document.getElementById('resource-url');

                if ((!fileInput.files || fileInput.files.length === 0) && !urlInput.value.trim()) {
                    urlInput.classList.add('is-invalid');
                    isValid = false;
                } else {
                    urlInput.classList.remove('is-invalid');
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

            // Reset form button
            document.getElementById('reset-form').addEventListener('click', function() {
                document.getElementById('resource-form').reset();
                resetFormState();
            });

            function resetFormState() {
                // Clear tags
                document.querySelector('.tags-input-container').innerHTML = '<input type="text" id="tags-input" class="tags-input" placeholder="Add relevant tags...">';
                document.getElementById('tags-input').addEventListener('keydown', tagsInput.onkeydown);

                // Reset file upload display
                const uploadText = document.querySelector('.file-upload-text');
                const uploadSubtext = document.querySelector('.file-upload-subtext');
                uploadText.textContent = 'Drag & drop your file or click to browse';
                uploadSubtext.textContent = 'Max file size: 50MB';
                document.querySelector('.file-upload').style.borderColor = 'var(--gray)';

                // Clear any validation errors
                document.querySelectorAll('.form-control').forEach(element => {
                    element.classList.remove('is-invalid');
                });
            }
        });
    </script>
    <?php include $this->resolve("partials/_footer.php"); ?>