
<h1>Post Config List</h1>


<?php echo form_open('/post/config/create') ?>
<?php echo form_input('name')?>
<input type="submit">
<?php echo form_close() ?>


<table>
    <tr><th>No.</th><th>Name</th><th>Description</th></tr>
    <?php
    foreach ( post_config()->loadAll() as $config ) {
        $name = $config->get('name');
        echo "<tr>";
        echo "<td><a href='/$name/list'>" . $config->get('id') . "</a></td>";
        echo "<td>$name</td>";
        echo "<td>" . $config->get('description') . "</td>";
        echo "</tr>";
    }
    ?>
</table>

