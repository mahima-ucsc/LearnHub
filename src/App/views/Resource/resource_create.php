<?php include $this->resolve("partials/_header.php"); ?>

<head>
    <link rel="stylesheet" href="/assets/styles/Resource/resource_create.css">
</head>

<section class="create-resource-container">
    <div class="create-resource-header">
        <h1>Add a New Resourse</h1>
        <p>Share your knowledge with the world</p>
    </div>

    <form class="create-resource-form" id="createresourceForm" enctype="multipart/form-data" method="POST" action="/save-resource-data">
        <div class="create-resource-section">
            <h2>Basic Information</h2>
            <div class="create-resource-form-group">
                <label for="resourceTitle">Resource Title *</label>
                <input type="text" id="title" name="title" value="<?php echo e($oldFormData['title'] ?? ''); ?>" required>
            </div>
            <div class="create-resource-form-group">
                <label for="description">Resource Description *</label>
                <textarea id="description" name="description" required><?php echo e($oldFormData['description'] ?? ''); ?></textarea>
            </div>

            <div class="create-resource-form-group">
                <label for="type">Resource Type *</label>
                <select id="type" name="type" required onchange="togglePriceField(this)">
                    <option value="">Select a type</option>
                    <option value="1">FREE</option>
                    <option value="2">PAID</option>
                </select>
            </div>

            <div class="create-resource-form-group" id="price-field" style="display: none;">
                <label for="price">Price (Rs.) *</label>
                <input type="number" id="price" name="price" min="0" step="0.01" placeholder="Enter price">
            </div>
        </div>

        <div class="create-resource-form-group">
            <label for="fileUpload">Attach Your Resource Here (PDF, DOC, etc.)</label>
            <input type="file" id="fileUpload" name="fileUpload" accept=".pdf, .doc, .docx, .txt, .ppt, .pptx" onchange="previewFile(this)">

            <div id="filePreview" style="display: none;">
                <p>File selected: <span id="fileName"></span></p>
            </div>
        </div>
        <div class="create-resource-btn-container">
            <button type="submit" class="create-resource-submit">ADD</button>
        </div>
    </form>
</section>


<script>
    function previewFile(input) {
        const fileName = input.files[0] ? input.files[0].name : '';
        document.getElementById('fileName').textContent = fileName;
        document.getElementById('filePreview').style.display = fileName ? 'block' : 'none';
    }

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