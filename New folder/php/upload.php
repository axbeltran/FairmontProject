<?php
if(isset($_POST['upd']))
{
	if(file_exists("/../img/gallery/".$_FILES['file']['name']))
	{
	echo "<font color='red'>".$_FILES['file']." already exist</font>";
	}
	else
	{
		$Supported_image = array('gif','jpg','jpeg','png');
		
		$src_file_name = $_FILES['file']['name'];
		$ext = strtolower(pathinfo($src_file_name, PATHINFO_EXTENSION));
	if (in_array($ext, $supported_image))
	{
	move_uploaded_file($_FILES['file']['tmp_name'],"../img/gallery/".$_FILES['file']['name']);
	echo $_FILES['file']['name']." image uploade";
	}
	else{
		echo "<font color='red'>please choose a valid image</font>";
}}}
?>
<form method="post" enctype=",ultipart/form-data">
choose your image<input type="file" name="file"/><br/>
<input type="submit" value="upload image" name="upd"/>
</form>
