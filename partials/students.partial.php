<div class="<?php echo (Request::get('arg0') == 'students_inside_course') ? 'col-sm-6' : 'col-sm-12';?> col-xs-12">
	<span><a href="/student_details/<?php echo $id; ?>"><img src="<?php echo $image; ?>"></a></span>
	<h2><?php echo $name; ?></h2>
	<h4><?php echo $phone; ?></h4>
	<h4><?php echo $email; ?></h4>
</div>
