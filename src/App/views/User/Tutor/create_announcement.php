<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Announcement</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        :root {
            --theme-color: #fcc400;
            --theme-dark: #e6b000;
            --bg-light: #f5f5f5;
            --text-dark: #333;
        }

        body {
            background-color: var(--bg-light);
            min-height: 100vh;
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
            max-width: 1000px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .announcement-form {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--text-dark);
        }

        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
            transition: border-color 0.2s;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--theme-color);
        }

        textarea.form-control {
            min-height: 150px;
            resize: vertical;
        }

        .attachment-area {
            border: 2px dashed #ddd;
            padding: 1.5rem;
            text-align: center;
            border-radius: 4px;
            cursor: pointer;
            transition: border-color 0.2s;
        }

        .attachment-area:hover {
            border-color: var(--theme-color);
        }

        .attachment-area i {
            display: block;
            font-size: 2rem;
            margin-bottom: 0.5rem;
            color: #666;
        }

        .audience-options {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .audience-option {
            flex: 1;
            min-width: 200px;
            padding: 1rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .audience-option:hover {
            border-color: var(--theme-color);
        }

        .audience-option.selected {
            background-color: var(--theme-color);
            border-color: var(--theme-color);
            color: var(--text-dark);
        }

        .preview-section {
            margin-top: 2rem;
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .preview-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #eee;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .btn-primary {
            background-color: var(--theme-color);
            color: var(--text-dark);
        }

        .btn-primary:hover {
            background-color: var(--theme-dark);
        }

        .btn-secondary {
            background-color: #e9ecef;
            color: var(--text-dark);
        }

        .btn-secondary:hover {
            background-color: #dee2e6;
        }

        .schedule-options {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .form-check {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .preview-badge {
            background-color: #e9ecef;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.875rem;
            color: #666;
        }

        .attached-files {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            margin-top: 1rem;
        }

        .file-badge {
            background-color: #e9ecef;
            padding: 0.5rem;
            border-radius: 4px;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .file-badge button {
            border: none;
            background: none;
            color: #666;
            cursor: pointer;
            font-size: 1rem;
        }
    </style>
</head>

<body>
    <header class="header">
        <h1>Create Announcement</h1>
    </header>

    <div class="container">
        <form class="announcement-form" id="announcementForm">
            <div class="form-group">
                <label for="title">Announcement Title</label>
                <input type="text" id="title" class="form-control" placeholder="Enter announcement title">
            </div>

            <div class="form-group">
                <label>Select Audience</label>
                <div class="audience-options">
                    <div class="audience-option selected">
                        <h3>All Students</h3>
                        <p>Send to all enrolled students</p>
                    </div>
                    <div class="audience-option">
                        <h3>Specific Class</h3>
                        <p>Choose specific class sections</p>
                    </div>
                    <div class="audience-option">
                        <h3>Individual Students</h3>
                        <p>Select individual students</p>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="content">Announcement Content</label>
                <textarea id="content" class="form-control" placeholder="Write your announcement here..."></textarea>
            </div>

            <div class="form-group">
                <label>Attachments</label>
                <div class="attachment-area" onclick="document.getElementById('fileInput').click()">
                    <i>📎</i>
                    <p>Click to add files or drag and drop them here</p>
                    <input type="file" id="fileInput" style="display: none" multiple>
                </div>
                <div class="attached-files">
                    <div class="file-badge">
                        assignment.pdf
                        <button type="button">&times;</button>
                    </div>
                    <div class="file-badge">
                        schedule.docx
                        <button type="button">&times;</button>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Scheduling</label>
                <div class="schedule-options">
                    <div class="form-check">
                        <input type="radio" id="publishNow" name="schedule" checked>
                        <label for="publishNow">Publish Now</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" id="scheduleLater" name="schedule">
                        <label for="scheduleLater">Schedule for Later</label>
                    </div>
                    <input type="datetime-local" class="form-control" style="width: auto;">
                </div>
            </div>

            <div class="preview-section">
                <div class="preview-header">
                    <h2>Preview</h2>
                    <span class="preview-badge">All Students</span>
                </div>
                <div id="previewContent">
                    <h3>Your announcement preview will appear here...</h3>
                    <p>Start typing in the form above to see how your announcement will look to students.</p>
                </div>
            </div>

            <div class="action-buttons">
                <button type="button" class="btn btn-secondary">Save as Draft</button>
                <button type="submit" class="btn btn-primary">Publish Announcement</button>
            </div>
        </form>
    </div>
</body>

</html>