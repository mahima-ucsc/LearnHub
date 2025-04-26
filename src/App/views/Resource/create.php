<?php include $this->resolve("partials/_header.php"); ?>

<head>
    <link rel="stylesheet" href="/assets/styles/Resource/create.css">

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
            <form id="resource-form" class="resource-form" method="post" enctype="multipart/form-data" action="/resource/create">
                <div class="form-content">
                    <!-- Basic Information Section -->
                    <div class="form-section">
                        <h3><i class="fas fa-info-circle"></i> Basic Information</h3>

                        <div class="form-group">
                            <label for="resource-title">Resource Title *</label>
                            <input
                                type="text"
                                id="resource-title"
                                name="title"
                                class="form-control"
                                placeholder="Enter a descriptive title"
                                value="<?= isset($oldFormData['title']) ? e($oldFormData['title']) : '' ?>">

                            <?php if (array_key_exists('title', $errors)) : ?>
                                <div class='createResource-error'>
                                    <?php echo e($errors['title'][0]); ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="resource-description">Description *</label>
                            <textarea
                                id="resource-description"
                                name="description"
                                class="form-control"
                                placeholder="Describe what users will learn from this resource"><?= isset($oldFormData['description']) ? e($oldFormData['description']) : '' ?></textarea>
                            <?php if (array_key_exists('description', $errors)) : ?>
                                <div class='createResource-error'>
                                    <?php echo e($errors['description'][0]); ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-row">
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="resource-type">Resource Type *</label>
                                    <select
                                        id="resource-type"
                                        name="type"
                                        class="form-control">
                                        <option value="">Select type</option>
                                        <option value="PDF" <?= isset($oldFormData['type']) && $oldFormData['type'] === 'PDF' ? 'selected' : '' ?>>PDF</option>
                                        <option value="Video" <?= isset($oldFormData['type']) && $oldFormData['type'] === 'Video' ? 'selected' : '' ?>>Video</option>
                                        <option value="Code" <?= isset($oldFormData['type']) && $oldFormData['type'] === 'Code' ? 'selected' : '' ?>>Code Snippets</option>
                                        <option value="Template" <?= isset($oldFormData['type']) && $oldFormData['type'] === 'Template' ? 'selected' : '' ?>>Template</option>
                                        <option value="Ebook" <?= isset($oldFormData['type']) && $oldFormData['type'] === 'Ebook' ? 'selected' : '' ?>>Ebook</option>
                                        <option value="Tool" <?= isset($oldFormData['type']) && $oldFormData['type'] === 'Tool' ? 'selected' : '' ?>>Tool</option>
                                    </select>
                                    <?php if (array_key_exists('type', $errors)) : ?>
                                        <div class='createResource-error'>
                                            <?php echo e($errors['type'][0]); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-col">
                                <div class="form-group">
                                    <label for="resource-category">Category *</label>
                                    <select
                                        id="resource-category"
                                        name="category"
                                        class="form-control">
                                        <option value="">Select category</option>
                                        <option value="Programming" <?= isset($oldFormData['category']) && $oldFormData['category'] === 'Programming' ? 'selected' : '' ?>>Programming</option>
                                        <option value="Design" <?= isset($oldFormData['category']) && $oldFormData['category'] === 'Design' ? 'selected' : '' ?>>Design</option>
                                        <option value="Marketing" <?= isset($oldFormData['category']) && $oldFormData['category'] === 'Marketing' ? 'selected' : '' ?>>Marketing</option>
                                        <option value="Data Science" <?= isset($oldFormData['category']) && $oldFormData['category'] === 'Data Science' ? 'selected' : '' ?>>Data Science</option>
                                        <option value="Business" <?= isset($oldFormData['category']) && $oldFormData['category'] === 'Business' ? 'selected' : '' ?>>Business</option>
                                        <option value="Academic" <?= isset($oldFormData['category']) && $oldFormData['category'] === 'Academic' ? 'selected' : '' ?>>Academic</option>
                                    </select>
                                    <?php if (array_key_exists('category', $errors)) : ?>
                                        <div class='createResource-error'>
                                            <?php echo e($errors['category'][0]); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>


                    </div>

                    <!-- Pricing Section -->
                    <div class="form-section">
                        <h3><i class="fas fa-tag"></i> Pricing </h3>

                        <div class="toggle-container">
                            <span class="toggle-label">This is a free resource</span>
                            <label class="switch">
                                <input
                                    type="checkbox"
                                    id="free-toggle"
                                    name="is_free"
                                    <?= isset($oldFormData['is_free']) && $oldFormData['is_free'] == '1' ? 'checked' : '' ?>>

                                <span class="slider"></span>
                            </label>
                        </div>

                        <div class="form-group price-field <?= isset($oldFormData['is_free']) && $oldFormData['is_free'] == '1' ? '' : 'active' ?>">
                            <label for="resource-price">Price (Rs.) *</label>
                            <div class="paid-description">
                                <label>If this is a paid resource, please include your contact details (e.g., phone number, email) in the description so interested users can reach you.</label>
                            </div>
                            <input
                                type="number"
                                id="resource-price"
                                name="price"
                                class="form-control"
                                placeholder="Enter price"
                                min="0.99"
                                step="0.01"
                                value="<?= isset($oldFormData['price']) ? e($oldFormData['price']) : '' ?>">

                            <?php if (array_key_exists('price', $errors)) : ?>
                                <div class='createResource-error'>
                                    <?php echo e($errors['price'][0]); ?>
                                </div>
                            <?php endif; ?>

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
                                <div class="invalid-feedback">Please upload a resource file</div>
                            </div>



                            <!-- <div class="form-group">
                                <label for="resource-url">External Resource URL</label>
                                <input type="url"
                                    id="resource-url"
                                    name="resource_url"
                                    class="form-control"
                                    placeholder="https://"
                                    value="<?= isset($oldFormData['resource_url']) ? e($oldFormData['resource_url']) : '' ?>">
                                <div class="invalid-feedback">Please enter a valid URL or upload a file</div>
                                <?php if (array_key_exists('resource_url', $errors)) : ?>
                                    <div class='createResource-error'>
                                        <?php echo e($errors['resource_url'][0]); ?>
                                    </div>
                                <?php endif; ?>

                            </div> -->
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-upload"></i> Submit Resource
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="/assets/js/Resources/create.js"></script>
    <?php include $this->resolve("partials/_footer.php"); ?>