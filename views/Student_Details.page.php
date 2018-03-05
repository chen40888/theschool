<a href="/edit_student/<?php echo Request::get('arg1');?>"><button class="btn btn-warrning">edit student</button></a>
<ul class="col-sm-12">
	<?php echo $student; ?>
</ul>
<h3>הקורסים של הסטודנט :</h3>
<ul class="col-sm-12 course_details">
	<?php echo $courses; ?>
</ul>
