<?php
$fo=opendir("gallery");
while($file=readdir($fo))
{
	//echo $file
		if(file!="." && $file!=".." && $file!="thumbs.db")
		{
			echo "<img src='gallery/$file' width='150' height='150'/>
			&nbsp;&nbsp;&nbsp;&nbsp;";
		}
}
?>