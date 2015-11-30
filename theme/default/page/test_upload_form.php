<?php


if ( in('category') ) {
    $datas = data()->query_loads("category='".in('category') ."'");
    if ( $datas ) {
        $uploads=[];
        foreach( $datas as $data ) {
            $uploads[$data->get('form_name')] = $data;
        }
    }
}


?>
<?php echo form_open_multipart('data/upload');?>

<input type="hidden" name="return_url" value="/data/test/upload">

file : <input type="file" name="file" size="20" /><br>
<img src="<?php echo $uploads['file']->get('url')?>" style="max-width:200px;"><br>
<hr>
photo : <input type="file" name="photo" size="255"><br>
<img src="<?php echo $uploads['photo']->get('url')?>" style="max-width:200px;"><br>
<hr>
<br /><br />

<input type="submit" value="upload" />

</form>

