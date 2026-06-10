<div class="navbar-nav ms-auto">
    <div class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
            <i class="fas fa-user-circle me-2"></i>
            <?php if(auth()->guard()->check()): ?>
                <?php echo e(Auth::user()->name); ?>

            <?php else: ?>
                Admin
            <?php endif; ?>
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="<?php echo e(url('/')); ?>">
                    <i class="fas fa-home me-2"></i>Home
                </a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li>
                <form method="POST" action="<?php echo e(route('logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="dropdown-item">
                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>
</div>
<?php /**PATH C:\Users\USER\Downloads\ABD\HeavenGift-main\HeavenGift-main\resources\views/partials/navbar.blade.php ENDPATH**/ ?>