<link rel="stylesheet" href="/assets/styles/components/pagination.css">

<!-- Pagination -->
<?php if ($pagination['lastPage'] > 1): ?>
    <div class="pagination-course-container">
        <?php if ($pagination['hasPreviousPage']): ?>
            <a href="?<?php echo e($pagination['previousPageQuery']); ?>" class="pagination-btn prev-btn" onclick="showLoader()">
                <i class="fas fa-chevron-left"></i> Previous
            </a>
        <?php endif; ?>

        <div class="page-numbers">
            <?php foreach ($pagination['pages'] as $i => $pageNum): ?>
                <a href="?<?php echo e($pagination['pageLinks'][$i]); ?>"
                    class="<?php echo $pageNum == $pagination['currentPage'] ? 'active-page' : ''; ?>"
                    onclick="showLoader()">
                    <?php echo $pageNum; ?>
                </a>
            <?php endforeach; ?>
        </div>

        <?php if ($pagination['hasNextPage']): ?>
            <a href="?<?php echo e($pagination['nextPageQuery']); ?>" class="pagination-btn next-btn" onclick="showLoader()">
                Next <i class="fas fa-chevron-right"></i>
            </a>
        <?php endif; ?>
    </div>
<?php endif; ?>