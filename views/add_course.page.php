<h2>הוספת קורס חדש</h2>
<form method="post" action="/add_course" enctype="multipart/form-data">
	<div class="form-group">
		<label>שם הקורס :</label>
		<input type="text" required name="course_name">
	</div>
	<div class="form-group">
		<label>תיאור הקוס :</label>
		<textarea name="description" required></textarea>
	</div>
	<div class="form-group">
		<input class="file" type="file" required name="file">
	</div>

	<?php echo $message; ?>

	<div class="form-group">
		<label>
			<input type="submit" name="insert_course" value="insert" class="btn btn-primary">
		</label>
	</div>
</form>
