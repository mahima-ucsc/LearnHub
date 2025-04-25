<?php include $this->resolve("partials/_header.php"); ?>

<link rel="stylesheet" href="/assets/styles/Course/create_course.css">
<style>
    .active {
        display: block;
    }
</style>
<div class="container">
    <div class="page-header">
        <h1 class="page-title">Create New Course</h1>
        <p class="page-subtitle">Share your knowledge with the world by creating an engaging course. Choose your course format and start building your content.</p>
    </div>

    <div id="successMessage" class="success-message <?= $_GET['m'] == 'success' ? 'active' : ''; ?>">
        Your course has been created successfully! You can now add course modules from course page.
    </div>

    <form id="createCourseForm" method="POST" enctype="multipart/form-data" action="/course/create">
        <!-- Basic Course Information Card -->
        <div class="card">
            <h2 class="section-title">Course Information</h2>

            <div class="form-group">
                <label for="courseTitle" class="form-label">Course Title*</label>
                <input type="text" name="courseTitle" id="courseTitle" class="form-control" placeholder="e.g., Advanced Web Development with React" value="<?= $oldFormData['courseTitle'] ?? ''; ?>">
                <?php if (array_key_exists('courseTitle', $errors)) : ?>
                    <div class="error-message" id="courseTitleError" style="display: block;">
                        Please enter a course title
                    </div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="courseDescription" class="form-label">Course Description*</label>
                <textarea name="courseDescription" id="courseDescription" class="form-control textarea-control" placeholder="Describe what students will learn in your course..."><?= $oldFormData['courseDescription'] ?? ''; ?></textarea>

                <?php if (array_key_exists('courseDescription', $errors)) : ?>
                    <div class="error-message" id="courseDescriptionError">Please enter a course description</div>
                <?php endif; ?>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="courseSubject" class="form-label">Subject*</label>
                    <select id="courseSubject" name="subject" class="form-control">
                        <option value="">Select Subject</option>
                        <?php foreach ($subjects as $subject): ?>
                            <option value="<?php echo e($subject['subject_id']); ?>" <?= $oldFormData['subject'] == e($subject['subject_id']) ? 'selected' : ''; ?>>
                                <?php echo e($subject['subject_title']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (array_key_exists('subject', $errors)) : ?>
                        <div class="error-message" id="courseSubjectError">Please select a subject</div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="courseGrade" class="form-label">Grade*</label>
                    <select id="courseGrade" name="grade" class="form-control">
                        <option value="">Select Grade</option>
                        <?php foreach ($grades as $grade): ?>
                            <option value="<?php echo e($grade['grade_id']); ?>" <?= $oldFormData['grade'] == e($grade['grade_id']) ? 'selected' : ''; ?>>
                                Grade <?php echo e($grade['grade_name']); ?>
                            </option>
                        <?php endforeach; ?>
                        <option value="-1">Other</option>
                    </select>
                    <?php if (array_key_exists('grade', $errors)) : ?>
                        <div class="error-message" id="courseGradeError">Please select a grade</div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="courseStartTime" class="form-label">Start Time*</label>
                    <input type="time" name="courseStartTime" id="courseStartTime" class="form-control" value="<?= $oldFormData['courseStartTime'] ?? ''; ?>">

                    <?php if (array_key_exists('courseStartTime', $errors)) : ?>
                        <div class="error-message">
                            <?php echo e($errors['courseStartTime'][0]); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="courseEndTime" class="form-label">End Time*</label>
                    <input type="time" name="courseEndTime" id="courseEndTime" class="form-control" value="<?= $oldFormData['courseEndTime'] ?? ''; ?>">

                    <?php if (array_key_exists('courseEndTime', $errors)) : ?>
                        <div class="error-message">
                            <?php echo e($errors['courseEndTime'][0]); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="courseDay" class="form-label">Day*</label>
                    <select id="courseDay" name="courseday" class="form-control">
                        <option value="">Select Day</option>
                        <option value="Sunday">Sunday</option>
                        <option value="Monday">Monday</option>
                        <option value="Tuesday">Tuesday</option>
                        <option value="Wednsday">Wednsday</option>
                        <option value="Thursday">Thursday</option>
                        <option value="Friday">Friday</option>
                        <option value="Saturday">Saturday</option>
                    </select>

                    <?php if (array_key_exists('courseday', $errors)) : ?>

                        <div class="error-message" id="courseDayError">
                            <?php echo e($errors['courseEndTime'][0]); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-group">
                <label for="location" class="form-label">Location*</label>
                <input type="text" name="location" id="location" class="form-control" value="<?= $oldFormData['location'] ?? ''; ?>">
                <?php if (array_key_exists('courseStartTime', $errors)) : ?>

                    <div class="error-message" id="locationError">Please enter a location</div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="courseThumbnail" class="form-label">Course Thumbnail Image*</label>
                <input type="file" id="courseThumbnail" name="courseThumbnail" class="form-control" accept="image/*">
                <p class="hint-text">Upload a high-quality image to attract students.</p>

                <?php if (array_key_exists('img', $errors)) : ?>

                    <div class="error-message" id="courseThumbnailError">
                        <?php echo e($errors['img'][0]); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Course Type Card -->
        <div class="card">
            <h2 class="section-title">Course Type & Pricing</h2>

            <div class="course-type-selector">
                <div class="course-type-option <?= $oldFormData['courseType'] == 'onetime' ? 'selected' : '' ?>" id="fullCourseOption">
                    <i class="fas fa-box"></i>
                    <h3>Complete Course</h3>
                    <p>Set a price for the entire course.</p>
                </div>

                <div class="course-type-option <?= $oldFormData['courseType'] == 'recurring' ? 'selected' : '' ?>" id="monthlyCourseOption">
                    <i class="fas fa-calendar-alt"></i>
                    <h3>Recurring Course</h3>
                    <p>Organize course content into time-based access periods, each with customizable pricing.</p>
                </div>
            </div>

            <input type="hidden" name="courseType" id="courseType" name="courseType" value="<?= $oldFormData['courseType'] ?? ''; ?>">
            <?php if (array_key_exists('courseType', $errors)) : ?>

                <div class="error-message">
                    <?php echo e($errors['courseType'][0]); ?>
                </div>
            <?php endif; ?>

            <!-- Full Course Pricing (shown when full course selected) -->
            <div id="fullCoursePricing" class="collapse-content">
                <div class="form-group">
                    <label for="fullCoursePrice" class="form-label">Course Price*</label>
                    <input type="number" id="fullCoursePrice" name="fullCoursePrice" class="form-control" placeholder="Enter price (in Rs.)" step="0.01" min="0"
                        value="<?= $oldFormData['fullCoursePrice'] ?? ''; ?>">
                    <?php if (array_key_exists('img', $errors)) : ?>

                        <div class="error-message">
                            <?php echo e($errors['fullCoursePrice'][0]); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>

        <!-- Form Actions -->
        <div class="form-actions">
            <button type="submit" class="btn btn-primary" id="createCourseBtn">
                <i class="fas fa-check"></i> Create Course
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Elements
        // const form = document.getElementById('createCourseForm');
        const fullCourseOption = document.getElementById('fullCourseOption');
        const monthlyCourseOption = document.getElementById('monthlyCourseOption');
        const courseTypeInput = document.getElementById('courseType');
        const fullCoursePricing = document.getElementById('fullCoursePricing');
        const fullCoursePrice = document.getElementById('fullCoursePrice');
        // const successMessage = document.getElementById('successMessage');
        // const createCourseBtn = document.getElementById('createCourseBtn');


        // Course Type Selection
        fullCourseOption.addEventListener('click', function() {
            selectCourseType('full');
        });

        monthlyCourseOption.addEventListener('click', function() {
            selectCourseType('monthly');
        });

        function selectCourseType(type) {
            fullCourseOption.classList.remove('selected');
            monthlyCourseOption.classList.remove('selected');
            fullCoursePrice.value = "";

            if (type === 'full') {
                fullCourseOption.classList.add('selected');
                fullCoursePricing.classList.add('show');
                courseTypeInput.value = 'onetime';

                // Hide pricing in modules for full course
                document.querySelectorAll('.monthly-module-pricing').forEach(el => {
                    el.style.display = 'none';
                });
            } else {
                monthlyCourseOption.classList.add('selected');
                fullCoursePricing.classList.remove('show');
                courseTypeInput.value = 'recurring';

                // Show pricing in modules for monthly course
                document.querySelectorAll('.monthly-module-pricing').forEach(el => {
                    el.style.display = 'block';
                });
            }

            document.getElementById('courseTypeError').style.display = 'none';

        }

        addEventListener("DOMContentLoaded", () => {
            setTimeout(() => {
                const successMessage = document.getElementById("successMessage");
                if (successMessage) {
                    successMessage.classList.remove('active');
                }
            }, 2000);
        })

        // Form validation
        // function validateForm() {
        //     let isValid = true;

        //     // Validate basic course info
        //     const Fields = ['courseTitle', 'courseDescription', 'courseSubject', 'courseGrade', 'courseThumbnail'];

        //     requiredFields.forEach(fieldId => {
        //         const field = document.getElementById(fieldId);
        //         const errorElement = document.getElementById(fieldId + 'Error');

        //         if (!field.value) {
        //             errorElement.style.display = 'block';
        //             field.classList.add('error');
        //             isValid = false;
        //         } else {
        //             errorElement.style.display = 'none';
        //             field.classList.remove('error');
        //         }
        //     });

        //     // Validate course type
        //     if (!courseTypeInput.value) {
        //         document.getElementById('courseTypeError').style.display = 'block';
        //         isValid = false;
        //     }

        //     // Validate pricing based on course type
        //     if (courseTypeInput.value === 'full') {
        //         const priceField = document.getElementById('fullCoursePrice');
        //         const priceError = document.getElementById('fullCoursePriceError');

        //         if (!priceField.value || parseFloat(priceField.value) < 0) {
        //             priceError.style.display = 'block';
        //             priceField.classList.add('error');
        //             isValid = false;
        //         } else {
        //             priceError.style.display = 'none';
        //             priceField.classList.remove('error');
        //         }

        //         // Validate free trial period if enabled
        //         if (hasFreeTrialPeriod.checked) {
        //             const startDateField = document.getElementById('freeTrialStartDate');
        //             const endDateField = document.getElementById('freeTrialEndDate');
        //             const startDateError = document.getElementById('freeTrialStartDateError');
        //             const endDateError = document.getElementById('freeTrialEndDateError');

        //             if (!startDateField.value) {
        //                 startDateError.style.display = 'block';
        //                 startDateField.classList.add('error');
        //                 isValid = false;
        //             } else {
        //                 startDateError.style.display = 'none';
        //                 startDateField.classList.remove('error');
        //             }

        //             if (!endDateField.value) {
        //                 endDateError.style.display = 'block';
        //                 endDateField.classList.add('error');
        //                 isValid = false;
        //             } else if (new Date(endDateField.value) <= new Date(startDateField.value)) {
        //                 endDateError.textContent = 'End date must be after start date';
        //                 endDateError.style.display = 'block';
        //                 endDateField.classList.add('error');
        //                 isValid = false;
        //             } else {
        //                 endDateError.style.display = 'none';
        //                 endDateField.classList.remove('error');
        //             }
        //         }
        //     }

        //     return isValid;
        // }

        // Form submission
        // form.addEventListener('submit', function(e) {
        //     e.preventDefault();

        //     if (validateForm()) {
        //         // Disable buttons and show loading state
        //         createCourseBtn.disabled = true;
        //         createCourseBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Creating...';

        //         // Use fetch API to submit the form
        //         fetch('/course/create', {
        //                 method: 'POST',
        //                 body: new FormData(form)
        //             })
        //             .then(response => {
        //                 if (!response.ok) {
        //                     throw new Error('Server returned error: ' + response.status);
        //                 }
        //                 return response.json();
        //             })
        //             .then(data => {
        //                 // Show success message
        //                 successMessage.style.display = 'block';
        //                 console.log(data);

        //                 // Scroll to top to see success message
        //                 window.scrollTo({
        //                     top: 0,
        //                     behavior: 'smooth'
        //                 });

        //                 // Reset form after showing the message
        //                 setTimeout(() => {
        //                     form.reset();
        //                     fullCourseOption.classList.remove('selected');
        //                     monthlyCourseOption.classList.remove('selected');
        //                     fullCoursePricing.classList.remove('show');
        //                     courseTypeInput.value = '';
        //                 }, 3000);
        //             })
        //             .catch(error => {
        //                 // Show error message
        //                 alert('Error submitting form: ' + error.message);
        //             })
        //             .finally(() => {
        //                 // Re-enable buttons
        //                 createCourseBtn.disabled = false;
        //                 createCourseBtn.innerHTML = '<i class="fas fa-check"></i> Create Course';
        //             });
        //     }
        // });

    });
</script>

<?php include $this->resolve("partials/_footer.php"); ?>