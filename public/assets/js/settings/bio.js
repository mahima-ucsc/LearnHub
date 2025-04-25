// Add subject entry
document.getElementById("addSubject").addEventListener("click", function () {
  const entries = document.getElementById("subjectEntries");
  const count = entries.children.length;
  const newEntry = document.createElement("div");

  newEntry.className = "subject-entry";
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
document.getElementById("addEducation").addEventListener("click", function (e) {
  e.preventDefault();
  const entries = document.getElementById("educationEntries");
  const count = entries.children.length;
  console.log(count);

  const newEntry = document.createElement("div");
  newEntry.className = "education-entry";
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
document
  .getElementById("addAvailability")
  .addEventListener("click", function () {
    const entries = document.getElementById("availabilityEntries");
    const count = entries.children.length;

    const newEntry = document.createElement("div");
    newEntry.className = "availability-row";
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
  document.querySelectorAll(".btn-remove").forEach((button) => {
    button.addEventListener("click", function () {
      this.closest(
        ".subject-entry, .education-entry, .availability-row"
      ).remove();
    });
  });
}

// Initial setup
setupRemoveButtons();
