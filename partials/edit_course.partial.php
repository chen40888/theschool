<h2>עדכון קורס</h2>
<form method="post" action="/edit_course/<?php echo $id?>" enctype="multipart/form-data">
	<input hidden name="id" value="<?php echo $id?>">
	<div class="form-group">
		<label>שם :</label>
		<input type="text" name="course_name" class="form-control" value="<?php echo $name;?>" required>
	</div>
	<div class="form-group">
		<label for="description">תיאור הקורס :</label>
		<textarea id="description" name="description"><?php echo $description; ?></textarea>
	</div>
	<div class="form-group">
		<label>תמונת הקורס :</label>
		<img src="<?php echo $image; ?>" />
	</div>
	<div class="form-group">
		<label>העלת תמונה :</label>
		<input class="file" type="file" name="file">
	</div>
	<label>
		<input value="submit" name="edit_course" type="submit" class="btn btn-primary">
	</label>
</form>
