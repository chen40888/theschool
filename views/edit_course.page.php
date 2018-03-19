<h2>עדכון קורס</h2>
<?php echo $message; ?>
<button class="btn btn-warrning" id="hook_delete">Delete Course</button>
<div id="show_btn" class="hidden">
	<h4>are you sure you want to delete this course?</h4>
	<a class="del_btn" href="/delete_course/<?php echo $id;?>">
		<button class="btn btn-warrning">Yes</button>
	</a>
	<a class="del_btn" href="/school/">
		<button class="btn btn-warrning">No</button>
	</a>
</div>
<?php echo $content; ?>






