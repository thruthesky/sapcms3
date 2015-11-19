<?php
$data = $this->data;
$users = $data['users'];
?>

<h1>User List</h1>
<table cellpadding=0 cellspacing=0 width='100%'>
<tr>
	<td>ID</td>
	<td>USER NAME</td>
	<td>FIRST NAME</td>
	<td>Edit</td>
	<td>Delete</td>
</tr>
<?php
foreach( $users as $user ){
?>
	<tr>
		<td><?php echo $user->record['id']; ?></td>
		<td><?php echo $user->record['username']; ?></td>
		<td><?php echo $user->record['first_name']; ?></td>
		<td><a href='/user/edit/<?php echo $user->record['id']; ?>'>Edit</a></td>
		<td><a href='/user/delete/<?php echo $user->record['id']; ?>'>Delete</a></td>
	</tr>
<?php
}
?>
</table>