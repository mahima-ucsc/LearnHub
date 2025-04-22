<?php include $this->resolve("partials/_header.php"); ?>

<head>
    <link rel="stylesheet" href="/assets/styles/Resource/edit.css">

</head>

<body>
    <!-- Hero Section -->
    <section class="share-hero">
        <div class="container">
            <div class="share-hero-content">
                <h1>Edit Your Resource</h1>
                <p>Update the details of your resource to ensure it remains relevant and helpful to the community.</p>
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
                        <h3><i class="fas fa-info-circle"></i>Basic Information</h3>

                        <div class="form-group">
                            <label for="resource-title">Resource Title *</label>
                            <input type="text" id="resource-title" name="title" class="form-control" placeholder="Enter a descriptive title" value="<?php echo htmlspecialchars($resource['title']); ?>" required>
                            <div class="invalid-feedback">Please provide a title for your resource</div>
                        </div>

                        <div class="form-group">
                            <label for="resource-description">Description *</label>
                            <textarea id="resource-description" name="description" class="form-control" placeholder="Describe what users will learn from this resource" required><?php echo htmlspecialchars($resource['description']); ?></textarea>
                            <div class="invalid-feedback">Please provide a description</div>
                        </div>

                        <div class="form-row">
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="resource-type">Resource Type *</label>
                                    <select id="resource-type" name="type" class="form-control" value="<?php echo htmlspecialchars($resource['resource_type']); ?>" required>
                                        <option value="">Select type</option>
                                        <option value="PDF" <?php echo $resource['resource_type'] === 'PDF' ? 'selected' : ''; ?>>PDF</option>
                                        <option value="Video" <?php echo $resource['resource_type'] === 'Video' ? 'selected' : ''; ?>>Video</option>
                                        <option value="Code" <?php echo $resource['resource_type'] === 'Code' ? 'selected' : ''; ?>>Code Snippets</option>
                                        <option value="Template" <?php echo $resource['resource_type'] === 'Template' ? 'selected' : ''; ?>>Template</option>
                                        <option value="Ebook" <?php echo $resource['resource_type'] === 'Ebook' ? 'selected' : ''; ?>>Ebook</option>
                                        <option value="Tool" <?php echo $resource['resource_type'] === 'Tool' ? 'selected' : ''; ?>>Tool</option>
                                    </select>
                                    <div class="invalid-feedback">Please select a resource type</div>
                                </div>
                            </div>

                            <div class="form-col">
                                <div class="form-group">
                                    <label for="resource-category">Category *</label>
                                    <select id="resource-category" name="category" class="form-control" required>
                                        <option value="">Select category</option>
                                        <option value="Programming" <?php echo $resource['category'] === 'Programming' ? 'selected' : ''; ?>>Programming</option>
                                        <option value="Design" <?php echo $resource['category'] === 'Design' ? 'selected' : ''; ?>>Design</option>
                                        <option value="Marketing" <?php echo $resource['category'] === 'Marketing' ? 'selected' : ''; ?>>Marketing</option>
                                        <option value="Data Science" <?php echo $resource['category'] === 'Data Science' ? 'selected' : ''; ?>>Data Science</option>
                                        <option value="Business" <?php echo $resource['category'] === 'Business' ? 'selected' : ''; ?>>Business</option>
                                        <option value="Academic" <?php echo $resource['category'] === 'Academic' ? 'selected' : ''; ?>>Academic</option>
                                    </select>
                                    <div class="invalid-feedback">Please select a category</div>
                                </div>
                            </div>
                        </div>


                    </div>

                    <!-- Pricing Section -->
                    <div class="form-section">
                        <h3><i class="fas fa-tag"></i> Pricing</h3>

                        <div class="toggle-container">
                            <span class="toggle-label">This is a free resource</span>
                            <label class="switch">
                                <input type="checkbox" id="free-toggle" name="is_free" <?php echo $resource['is_free'] ? 'checked' : ''; ?>>
                                <span class="slider"></span>
                            </label>
                        </div>

                        <div class="form-group price-field" <?php echo $resource['is_free'] ? 'active' : ''; ?>">
                            <label for="resource-price">Price (Rs.) *</label>
                            <input type="number" id="resource-price" name="price" class="form-control" placeholder="Enter price" min="0.99" step="0.01" value="<?php echo htmlspecialchars($resource['price']); ?>">
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
                                <input type="url" id="resource-url" name="resource_url" class="form-control" placeholder="https://" value="<?php echo htmlspecialchars($resource['resource_url']); ?>">
                                <div class="invalid-feedback">Please enter a valid URL or upload a file</div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions">
                        <a href="/resource/my-resources" class="btn btn-outline">
                            <i class="fas fa-arrow-left"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save Changes
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {


            // Toggle Free/Paid Resource
            const freeToggle = document.getElementById('free-toggle');
            const priceField = document.querySelector('.price-field');
            const priceInput = document.getElementById('resource-price');

            // Set initial visibility of the price field
            if (freeToggle.checked) {
                priceField.classList.remove('active');
                priceInput.value = ''; // Clear the price if free is selected
            } else {
                priceField.classList.add('active');
            }

            // Toggle visibility when the checkbox is changed
            freeToggle.addEventListener('change', function() {
                if (this.checked) {
                    priceField.classList.remove('active');
                    priceInput.value = ''; // Clear the price when toggled to free
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