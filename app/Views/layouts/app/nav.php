
<!-- navbar-->
<header class="bg-white">
<!-- container -->
<div class="container px-lg-3">
<nav class="navbar navbar-expand-lg navbar-light py-3 px-lg-0">
    <!-- navbar-brand -->
    <a href="index.html" class="navbar-brand"><span
            class="fw-bold text-uppercase text-dark">Shopaholic</span></a>
    <!-- navbar-toggler -->

    <a href="#!" class="navbar-toggler navbar-toggler-end collapsed" id="navbar-toggler"><span
            class="navbar-toggler-icon"></span></a>

    <div class="navbar-collapse collapse">
        <!-- navbar-nav -->
        <ul class="navbar-nav me-auto">
            <!-- nav-item -->
            <li class="nav-item">
                <!-- nav-link-->
                <a href="/" class="nav-link active">Home</a>
            </li>
            <li class="nav-item">
                <!-- Link--><a href="/shop" class="nav-link">Shop</a>
            </li>
            <li>
                <!-- Link--><a href="/contact" class="nav-link">Contact</a>
            </li>
        </ul>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a href="/cart" class="nav-link"><i class="fas fa-dolly-flatbed me-1 text-gray"></i>Cart<small
                        class="text-gray fw-normal">(<span id="shopping-cart-value">0</span>)</small></a>
            </li>
            <li class="nav-item"><a href="/wishlist" class="nav-link"><i class="far fa-heart me-1"></i><small
                        class="text-gray fw-normal">(<span id="wish-list-value">0</span>)</small></a>
            </li>
            <?php if(Core\Session::instance()->get('isAuth')):?>
                <li class="nav-item"><a href="/profile" class="nav-link"><i class="fas fa-user me-1 text-gray fw-normal"></i>Profile</a>
                </li>
                <li class="nav-item"><a href="/logout" class="nav-link"><i class="fas fa-user me-1 text-gray fw-normal"></i>Logout</a>
                </li>
                <?php else: ?>
            <li class="nav-item"><a href="/login" class="nav-link"><i
                        class="fas fa-user me-1 text-gray fw-normal"></i>Login</a>
            </li>
            <li class="nav-item"><a href="/register" class="nav-link"><i class="fas fa-user me-1 text-gray fw-normal"></i>Sign Up</a>
            </li>
            <?php endif?>
        </ul>
    </div>
</nav>
</div>
</header>