<div class="main-menu">
    <img src="/tmp/logo.png">
    <a href="/">Home</a>

    <?php if ( login() ) { ?>
        (
        <?php echo login('username')?>
        |
        <a href="/user/logout">Logout</a>
        )
    <?php } else { ?>
        <a href="/user/login">Login</a>
    <?php } ?>

    <span class="slide-menu-button">MENU</span>

</div>
