<?php
$data = $this->data;

date_default_timezone_set( 'Asia/Singapore' );//temp
?>

<h1>Message List</h1>

<div class='search-label'>
	Showing <?php echo ( $data['offset'] + 1 ); ?> - <?php echo ( $data['offset'] + 10 ); ?> of <?php echo $this->data['total_row']?>
</div>


<table class='list-table' cellpadding=0 cellspacing=0 width='100%'>
<tr class='header'>
	<td><span>ID FROM</span></td>
	<td><span>ID TO</span></td>
	<td><span>TITLE</span></td>
	<td><span>CONTENT</span></td>
	<td><span>CHECKED</span></td>	
</tr>
<?php
$messages = $data['messages'];
foreach( $messages as $message ){
$user_from_username = user()->load( $message->get('id_from') )->get('username');
$user_to_username = user()->load( $message->get('id_to') )->get('username');
$checked = date( 'M d, Y',$message->get('checked') ); 
?>
	<tr>
		<td><span><?php echo $user_from_username; ?></span></td>
		<td><span><?php echo $user_to_username; ?></span></td>
		<td><span><?php echo $message->get('title'); ?></span></td>
		<td><span><?php echo $message->get('content'); ?></span></td>
		<td><span><?php $checked; ?></span></td>		
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

