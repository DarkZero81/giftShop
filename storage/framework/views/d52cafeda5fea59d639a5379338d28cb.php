<?php $__env->startSection('title', isset($selectedCategory) ? $selectedCategory->name : 'Products'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-3">
            <h5>Categories</h5>
            <ul class="list-group">
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('products.index', ['category' => $cat->id])); ?>"
                        class="list-group-item list-group-item-action <?php echo e(isset($selectedCategory) && $selectedCategory->id == $cat->id ? 'active' : ''); ?>"><?php echo e($cat->name); ?></a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>

        <div class="col-md-9">
            <h3 class="mb-4"><?php echo e(isset($selectedCategory) ? $selectedCategory->name : 'All Products'); ?></h3>
            <div class="row">
                <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="col-md-4 mb-4">
                        <?php echo $__env->make('partials.product_card', ['product' => $product], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="col-12">
                        <div class="alert alert-info">No products found.</div>
                    </div>
                <?php endif; ?>
            </div>

            <div class="d-flex justify-content-center">
                <?php echo e($products->links()); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Downloads\ABD\HeavenGift-main\HeavenGift-main\resources\views/products/index.blade.php ENDPATH**/ ?>