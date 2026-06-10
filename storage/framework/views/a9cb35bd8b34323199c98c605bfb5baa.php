<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Category Management</h1>
            <a href="<?php echo e(route('admin.categories.create')); ?>" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Add New Category
            </a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">قائمة التصنيفات</h6>
                <div class="d-flex align-items-center" aria-hidden="false">
                    <?php
                        $baseParams = request()->except(['page']);
                    ?>
                    <a href="<?php echo e(route('admin.categories.index', array_merge($baseParams, []))); ?>"
                        class="text-decoration-none" aria-label="Show all categories">
                        <span class="badge bg-secondary me-2 <?php echo e(request()->has('is_active') ? '' : 'fw-bold'); ?>"
                            data-bs-toggle="tooltip" title="Show all categories">Total:
                            <?php echo e($total ?? $categories->total()); ?></span>
                    </a>
                    <a href="<?php echo e(route('admin.categories.index', array_merge($baseParams, ['is_active' => 1]))); ?>"
                        class="text-decoration-none" aria-label="Show active categories">
                        <span class="badge bg-success me-2 <?php echo e(request('is_active') === '1' ? 'fw-bold' : ''); ?>"
                            data-bs-toggle="tooltip" title="Show only active categories">Active:
                            <?php echo e($activeCount ?? 0); ?></span>
                    </a>
                    <a href="<?php echo e(route('admin.categories.index', array_merge($baseParams, ['is_active' => 0]))); ?>"
                        class="text-decoration-none" aria-label="Show inactive categories">
                        <span class="badge bg-danger <?php echo e(request('is_active') === '0' ? 'fw-bold' : ''); ?>"
                            data-bs-toggle="tooltip" title="Show only inactive categories">Inactive:
                            <?php echo e($inactiveCount ?? 0); ?></span>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <?php if(session('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo e(session('success')); ?>

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <!-- Per-page selector -->
                        <form method="GET" class="form-inline" id="perPageForm" aria-label="Items per page form">
                            <?php $__currentLoopData = request()->except(['per_page', 'page']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <input type="hidden" name="<?php echo e($key); ?>" value="<?php echo e($value); ?>">
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <label for="per_page" class="mr-2">Items per page:</label>
                            <select name="per_page" id="per_page" class="form-control form-control-sm mr-2"
                                onchange="document.getElementById('perPageForm').submit()"
                                aria-label="Select items per page">
                                <?php $__currentLoopData = [10, 20, 50, 100]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($n); ?>"
                                        <?php echo e(request('per_page', 20) == $n ? 'selected' : ''); ?>><?php echo e($n); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </form>
                    </div>
                    <div>
                        <!-- Clear filters button -->
                        <?php if(request()->query()): ?>
                            <a href="<?php echo e(route('admin.categories.index')); ?>" class="btn btn-sm btn-outline-secondary"
                                title="Clear filters">Clear filters</a>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Photo</th>
                                <th>Category Name</th>
                                <th>Product Amount</th>
                                <th>State</th>
                                <th>Add Date</th>
                                <th>Prcedures</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($category->id); ?></td>
                                    <td>
                                        <?php if($category->image): ?>
                                            <img src="<?php echo e(asset('https://img.icons8.com/fluency/48/' . $category->name)); ?>"
                                                alt="<?php echo e($category->name); ?>" class="img-thumbnail "
                                                style="width: 60px; height: 60px; object-fit: cover;">
                                        <?php else: ?>
                                            <div class="bg-light d-flex align-items-center justify-content-center"
                                                style="width: 80px; height: 80px;">
                                                <i class="bi bi-<?php echo e($category->name); ?> fs-1" style="color: #1976d2 "></i>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($category->name); ?></td>
                                    <td><?php echo e($category->products_count ?? 0); ?></td>
                                    <td>
                                        <?php if($category->is_active): ?>
                                            <span class="badge text-success">Active</span>
                                        <?php else: ?>
                                            <span class="badge text-danger">Not Active</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($category->created_at->format('Y-m-d')); ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="<?php echo e(route('admin.categories.edit', $category)); ?>"
                                                class="btn btn-sm btn-primary">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="<?php echo e(route('admin.categories.destroy', $category)); ?>"
                                                method="POST" class="d-inline">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('هل أنت متأكد من حذف هذا التصنيف؟')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination and summary -->
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div>
                        <?php if($categories->total() > 0): ?>
                            <p class="mb-0 text-muted">Showing
                                <?php echo e($categories->firstItem()); ?>&ndash;<?php echo e($categories->lastItem()); ?> of
                                <?php echo e($categories->total()); ?></p>
                        <?php else: ?>
                            <p class="mb-0 text-muted">No categories found.</p>
                        <?php endif; ?>
                    </div>
                    <div>
                        <nav aria-label="Categories pagination">
                            <?php echo e($categories->links('vendor.pagination.custom')); ?>

                        </nav>
                    </div>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        try {
                            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                            if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
                                tooltipTriggerList.forEach(function(el) {
                                    new bootstrap.Tooltip(el);
                                });
                            }
                        } catch (e) {
                            // ignore if bootstrap isn't available
                            console && console.debug && console.debug('Tooltip init skipped', e);
                        }
                    });
                </script>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Downloads\ABD\HeavenGift-main\HeavenGift-main\resources\views/admin/categories/index.blade.php ENDPATH**/ ?>