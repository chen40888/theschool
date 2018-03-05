<form action="/edit_student/<?php echo Request::get('arg1')?>" method="post" enctype="multipart/form-data">
	<div class="col-sm-6">
		<div class="funkyradio">
			<?php echo $courses?>
		</div>
	</div>
	<div class="col-sm-6">
		<?php echo $content; ?>
	</div>

<a href="/delete_student/<?php echo Request::get('arg1');?>"><button class="btn btn-warrning">delete student</button></a>

<?php echo $message; ?>

<div class="form-group">
	<label>
		<input value="submit" name="edit_student" type="submit" class="btn btn-primary">
	</label>
</div>
</form>
