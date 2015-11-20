<?php
$data = $this->data;
$users = $data['users'];
?>

<h1>User List</h1>



<?php echo form_open('/user/list')?>

<input name="keyword" value="<?php echo set_value('keyword')?>">
<input type="submit">

</form>


No of Users.: <?php echo $this->data['total_row']?>


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
		<td><?php echo $user->get('id'); ?></td>
		<td><?php echo $user->get('username'); ?></td>
		<td><?php echo $user->get('first_name'); ?></td>
		<td><a href='/user/edit/<?php echo $user->get('id'); ?>'>Edit</a></td>
		<td><a href='/user/delete/<?php echo $user->get('id'); ?>'>Delete</a></td>
	</tr>
<?php
}
?>
</table>

<?php echo $this->data['page_navigator']; ?>