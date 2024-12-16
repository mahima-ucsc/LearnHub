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