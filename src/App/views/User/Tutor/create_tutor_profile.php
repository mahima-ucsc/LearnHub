<head>
    <title>Create Tutor Profile</title>
    <style>
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .form-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-header h1 {
            margin: 0;
            color: #2d3748;
            font-size: 28px;
        }

        .form-header p {
            color: #718096;
            font-size: 16px;
        }

        .form-card {
            background: white;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }

        .form-section {
            margin-bottom: 30px;
        }

        .form-section h2 {
            margin-top: 0;
            color: #2d3748;
            font-size: 20px;
            border-bottom: 1px solid #edf2f7;
            padding-bottom: 10px;
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 15px;
        }

        .form-group {
            flex: 1;
            min-width: 250px;
            margin-right: 20px;
            margin-bottom: 15px;
        }

        .form-group:last-child {
            margin-right: 0;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: #4a5568;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            font-size: 16px;
            color: #2d3748;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        .checkbox-group {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
            background-color: #edf2f7;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
        }

        .checkbox-item input {
            width: auto;
            margin-right: 5px;
        }

        .hint-text {
            font-size: 14px;
            color: #718096;
            margin-top: 5px;
        }

        .availability-row {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            gap: 10px;
        }

        .availability-day {
            width: 100px;
        }

        .availability-time {
            flex: 1;
        }

        .btn-add {
            background-color: #e2e8f0;
            border: none;
            border-radius: 4px;
            padding: 8px 12px;
            cursor: pointer;
            color: #4a5568;
            font-size: 14px;
            margin-top: 5px;
        }

        .btn-remove {
            background-color: #fed7d7;
            border: none;
            border-radius: 4px;
            padding: 5px 10px;
            cursor: pointer;
            color: #e53e3e;
            font-size: 14px;
        }

        .btn-submit {
            background-color: #4299e1;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 12px 24px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
            display: block;
            margin: 30px auto 0;
            width: 200px;
        }

        .btn-submit:hover {
            background-color: #3182ce;
        }

        .education-entry,
        .subject-entry {
            background-color: #f7fafc;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            padding: 15px;
            margin-bottom: 15px;
        }

        .entry-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        @media (max-width: 768px) {
            .form-row {
                flex-direction: column;
            }

            .form-group {
                margin-right: 0;
            }
        }
    </style>
</head>

