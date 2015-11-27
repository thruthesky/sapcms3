<?php
if ( ! getError() ) return;
widget_css();
?>

<section class="error alert alert-danger" role="alert">

    <div class="title">Error</div>

    <?php
        foreach ( getError() as $message ) {
            echo "<div class='message'>$message</div>";
        }
    ?>

</section>