<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment Review Dashboard</title>
    <!-- Add Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f7fa;
            padding: 20px;
            color: #333;
        }

        .header {
            background: linear-gradient(135deg, #4776E6 0%, #8E54E9 100%);
            padding: 30px;
            border-radius: 16px;
            margin-bottom: 30px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
            color: white;
        }

        .header:before {
            content: "";
            position: absolute;
            top: -20px;
            right: -20px;
            width: 140px;
            height: 140px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .header:after {
            content: "";
            position: absolute;
            bottom: -40px;
            left: 10%;
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        h1 {
            color: white;
            text-align: center;
            font-weight: 700;
            letter-spacing: -0.5px;
            font-size: 2.2rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .container {
            max-width: 1300px;
            margin: 0 auto;
        }

        .assignments {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 25px;
        }

        .assignment-card {
            background: white;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.03);
            display: flex;
            flex-direction: column;
        }

        .assignment-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.08);
        }

        .assignment-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .student-name {
            font-weight: 600;
            font-size: 1.1em;
            color: #222;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .student-name i {
            color: #8E54E9;
        }

        .submission-date {
            color: #777;
            font-size: 0.9em;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .submission-date i {
            color: #8E54E9;
            font-size: 0.9em;
        }

        .assignment-title {
            color: #222;
            margin-bottom: 12px;
            font-weight: 600;
            font-size: 1.05em;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .assignment-title i {
            color: #4776E6;
        }

        .assignment-content {
            color: #555;
            margin-bottom: 20px;
            max-height: 100px;
            overflow: hidden;
            text-overflow: ellipsis;
            line-height: 1.6;
            font-size: 0.95em;
            position: relative;
        }

        .assignment-content:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 30px;
            background: linear-gradient(to top, white, transparent);
        }

        .status {
            padding: 8px 14px;
            border-radius: 30px;
            font-size: 0.8em;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .pending {
            background-color: #FFF3CD;
            color: #856404;
        }

        .graded {
            background-color: #D4EDDA;
            color: #155724;
        }

        .attachments-section {
            margin: 15px 0;
            padding-top: 15px;
            border-top: 1px solid #eee;
        }

        .attachment-title {
            font-size: 0.9em;
            font-weight: 600;
            margin-bottom: 10px;
            color: #555;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .attachment-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 15px;
        }

        .attachment-item {
            background-color: #f0f5ff;
            padding: 6px 12px;
            border-radius: 30px;
            font-size: 0.8em;
            color: #4776E6;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: all 0.2s;
        }

        .attachment-item:hover {
            background-color: #e0ebff;
            transform: translateY(-2px);
        }

        .attachment-item i {
            font-size: 0.9em;
        }

        .review-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            justify-content: center;
            align-items: center;
            backdrop-filter: blur(8px);
            z-index: 1000;
        }

        .modal-content {
            background-color: white;
            padding: 30px;
            border-radius: 20px;
            width: 85%;
            max-width: 800px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
            animation: modal-in 0.3s ease;
        }

        @keyframes modal-in {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .close-button {
            font-size: 1.5em;
            cursor: pointer;
            background: none;
            border: none;
            color: #777;
            transition: color 0.3s;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .close-button:hover {
            color: #333;
            background-color: #f5f5f5;
        }

        .full-submission {
            margin-bottom: 25px;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 12px;
            border-left: 4px solid #8E54E9;
            line-height: 1.6;
        }

        .feedback-section {
            margin-bottom: 25px;
        }

        textarea {
            width: 100%;
            min-height: 140px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 12px;
            margin-bottom: 15px;
            resize: vertical;
            font-family: inherit;
            transition: all 0.3s;
            font-size: 0.95em;
            line-height: 1.5;
        }

        textarea:focus {
            border-color: #4776E6;
            outline: none;
            box-shadow: 0 0 0 3px rgba(71, 118, 230, 0.2);
        }

        .grade-section {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 25px;
        }

        .grade-section input {
            width: 70px;
            padding: 10px 14px;
            border: 1px solid #ddd;
            border-radius: 12px;
            transition: all 0.3s;
            font-size: 1em;
        }

        .grade-section input:focus {
            border-color: #4776E6;
            outline: none;
            box-shadow: 0 0 0 3px rgba(71, 118, 230, 0.2);
        }

        .submit-review {
            background: linear-gradient(135deg, #4776E6 0%, #8E54E9 100%);
            color: white;
            border: none;
            padding: 14px 28px;
            border-radius: 12px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
            font-size: 1em;
        }

        .submit-review:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(71, 118, 230, 0.3);
        }

        .filter-section {
            margin-bottom: 30px;
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            align-items: center;
            background-color: white;
            padding: 15px 20px;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .filter-button {
            background-color: #f0f0f0;
            border: none;
            padding: 10px 20px;
            border-radius: 30px;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .filter-button.active {
            background: linear-gradient(135deg, #4776E6 0%, #8E54E9 100%);
            color: white;
            font-weight: 600;
            box-shadow: 0 4px 10px rgba(71, 118, 230, 0.3);
        }

        .filter-button:not(.active):hover {
            background-color: #e0e0e0;
            transform: translateY(-2px);
        }

        .search-box {
            flex-grow: 1;
            padding: 14px 20px;
            border: 1px solid #ddd;
            border-radius: 30px;
            outline: none;
            transition: all 0.3s;
            font-size: 0.95em;
        }

        .search-box:focus {
            border-color: #4776E6;
            box-shadow: 0 0 0 3px rgba(71, 118, 230, 0.2);
        }

        .view-details {
            background: linear-gradient(135deg, #4776E6 0%, #8E54E9 100%);
            color: white;
            border: none;
            padding: 12px 18px;
            border-radius: 12px;
            cursor: pointer;
            display: block;
            width: 100%;
            font-weight: 600;
            transition: all 0.3s;
            margin-top: auto;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .view-details:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(71, 118, 230, 0.3);
        }

        #modal-student,
        #modal-date {
            color: #666;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        h2,
        h3 {
            color: #222;
            margin-bottom: 15px;
        }

        .modal-attachments {
            margin-bottom: 25px;
        }

        .modal-attachments h3 {
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .modal-attachment-list {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .modal-attachment-item {
            background-color: #f0f5ff;
            padding: 10px 16px;
            border-radius: 8px;
            font-size: 0.9em;
            color: #4776E6;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
            cursor: pointer;
        }

        .modal-attachment-item:hover {
            background-color: #e0ebff;
            transform: translateY(-2px);
        }

        .no-assignments {
            text-align: center;
            padding: 40px;
            color: #777;
            font-size: 1.1em;
            grid-column: 1 / -1;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Assignment Review Dashboard</h1>
        </div>

        <div class="filter-section">
            <input type="text" class="search-box" placeholder="Search by student name or assignment title">
            <button class="filter-button active" data-filter="all"><i class="fas fa-th-list"></i> All</button>
            <button class="filter-button" data-filter="pending"><i class="fas fa-clock"></i> Pending Review</button>
            <button class="filter-button" data-filter="graded"><i class="fas fa-check-circle"></i> Graded</button>
        </div>

        <div class="assignments" id="assignments-container">
            <!-- Assignment cards will be dynamically loaded here -->
        </div>
    </div>

    <!-- Review Modal -->
    <div class="review-modal" id="review-modal">
        <div class="modal-content">
            <div class="modal-header">
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
                <textarea id="feedback-text" placeholder="Enter your feedback here..."></textarea>
            </div>
            <div class="grade-section">
                <label for="grade"><i class="fas fa-star"></i> Grade:</label>
                <input type="number" id="grade" min="0" max="100" value="0">
                <span>/100</span>
            </div>
            <button class="submit-review" id="submit-review"><i class="fas fa-paper-plane"></i> Submit Review</button>
        </div>
    </div>

    <script>
        // Sample data for assignments
        const assignments = [{
                id: 1,
                studentName: "John Doe",
                title: "JavaScript Basics Quiz",
                content: "In this assignment, I've implemented the required functions for array manipulation. I've created functions for mapping, filtering, and reducing arrays as requested. All test cases pass successfully.",
                submissionDate: "2023-06-15",
                status: "pending",
                grade: null,
                feedback: "",
                attachments: [{
                        name: "javascript_basics.zip",
                        url: "#"
                    },
                    {
                        name: "test_results.pdf",
                        url: "#"
                    }
                ]
            },
            {
                id: 2,
                studentName: "Jane Smith",
                title: "CSS Layout Project",
                content: "I've created a responsive layout using CSS Grid and Flexbox as per the requirements. The website works well on mobile, tablet, and desktop sizes. I've also implemented the dark mode toggle as requested in the bonus section.",
                submissionDate: "2023-06-14",
                status: "graded",
                grade: 92,
                feedback: "Excellent work on the responsive design! Your CSS organization is clean and well-structured. For future projects, consider adding some comments to explain complex layout decisions.",
                attachments: [{
                    name: "layout_project.zip",
                    url: "#"
                }]
            },
            {
                id: 3,
                studentName: "Mike Johnson",
                title: "HTML Form Validation",
                content: "I've built the form with client-side validation using JavaScript. The form validates email, password strength, and ensures matching passwords for confirmation. I've also implemented custom error messages as required.",
                submissionDate: "2023-06-16",
                status: "pending",
                grade: null,
                feedback: "",
                attachments: []
            },
            {
                id: 4,
                studentName: "Sarah Williams",
                title: "Node.js API Development",
                content: "I've created a REST API with Express.js that connects to a MongoDB database. The API has endpoints for CRUD operations on user resources and includes authentication with JWT. All required endpoints have been tested with Postman.",
                submissionDate: "2023-06-10",
                status: "graded",
                grade: 88,
                feedback: "Good implementation of the REST API. Authentication works well. Consider adding more error handling for edge cases. Your code structure is clean and follows best practices.",
                attachments: [{
                        name: "api_source.zip",
                        url: "#"
                    },
                    {
                        name: "postman_collection.json",
                        url: "#"
                    }
                ]
            },
            {
                id: 5,
                studentName: "Alex Brown",
                title: "React State Management",
                content: "I've built the React application using Context API for state management as required. The app includes the user authentication flow, product listing, and shopping cart functionality. I've also implemented local storage to persist the cart items.",
                submissionDate: "2023-06-12",
                status: "pending",
                grade: null,
                feedback: "",
                attachments: [{
                    name: "react_app.zip",
                    url: "#"
                }]
            }
        ];

        // Function to get icon based on file extension
        function getFileIcon(filename) {
            const ext = filename.split('.').pop().toLowerCase();

            if (['zip', 'rar', '7z'].includes(ext)) return 'fas fa-file-archive';
            if (['pdf'].includes(ext)) return 'fas fa-file-pdf';
            if (['doc', 'docx'].includes(ext)) return 'fas fa-file-word';
            if (['xls', 'xlsx'].includes(ext)) return 'fas fa-file-excel';
            if (['jpg', 'jpeg', 'png', 'gif', 'svg'].includes(ext)) return 'fas fa-file-image';
            if (['js', 'jsx', 'ts', 'tsx', 'html', 'css', 'php'].includes(ext)) return 'fas fa-file-code';
            if (['txt', 'md'].includes(ext)) return 'fas fa-file-alt';

            return 'fas fa-file';
        }

        // Function to render assignment cards
        function renderAssignments(filter = 'all', searchTerm = '') {
            const container = document.getElementById('assignments-container');
            container.innerHTML = '';

            const filteredAssignments = assignments.filter(assignment => {
                const matchesFilter = filter === 'all' || assignment.status === filter;
                const matchesSearch = assignment.studentName.toLowerCase().includes(searchTerm.toLowerCase()) ||
                    assignment.title.toLowerCase().includes(searchTerm.toLowerCase());
                return matchesFilter && matchesSearch;
            });

            if (filteredAssignments.length === 0) {
                container.innerHTML = '<div class="no-assignments"><i class="fas fa-search"></i> No assignments found matching your criteria.</div>';
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
                                        <i class="${getFileIcon(file.name)}"></i> ${file.name}
                                    </a>
                                `).join('')}
                            </div>
                        </div>
                    `;
                }

                card.innerHTML = `
                    <div class="assignment-header">
                        <span class="student-name"><i class="fas fa-user-graduate"></i> ${assignment.studentName}</span>
                        <span class="status ${statusClass}"><i class="${statusIcon}"></i> ${statusText}</span>
                    </div>
                    <div class="submission-date"><i class="far fa-calendar-alt"></i> Submitted: ${assignment.submissionDate}</div>
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
            const assignment = assignments.find(a => a.id === id);
            if (!assignment) return;

            document.getElementById('modal-title').textContent = assignment.title;
            document.getElementById('modal-student').innerHTML = `<i class="fas fa-user-graduate"></i> Student: ${assignment.studentName}`;
            document.getElementById('modal-date').innerHTML = `<i class="far fa-calendar-alt"></i> Submitted: ${assignment.submissionDate}`;
            document.getElementById('full-submission').textContent = assignment.content;

            // Render attachments in modal
            const attachmentsContainer = document.getElementById('modal-attachments');
            if (assignment.attachments && assignment.attachments.length > 0) {
                attachmentsContainer.innerHTML = `
                    <h3><i class="fas fa-paperclip"></i> Attachments</h3>
                    <div class="modal-attachment-list">
                        ${assignment.attachments.map(file => `
                            <a href="${file.url}" class="modal-attachment-item" title="Download ${file.name}">
                                <i class="${getFileIcon(file.name)}"></i> ${file.name}
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

            if (!feedback) {
                alert('Please provide feedback for the student.');
                return;
            }

            if (isNaN(grade) || grade < 0 || grade > 100) {
                alert('Please enter a valid grade between 0 and 100.');
                return;
            }

            // Update the assignment in our data
            const assignmentIndex = assignments.findIndex(a => a.id === id);
            if (assignmentIndex !== -1) {
                assignments[assignmentIndex].status = 'graded';
                assignments[assignmentIndex].grade = grade;
                assignments[assignmentIndex].feedback = feedback;
            }

            // Close the modal and re-render assignments
            closeReviewModal();
            renderAssignments(currentFilter, document.querySelector('.search-box').value);

            // Show confirmation
            alert('Review submitted successfully!');
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
</body>

</html>