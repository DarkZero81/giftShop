<?php if($paginator->hasPages()): ?>
    <?php
        $current = $paginator->currentPage();
        $last = $paginator->lastPage();
        $window = 2; // pages on either side of current
        $start = max(1, $current - $window);
        $end = min($last, $current + $window);
        $queryParams = request()->except('page');
    ?>

    <nav role="navigation" aria-label="Pagination Navigation" class="d-flex flex-column align-items-center w-100">
        <style>
            /* pill-style pagination */
            .pagination .page-link {
                border-radius: 999rem;
                padding-left: 0.6rem;
                padding-right: 0.6rem;
            }

            /* hide page numbers on very small screens to keep layout compact */
            @media (max-width: 480px) {
                .pagination .page-number {
                    display: none;
                }

                .pagination .page-link.current-visible {
                    display: inline-block;
                }
            }
        </style>

        <ul class="pagination pagination-sm mb-0">
            
            <?php if($current == 1): ?>
                <li class="page-item disabled"><span class="page-link">« First</span></li>
            <?php else: ?>
                <li class="page-item"><a class="page-link"
                        href="<?php echo e($paginator->url(1)); ?><?php echo e(http_build_query($queryParams) ? (strpos($paginator->url(1), '?') === false ? '?' : '&') . http_build_query($queryParams) : ''); ?>"
                        rel="first">« First</a></li>
            <?php endif; ?>

            
            <?php if($paginator->onFirstPage()): ?>
                <li class="page-item disabled"><span class="page-link" aria-hidden="true"><i
                            class="bi bi-chevron-left"></i></span></li>
            <?php else: ?>
                <li class="page-item"><a class="page-link" href="<?php echo e($paginator->previousPageUrl()); ?>" rel="prev"
                        aria-label="Previous"><i class="bi bi-chevron-left"></i></a></li>
            <?php endif; ?>

            
            <?php if($start > 1): ?>
                <li class="page-item page-number"><a class="page-link" href="<?php echo e($paginator->url(1)); ?>">1</a></li>
                <?php if($start > 2): ?>
                    <li class="page-item disabled page-number"><span class="page-link">…</span></li>
                <?php endif; ?>
            <?php endif; ?>

            <?php for($page = $start; $page <= $end; $page++): ?>
                <?php if($page == $current): ?>
                    <li class="page-item active" aria-current="page"><span
                            class="page-link current-visible"><?php echo e($page); ?></span></li>
                <?php else: ?>
                    <li class="page-item page-number"><a class="page-link"
                            href="<?php echo e($paginator->url($page)); ?>"><?php echo e($page); ?></a></li>
                <?php endif; ?>
            <?php endfor; ?>

            <?php if($end < $last): ?>
                <?php if($end < $last - 1): ?>
                    <li class="page-item disabled page-number"><span class="page-link">…</span></li>
                <?php endif; ?>
                <li class="page-item page-number"><a class="page-link"
                        href="<?php echo e($paginator->url($last)); ?>"><?php echo e($last); ?></a></li>
            <?php endif; ?>

            
            <?php if($paginator->hasMorePages()): ?>
                <li class="page-item"><a class="page-link" href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next"
                        aria-label="Next"><i class="bi bi-chevron-right"></i></a></li>
            <?php else: ?>
                <li class="page-item disabled"><span class="page-link" aria-hidden="true"><i
                            class="bi bi-chevron-right"></i></span></li>
            <?php endif; ?>

            
            <?php if($current == $last): ?>
                <li class="page-item disabled"><span class="page-link">Last »</span></li>
            <?php else: ?>
                <li class="page-item"><a class="page-link" href="<?php echo e($paginator->url($last)); ?>">Last »</a></li>
            <?php endif; ?>
        </ul>

        <div class="d-flex align-items-center gap-3 mt-2">
            <div class="small text-muted">Page <?php echo e($current); ?> of <?php echo e($last); ?> — <?php echo e($paginator->total()); ?>

                results</div>

            <!-- Jump to page form -->
            <form method="GET" class="d-inline-flex align-items-center" style="gap:.5rem;"
                action="<?php echo e(request()->url()); ?>">
                <?php $__currentLoopData = request()->except('page'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <input type="hidden" name="<?php echo e($key); ?>" value="<?php echo e($value); ?>">
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <label for="goto_page" class="visually-hidden">Go to page</label>
                <input id="goto_page" name="page" type="number" min="1" max="<?php echo e($last); ?>"
                    class="form-control form-control-sm" style="width:5.5rem;" placeholder="#" />
                <button type="submit" class="btn btn-sm btn-outline-primary">Go</button>
            </form>
        </div>
    </nav>
<?php endif; ?>
<?php /**PATH C:\Users\USER\Downloads\ABD\HeavenGift-main\HeavenGift-main\resources\views/vendor/pagination/custom.blade.php ENDPATH**/ ?>