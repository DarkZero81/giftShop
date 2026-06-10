<?php $__env->startSection('title', 'Users Management'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-users mr-2"></i>
                            Users Management
                        </h3>
                        <div class="card-tools">
                            <a href="<?php echo e(route('admin.users.create')); ?>" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> Add New User
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <?php if($users->count() > 0): ?>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Profile Photo</th>
                                            <th>Orders Count</th>
                                            <th>Joined Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($user->id); ?></td>
                                                <td>
                                                    <strong><?php echo e($user->name); ?></strong>
                                                </td>
                                                <td>
                                                    <a href="mailto:<?php echo e($user->email); ?>" class="text-decoration-none">
                                                        <?php echo e($user->email); ?>

                                                    </a>
                                                </td>
                                                <td>
                                                    <?php if($user->is_admin): ?>
                                                        <span class="badge bg-danger">Administrator</span>
                                                    <?php else: ?>
                                                        <span class="badge bg-info">Customer</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if($user->profile_photo_url): ?>
                                                        <img src="<?php echo e($user->profile_photo_url); ?>" alt="Profile Photo"
                                                            class="rounded-circle" width="40" height="40">
                                                    <?php else: ?>
                                                        <div class="bg-secondary rounded-circle d-inline-flex align-items-center justify-content-center"
                                                            style="width: 40px; height: 40px;">
                                                            <i class="fas fa-user text-white"></i>
                                                        </div>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if($user->discount_percent): ?>
                                                        <span class="badge bg-success"><?php echo e($user->discount_percent); ?>%</span>
                                                    <?php else: ?>
                                                        <span class="text-muted">No discount</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <small class="text-muted">
                                                        <?php echo e($user->created_at->format('M j, Y')); ?>

                                                    </small>
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="<?php echo e(route('admin.users.show', $user->id)); ?>"
                                                            class="btn btn-sm btn-info">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="<?php echo e(route('admin.users.edit', $user->id)); ?>"
                                                            class="btn btn-sm btn-warning">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <?php if($user->id !== auth()->id()): ?>
                                                            <button type="button" class="btn btn-sm btn-danger"
                                                                onclick="deleteUser(<?php echo e($user->id); ?>)">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-3">
                                <?php echo e($users->links()); ?>

                            </div>
                        <?php else: ?>
                            <div class="text-center py-5">
                                <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                <h4 class="text-muted">No users found</h4>
                                <p class="text-muted">When users register, they will appear here.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Deletion</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this user? This action cannot be undone.</p>
                    <div class="alert alert-warning">
                        <strong>Warning:</strong> Deleting a user will also remove all their associated data (orders, cart
                        items, etc.).
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Delete User</button>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        let userToDelete = null;

        function deleteUser(id) {
            userToDelete = id;
            $('#deleteUserModal').modal('show');
        }

        $('#confirmDelete').click(function() {
            if (userToDelete) {
                // Create and submit a form for deletion
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/admin/users/${userToDelete}`;

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

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Downloads\ABD\HeavenGift-main\HeavenGift-main\resources\views/admin/users/index.blade.php ENDPATH**/ ?>