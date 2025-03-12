<?php include $this->resolve("partials/_header.php"); ?>
<link rel="stylesheet" href="/assets/styles/components/toast.css">


<style>
    :root {
        --theme-color: #FFC400;
        --theme-dark: #e6b000;
        --theme-light: #ffd54f;
        --theme-ultra-light: #fff8e1;
        --dark-text: #333333;
        --light-text: #666666;
        --lightest-text: #999999;
        --background: #f9f9f9;
        --white: #ffffff;
        --shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        --border-radius: 12px;
        --input-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
        --transition: all 0.3s ease;
    }


    .main-post-container {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .btn {
        background-color: transparent;
        border: none;
        padding: 14px 28px;
        border-radius: var(--border-radius);
        cursor: pointer;
        font-weight: 600;
        transition: var(--transition);
        font-size: 16px;
        letter-spacing: 0.5px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .btn i {
        margin-right: 8px;
    }

    .btn-primary {
        background-color: var(--theme-color);
        color: var(--dark-text);
    }

    .btn-primary:hover {
        background-color: var(--theme-dark);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 196, 0, 0.3);
    }

    /* Main Content */
    .page-title {
        text-align: center;
        margin: 30px 0 50px;
    }

    .page-title h2 {
        font-size: 38px;
        color: var(--dark-text);
        font-weight: 700;
        margin-bottom: 12px;
    }

    .page-title p {
        font-size: 18px;
        color: var(--light-text);
        max-width: 600px;
        margin: 0 auto;
    }

    /* Post Form */
    .post-container {
        background-color: var(--white);
        border-radius: var(--border-radius);
        box-shadow: var(--shadow);
        padding: 40px;
        margin-bottom: 60px;
        position: relative;
        overflow: hidden;
    }

    .post-container:before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 6px;
        background: var(--theme-color);
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-group label {
        display: block;
        margin-bottom: 10px;
        font-weight: 600;
        color: var(--dark-text);
        font-size: 15px;
    }

    .form-control {
        width: 100%;
        padding: 16px 20px;
        border: 1px solid #e0e0e0;
        border-radius: var(--border-radius);
        font-size: 16px;
        transition: var(--transition);
        box-shadow: var(--input-shadow);
        background-color: #fafafa;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--theme-color);
        background-color: var(--white);
        box-shadow: 0 0 0 3px rgba(255, 196, 0, 0.15);
    }

    .form-control::placeholder {
        color: var(--lightest-text);
    }

    select.form-control {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%23666666' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 16px center;
        padding-right: 45px;
    }

    .rich-editor {
        border: 1px solid #e0e0e0;
        border-radius: var(--border-radius);
        overflow: hidden;
        box-shadow: var(--input-shadow);
        background-color: #fafafa;
        transition: var(--transition);
    }

    .rich-editor:focus-within {
        border-color: var(--theme-color);
        box-shadow: 0 0 0 3px rgba(255, 196, 0, 0.15);
        background-color: var(--white);
    }

    .toolbar {
        display: flex;
        background-color: #f1f1f1;
        padding: 12px 15px;
        border-bottom: 1px solid #e0e0e0;
        flex-wrap: wrap;
        gap: 5px;
    }

    .toolbar button {
        background-color: transparent;
        border: none;
        padding: 8px 14px;
        cursor: pointer;
        border-radius: 6px;
        transition: var(--transition);
        color: var(--dark-text);
    }

    .toolbar button:hover {
        background-color: var(--theme-ultra-light);
    }

    .toolbar button.active {
        background-color: var(--theme-light);
    }

    .editor-content {
        padding: 20px;
        min-height: 220px;
        outline: none;
        background-color: inherit;
    }

    /* Recent Posts */
    .recent-posts {
        margin-top: 60px;
    }

    .recent-posts h2 {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 25px;
        position: relative;
        padding-bottom: 12px;
    }

    .recent-posts h2:after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 4px;
        background-color: var(--theme-color);
        border-radius: 10px;
    }

    .post-list {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 30px;
    }

    .post-card {
        background-color: var(--white);
        border-radius: var(--border-radius);
        box-shadow: var(--shadow);
        overflow: hidden;
        transition: var(--transition);
        border: 1px solid rgba(0, 0, 0, 0.03);
    }

    .post-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }

    .post-card-header {
        background-color: var(--theme-color);
        color: var(--dark-text);
        padding: 20px;
        position: relative;
    }

    .post-card-header h3 {
        font-size: 20px;
        margin-bottom: 10px;
        font-weight: 700;
    }

    .post-meta {
        display: flex;
        justify-content: space-between;
        font-size: 14px;
        color: var(--dark-text);
        opacity: 0.9;
        font-weight: 500;
    }

    .post-meta span {
        display: flex;
        align-items: center;
    }

    .post-meta i {
        margin-right: 5px;
    }

    .post-card-body {
        padding: 20px;
    }

    .post-content {
        margin-bottom: 15px;
        font-size: 15px;
        color: var(--light-text);
        max-height: 120px;
        overflow: hidden;
        position: relative;
    }

    .post-content:after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 40px;
        background: linear-gradient(rgba(255, 255, 255, 0), rgba(255, 255, 255, 1));
    }

    .post-card-footer {
        display: flex;
        justify-content: space-between;
        padding: 15px 20px;
        border-top: 1px solid #eee;
        color: var(--lightest-text);
        font-size: 14px;
    }

    /* Tags */
    .tag {
        display: inline-block;
        padding: 5px 12px;
        font-size: 12px;
        font-weight: 600;
        border-radius: 20px;
        background-color: var(--theme-ultra-light);
        color: var(--dark-text);
        margin-right: 8px;
    }

    /* Button with icon */
    .icon-btn {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .icon-btn i {
        margin-right: 8px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .post-list {
            grid-template-columns: 1fr;
        }

        .post-container {
            padding: 30px 20px;
        }

        .page-title h2 {
            font-size: 30px;
        }

        .page-title p {
            font-size: 16px;
        }
    }
</style>

<main>
    <div class="main-post-container">
        <div class="page-title">
            <h2>Post Your Course Requirements</h2>
            <p>Can't find the course you need? Let our teachers know what you're looking for.</p>
        </div>

        <div class="post-container">
            <form id="requirementForm">
                <div class="form-group">
                    <label for="postTitle">Course Title</label>
                    <input type="text" id="postTitle" class="form-control" placeholder="What course are you looking for?" required>
                </div>

                <div class="form-group">
                    <label for="postContent">Course Description</label>
                    <div class="rich-editor">
                        <div class="toolbar">
                            <button type="button" id="bold" title="Bold"><i class="fas fa-bold"></i></button>
                            <button type="button" id="italic" title="Italic"><i class="fas fa-italic"></i></button>
                            <button type="button" id="underline" title="Underline"><i class="fas fa-underline"></i></button>
                            <button type="button" id="bullet" title="Bullet List"><i class="fas fa-list-ul"></i></button>
                            <button type="button" id="number" title="Numbered List"><i class="fas fa-list-ol"></i></button>
                        </div>
                        <div class="editor-content" id="editor" contenteditable="true" placeholder="Describe what you're looking to learn..."></div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="category">Course Category</label>
                    <select id="category" class="form-control" required>
                        <option value="">Select a category</option>
                        <option value="programming">Programming & Development</option>
                        <option value="design">Design & Creative</option>
                        <option value="business">Business & Finance</option>
                        <option value="marketing">Marketing & Communications</option>
                        <option value="languages">Languages</option>
                        <option value="academic">Academic & Science</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="budget">Budget Range</label>
                    <div style="display: flex; gap: 15px; align-items: center;">
                        <div style="flex: 1;">
                            <input type="number" id="budgetMin" class="form-control" placeholder="Min ($)" min="0" step="1">
                        </div>
                        <span style="font-weight: 500;">to</span>
                        <div style="flex: 1;">
                            <input type="number" id="budgetMax" class="form-control" placeholder="Max ($)" min="0" step="1">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary icon-btn">
                        <i class="fas fa-paper-plane"></i> Post Requirement
                    </button>
                </div>
            </form>
        </div>
</main>
<script src="/assets/js/components/toast.js"></script>


<script>
    // Simple rich text editor functionality
    document.querySelectorAll('.toolbar button').forEach(button => {
        button.addEventListener('click', function() {
            let command = this.id;
            if (command === 'bullet') {
                document.execCommand('insertUnorderedList', false, null);
            } else if (command === 'number') {
                document.execCommand('insertOrderedList', false, null);
            } else {
                document.execCommand(command, false, null);
            }
            this.classList.toggle('active');
        });
    });

    // Form submission
    document.getElementById('requirementForm').addEventListener('submit', function(e) {
        e.preventDefault();

        // Get all form values
        const formData = {
            title: document.getElementById('postTitle').value,
            description: document.getElementById('editor').innerHTML,
            category: document.getElementById('category').value,
            budgetMin: document.getElementById('budgetMin').value,
            budgetMax: document.getElementById('budgetMax').value
        };

        // Send POST request to the server
        fetch('/course/request/create', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(formData)
            })
            .then(response => {
                if (response.ok) {
                    showToast('Post Submitted', 'The post has been submitted successfully.', 'success');
                    return response.json();
                }
                throw new Error('Network response was not ok');
            })
            .then(data => {
                // Optional: redirect or clear form after successful submission
                // window.location.href = '/course/requests';
                // document.getElementById('requirementForm').reset();
                console.log(data);

            })
            .catch(error => {
                console.error('Error:', error);
                alert('There was a problem submitting your request. Please try again.');
            });
    });
</script>

<?php include $this->resolve("partials/_footer.php"); ?>