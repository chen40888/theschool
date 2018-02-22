<form action="/edit_student/<?php echo $id?>" method="post" enctype="multipart/form-data">
<?php echo $content; ?>
<div class="funkyradio">
	<?php echo $courses?>
</div>

<a href="/delete_student/<?php echo Request::get('arg1');?>"><button class="btn btn-warrning">delete student</button></a>


<?php echo $error_message; ?>

<div class="form-group">
	<label>
		<input value="submit" name="edit_student" type="submit" class="btn btn-primary">
	</label>
</div>
</form>
