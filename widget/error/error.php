<?php if ( ! getError() ) return; ?>
<link rel="stylesheet" href="/widget/error/error.css">
<div class="error">

    <h3>Error</h3>

    <?php
        foreach ( getError() as $message ) {
            echo "<div class='message'>$message</div>";
        }
    ?>

</div>