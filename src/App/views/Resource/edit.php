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

    <script src="/assets/js/Resources/edit.js"></script>


    <?php include $this->resolve("partials/_footer.php"); ?>