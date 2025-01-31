<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment Review Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        :root {
            --theme-color: #fcc400;
            --theme-color-dark: #e6b000;
            --theme-color-light: #ffd333;
            --text-dark: #333;
            --bg-light: #f5f5f5;
        }

        body {
            background-color: var(--bg-light);
        }

        .header {
            background-color: var(--theme-color);
            padding: 1rem 2rem;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .header h1 {
            color: var(--text-dark);
        }

        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .filters {
            background: white;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 2rem;
            display: flex;
            gap: 1rem;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .filters select,
        .filters input {
            padding: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            outline: none;
        }

        .filters select:focus,
        .filters input:focus {
            border-color: var(--theme-color);
        }

        .submission-card {
            background: white;
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s;
        }

        .submission-card:hover {
            transform: translateY(-2px);
        }

        .submission-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .student-info {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .student-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--theme-color-light);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-reviewed {
            background-color: #d4edda;
            color: #155724;
        }

        .submission-content {
            margin-bottom: 1rem;
        }

        .submission-actions {
            display: flex;
            gap: 1rem;
        }

        .btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 500;
            transition: background-color 0.2s;
        }

        .btn-primary {
            background-color: var(--theme-color);
            color: var(--text-dark);
        }

        .btn-primary:hover {
            background-color: var(--theme-color-dark);
        }

        .btn-secondary {
            background-color: #e9ecef;
            color: var(--text-dark);
        }

        .btn-secondary:hover {
            background-color: #dee2e6;
        }

        .feedback-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            width: 90%;
            max-width: 600px;
        }

        .modal-content textarea {
            width: 100%;
            min-height: 150px;
            margin: 1rem 0;
            padding: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
        }
    </style>
</head>

<body>
    <header class="header">
        <h1>Assignment Review Dashboard</h1>
    </header>

    <div class="container">
        <div class="filters">
            <select id="assignmentFilter">
                <option value="">All Assignments</option>
                <option value="assignment1">Assignment 1</option>
                <option value="assignment2">Assignment 2</option>
            </select>
            <select id="statusFilter">
                <option value="">All Status</option>
                <option value="pending">Pending Review</option>
                <option value="reviewed">Reviewed</option>
            </select>
            <input type="text" placeholder="Search by student name..." id="searchInput">
        </div>

        <div id="submissionsList">
            <!-- Submissions will be dynamically added here -->
        </div>
    </div>

    <div class="feedback-modal" id="feedbackModal">
        <div class="modal-content">
            <h2>Provide Feedback</h2>
            <textarea id="feedbackText" placeholder="Enter your feedback here..."></textarea>
            <div class="modal-actions">
                <button class="btn btn-secondary" onclick="closeModal()">Cancel</button>
                <button class="btn btn-primary" onclick="submitFeedback()">Submit Feedback</button>
            </div>
        </div>
    </div>

    <script>
        // Sample data - in a real application, this would come from a backend
        const submissions = [{
                id: 1,
                studentName: "John Doe",
                studentId: "ST001",
                assignmentName: "Assignment 1",
                submissionDate: "2025-01-15",
                status: "pending",
                content: "Lorem ipsum dolor sit amet, consectetur adipiscing elit."
            },
            {
                id: 2,
                studentName: "Jane Smith",
                studentId: "ST002",
                assignmentName: "Assignment 1",
                submissionDate: "2025-01-16",
                status: "reviewed",
                content: "Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."
            }
        ];

        let currentSubmissionId = null;

        // Render submissions
        function renderSubmissions(filteredSubmissions = submissions) {
            const submissionsList = document.getElementById('submissionsList');
            submissionsList.innerHTML = filteredSubmissions.map(submission => `
                <div class="submission-card">
                    <div class="submission-header">
                        <div class="student-info">
                            <div class="student-avatar">${submission.studentName.charAt(0)}</div>
                            <div>
                                <h3>${submission.studentName}</h3>
                                <small>${submission.studentId} • ${submission.assignmentName}</small>
                            </div>
                        </div>
                        <span class="status-badge status-${submission.status}">
                            ${submission.status.charAt(0).toUpperCase() + submission.status.slice(1)}
                        </span>
                    </div>
                    <div class="submission-content">
                        <p>${submission.content}</p>
                        <small>Submitted on: ${submission.submissionDate}</small>
                    </div>
                    <div class="submission-actions">
                        <button class="btn btn-primary" onclick="openFeedbackModal(${submission.id})">
                            ${submission.status === 'pending' ? 'Review' : 'Edit Review'}
                        </button>
                        <button class="btn btn-secondary" onclick="downloadSubmission(${submission.id})">
                            Download
                        </button>
                    </div>
                </div>
            `).join('');
        }

        // Filter submissions
        function filterSubmissions() {
            const assignmentFilter = document.getElementById('assignmentFilter').value;
            const statusFilter = document.getElementById('statusFilter').value;
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();

            const filtered = submissions.filter(submission => {
                const matchesAssignment = !assignmentFilter || submission.assignmentName === assignmentFilter;
                const matchesStatus = !statusFilter || submission.status === statusFilter;
                const matchesSearch = submission.studentName.toLowerCase().includes(searchTerm);
                return matchesAssignment && matchesStatus && matchesSearch;
            });

            renderSubmissions(filtered);
        }

        // Modal functions
        function openFeedbackModal(submissionId) {
            currentSubmissionId = submissionId;
            document.getElementById('feedbackModal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('feedbackModal').style.display = 'none';
            document.getElementById('feedbackText').value = '';
            currentSubmissionId = null;
        }

        function submitFeedback() {
            const feedback = document.getElementById('feedbackText').value;
            // In a real application, this would send the feedback to a backend
            console.log(`Submitting feedback for submission ${currentSubmissionId}:`, feedback);

            // Update submission status
            const submission = submissions.find(s => s.id === currentSubmissionId);
            if (submission) {
                submission.status = 'reviewed';
                renderSubmissions();
            }

            closeModal();
        }

        function downloadSubmission(submissionId) {
            // In a real application, this would trigger a file download
            console.log(`Downloading submission ${submissionId}`);
        }

        // Add event listeners
        document.getElementById('assignmentFilter').addEventListener('change', filterSubmissions);
        document.getElementById('statusFilter').addEventListener('change', filterSubmissions);
        document.getElementById('searchInput').addEventListener('input', filterSubmissions);

        // Initial render
        renderSubmissions();
    </script>
</body>

</html>