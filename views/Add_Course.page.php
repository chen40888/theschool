<form method="post" action="/add_course" enctype="multipart/form-data">
	insert new cours:<br>
	<input type="text" name="course_name">
	<br>
	<textarea name="description" rows="4" cols="50"></textarea>

	<input type="file" name="file">
	<?php echo $error_message; ?>


	<input type="submit" name="insert_course" value="insert">
</form>
