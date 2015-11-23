<?php
$data = $this->data;
$users = $data['users'];

$extra_query = '';

//needs an easier way for search filters...
$keyword = $data['keyword'];
if( empty( $keyword ) ) $keyword = null;
else {
	if( !empty( $extra_query ) ) $extra_query .= '&';
	else $extra_query .= '?';
	$extra_query .= "keyword=$keyword";
}
$offset = $data['offset'];
if( empty( $offset ) ) $offset = null;	
else {
	if( !empty( $extra_query ) ) $extra_query .= '&';
	else $extra_query .= '?';
	$extra_query .= "offset=$offset";
}

$filter_by = $data['filter_by'];
if( empty( $filter_by ) ) $filter_by = null;	
else {
	if( !empty( $extra_query ) ) $extra_query .= '&';
	else $extra_query .= '?';
	$extra_query .= "filter_by=$filter_by";
}
?>

<h1>User List</h1>



<?php echo form_open('/user/list',['class'=>'search-form'])?>

<input type='text' name="keyword" value="<?php echo set_value('keyword', $keyword)?>">
<select name='filter_by'>
	<option value=''>Filter by</option>
	<option value='username' <?php if( $filter_by =='username' ) echo 'selected'?> >Username</option>
	<option value='email' <?php if( $filter_by =='email' ) echo 'selected'?>>Email</option>
	<option value='first_name' <?php if( $filter_by =='first_name' ) echo 'selected'?>>First Name</option>
	<option value='middle_name' <?php if( $filter_by =='middle_name' ) echo 'selected'?>>Middle Name</option>
	<option value='last_name' <?php if( $filter_by =='last_name' ) echo 'selected'?>>Last Name</option>
</select>
<input type="submit">

</form>


<div class='search-label'>
	Showing <?php echo ( $data['offset'] + 1 ); ?> - <?php echo ( $data['offset'] + 10 ); ?> of <?php echo $this->data['total_row']?>
</div>


<table class='list-table' cellpadding=0 cellspacing=0 width='100%'>
<tr class='header'>
	<td><span>ID</span></td>
	<td><span>USER NAME</span></td>
	<td><span>PASSWORD</span></td>
	<td><span>FIRST NAME</span></td>
	<td><span>EDIT</span></td>
	<td><span>DELETE</span></td>
</tr>
<?php
foreach( $users as $user ){

?>
	<tr>
		<td><span><?php echo $user->get('id'); ?></span></td>
		<td><span><?php echo $user->get('username'); ?></span></td>
		<td><span><?php echo $user->get('password'); ?></span></td>
		<td><span><?php echo $user->get('first_name'); ?></span></td>
		<td><a href='/user/edit/<?php echo $user->get('id').$extra_query; ?>'>Edit</a></td>
		<td><a href='/user/delete/<?php echo $user->get('id').$extra_query; ?>'>Delete</a></td>
	</tr>
<?php
}
?>
</table>
<div class='page-navigator'>
<?php echo $this->data['page_navigator']; ?>
</div>


<style>
	body{
		font-family:arial;
	}
	
	/*search-form*/
	.search-form{
		margin-bottom:20px;
	}
	
	.search-form input[type='text']{
		padding: 4px 5px;
		border: 1px solid #003366;
		box-sizing: border-box;
	}
	
	.search-form input[type='submit']{
		    display: inline-block;
			padding: 5px 10px 5px 10px;
			border:0;
			border-radius: 2px;
			background-color: #003366;
			color: #ffffff;
			box-sizing: border-box;
			cursor: pointer;
	}
	
	.search-label{
		margin-bottom:10px;
	}
	/*eo search-form*/
	
	/*list-table*/
	.list-table{
		text-align:center;
		margin-bottom:20px;
	}
	
	.list-table tr.header {		
		font-weight: bold;
		background-color: #d5d5d5;
	}
	
	.list-table tr.header td {
		padding: 5px 10px;
		color: #444444;
	}
	
	.list-table tr:nth-child(2n + 3) {
		background-color: #f2f2f2;
	}
	
	.list-table td > span, .list-table td > a {
		display: block;
		padding: 10px;
	}
	/*eo list-table*/
	
	/*page-navigator*/
	.page-navigator{
		padding: 5px 9px;	
		font-size:.8em;		
		text-align: center;
	}
	
	.page-navigator > *{		
		display: inline-block;
		padding: 7px 10px;
		margin: 0 10px 5px 0;
		border: 1px solid #dddddd;
		border-radius: 2px;
		color:#000;		
		line-height: 100%;
		text-decoration:none;
	}
	
	.page-navigator > *:hover{		
		background-color: #7997ab;
		color: #ffffff;		
	}
	
	.page-navigator > strong{		
		background-color: #7997ab;
		color: #ffffff;
		font-weight:normal;
	}
	/*eo page-navigator*/
</style>