<body>
    <?php
    // dd($subjects); 
    ?>
    <div class="container">
        <div class="form-header">
            <h1>Create Your Tutor Profile</h1>
            <p>Complete the form below to set up your profile information for students</p>
        </div>

        <form id="tutorProfileForm" action="/api/tutor/profile" method="POST">
            <input type="hidden" id="tutorId" name="tutor_id" value="<?php echo $_SESSION['user'] ?>">

            <!-- Basic Information -->
            <div class="form-card">
                <div class="form-section">
                    <h2>Basic Information</h2>

                    <div class="form-group">
                        <label for="title">Professional Title</label>
                        <input type="text" id="title" name="title" placeholder="e.g. Mathematics & Computer Science Tutor">
                        <p class="hint-text">A short description of your specialty</p>
                    </div>

                    <div class="form-group">
                        <label for="bio">Bio</label>
                        <textarea id="bio" name="bio" rows="5" placeholder="Introduce yourself, your experience, and your teaching approach"></textarea>
                        <p class="hint-text">This will be displayed on your profile page</p>
                    </div>
                </div>
            </div>

            <!-- Subjects & Experience -->
            <div class="form-card">
                <div class="form-section">
                    <h2>Subjects & Experience</h2>

                    <div id="subjectEntries">
                        <div class="subject-entry">
                            <div class="entry-header">
                                <h3>Subject #1</h3>
                                <button type="button" class="btn-remove">Remove</button>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Subject</label>
                                    <select name="subjects[0][subject_id]">
                                        <option value="">Select a subject...</option>
                                        <?php
                                        foreach ($subjects as $subject) {
                                            echo "<option value='" . $subject['subject_id'] . "'>" . $subject['subject_title'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Years of Experience</label>
                                    <input type="number" name="subjects[0][years_experience]" min="0" max="50">
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="button" id="addSubject" class="btn-add">+ Add Another Subject</button>
                </div>
            </div>

            <!-- Education -->
            <div class="form-card">
                <div class="form-section">
                    <h2>Education</h2>

                    <div id="educationEntries">
                        <div class="education-entry">
                            <div class="entry-header">
                                <h3>Education #1</h3>
                                <button type="button" class="btn-remove">Remove</button>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Degree</label>
                                    <input type="text" name="education[0][degree]" placeholder="e.g. Ph.D., M.S., B.S.">
                                </div>
                                <div class="form-group">
                                    <label>Field of Study</label>
                                    <input type="text" name="education[0][field_of_study]" placeholder="e.g. Applied Mathematics">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Institution</label>
                                <input type="text" name="education[0][institution]" placeholder="e.g. Massachusetts Institute of Technology">
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Start Date</label>
                                    <input type="date" name="education[0][start_date]">
                                </div>
                                <div class="form-group">
                                    <label>End Date</label>
                                    <input type="date" name="education[0][end_date]">
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="button" id="addEducation" class="btn-add">+ Add Another Education</button>
                </div>
            </div>

            <!-- Availability -->
            <div class="form-card">
                <div class="form-section">
                    <h2>Availability</h2>

                    <div id="availabilityEntries">
                        <div class="availability-row">
                            <div class="availability-day">
                                <select name="availability[0][day_of_week]">
                                    <option value="0">Sunday</option>
                                    <option value="1">Monday</option>
                                    <option value="2">Tuesday</option>
                                    <option value="3">Wednesday</option>
                                    <option value="4">Thursday</option>
                                    <option value="5">Friday</option>
                                    <option value="6">Saturday</option>
                                </select>
                            </div>
                            <div class="availability-time">
                                <input type="time" name="availability[0][start_time]" value="15:00">
                            </div>
                            <div class="availability-time">
                                <input type="time" name="availability[0][end_time]" value="20:00">
                            </div>
                            <div>
                                <input type="checkbox" id="recurring0" name="availability[0][is_recurring]" checked>
                                <label for="recurring0">Recurring</label>
                            </div>
                            <button type="button" class="btn-remove">Remove</button>
                        </div>
                    </div>

                    <button type="button" id="addAvailability" class="btn-add">+ Add Another Time Slot</button>
                </div>
            </div>

            <button type="submit" class="btn-submit">Save Profile</button>
        </form>
    </div>

    <script>
        // Add subject entry
        document.getElementById('addSubject').addEventListener('click', function() {
            const entries = document.getElementById('subjectEntries');
            const count = entries.children.length;

            const newEntry = document.createElement('div');
            newEntry.className = 'subject-entry';
            newEntry.innerHTML = `
                <div class="entry-header">
                    <h3>Subject #${count + 1}</h3>
                    <button type="button" class="btn-remove">Remove</button>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Subject</label>
                        <select name="subjects[${count}][subject_id]">
                            <option value="">Select a subject...</option>
                            <option value="1">Mathematics</option>
                            <option value="2">Computer Science</option>
                            <option value="3">Physics</option>
                            <option value="4">Chemistry</option>
                            <option value="5">Biology</option>
                            <option value="6">English</option>
                            <option value="7">History</option>
                            <option value="8">Economics</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Years of Experience</label>
                        <input type="number" name="subjects[${count}][years_experience]" min="0" max="50">
                    </div>
                </div>
            `;

            entries.appendChild(newEntry);
            setupRemoveButtons();
        });

        // Add education entry
        document.getElementById('addEducation').addEventListener('click', function() {
            const entries = document.getElementById('educationEntries');
            const count = entries.children.length;

            const newEntry = document.createElement('div');
            newEntry.className = 'education-entry';
            newEntry.innerHTML = `
                <div class="entry-header">
                    <h3>Education #${count + 1}</h3>
                    <button type="button" class="btn-remove">Remove</button>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Degree</label>
                        <input type="text" name="education[${count}][degree]" placeholder="e.g. Ph.D., M.S., B.S.">
                    </div>
                    <div class="form-group">
                        <label>Field of Study</label>
                        <input type="text" name="education[${count}][field_of_study]" placeholder="e.g. Applied Mathematics">
                    </div>
                </div>
                <div class="form-group">
                    <label>Institution</label>
                    <input type="text" name="education[${count}][institution]" placeholder="e.g. Massachusetts Institute of Technology">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Start Date</label>
                        <input type="date" name="education[${count}][start_date]">
                    </div>
                    <div class="form-group">
                        <label>End Date</label>
                        <input type="date" name="education[${count}][end_date]">
                    </div>
                </div>
            `;

            entries.appendChild(newEntry);
            setupRemoveButtons();
        });

        // Add availability entry
        document.getElementById('addAvailability').addEventListener('click', function() {
            const entries = document.getElementById('availabilityEntries');
            const count = entries.children.length;

            const newEntry = document.createElement('div');
            newEntry.className = 'availability-row';
            newEntry.innerHTML = `
                <div class="availability-day">
                    <select name="availability[${count}][day_of_week]">
                        <option value="0">Sunday</option>
                        <option value="1">Monday</option>
                        <option value="2">Tuesday</option>
                        <option value="3">Wednesday</option>
                        <option value="4">Thursday</option>
                        <option value="5">Friday</option>
                        <option value="6">Saturday</option>
                    </select>
                </div>
                <div class="availability-time">
                    <input type="time" name="availability[${count}][start_time]" value="15:00">
                </div>
                <div class="availability-time">
                    <input type="time" name="availability[${count}][end_time]" value="20:00">
                </div>
                <div>
                    <input type="checkbox" id="recurring${count}" name="availability[${count}][is_recurring]" checked>
                    <label for="recurring${count}">Recurring</label>
                </div>
                <button type="button" class="btn-remove">Remove</button>
            `;

            entries.appendChild(newEntry);
            setupRemoveButtons();
        });

        // Setup remove buttons
        function setupRemoveButtons() {
            document.querySelectorAll('.btn-remove').forEach(button => {
                button.addEventListener('click', function() {
                    this.closest('.subject-entry, .education-entry, .availability-row').remove();
                });
            });
        }

        // Initial setup
        setupRemoveButtons();
    </script>
</body>