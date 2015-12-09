
<h2>Entity : <?php echo $name?></h2>
<a href="/entity/list">Entity List</a>

<?php
echo "<table>";
foreach( $list as $entity ) {
    $id = $entity->get('id');
    $created = $entity->get('created');
    $updated = $entity->get('updated');
    echo "
    <tr>
        <td>$id</td>
        <td>$created</td>
        <td>$updated</td>
        <td><a href='/entity/$name/edit/$id'>Edit</a></td>
        <td>Delete</td>
    </tr>
    ";
}
echo "</table>";

widget('navigator_default', [
    'base_url' => "/entity/$name/list",
    'per_page'=> $per_page,
    'total_rows' => $total_rows,
]);
