<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">administration Productes</h1>
            <a href="<?php echo e(route('admin.products.create')); ?>" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> إضافة منتج جديد
            </a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Productes List</h6>
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

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Photo</th>
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Inventory</th>
                                <th>State</th>
                                <th>Add Time</th>
                                <th>Prcedures</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($product->id); ?></td>
                                    <td>
                                        <?php if($product->image): ?>
                                            <img src="<?php echo e(asset($product->image)); ?>" alt="<?php echo e($product->name); ?>"
                                                class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                                        <?php else: ?>
                                            <div class="bg-light d-flex align-items-center justify-content-center"
                                                style="width: 60px; height: 60px;">
                                                <i class="bi bi-image text-muted"></i>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($product->name); ?></td>
                                    <td>
                                        <?php if($product->category): ?>
                                            <span class="badge text-info text-dark"><?php echo e($product->category->name); ?></span>
                                        <?php else: ?>
                                            <span class="badge badge-secondary text-dark">بدون تصنيف</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>$<?php echo e(number_format($product->price, 2)); ?></td>
                                    <td>
                                        <span
                                            class="badge text-<?php echo e($product->stock > 10 ? 'success' : ($product->stock > 0 ? 'warning' : 'danger')); ?> ">
                                            <?php echo e($product->stock); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <?php if($product->stock > 0): ?>
                                            <span class="badge badge-success text-dark">متوفر</span>
                                        <?php else: ?>
                                            <span class="badge badge-danger text-dark">غير متوفر</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($product->created_at->format('Y-m-d')); ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="<?php echo e(route('products.show', $product)); ?>" class="btn btn-sm btn-info"
                                                target="_blank">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="<?php echo e(route('admin.products.edit', $product)); ?>"
                                                class="btn btn-sm btn-primary">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="<?php echo e(route('admin.products.destroy', $product)); ?>" method="POST"
                                                class="d-inline">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('هل أنت متأكد من حذف هذا المنتج؟')">
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

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    <?php echo e($products->links()); ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Downloads\ABD\HeavenGift-main\HeavenGift-main\resources\views/admin/products/index.blade.php ENDPATH**/ ?>