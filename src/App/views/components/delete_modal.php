<!-- Delete confirmation modal -->
<!-- 
    This is the modal that will be shown when a user attempts to delete an entity (like a course, user, etc.). 
    The modal will ask for confirmation and then submit a form to the specified deletion URL.

    How to use:
    - Include this modal HTML where you want it in your page.
    - Call the JavaScript function `showModal(deleteUrl)` to open the modal and pass the correct URL for deletion.

    Example usage:
        <button onclick="showModal('/manage-course/delete/<?php //echo e($courseData['course_id']) 
                                                            ?>')">Delete Course</button>

        REMOVE // in php statement
-->
<style>
    /* Modal Styles */
    .modal {
        display: none;
        z-index: 1000;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .modal.show {
        display: block;
        opacity: 1;
    }

    .modal-content {
        display: flex;
        flex-direction: column;
        justify-content: center;
        gap: 20px;
        background: #fff;
        padding: 24px;
        width: 90%;
        max-width: 500px;
        border-radius: 12px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
    }

    .modal-content {
        position: absolute;
        top: 25%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        max-width: 90%;
        width: 400px;
    }

    .modal-header {
        margin-bottom: 1.5rem;
    }

    .modal-title {
        font-size: 1.25rem;
        font-weight: bold;
        color: #2d3748;
        margin: 0;
    }

    .modal-body {
        margin-bottom: 1.5rem;
        color: #4a5568;
    }

    .modal-footer {
        display: flex;
        justify-content: flex-end;
        gap: 0.75rem;
    }

    .btn {
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 0.875rem;
        transition: background-color 0.2s;
    }

    .btn-cancel {
        background-color: #e2e8f0;
        color: #4a5568;
    }

    .btn-cancel:hover {
        background-color: #cbd5e0;
    }

    .btn-delete {
        background-color: #e53e3e;
        color: white;
    }

    .btn-delete:hover {
        background-color: #c53030;
    }

    .close {
        position: absolute;
        right: 24px;
        top: 16px;
        font-size: 24px;
        font-weight: bold;
        color: #6c757d;
        cursor: pointer;
    }

    .close:hover {
        color: #2c3e50;
    }

    @media (max-width: 768px) {
        .modal-content {
            margin: 20% auto;
            width: 95%;
            padding: 16px;
        }
    }

    @media (max-width: 480px) {
        .modal-content {
            width: 85%;
            padding: 1.5rem;
        }

        .modal-footer {
            flex-direction: column;
            gap: 0.5rem;
        }

        .btn {
            width: 100%;
        }
    }
</style>
<div id="deleteModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Confirm Delete</h3>
        </div>
        <div class="modal-body">
            Are you sure you want to delete this course? This action cannot be undone.
        </div>
        <div class="modal-footer">
            <button onclick="hideModal()" class="btn btn-cancel">Cancel</button>
            <form id="deleteForm" method="POST">
                <?php include $this->resolve("partials/_csrf.php"); ?>
                <input type="hidden" name="_METHOD" value="DELETE" />
                <button type="submit" class="btn btn-delete">Delete</button>
            </form>
        </div>
    </div>
</div>

<!-- Link to the JavaScript file where the modal logic is defined -->
<script src="/assets/js/modals/delete_modal.js"></script>
<script>
    // JavaScript for handling the dlete modal behavior

    const modal = document.getElementById("deleteModal");

    function showModal(deleteUrl) {
        // Set the form's action to the delete URL passed in
        const deleteForm = document.getElementById("deleteForm");
        deleteForm.action = deleteUrl;

        // Show the modal
        modal.classList.toggle("show");
        document.body.style.overflow = "hidden";
    }

    function hideModal() {
        modal.classList.toggle("show");
        document.body.style.overflow = "auto";
    }

    // Close modal when clicking outside
    // window.onclick = function (event) {
    //   const modal = document.getElementById("deleteModal");
    //   if (event.target === modal) {
    //     hideModal();
    //   }
    // };

    // Close modal on escape key press
    document.addEventListener("keydown", function(event) {
        if (event.key === "Escape") {
            hideModal();
        }
    });
</script>