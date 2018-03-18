<div class="funkyradio-success">
		<input <?php if($is_checked) echo 'checked'; ?> id="<?php echo $id; ?>" type="checkbox" name="courses[]" value="<?php echo $id; ?>">
		<label for="<?php echo $id; ?>"><img class="course_image" src="<?php echo $image; ?>"><?php echo $name; ?></label>
</div>
