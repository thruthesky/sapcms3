
<h1>Post Config List</h1>


<?php echo form_open('/post/config/create') ?>
<?php echo form_input('name')?>
<input type="submit">
<?php echo form_close() ?>


<table>
    <tr><th>No.</th><th>Name</th></tr>
    <?php
    foreach ( post_config()->loadAll() as $config ) {
        echo "<tr>";
        echo "<td>" . $config->get('name') . "</td>";
        echo "<td>" . $config->get('description') . "</td>";
        echo "</tr>";
    }
    ?>
</table>

