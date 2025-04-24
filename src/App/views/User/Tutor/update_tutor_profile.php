<?php include $this->resolve("partials/_header.php"); ?>
<link rel="stylesheet" href="/assets/styles/Tutor/update_tutor_profile.css">

<div class="container">
    <div class="form-header">
        <h1>Create Your Tutor Profile</h1>
        <p>Complete the form below to set up your profile information for students</p>
    </div>

    <form id="tutorProfileForm" action="/api/tutor/profile_update" method="POST">
        <input type="hidden" id="tutorId" name="tutor_id" value="<?php echo $_SESSION['user'] ?>">

        <!-- Basic Information -->
        <div class="form-card">
            <div class="form-section">
                <h2>Basic Information</h2>

                <div class="form-group">
                    <label for="title">Professional Title</label>
                    <input type="text" id="title" name="title" placeholder="e.g. Mathematics & Computer Science Tutor" value="<?php echo isset($tutorBasic['title']) ? htmlspecialchars($tutorBasic['title']) : ''; ?>">
                    <p class="hint-text">A short description of your specialty</p>
                </div>

                <div class="form-group">
                    <label for="bio">Bio</label>
                    <textarea id="bio" name="bio" rows="5" placeholder="Introduce yourself, your experience, and your teaching approach"><?php echo isset($tutorBasic['bio']) ? htmlspecialchars($tutorBasic['bio']) : ''; ?></textarea>
                    <p class="hint-text">This will be displayed on your profile page</p>
                </div>
            </div>
        </div>

        <!-- Subjects & Experience -->
        <div class="form-card">
            <div class="form-section">
                <h2>Subjects & Experience</h2>

                <div id="subjectEntries">
                    <?php $indexforsubject = 0 ?>
                    <?php foreach ($tutorSubjects as $tutorSubject): ?>
                        <input type="hidden" name="subjects[<?php echo $indexforsubject ?>][subject_id]" value="<?php echo $tutorSubject['subject_id'] ?>">
                        <div class="subject-entry">
                            <div class="entry-header">
                                <h3>Subject #<?php echo $indexforsubject + 1 ?></h3>
                                <button type="button" class="btn-remove">Remove</button>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Subject</label>
                                    <select name="subjects[<?php echo $indexforsubject ?>][<?php echo $tutorSubject['subject_id'] ?>]">
                                        <?php
                                        foreach ($subjects as $subject) {
                                            if ($subject['subject_id'] == $tutorSubject['subject_id']) {
                                                echo "<option value='" . $subject['subject_id'] . "' selected>" . htmlspecialchars($subject['subject_title']) . "</option>";
                                            }
                                        }
                                        ?>
                                        <?php
                                        foreach ($subjects as $subject) {
                                            echo "<option value='" . $subject['subject_id'] . "'>" . $subject['subject_title'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Years of Experience</label>
                                    <input type="number" name="subjects[<?php echo $indexforsubject ?>][years_experience]" value="<?php echo isset($tutorSubject['years_experience']) ? htmlspecialchars($tutorSubject['years_experience']) : ''; ?>" min="0" max="100">
                                </div>
                                <input type="hidden" name="subjects[<?php echo $indexforsubject ?>][is_new]" value="0">
                            </div>
                        </div>
                        <?php $indexforsubject++ ?>
                    <?php endforeach; ?>
                </div>

                <button type="button" id="addSubject" class="btn-add">+ Add Another Subject</button>
            </div>
        </div>

        <!-- Education -->
        <div class="form-card">
            <div class="form-section">
                <h2>Education</h2>

                <div id="educationEntries">
                    <?php $indexforeducation = 0 ?>
                    <?php foreach ($tutorEducations as $tutorEducation): ?>
                        <input type="hidden" name="educations[<?php echo $indexforeducation ?>][education_id]" value="<?php echo $tutorEducation['education_id'] ?>">
                        <div class="education-entry">
                            <div class="entry-header">
                                <h3>Education #<?php echo $indexforeducation + 1 ?> </h3>
                                <button type="button" class="btn-remove">Remove</button>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Degree</label>
                                    <input type="text" name="educations[<?php echo $indexforeducation ?>][degree]" placeholder="e.g. Ph.D., M.S., B.S." value="<?php echo isset($tutorEducation['degree']) ? $tutorEducation['degree'] : '' ?>">
                                </div>
                                <div class="form-group">
                                    <label>Field of Study</label>
                                    <input type="text" name="educations[<?php echo $indexforeducation ?>][field_of_study]" placeholder="e.g. Applied Mathematics" value="<?php echo isset($tutorEducation['field_of_study']) ? $tutorEducation['field_of_study'] : '' ?>">
                                </div>
                            </div>
                            <div class=" form-group">
                                <label>Institution</label>
                                <input type="text" name="educations[<?php echo $indexforeducation ?>][institution]" placeholder="e.g. Massachusetts Institute of Technology" value="<?php echo isset($tutorEducation['institution']) ? $tutorEducation['institution'] : '' ?>">
                            </div>
                            <div class=" form-row">
                                <div class="form-group">
                                    <label>Start Date</label>
                                    <input type="date" name="educations[<?php echo $indexforeducation ?>][start_date]" value="<?php echo isset($tutorEducation['start_date']) ? $tutorEducation['start_date'] : '' ?>">
                                </div>
                                <div class=" form-group">
                                    <label>End Date</label>
                                    <input type="date" name="educations[<?php echo $indexforeducation  ?>][end_date]" value="<?php echo isset($tutorEducation['end_date']) ? $tutorEducation['end_date'] : '' ?>">
                                </div>
                            </div>
                            <input type="hidden" name="educations[<?php echo $indexforeducation ?>][is_new]" value="0">
                        </div>
                        <?php $indexforeducation++ ?>
                    <?php endforeach; ?>
                </div>

                <button type=" button" id="addEducation" class="btn-add">+ Add Another Education</button>
            </div>
        </div>

        <!-- Availability -->
        <div class="form-card">
            <div class="form-section">
                <h2>Availability</h2>

                <div id="availabilityEntries">
                    <?php $indexfortimeslote = 0 ?>
                    <?php foreach ($tutorAvailablities as $tutorAvailablity): ?>
                        <input type="hidden" name="availability[<?php echo $indexfortimeslote ?>][availability_id]" value="<?php echo $tutorAvailablity['availability_id'] ?>">
                        <div class="availability-row">
                            <div class="availability-day">
                                <select name="availability[<?php echo $indexfortimeslote ?>][day_of_week]">
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
                                <input type="time" name="availability[<?php echo $indexfortimeslote ?>][start_time]" value="<?php echo isset($tutorAvailablity['start_time']) ? $tutorAvailablity['start_time'] : '' ?>">
                            </div>
                            <div class="availability-time">
                                <input type="time" name="availability[<?php echo $indexfortimeslote ?>][end_time]" value="<?php echo isset($tutorAvailablity['end_time']) ? $tutorAvailablity['end_time'] : '' ?>">
                            </div>
                            <div>
                                <input type="checkbox" id="recurring<?php echo $indexfortimeslote ?>" name="availability[<?php echo $indexfortimeslote ?>][is_recurring]" checked>
                                <label for="recurring<?php echo $indexfortimeslote ?>">Recurring</label>
                            </div>
                            <input type="hidden" name="availability[<?php echo $indexfortimeslote ?>][is_new]" value="0">
                            <button type="button" class="btn-remove">Remove</button>
                        </div>
                        <?php $indexfortimeslote++ ?>
                    <?php endforeach; ?>
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
                            <?php
                            foreach ($subjects as $subject) {
                                echo "<option value='" . $subject['subject_id'] . "'>" . $subject['subject_title'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Years of Experience</label>
                        <input type="number" name="subjects[${count}][years_experience]" min="0" max="50">
                    </div>
                    <input type="hidden" name="subjects[${count}][is_new]" value="1">
                </div>
            `;

        entries.appendChild(newEntry);
        setupRemoveButtons();
    });

    // Add education entry
    document.getElementById('addEducation').addEventListener('click', function(e) {
        e.preventDefault();
        const entries = document.getElementById('educationEntries');
        const count = entries.children.length;
        console.log(count);

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
                        <input type="text" name="educations[${count}][degree]" placeholder="e.g. Ph.D., M.S., B.S.">
                    </div>
                    <div class="form-group">
                        <label>Field of Study</label>
                        <input type="text" name="educations[${count}][field_of_study]" placeholder="e.g. Applied Mathematics">
                    </div>
                </div>
                <div class="form-group">
                    <label>Institution</label>
                    <input type="text" name="educations[${count}][institution]" placeholder="e.g. Massachusetts Institute of Technology">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Start Date</label>
                        <input type="date" name="educations[${count}][start_date]">
                    </div>
                    <div class="form-group">
                        <label>End Date</label>
                        <input type="date" name="educations[${count}][end_date]">
                    </div>
                </div>
                <input type="hidden" name="educations[${count}][is_new]" value="1">
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
                <input type="hidden" name="availability[${count}][is_new]" value="1">
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

<?php include $this->resolve("partials/_footer.php"); ?>