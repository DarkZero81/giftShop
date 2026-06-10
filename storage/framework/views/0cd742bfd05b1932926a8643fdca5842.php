<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">إدارة الطلبات</h1>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">قائمة الطلبات</h6>
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
                                <th>رقم الطلب</th>
                                <th>العميل</th>
                                <th>البريد الإلكتروني</th>
                                <th>الهاتف</th>
                                <th>الإجمالي</th>
                                <th>الحالة</th>
                                <th>التاريخ</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>#<?php echo e($order->id); ?></td>
                                    <td><?php echo e($order->customer_name); ?></td>
                                    <td><?php echo e($order->customer_email); ?></td>
                                    <td><?php echo e($order->customer_phone); ?></td>
                                    <td>$<?php echo e(number_format($order->total, 2)); ?></td>
                                    <td>
                                        <?php
                                            $statusColors = [
                                                'pending' => 'warning',
                                                'processing' => 'info',
                                                'shipped' => 'primary',
                                                'delivered' => 'success',
                                                'cancelled' => 'danger',
                                            ];
                                        ?>
                                        <span class="badge text-<?php echo e($statusColors[$order->status] ?? 'secondary'); ?>">
                                            <?php echo e($order->status); ?>

                                        </span>
                                    </td>
                                    <td><?php echo e($order->created_at->format('Y-m-d H:i')); ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="<?php echo e(route('admin.orders.show', $order)); ?>"
                                                class="btn btn-sm btn-primary">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-info" data-toggle="modal"
                                                data-target="#statusModal<?php echo e($order->id); ?>">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Status Modal -->
                                <div class="modal fade" id="statusModal<?php echo e($order->id); ?>" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form action="<?php echo e(route('admin.orders.updateStatus', $order)); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <div class="modal-header">
                                                    <h5 class="modal-title">تغيير حالة الطلب #<?php echo e($order->id); ?></h5>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>الحالة الحالية:
                                                            <strong><?php echo e($order->status); ?></strong></label>
                                                        <select name="status" class="form-control" required>
                                                            <option value="pending"
                                                                <?php echo e($order->status == 'pending' ? 'selected' : ''); ?>>معلق
                                                            </option>
                                                            <option value="processing"
                                                                <?php echo e($order->status == 'processing' ? 'selected' : ''); ?>>قيد
                                                                المعالجة</option>
                                                            <option value="shipped"
                                                                <?php echo e($order->status == 'shipped' ? 'selected' : ''); ?>>تم
                                                                الشحن</option>
                                                            <option value="delivered"
                                                                <?php echo e($order->status == 'delivered' ? 'selected' : ''); ?>>تم
                                                                التسليم</option>
                                                            <option value="cancelled"
                                                                <?php echo e($order->status == 'cancelled' ? 'selected' : ''); ?>>ملغى
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">إلغاء</button>
                                                    <button type="submit" class="btn btn-primary">تحديث الحالة</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    <?php echo e($orders->links()); ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Downloads\ABD\HeavenGift-main\HeavenGift-main\resources\views/admin/orders/index.blade.php ENDPATH**/ ?>