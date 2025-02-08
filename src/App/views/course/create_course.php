<?php include $this->resolve("partials/_header.php"); ?>

<head>
    <link rel="stylesheet" href="/assets/styles/Course/create-course.css">
</head>

<section class="create-course-container">
    <div class="create-course-header">
        <h1>Create New Course</h1>
        <p>Share your knowledge with the world</p>
    </div>

    <form class="create-course-form" id="createCourseForm" enctype="multipart/form-data" method="POST" action="/save-course-data">
        <div class="create-course-section">
            <h2>Basic Information</h2>
            <div class="create-course-form-group">
                <label for="courseTitle">Course Title *</label>
                <input type="text" id="title" name="title" value="<?= isset($oldFormData['title']) ? e($oldFormData['title']) : '' ?>" required>
            </div>
            <div class="create-course-form-group">
                <label for="description">Course Description *</label>
                <textarea id="description" name="description" required><?= isset($oldFormData['description']) ? e($oldFormData['description']) : '' ?></textarea>
            </div>
            <div class="create-course-form-group">
                <label for="price">Course Price (Rs.) *</label>
                <div style="display: flex;flex-direction: row; padding: 10px;">
                    <input type="number" id="price" name="price" min="0" step="0.01" value="<?= isset($oldFormData['price']) ? e($oldFormData['price']) : '' ?>" required>

                    <select id="pricing_period" name="pricing_period" style="margin-left:16px" required>
                        <option value="">Select Price period</option>
                        <option value="daily" <?= isset($oldFormData['pricing_period']) && $oldFormData['pricing_period'] == 'daily' ? 'selected' : '' ?>>Daily</option>
                        <option value="monthly" <?= isset($oldFormData['pricing_period']) && $oldFormData['pricing_period'] == 'monthly' ? 'selected' : '' ?>>Monthly</option>
                        <option value="yearly" <?= isset($oldFormData['pricing_period']) && $oldFormData['pricing_period'] == 'yearly' ? 'selected' : '' ?>>Yearly</option>
                        <option value="wholecourse" <?= isset($oldFormData['pricing_period']) && $oldFormData['pricing_period'] == 'wholecourse' ? 'selected' : '' ?>>For whole course</option>
                    </select>
                </div>
            </div>
            <div class="create-course-form-group">
                <label for="subject_id">Subject *</label>
                <select id="subject_id" name="subject_id" required>
                    <option value="">Select a subject</option>
                    <option value="1">Physics</option>
                    <option value="2">Combined Mathematics</option>
                    <option value="3">Chemistry</option>
                    <option value="4">ICT</option>
                    <option value="5">Science for Technology</option>
                    <option value="6">Bio Science Technology</option>
                    <option value="7">Mathematics</option>
                    <option value="8">Science</option>
                    <option value="9">Geography</option>
                    <option value="10">Econ</option>
                    <option value="11">Political Science</option>
                    <option value="12">Logics</option>
                </select>
            </div>
            <div class="create-course-form-group">
                <label for="day">Day (in weeks) *</label>
                <select id="day" name="day" required>
                    <option value="">Select a day</option>
                    <option value="sun" <?= isset($oldFormData['day']) && $oldFormData['day'] == 'sun' ? 'selected' : '' ?>>Sunday</option>
                    <option value="mon" <?= isset($oldFormData['day']) && $oldFormData['day'] == 'mon' ? 'selected' : '' ?>>Monday</option>
                    <option value="tue" <?= isset($oldFormData['day']) && $oldFormData['day'] == 'tue' ? 'selected' : '' ?>>Tuesday</option>
                    <option value="wed" <?= isset($oldFormData['day']) && $oldFormData['day'] == 'wed' ? 'selected' : '' ?>>Wednesday</option>
                    <option value="thu" <?= isset($oldFormData['day']) && $oldFormData['day'] == 'thu' ? 'selected' : '' ?>>Thursday</option>
                    <option value="fri" <?= isset($oldFormData['day']) && $oldFormData['day'] == 'fri' ? 'selected' : '' ?>>Friday</option>
                    <option value="sat" <?= isset($oldFormData['day']) && $oldFormData['day'] == 'sat' ? 'selected' : '' ?>>Saturday</option>
                </select>
            </div>
            <div class="create-course-form-group">
                <label>Course Time*</label> <br>
                <div style="display: flex; flex-direction: row; margin-left: 26px;">
                    <label for="start_time" style="margin-right: 26px;">Start Time*</label>
                    <input type="time" id="start_time" name="start_time" value='<?= isset($oldFormData['start_time']) ? e($oldFormData['start_time']) : '' ?>' required>

                    <label for="end_time" style="margin-right: 26px;margin-left: 16px;">End Time*</label>
                    <input type="time" id="end_time" name="end_time" value='<?= isset($oldFormData['end_time']) ? e($oldFormData['end_time']) : '' ?>' required>
                </div>
            </div>
            <div class="create-course-form-group">
                <label for="grade_id">Course Level *</label>
                <select id="grade_id" name="grade_id" required>
                    <option value="">Select a level</option>
                    <option value="1">Grade 1</option>
                    <option value="2">Grade 2</option>
                    <option value="3">Grade 3</option>
                    <option value="4">Grade 4</option>
                    <option value="5">Grade 5</option>
                    <option value="6">Grade 6</option>
                    <option value="7">Grade 7</option>
                    <option value="8">Grade 8</option>
                    <option value="9">Grade 9</option>
                    <option value="10">Grade 10</option>
                    <option value="11">Grade 11</option>
                    <option value="12">Grade 12</option>
                    <option value="13">Grade 13</option>
                </select>
            </div>
        </div>

        <div class="create-course-form-group">
            <label for="location">Location</label>
            <input type="text" name="location" id="location" value="<?= isset($oldFormData['location']) ? e($oldFormData['location']) : '' ?>">
        </div>
        <div class="create-course-form-group">
            <label for="thumbnail">Course Thumbnail</label>
            <input type="file" id="thumbnail" name="thumbnail" accept="image/*" onchange="previewThumbnail(this)">

            <img id="thumbnailPreview" style="max-width: 100%; max-height: 200px; display: none;" alt="Thumbnail preview">
            <?php if (isset($errors['img'])): ?>
                <div class="error">
                    <?= e($errors['img'][0]) ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="create-course-btn-container">
            <button type="submit" class="create-course-submit">Next</button>
        </div>
    </form>
</section>

<script>
    function previewThumbnail(input) {
        const preview = document.getElementById('thumbnailPreview');
        const uploadText = document.getElementById('uploadText');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
                uploadText.style.display = 'none';
            };

            reader.readAsDataURL(input.files[0]);
        } else {
            preview.style.display = 'none';
            uploadText.style.display = 'block';
            preview.src = '';
        }
    }
</script>