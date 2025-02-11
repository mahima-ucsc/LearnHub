<?php include $this->resolve("partials/_header.php"); ?>

<head>
    <link rel="stylesheet" href="/assets/styles/Course/create-course.css">
    <style>
        /* Module Styles */
        .create-course-module {
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
            border: 1px solid #e0e0e0;
            position: relative;
        }


        .create-course-module-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .create-course-module-header h3 {
            font-size: 18px;
            font-weight: 600;
            color: #2c3e50;
        }

        /* Enhanced Button Styles */
        .create-course-add-button,
        .create-course-remove-button,
        .create-course-submit,
        .create-course-back {
            padding: 14px 28px;
            font-size: 16px;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .create-course-add-button {
            background-color: #f0f2f5;
            color: #2c3e50;
            width: 100%;
            margin: 20px 0;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .create-course-add-button:hover {
            background-color: #e9ecef;
            transform: translateY(-2px);
        }

        .create-course-remove-button {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #ff4d4d;
            color: #ffffff;
            font-size: 14px;
            padding: 8px 16px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .create-course-module:hover .create-course-remove-button {
            opacity: 1;
        }

        .create-course-remove-button:hover {
            background-color: #ff3333;
            transform: translateY(-1px);
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            gap: 20px;
        }

        .create-course-back {
            background-color: #e9ecef;
            color: #2c3e50;
            flex: 1;
        }

        .create-course-back:hover {
            background-color: #dee2e6;
            transform: translateY(-2px);
        }

        .create-course-submit {
            background-color: #FFC400;
            flex: 1;
        }

        .create-course-submit:hover {
            background-color: #fad661;
            transform: translateY(-2px);
        }

        /* Error message */
        .error {
            background-color: #ffebee;
            /* Light red background */
            color: #d32f2f;
            /* Dark red text */
            border: 1px solid #f44336;
            /* Red border */
            border-radius: 4px;
            padding: 10px;
            margin-top: 10px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .error::before {
            content: '⚠️';
            /* Warning icon */
            font-size: 18px;
        }


        /* Responsive Design */
        @media (max-width: 768px) {
            .create-course-module {
                padding: 15px;
            }

            .button-container {
                flex-direction: column;
            }

            .create-course-back,
            .create-course-submit {
                width: 100%;
            }
        }
    </style>
</head>

<section class="create-course-container">
    <div class="create-course-header">
        <h1>Add Course Modules</h1>
        <p>Provide detailed information about each module</p>
    </div>

    <form class="create-course-form" id="addModulesForm" enctype="multipart/form-data" method="POST" action="/create-course">
        <div id="modulesContainer">
            <!-- Initial module will be added by JavaScript -->
        </div>

        <button type="button" class="create-course-add-button" onclick="addModule()">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            Add Another Module
        </button>

        <div class="button-container">
            <button type="button" class="create-course-back" onclick="window.history.back()">Back</button>
            <button type="submit" class="create-course-submit">Create Course</button>
        </div>
        <div class="err">
            <?php if ($errors['create_course']): ?>
                <div class="error">
                    <?php echo e($errors['create_course'][0]); ?>
                </div>
            <?php endif; ?>
        </div>
    </form>

    <script>
        let moduleCount = 0;

        // Function to add a new module
        function addModule() {
            const container = document.getElementById('modulesContainer');
            const newModule = document.createElement('div');
            newModule.className = 'create-course-module';
            newModule.dataset.moduleId = moduleCount;

            newModule.innerHTML = `
                <button type="button" class="create-course-remove-button" onclick="removeModule(${moduleCount})">
                    Remove
                </button>
                <div class="create-course-form-group">
                    <label for="module_title_${moduleCount}">Module Title *</label>
                    <input type="text" id="module_title_${moduleCount}" name="modules[${moduleCount}][title]" required>
                </div>
                <div class="create-course-form-group">
                    <label for="module_description_${moduleCount}">Module Description *</label>
                    <textarea id="module_description_${moduleCount}" name="modules[${moduleCount}][description]" required></textarea>
                </div>
            `;

            container.appendChild(newModule);
            moduleCount++;
            updateModuleIndexes();
        }

        // Function to remove a module
        function removeModule(moduleId) {
            const module = document.querySelector(`[data-module-id="${moduleId}"]`);
            if (module && document.querySelectorAll('.create-course-module').length > 1) {
                module.remove();
                updateModuleIndexes();
            } else {
                alert('You must have at least one module!');
            }
        }

        // Function to update module indexes after removal
        function updateModuleIndexes() {
            const modules = document.querySelectorAll('.create-course-module');
            modules.forEach((module, index) => {
                const inputs = module.querySelectorAll('input, textarea');
                inputs.forEach(input => {
                    const nameAttr = input.getAttribute('name');
                    if (nameAttr) {
                        input.setAttribute('name', nameAttr.replace(/\[\d+\]/, `[${index}]`));
                    }
                });
            });
        }

        // Add initial module on page load
        document.addEventListener('DOMContentLoaded', function() {
            addModule();
        });
    </script>
</section>