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

<h2>File Upload with Form Submit</h2>
<?php echo form_open_multipart('data/upload');?>
<input type="hidden" name="return_url" value="/data/test/upload">
file : <input type="file" name="file" size="20" /><br>
<?php if( !empty( $uploads ) ){ ?>
<img src="<?php echo $uploads['file']->get('url')?>" style="max-width:200px;"><br>
<?php } ?>
photo : <input type="file" name="photo" size="255"><br>
<?php if( !empty( $uploads ) ){ ?>
<img src="<?php echo $uploads['photo']->get('url')?>" style="max-width:200px;"><br>
<?php } ?>
<input type="submit" value="upload" />
<?php echo form_close()?>

<h2>Ajax Upload without Form Submit</h2>


<?php echo js('/etc/js/jquery.form/jquery.form.min');?>
<?php echo js('/etc/js/file');?>


<form class="ajax-upload" action="/data/upload" enctype="multipart/form-data" method="post" accept-charset="utf-8">
    Subject : <input type="text" name="subject"><br>
    File: <input type="file" name="file" onchange='onFileChange(this);'><br>
    Photo: <input type="file" name="photo" onchange='onFileChange(this);'><br>
    Doc: <input type="file" name="doc" onchange='onFileChange(this);'><br>
    <input type="submit" value="upload">
</form>

<div class="ajax-upload-progress progress" style="display:none;">
    <div class="progress-bar" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: 0%;">
        0%
    </div>
</div>

