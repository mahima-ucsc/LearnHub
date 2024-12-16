<?php include $this->resolve("partials/_header.php"); ?>

<head>
    <link rel="stylesheet" href="/assets/styles/Course/create-course.css">
</head>

<section class="create-course-container">
    <div class="create-course-header">
        <h1>Create New Course</h1>
        <p>Share your knowledge with the world</p>
    </div>

    <form class="create-course-form" id="createCourseForm" method="POST" action="/create-course">
        <div class="create-course-section">
            <h2>Basic Information</h2>
            <div class="create-course-form-group">
                <label for="courseTitle">Course Title *</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="create-course-form-group">
                <label for="description">Course Description *</label>
                <textarea id="description" name="description" required></textarea>
            </div>
            <div class="create-course-form-group">
                <label for="price">Course Price (Rs.) *</label>
                <div style="display: flex;flex-direction: row; padding: 10px;">
                    <input type="number" id="price" name="price" min="0" step="0.01" required>
                    <select id="pricing_period" name="pricing_period" style="margin-left:16px" required>
                        <option value="">Select Price period</option>
                        <option value="daily">Daily</option>
                        <option value="monthly">Monthly</option>
                        <option value="yearly">Yearly</option>
                        <option value="wholecourse">For whole course</option>
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
                    <option value="9">Geogrophy</option>
                    <option value="10">Econ</option>
                    <option value="11">Political Science</option>
                    <option value="12">Logics</option>
                </select>
            </div>
            <div class="create-course-form-group">
                <label for="day">Day (in weeks) *</label>
                <select id="day" name="day" required>
                    <option value="">Select a day</option>
                    <option value="sun">Sunday</option>
                    <option value="mon">Monday</option>
                    <option value="tue">Tuesday</option>
                    <option value="wed">Wednsday</option>
                    <option value="thu">Thursday</option>
                    <option value="fri">Friday</option>
                    <option value="sat">Sataday</option>
                </select>
            </div>
            <div class="create-course-form-group">
                <label>Course Time*</label> <br>
                <div style="display: flex; flex-direction: row; margin-left: 26px;">
                    <label for="start_time" style="margin-right: 26px;">Start Time*</label>
                    <input type="time" id="start_time" name="start_time" min="0" step="60" placeholder="08:00" required>

                    <label for="end_time" style="margin-right: 26px;margin-left: 16px;">End Time*</label>
                    <input type="time" id="end_time" name="end_time" min="0" placeholder="10:00" required>
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
            <input type="text" name="location" id="location">
        </div>

        <div class="create-course-section">
            <h2>Course Modules (Optional)</h2>
            <div id="moduleContainer"></div>
            <button type="button" class="create-course-add-button" id="addModuleBtn">Add Module</button>
        </div>
        <div class="create-course-form-group">
            <label for="thumbnail">Course Thumbnail</label>
            <div class="upload-area" onclick="document.getElementById('thumbnail').click()">
                <p>Click to upload image</p>
                <p>or drag and drop</p>
                <input type="file" id="thumbnail" name="thumbnail" accept="image/*" style="display: none">
            </div>
        </div>

        <button type="submit" class="create-course-submit">Create Course</button>
    </form>


    <script>
        let moduleCount = 0;

        function createModuleHTML(index) {
            return `
            <div class="create-course-module" id="module${index}">
                <div class="create-course-module-header">
                    <h3>Module ${index + 1}</h3>
                    <button type="button" class="create-course-remove-button" onclick="removeModule(${index})">Remove</button>
                </div>
                <div class="create-course-form-group">
                    <label for="moduleTitle${index}">Module Title</label>
                    <input type="text" id="moduleTitle${index}" name="moduleTitle${index}">
                </div>
                <div class="create-course-form-group">
                    <label for="moduleDescription${index}">Module Description</label>
                    <textarea id="moduleDescription${index}" name="moduleDescription${index}"></textarea>
                </div>
                <div class="create-course-form-group">
                    <label for="moduleResources${index}">Module Resources (comma-separated)</label>
                    <input type="text" id="moduleResources${index}" name="moduleResources${index}">
                </div>
            </div>
        `;
        }

        function addModule() {
            const moduleContainer = document.getElementById('moduleContainer');
            moduleContainer.insertAdjacentHTML('beforeend', createModuleHTML(moduleCount));
            moduleCount++;
        }

        function removeModule(index) {
            const module = document.getElementById(`module${index}`);
            module.remove();
        }

        document.getElementById('addModuleBtn').addEventListener('click', addModule);

        // document.getElementById('createCourseForm').addEventListener('submit', function(e) {
        //     e.preventDefault();
        //     alert('Course created successfully!');
        //     // Here you would typically handle the form submission and course creation process
        // });
    </script>

</section>