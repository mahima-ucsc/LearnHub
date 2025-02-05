<?php include $this->resolve("partials/_header.php"); ?>

<head>
    <link rel="stylesheet" href="/assets/styles/Resource/edit_resource.css">
</head>

<section class="create-resource-container">
    <div class="create-resource-header">
        <h1>Edit Resource</h1>
        <p>Update your resource details</p>
    </div>

    <form class="create-resource-form" method="POST" action="/resource/edit/<?php echo e($resource['resource_id']); ?>" enctype="multipart/form-data">
        <?php include $this->resolve("partials/_csrf.php"); ?>

        <div class="create-resource-section">
            <h2>Basic Information</h2>
            <div class="create-resource-form-group">
                <label for="title">Resource Title *</label>
                <input type="text" id="title" name="title" value="<?php echo e($resource['title']); ?>" required>
            </div>

            <div class="create-resource-form-group">
                <label for="description">Resource Description *</label>
                <textarea id="description" name="description" required><?php echo e($resource['description']); ?></textarea>
            </div>

            <div class="create-resource-form-group">
                <label for="type">Resource Type *</label>
                <select id="type" name="type" required onchange="togglePriceField(this)">
                    <option value="1" <?php echo $resource['type'] == '1' ? 'selected' : ''; ?>>FREE</option>
                    <option value="2" <?php echo $resource['type'] == '2' ? 'selected' : ''; ?>>PAID</option>
                </select>
            </div>

            <div class="create-resource-form-group" id="price-field" style="display: <?php echo $resource['type'] == '2' ? 'block' : 'none'; ?>">
                <label for="price">Price (Rs.) *</label>
                <input type="number" id="price" name="price" min="0" step="0.01" value="<?php echo e($resource['price']); ?>">
            </div>

            <div class="create-resource-form-group">
                <label for="fileUpload">Update Resource File (Optional)</label>
                <input type="file" id="fileUpload" name="fileUpload" accept=".pdf, .doc, .docx, .txt, .ppt, .pptx">
                <?php if ($resource['attachment_link']): ?>
                    <p class="current-file">Current file: <?php echo e($resource['attachment_link']); ?></p>
                <?php endif; ?>
            </div>
        </div>

        <div class="create-resource-btn-container">
            <button type="submit" class="create-resource-submit">Update Resource</button>
        </div>
    </form>
</section>

<script>
    function togglePriceField(selectElement) {
        const priceField = document.getElementById('price-field');
        if (selectElement.value === "2") {
            priceField.style.display = "block";
            document.getElementById('price').required = true;
        } else {
            priceField.style.display = "none";
            document.getElementById('price').required = false;
        }
    }
</script>

<?php include $this->resolve("partials/_footer.php"); ?>