<!-- navbar -->
<link rel = "stylesheet" href="main.css">
<div class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container">


        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li>
                    <div class="navbar-header">
            <a class="navbar-brand">Movie Mania</a>

        </div>
                </li>
                <li <?php echo $page_title=="movies" ? "class='active'" : ""; ?> >
                    <a href="movies.php">Movies</a>
                </li>
                <li <?php echo $page_title=="Cart" ? "class='active'" : ""; ?> >
                    <a href="cart.php">
                        <?php
                        // count products in cart
                        $cart_count=count($_SESSION['cart_items']);
                        ?>
                        Cart <span class="badge" id="comparison-count"><?php echo $cart_count; ?></span>
                    </a>
                </li>
            </ul>
        </div><!--/.nav-collapse -->

    </div>
</div>
<!-- /navbar -->