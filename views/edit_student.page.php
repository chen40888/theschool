<?php echo $message; ?>
<button class="btn btn-warrning" id="hook_delete">Delete Student</button>
<div id="show_btn" class="hidden">
	<h4>are you sure you want to delete this student?</h4>
	<a class="del_btn" href="/delete_student/<?php echo $student_id; ?>">
		<button class="btn btn-warrning">Yes</button>
	</a>
	<a class="del_btn" href="/school/">
		<button class="btn btn-warrning">No</button>
	</a>
</div>
<form action="/edit_student/<?php echo $student_id; ?>" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>
			<input value="submit" name="edit_student" type="submit" class="btn btn-primary submit">
		</label>
	</div>
	<div class="col-sm-6">
		<div class="funkyradio">
			<?php echo $courses ?>
		</div>
	</div>
	<div class="col-sm-6">
		<?php echo $content; ?>
	</div>
</form>

