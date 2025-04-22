<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Your Interests | LearnHub</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f9f9f9;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 800px;
            overflow: hidden;
        }

        .header {
            padding: 30px;
            text-align: center;
        }

        h1 {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 10px;
            color: #222;
        }

        p {
            color: #666;
            line-height: 1.6;
        }

        .accent {
            color: #ffc400;
        }

        .subjects-container {
            padding: 0 30px 20px;
        }

        .subjects-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 16px;
            margin-bottom: 30px;
        }

        .subject-card {
            border: 2px solid #eaeaea;
            border-radius: 8px;
            padding: 16px;
            cursor: pointer;
            transition: all 0.2s ease;
            position: relative;
            overflow: hidden;
        }

        .subject-card:hover {
            border-color: #ffc400;
            transform: translateY(-3px);
        }

        .subject-card.selected {
            border-color: #ffc400;
            background-color: rgba(255, 196, 0, 0.1);
        }

        .subject-card.selected::before {
            content: '✓';
            position: absolute;
            top: 8px;
            right: 8px;
            background-color: #ffc400;
            color: white;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: bold;
        }

        .subject-name {
            font-weight: 500;
            margin-bottom: 5px;
        }

        .subject-count {
            font-size: 12px;
            color: #888;
        }

        .footer {
            display: flex;
            justify-content: space-between;
            padding: 20px 30px;
            border-top: 1px solid #eaeaea;
            background-color: #fcfcfc;
        }

        button {
            padding: 12px 24px;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 15px;
        }

        .btn-skip {
            background-color: transparent;
            border: 1px solid #ddd;
            color: #666;
        }

        .btn-skip:hover {
            background-color: #f5f5f5;
            color: #333;
        }

        .btn-continue {
            background-color: #ffc400;
            border: none;
            color: #333;
        }

        .btn-continue:hover {
            background-color: #e6b000;
            box-shadow: 0 4px 12px rgba(255, 196, 0, 0.3);
        }

        .selected-count {
            background-color: rgba(255, 196, 0, 0.2);
            padding: 8px 16px;
            border-radius: 20px;
            display: inline-block;
            margin-bottom: 20px;
            font-size: 14px;
            font-weight: 500;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Choose Your <span class="accent">Interests</span></h1>
            <p>Select subjects you're interested in to personalize your learning experience.</p>
        </div>

        <div class="subjects-container">
            <div class="selected-count">
                <span id="selected-number">0</span> subjects selected
            </div>

            <div class="subjects-grid" id="subjects-grid">
                <?php foreach ($subjects as $subject): ?>
                    <div class="subject-card" data-id="<?= e($subject['subject_id']); ?>">
                        <div class="subject-name"><?= e($subject['subject_title']); ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="footer">
            <button class="btn-skip" onclick="location.href='/dashboard'">Skip</button>
            <button class="btn-continue" id="continue-btn">Continue</button>
        </div>
    </div>

    <script>
        let selectedSubjects = [];
        const selectedCount = document.getElementById('selected-number');

        // Add click event listeners to all subject cards
        document.querySelectorAll('.subject-card').forEach(card => {
            card.addEventListener('click', () => {
                const subjectId = card.getAttribute('data-id');
                toggleSubject(card, subjectId);
            });
        });

        function toggleSubject(card, id) {
            card.classList.toggle('selected');

            if (card.classList.contains('selected')) {
                selectedSubjects.push(id);
            } else {
                selectedSubjects = selectedSubjects.filter(subjectId => subjectId !== id);
            }

            selectedCount.textContent = selectedSubjects.length;
        }

        document.getElementById('continue-btn').addEventListener('click', () => {
            if (selectedSubjects.length > 0) {
                fetch('/interest', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            interests: selectedSubjects
                        })
                    })
                    .then(response => {
                        if (response.ok) {
                            window.location.href = '/dashboard';
                        }
                    })
                    .catch(error => {
                        console.error('Error submitting interests:', error);
                    });
            } else {
                // If no subjects selected, just go to dashboard
                window.location.href = '/dashboard';
            }
        });
    </script>
</body>

</html>