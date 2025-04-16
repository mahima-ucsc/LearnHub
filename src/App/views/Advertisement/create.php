<?php include $this->resolve("partials/_header.php"); ?>
<link rel="stylesheet" href="/assets/styles/Advertisement/create.css">

<div class="promotion-container">
    <div class="promotion-header">
        <h1 class="promotion-title">Course Promotion Submission</h1>
        <p class="promotion-subtitle">Submit your course promotion for admin approval. Promotions that meet our quality standards will be featured on the homepage.</p>
    </div>

    <div class="success-message" id="successMessage">
        Your promotion has been successfully submitted for review. You will be notified once it is approved.
    </div>

    <div class="promotion-form-container">
        <form id="promotionForm" method="POST" enctype="multipart/form-data">
            <!-- Course Selection Section -->
            <div class="form-section">
                <h3 class="section-title">Select Course for Promotion</h3>

                <div class="form-group">
                    <label for="existingCourse" class="form-label">Your Courses *</label>
                    <select id="existingCourse" name="courseId" class="form-control" required>
                        <option value="">Select a course</option>
                        <?php foreach ($courses as $course): ?>
                            <option value="<?php echo e($course['course_id']) ?>"><?php echo e($course['title']) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <p class="hint-text">Choose one of your existing courses that you want to promote.</p>
                    <div class="error-message" id="existingCourseError">Please select a course</div>
                </div>
                <div class="form-group">
                    <label for="promotionDescription" class="form-label">Promotion Description *</label>
                    <textarea id="promotionDescription" name="description" class="form-control textarea-control" placeholder="Highlight the main benefits and special offers (max 200 characters)" required maxlength="200"></textarea>
                    <div class="error-message" id="promotionDescriptionError">Please enter a promotion description</div>
                </div>
            </div>

            <!-- Package Selection Section -->
            <div class="form-section">
                <h3 class="section-title">Select Promotion Package</h3>

                <div class="form-group">
                    <label for="selectedPackage" class="form-label">Promotion Package *</label>
                    <select id="selectedPackage" name="package" class="form-control" required>
                        <option value="">Select a package</option>
                        <option value="basic">Basic - Rs. 400 (Homepage feature for 7 days)</option>
                        <option value="standard">Standard - Rs. 800 (Homepage feature for 14 days)</option>
                        <option value="gold">Gold - Rs. 1500 (Homepage feature for 30 days)</option>
                    </select>
                    <p class="hint-text">Choose the best promotion package to showcase your course to potential students.</p>
                    <div class="error-message" id="selectedPackageError">Please select a promotion package</div>
                </div>
            </div>

            <!-- Course Features Section -->
            <div class="form-section">
                <h3 class="section-title">Course Features</h3>
                <p class="hint-text">Add key features or benefits of your course to highlight in the promotion</p>

                <div id="featuresList" class="feature-list">
                    <div class="feature-item">
                        <input type="text" class="form-control feature-input" name="features[]" placeholder="e.g., '50+ hours of video content'">
                        <button type="button" class="remove-feature"><i class="fas fa-times"></i></button>
                    </div>
                </div>

                <button type="button" id="addFeature" class="add-feature">
                    <i class="fas fa-plus"></i> Add Another Feature
                </button>
            </div>

            <!-- Promotion Settings Section -->
            <div class="form-section">
                <h3 class="section-title">Promotion Settings</h3>

                <div class="form-group">
                    <label for="discountPercentage" class="form-label">Discount Percentage (Optional)</label>
                    <input type="number" id="discountPercentage" name="discount" class="form-control" min="0" max="100" placeholder="e.g., 20">
                    <p class="hint-text">Enter a percentage discount to offer during this promotion (0-100)</p>
                </div>
            </div>

            <!-- Thumbnail Upload Section -->
            <div class="form-section">
                <h3 class="section-title">Promotion Thumbnail</h3>

                <div class="form-group">
                    <label for="promotionThumbnail" class="form-label">Upload Thumbnail Image *</label>
                    <input type="file" id="promotionThumbnail" name="thumbnail" class="form-control" accept="image/png, image/jpeg, image/jpg" required>
                    <p class="hint-text">Upload a high-quality image (JPEG, PNG). Recommended size: 1280x720px. Maximum file size: 2MB.</p>
                    <div class="error-message" id="promotionThumbnailError">Please upload a valid image file</div>
                </div>

                <div id="thumbnailPreviewContainer" style="display: none; margin-top: 15px;">
                    <p class="hint-text">Preview:</p>
                    <img id="thumbnailPreview" src="#" alt="Thumbnail preview" style="max-width: 300px; border-radius: var(--radius-sm); box-shadow: var(--shadow);">
                </div>
            </div>

            <!-- Remark section -->
            <div class="form-section">
                <h3 class="section-title">Additional Information</h3>

                <div class="form-group">
                    <label for="remark" class="form-label">Remark (Optional)</label>
                    <input type="text" id="remark" name="remark" class="form-control" placeholder="Any additional notes for the admin">
                </div>
            </div>

            <!-- Terms and Submit Section -->
            <div class="form-group">
                <div class="toggle-container">
                    <label class="toggle-switch">
                        <input type="checkbox" id="termsAgreed" name="termsAgreed" required>
                        <span class="toggle-slider"></span>
                    </label>
                    <span class="toggle-label">I agree to the promotion guidelines and terms</span>
                </div>
                <div class="error-message" id="termsAgreedError">You must agree to the terms</div>
            </div>

            <div class="form-actions">
                <button type="button" class="btn btn-outline" id="cancelPromotion">Cancel</button>
                <button type="submit" class="btn btn-primary" id="submitPromotion"><i class="fas fa-paper-plane"></i> Submit Promotion</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Form elements
        const form = document.getElementById('promotionForm');
        const featuresList = document.getElementById('featuresList');
        const addFeatureBtn = document.getElementById('addFeature');
        const submitButton = document.getElementById('submitPromotion');
        const cancelButton = document.getElementById('cancelPromotion');
        const thumbnailInput = document.getElementById('promotionThumbnail');
        const thumbnailPreview = document.getElementById('thumbnailPreview');
        const thumbnailPreviewContainer = document.getElementById('thumbnailPreviewContainer');

        // Add feature functionality
        addFeatureBtn.addEventListener('click', addFeature);

        // Initialize remove feature buttons
        document.querySelectorAll('.remove-feature').forEach(btn => {
            btn.addEventListener('click', function() {
                removeFeature(this);
            });
        });

        // Handle form submission
        form.addEventListener('submit', handleFormSubmit);

        // Handle cancel button
        cancelButton.addEventListener('click', handleCancel);

        // Initialize form field validations on blur
        const allInputs = document.querySelectorAll('.form-control, input[type="checkbox"]');
        allInputs.forEach(input => {
            input.addEventListener('blur', function() {
                validateField(this.id);
            });
        });

        // Thumbnail preview
        thumbnailInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    thumbnailPreview.src = e.target.result;
                    thumbnailPreviewContainer.style.display = 'block';
                }

                reader.readAsDataURL(this.files[0]);
            }
        });

        // Function to add new feature
        function addFeature() {
            const featureItems = document.querySelectorAll('.feature-item');

            // Limit to max 10 features
            if (featureItems.length >= 10) {
                alert('Maximum 10 features allowed');
                return;
            }

            const newFeature = document.createElement('div');
            newFeature.className = 'feature-item';
            newFeature.style.opacity = '0';

            newFeature.innerHTML = `
                <input type="text" class="form-control feature-input" name="features[]" placeholder="Enter course feature">
                <button type="button" class="remove-feature"><i class="fas fa-times"></i></button>
            `;

            featuresList.appendChild(newFeature);

            // Animate the new feature
            setTimeout(() => {
                newFeature.style.opacity = '1';
            }, 10);

            // Add event listener to the new remove button
            const removeBtn = newFeature.querySelector('.remove-feature');
            removeBtn.addEventListener('click', function() {
                removeFeature(this);
            });
        }

        // Function to remove feature
        function removeFeature(button) {
            const featureItem = button.closest('.feature-item');

            // Animate removal
            featureItem.style.opacity = '0';

            setTimeout(() => {
                featureItem.remove();
            }, 300);
        }

        // Function to validate form
        function validateForm() {
            let isValid = true;

            // Validate required fields
            const requiredFields = form.querySelectorAll('[required]');
            requiredFields.forEach(field => {
                if (!validateField(field.id)) {
                    isValid = false;
                }
            });

            // Validate that at least one feature is entered
            const features = document.querySelectorAll('input[name="features[]"]');
            let hasFeature = false;

            features.forEach(feature => {
                if (feature.value.trim() !== '') {
                    hasFeature = true;
                }
            });

            if (!hasFeature) {
                alert('Please add at least one course feature');
                isValid = false;
            }

            return isValid;
        }

        // Function to validate individual field
        function validateField(fieldId) {
            const field = document.getElementById(fieldId);
            const errorElement = document.getElementById(`${fieldId}Error`);

            let isValid = true;

            if (field.required && !field.value) {
                isValid = false;
                if (errorElement) {
                    errorElement.style.display = 'block';
                }
                if (field.classList) {
                    field.classList.add('error');
                }
            } else if (field.type === 'checkbox' && field.required && !field.checked) {
                isValid = false;
                if (errorElement) {
                    errorElement.style.display = 'block';
                }
            } else {
                if (errorElement) {
                    errorElement.style.display = 'none';
                }
                if (field.classList) {
                    field.classList.remove('error');
                }
            }

            return isValid;
        }

        // Handle form submission
        function handleFormSubmit(e) {
            e.preventDefault();

            if (validateForm()) {
                // Show loading state
                submitButton.disabled = true;
                submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Submitting...';

                // Submit form
                form.submit();

                // Simulate success for demo purposes
                setTimeout(() => {
                    // Show success message
                    const successMessage = document.getElementById('successMessage');
                    successMessage.style.display = 'block';

                    // Reset button
                    submitButton.disabled = false;
                    submitButton.innerHTML = '<i class="fas fa-paper-plane"></i> Submit Promotion';

                    // Scroll to top to see message
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });

                    // Reset form after delay
                    setTimeout(() => {
                        form.reset();
                        thumbnailPreviewContainer.style.display = 'none';

                        // Remove all features except the first one
                        const features = document.querySelectorAll('.feature-item');
                        for (let i = 1; i < features.length; i++) {
                            features[i].remove();
                        }
                        // Clear the first feature
                        if (features[0]) {
                            features[0].querySelector('input').value = '';
                        }
                    }, 3000);
                }, 2000);
            }
        }

        // Handle cancel button
        function handleCancel() {
            if (confirm('Are you sure you want to cancel? All entered data will be lost.')) {
                window.location.href = 'index.php'; // Replace with your desired cancel URL
            }
        }
    });
</script>

<?php include $this->resolve("partials/_footer.php"); ?>