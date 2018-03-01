<!--<a href="../school"><button class="btn btn-defult">Home Page</button></a>-->
<a href="../edit_course/<?php echo Request::get('arg1')?>"><button class="btn btn-defult">Edit Course</button></a>
<div class="container">
	<ul class="col-sm-12">
	<?php echo $course; ?>
	</ul>
	<ul class="col-sm-12">
	<?php echo $students; ?>
	</ul>
</div>
