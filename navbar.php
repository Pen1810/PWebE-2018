<?php
session_start();
?>
<ul>
    <li><a href="index.php" class="smoothScroll">Home</a></li>
    <li><a href="shop.php" class="smoothScroll">Shop</a></li>
    <li><a href="#about" class="smoothScroll">About</a></li>
        <?php
    if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
        ?>
    <li style="float:right">
        <div class="dropdown">
            <button style="padding: 10px" data-toggle="dropdown" type="button" class="btn btn-link dropdown-toggle">
                <img src="<?php echo $_SESSION['profpic']; ?>" style="height: 22px; width: auto; margin: 0">
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#">item1</a>
                <a class="dropdown-item" href="#">item2</a>
            </div>
        </div>
    </li>
    <li style="float:right; margin: 11px"><?php echo $_SESSION['username']; ?></li>
    <?php
    if ($_SESSION['role'] == 1) {
        echo "<li style='float:right'><a href='admin'>Admin Page</a></li>";
    }
    elseif ($_SESSION['rule'] == 2) {
        echo "<li style='float:right'><a href='seller'>Seller Page</a></li>";
    }
    ?>
</ul>

<?php
}
else {
    ?>
    <li style="float:right"><a href="signup.php" class="smoothScroll">Sign up</a></li>
    <li style="float:right"><a href="signin.php" class="smoothScroll">Sign in</a></li>
</ul>
<?php
}
?>
