<?php $__env->startSection('title', 'Cart'); ?>

<?php $__env->startSection('content'); ?>
    <h2>Your Cart</h2>
    <?php if($cart && $cart->items->count()): ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php $total = 0; ?>
                <?php $__currentLoopData = $cart->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $subtotal = $item->price * $item->quantity;
                        $total += $subtotal;
                    ?>
                    <tr>
                        <td><?php echo e($item->product?->name); ?></td>
                        <td>$<?php echo e(number_format($item->price, 2)); ?></td>
                        <td>
                            <form method="POST" action="<?php echo e(route('cart.update', $item->id)); ?>" class="d-flex">
                                <?php echo csrf_field(); ?>
                                <input type="number" name="quantity" value="<?php echo e($item->quantity); ?>" min="1"
                                    class="form-control form-control-sm me-2" style="width:80px">
                                <button class="btn btn-sm btn-secondary">Update</button>
                            </form>
                        </td>
                        <td>$<?php echo e(number_format($subtotal, 2)); ?></td>
                        <td>
                            <form method="POST" action="<?php echo e(route('cart.remove', $item->id)); ?>">
                                <?php echo csrf_field(); ?>
                                <button class="btn btn-sm btn-danger">Remove</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <div class="d-flex justify-content-between align-items-center">
            <div><strong>Total:</strong> $<?php echo e(number_format($total, 2)); ?></div>
            <div>
                <form method="POST" action="<?php echo e(route('cart.clear')); ?>" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <button class="btn btn-outline-danger">Clear Cart</button>
                </form>
                <a href="<?php echo e(route('checkout.index')); ?>" class="btn btn-primary ms-2">Proceed to Checkout</a>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-info">Your cart is empty.</div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Downloads\ABD\HeavenGift-main\HeavenGift-main\resources\views/cart/index.blade.php ENDPATH**/ ?>