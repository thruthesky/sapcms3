<html>
<head>
    <title>Upload Form</title>
</head>
<body>

<?php echo $error;?>

<?php echo form_open_multipart('data/upload');?>

<input type="file" name="file" size="20" />

<br /><br />

<input type="submit" value="upload" />

</form>

</body>
</html>
