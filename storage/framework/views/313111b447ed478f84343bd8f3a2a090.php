<?php $__env->startSection('title', 'Payments Management'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-credit-card mr-2"></i>
                            Payments Management
                        </h3>
                        <div class="card-tools">
                            <a href="<?php echo e(route('admin.payments.create')); ?>" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> Add New Payment
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <?php if($payments->count() > 0): ?>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Payment Intent ID</th>
                                            <th>Amount</th>
                                            <th>Currency</th>
                                            <th>Status</th>
                                            <th>Email</th>
                                            <th>Order ID</th>
                                            <th>Created At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($payment->id); ?></td>
                                                <td>
                                                    <code
                                                        class="text-muted"><?php echo e($payment->payment_intent_id ?? 'N/A'); ?></code>
                                                </td>
                                                <td>
                                                    <strong class="text-success">
                                                        $<?php echo e(number_format($payment->amount, 2)); ?>

                                                    </strong>
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge badge-secondary"><?php echo e(strtoupper($payment->currency)); ?></span>
                                                </td>
                                                <td>
                                                    <?php if($payment->status === 'succeeded'): ?>
                                                        <span class="badge bg-success">Succeeded</span>
                                                    <?php elseif($payment->status === 'pending'): ?>
                                                        <span class="badge bg-warning">Pending</span>
                                                    <?php elseif($payment->status === 'failed'): ?>
                                                        <span class="badge bg-danger">Failed</span>
                                                    <?php else: ?>
                                                        <span class="badge bg-info"><?php echo e(ucfirst($payment->status)); ?></span>
                                                    <?php endif; ?>
                                                </td>
                                                <td><?php echo e($payment->email ?? 'N/A'); ?></td>
                                                <td>
                                                    <?php if($payment->order_id): ?>
                                                        <a href="<?php echo e(route('admin.orders.show', $payment->order_id)); ?>"
                                                            class="btn btn-sm btn-outline-info">
                                                            Order #<?php echo e($payment->order_id); ?>

                                                        </a>
                                                    <?php else: ?>
                                                        <span class="text-muted">N/A</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td><?php echo e($payment->created_at->format('M j, Y g:i A')); ?></td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="<?php echo e(route('admin.payments.show', $payment->id)); ?>"
                                                            class="btn btn-sm btn-info">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                            onclick="deletePayment(<?php echo e($payment->id); ?>)">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-3">
                                <?php echo e($payments->links()); ?>

                            </div>
                        <?php else: ?>
                            <div class="text-center py-5">
                                <i class="fas fa-credit-card fa-3x text-muted mb-3"></i>
                                <h4 class="text-muted">No payments found</h4>
                                <p class="text-muted">When payments are made, they will appear here.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deletePaymentModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Deletion</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this payment record? This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        let paymentToDelete = null;

        function deletePayment(id) {
            paymentToDelete = id;
            $('#deletePaymentModal').modal('show');
        }

        $('#confirmDelete').click(function() {
            if (paymentToDelete) {
                // Create and submit a form for deletion
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/admin/payments/${paymentToDelete}`;

                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '<?php echo e(csrf_token()); ?>';

                const methodField = document.createElement('input');
                methodField.type = 'hidden';
                methodField.name = '_method';
                methodField.value = 'DELETE';

                form.appendChild(csrfToken);
                form.appendChild(methodField);
                document.body.appendChild(form);
                form.submit();
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Downloads\ABD\HeavenGift-main\HeavenGift-main\resources\views/admin/payments/index.blade.php ENDPATH**/ ?>