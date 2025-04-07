<?php include $this->resolve('/partials/_header.php'); ?>
<link rel="stylesheet" href="/assets/styles/components/toast.css">
<style>
    :root {
        --primary: #ffc400;
        --primary-dark: #ffaa00;
        --primary-light: #fff8e0;
        --text-dark: #333333;
        --text-light: #777777;
        --white: #ffffff;
        --bg-light: #f9f9f9;
        --border-radius: 16px;
        --card-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
        --hover-shadow: 0 15px 30px rgba(0, 0, 0, 0.12);
        --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    .assignment-header {
        background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%);
        padding: 40px 30px;
        border-radius: var(--border-radius);
        margin-bottom: 35px;
        box-shadow: var(--card-shadow);
        position: relative;
        overflow: hidden;
        color: var(--white);
    }

    .assignment-header:before {
        content: "";
        position: absolute;
        top: -40px;
        right: -20px;
        width: 180px;
        height: 180px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .assignment-header:after {
        content: "";
        position: absolute;
        bottom: -50px;
        left: 10%;
        width: 120px;
        height: 120px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    h1 {
        color: var(--white);
        text-align: center;
        font-weight: 800;
        letter-spacing: -0.5px;
        font-size: 2.4rem;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
        margin: 0;
    }

    .assignment-main-container {
        max-width: 1300px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .assignments {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .assignment-card {
        background: var(--white);
        border-radius: var(--border-radius);
        padding: 25px;
        box-shadow: var(--card-shadow);
        transition: var(--transition);
        border: 1px solid rgba(0, 0, 0, 0.03);
        display: grid;
        grid-template-columns: 1fr auto;
        grid-template-areas:
            "header status"
            "date date"
            "title title"
            "content content"
            "attachments attachments"
            "actions actions";
        column-gap: 20px;
        row-gap: 10px;
    }

    .assignment-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--hover-shadow);
    }

    .assignment-card-header {
        grid-area: header;
        display: flex;
        align-items: center;
    }

    .student-name {
        font-weight: 600;
        font-size: 1.15em;
        color: var(--text-dark);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .student-name i {
        color: var(--primary);
        font-size: 1.1em;
    }

    .submission-date {
        grid-area: date;
        color: var(--text-light);
        font-size: 0.95em;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .submission-date i {
        color: var(--primary);
    }

    .assignment-title {
        grid-area: title;
        margin: 10px 0;
        font-size: 1.2em;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .assignment-title i {
        color: var(--primary-dark);
    }

    .assignment-content {
        grid-area: content;
        margin-bottom: 15px;
        position: relative;
        max-height: 65px;
        overflow: hidden;
        color: var(--text-light);
        line-height: 1.65;
    }

    .assignment-content:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 35px;
        background: linear-gradient(to top, var(--white), transparent);
    }

    .status {
        grid-area: status;
        justify-self: end;
        padding: 8px 16px;
        border-radius: 30px;
        font-size: 0.9em;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .pending {
        background-color: rgba(255, 196, 0, 0.15);
        color: var(--primary-dark);
    }

    .graded {
        background-color: rgba(21, 87, 36, 0.1);
        color: #155724;
    }

    .attachments-section {
        grid-area: attachments;
        margin-bottom: 15px;
    }

    .attachment-title {
        font-size: 0.9em;
        font-weight: 600;
        margin-bottom: 12px;
        color: var(--text-light);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .attachment-list {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .attachment-item {
        background-color: var(--primary-light);
        padding: 8px 16px;
        border-radius: 30px;
        font-size: 0.85em;
        color: var(--primary-dark);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: var(--transition);
        text-decoration: none;
    }

    .attachment-item:hover {
        background-color: rgba(255, 196, 0, 0.25);
        transform: translateY(-3px);
        box-shadow: 0 4px 10px rgba(255, 196, 0, 0.2);
    }

    .attachment-item i {
        font-size: 0.95em;
    }

    .review-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.75);
        justify-content: center;
        align-items: center;
        backdrop-filter: blur(8px);
        z-index: 1000;
    }

    .assignment-modal-content {
        background-color: var(--white);
        padding: 35px;
        border-radius: 24px;
        width: 90%;
        max-width: 850px;
        max-height: 90vh;
        overflow-y: auto;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        animation: modal-in 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    @keyframes modal-in {
        from {
            opacity: 0;
            transform: translateY(40px) scale(0.95);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .assignment-modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid #eee;
    }

    .close-button {
        font-size: 1.5em;
        cursor: pointer;
        background: none;
        border: none;
        color: var(--text-light);
        transition: var(--transition);
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .close-button:hover {
        color: var(--text-dark);
        background-color: #f5f5f5;
    }

    .full-submission {
        margin-bottom: 30px;
        padding: 25px;
        background-color: #f8f9fa;
        border-radius: 16px;
        border-left: 5px solid var(--primary);
        line-height: 1.7;
        font-size: 1.05em;
    }

    .feedback-section {
        margin-bottom: 30px;
    }

    .feedback-section h3,
    .modal-attachments h3 {
        font-size: 1.25em;
        color: var(--text-dark);
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    textarea {
        width: 100%;
        min-height: 150px;
        padding: 18px;
        border: 1px solid #e0e0e0;
        border-radius: 16px;
        margin-bottom: 20px;
        resize: vertical;
        transition: var(--transition);
        font-size: 1em;
        line-height: 1.6;
        color: var(--text-dark);
    }

    textarea:focus {
        outline: none;
    }

    .grade-section {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 30px;
        font-size: 1.05em;
    }

    .grade-section input {
        width: 80px;
        padding: 12px 18px;
        border: 1px solid #e0e0e0;
        border-radius: 12px;
        transition: var(--transition);
        font-size: 1.1em;
        text-align: center;
        font-weight: 600;
    }

    .grade-section input:focus {
        outline: none;
    }

    textarea:focus,
    .search-box:focus,
    .grade-section input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(255, 196, 0, 0.15);
    }

    .submit-review {
        background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%);
        color: var(--white);
        border: none;
        padding: 16px 32px;
        border-radius: 14px;
        cursor: pointer;
        font-weight: 600;
        transition: var(--transition);
        font-size: 1.05em;
        display: flex;
        align-items: center;
        gap: 10px;
        justify-content: center;
    }

    .submit-review:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(255, 196, 0, 0.35);
    }

    .filter-section {
        margin-bottom: 35px;
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
        align-items: center;
        background-color: var(--white);
        padding: 20px 25px;
        border-radius: var(--border-radius);
        box-shadow: var(--card-shadow);
    }

    .filter-button {
        background-color: #f5f5f5;
        border: none;
        padding: 12px 24px;
        border-radius: 30px;
        cursor: pointer;
        transition: var(--transition);
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 0.95em;
    }

    .filter-button.active {
        background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%);
        color: var(--white);
        font-weight: 600;
        box-shadow: 0 6px 15px rgba(255, 196, 0, 0.3);
    }

    .filter-button:not(.active):hover {
        background-color: #eaeaea;
        transform: translateY(-3px);
    }

    .search-box {
        flex-grow: 1;
        padding: 16px 24px;
        border: 1px solid #eaeaea;
        border-radius: 30px;
        outline: none;
        transition: var(--transition);
        font-size: 0.95em;
        color: var(--text-dark);
        background-color: #f5f5f5;
    }

    .search-box:focus {
        background-color: var(--white);
    }

    .view-details {
        grid-area: actions;
        width: 200px;
        margin-left: auto;
        background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%);
        color: var(--white);
        border: none;
        padding: 14px 0;
        border-radius: 12px;
        cursor: pointer;
        font-weight: 600;
        transition: var(--transition);
        font-size: 0.95em;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .view-details:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(255, 196, 0, 0.3);
    }

    #modal-student,
    #modal-date {
        color: var(--text-light);
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 1.05em;
    }

    h2 {
        color: var(--text-dark);
        margin: 0;
        font-size: 1.6em;
        font-weight: 700;
    }

    .modal-attachments {
        margin-bottom: 30px;
    }

    .modal-attachment-list {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
    }

    .modal-attachment-item {
        background-color: var(--primary-light);
        padding: 12px 20px;
        border-radius: 12px;
        font-size: 0.95em;
        color: var(--primary-dark);
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: var(--transition);
        cursor: pointer;
        text-decoration: none;
        font-weight: 500;
        border: 1px solid rgba(255, 196, 0, 0.2);
    }

    .modal-attachment-item:hover {
        background-color: rgba(255, 196, 0, 0.25);
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(255, 196, 0, 0.2);
    }

    .no-assignments {
        text-align: center;
        padding: 40px;
        color: var(--text-light);
        font-size: 1.15em;
        background: var(--white);
        border-radius: var(--border-radius);
        box-shadow: var(--card-shadow);
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 15px;
    }

    .no-assignments i {
        font-size: 2.5em;
        color: var(--primary);
        margin-bottom: 10px;
    }

    @media (max-width: 768px) {
        .filter-section {
            flex-direction: column;
            align-items: stretch;
        }

        .search-box {
            order: -1;
            margin-bottom: 10px;
        }

        .filter-button {
            width: 100%;
            justify-content: center;
        }

        .assignment-card {
            padding: 20px;
        }

        .view-details {
            width: 100%;
        }

        .assignment-modal-content {
            padding: 25px;
            width: 95%;
        }
    }
</style>

<div class="assignment-main-container">
    <div class="assignment-header">
        <h1>Review Assignments</h1>
    </div>

    <div class="filter-section">
        <input type="text" class="search-box" placeholder="Search by student name or submission number...">
        <button class="filter-button active" data-filter="all"><i class="fas fa-th-list"></i> All Assignments</button>
        <button class="filter-button" data-filter="pending"><i class="fas fa-clock"></i> Pending Review</button>
        <button class="filter-button" data-filter="graded"><i class="fas fa-check-circle"></i> Graded</button>
    </div>

    <div class="assignments" id="assignments-container">
        <!-- Assignment cards will be dynamically loaded here -->
    </div>
</div>

<!-- Review Modal -->
<div class="review-modal" id="review-modal">
    <div class="assignment-modal-content">
        <div class="assignment-modal-header">
            <h2 id="modal-title">Assignment Review</h2>
            <button class="close-button" id="close-modal"><i class="fas fa-times"></i></button>
        </div>
        <div id="modal-student"></div>
        <div id="modal-date"></div>
        <div class="full-submission" id="full-submission">
            <!-- Full assignment content will be loaded here -->
        </div>
        <div class="modal-attachments" id="modal-attachments">
            <!-- Attachments will be loaded here -->
        </div>
        <div class="feedback-section">
            <h3><i class="fas fa-comment-alt"></i> Feedback</h3>
            <textarea id="feedback-text" placeholder="Provide helpful feedback to the student here..."></textarea>
        </div>
        <div class="grade-section">
            <label for="grade"><i class="fas fa-star"></i> Grade:</label>
            <input type="number" id="grade" min="0" max="100" value="0">
            <span>/100</span>
        </div>
        <button type="submit" class="submit-review" id="submit-review"><i class="fas fa-paper-plane"></i> Submit Review</button>
    </div>
</div>
<script src="/assets/js/components/toast.js"></script>

<script>
    const assignments = <?php echo json_encode($submissions); ?>;
    const processedAssignments = assignments.map(assignment => {
        // Parse the attachments JSON string
        let parsedAttachments = [];
        try {
            parsedAttachments = JSON.parse(assignment.attachments);
            // Add URL property to each attachment
            parsedAttachments = parsedAttachments.map(attachment => ({
                ...attachment,
                url: `/submission/${assignment.id}/attachment/${attachment.attachment_id}`
            }));
        } catch (e) {
            console.error("Error parsing attachments:", e);
        }

        // Return processed assignment with required fields
        return {
            ...assignment,
            title: assignment.title || `Submission #${assignment.id}`, // Default title if missing
            content: assignment.content || "No content provided", // Default content if missing
            attachments: parsedAttachments
        };
    });

    function renderAssignments(filter = 'all', searchTerm = '') {
        const container = document.getElementById('assignments-container');
        container.innerHTML = '';

        const filteredAssignments = processedAssignments.filter(assignment => {
            const matchesFilter = filter === 'all' || assignment.status === filter;
            const matchesSearch = assignment.studentName.toLowerCase().includes(searchTerm.toLowerCase()) ||
                assignment.title.toLowerCase().includes(searchTerm.toLowerCase());
            return matchesFilter && matchesSearch;
        });

        if (filteredAssignments.length === 0) {
            container.innerHTML = `
                <div class="no-assignments">
                    <i class="fas fa-search"></i>
                    <p>No assignments found matching your criteria.</p>
                </div>`;
            return;
        }

        filteredAssignments.forEach(assignment => {
            const card = document.createElement('div');
            card.className = 'assignment-card';

            const statusClass = assignment.status === 'pending' ? 'pending' : 'graded';
            const statusText = assignment.status === 'pending' ? 'Pending Review' : `Graded: ${assignment.grade}/100`;
            const statusIcon = assignment.status === 'pending' ? 'fas fa-clock' : 'fas fa-check-circle';

            // Create attachments HTML if there are any
            let attachmentsHTML = '';
            if (assignment.attachments && assignment.attachments.length > 0) {
                attachmentsHTML = `
                <div class="attachments-section">
                    <div class="attachment-title"><i class="fas fa-paperclip"></i> Attachments:</div>
                    <div class="attachment-list">
                        ${assignment.attachments.map(file => `
                            <a href="${file.url}" class="attachment-item" title="${file.name}">
                                <i class="fas fa-file"></i> ${file.name}
                            </a>
                        `).join('')}
                    </div>
                </div>
            `;
            }

            card.innerHTML = `
            <div class="assignment-card-header">
                <span class="student-name"><i class="fas fa-user-graduate"></i> ${assignment.studentName}</span>
            </div>
            <span class="status ${statusClass}"><i class="${statusIcon}"></i> ${statusText}</span>
            <div class="submission-date"><i class="far fa-calendar-alt"></i> Submitted: ${assignment.upload_date}</div>
            <div class="assignment-title"><i class="fas fa-book"></i> ${assignment.title}</div>
            <div class="assignment-content">${assignment.content}</div>
            ${attachmentsHTML}
            <button class="view-details" data-id="${assignment.id}"><i class="fas fa-eye"></i> Review Assignment</button>
        `;

            container.appendChild(card);
        });

        // Add event listeners to view details buttons
        document.querySelectorAll('.view-details').forEach(button => {
            button.addEventListener('click', function() {
                const id = parseInt(this.getAttribute('data-id'));
                openReviewModal(id);
            });
        });
    }

    // Function to open the review modal
    function openReviewModal(id) {
        const assignment = processedAssignments.find(a => a.id === id);
        if (!assignment) return;

        document.getElementById('modal-title').textContent = assignment.title;
        document.getElementById('modal-student').innerHTML = `<i class="fas fa-user-graduate"></i> Student: ${assignment.studentName}`;
        document.getElementById('modal-date').innerHTML = `<i class="far fa-calendar-alt"></i> Submitted: ${assignment.upload_date}`;
        document.getElementById('full-submission').textContent = assignment.content;

        // Render attachments in modal
        const attachmentsContainer = document.getElementById('modal-attachments');
        if (assignment.attachments && assignment.attachments.length > 0) {
            attachmentsContainer.innerHTML = `
                    <h3><i class="fas fa-paperclip"></i> Attachments</h3>
                    <div class="modal-attachment-list">
                        ${assignment.attachments.map(file => `
                            <a href="${file.url}" class="modal-attachment-item" title="Download ${file.name}">
                                <i class="fas fa-file"></i> ${file.name}
                            </a>
                        `).join('')}
                    </div>
                `;
            attachmentsContainer.style.display = 'block';
        } else {
            attachmentsContainer.style.display = 'none';
        }

        // Pre-fill existing feedback and grade if available
        document.getElementById('feedback-text').value = assignment.feedback || '';
        document.getElementById('grade').value = assignment.grade || 0;

        // Set the assignment ID on the submit button for reference
        document.getElementById('submit-review').setAttribute('data-id', id);

        // Show the modal
        document.getElementById('review-modal').style.display = 'flex';
    }

    // Function to close the review modal
    function closeReviewModal() {
        document.getElementById('review-modal').style.display = 'none';
    }

    // Function to handle assignment review submission
    function submitReview() {
        const id = parseInt(document.getElementById('submit-review').getAttribute('data-id'));
        const feedback = document.getElementById('feedback-text').value.trim();
        const grade = parseInt(document.getElementById('grade').value);

        if (isNaN(grade) || grade < 0 || grade > 100) {
            alert('Please enter a valid grade between 0 and 100.');
            return;
        }

        // Show loading state
        const submitButton = document.getElementById('submit-review');
        const originalButtonText = submitButton.innerHTML;
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Submitting...';
        submitButton.disabled = true;

        // Prepare data for submission
        const formData = new FormData();
        formData.append('submission_id', id);
        formData.append('feedback', feedback);
        formData.append('grade', grade);

        // Send POST request to server
        fetch('/submit/review', {
                method: 'POST',
                body: formData,
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response;
            })
            .then(data => {
                // Close the modal and re-render assignments
                console.log(data);

                closeReviewModal();
                renderAssignments(currentFilter, document.querySelector('.search-box').value);
                // Show confirmation
                showToast('Review submitted', 'The review has been submitted successfully.', 'success');
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            })
            .catch(error => {
                console.error('Error submitting review:', error);
                showToast('Failed to submit review', 'TThere was a problem submitting review. Please try again.', 'error');
            })
            .finally(() => {
                // Reset button state
                submitButton.innerHTML = originalButtonText;
                submitButton.disabled = false;
            });

    }

    // Track current filter
    let currentFilter = 'all';

    // Initialize the page
    document.addEventListener('DOMContentLoaded', function() {
        // Initial render
        renderAssignments();

        // Setup event listeners for filter buttons
        document.querySelectorAll('.filter-button').forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons
                document.querySelectorAll('.filter-button').forEach(btn => {
                    btn.classList.remove('active');
                });

                // Add active class to clicked button
                this.classList.add('active');

                // Apply filter
                currentFilter = this.getAttribute('data-filter');
                renderAssignments(currentFilter, document.querySelector('.search-box').value);
            });
        });

        // Setup search box
        document.querySelector('.search-box').addEventListener('input', function() {
            renderAssignments(currentFilter, this.value);
        });

        // Setup modal close button
        document.getElementById('close-modal').addEventListener('click', closeReviewModal);

        // Setup submit review button
        document.getElementById('submit-review').addEventListener('click', submitReview);

        // Close modal when clicking outside of it
        document.getElementById('review-modal').addEventListener('click', function(event) {
            if (event.target === this) {
                closeReviewModal();
            }
        });
    });
</script>

<?php include $this->resolve('/partials/_footer.php'); ?>