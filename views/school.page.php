<div class="container">
<h2>home</h2>
<a href="/logout"><button class="btn btn-warrning">Logout</button></a>
<a href="/add_course"><button class="btn btn-warrning">add course</button></a>
<a href="/add_student"><button class="btn btn-warrning">add student</button></a>
	<div class="main_student col-sm-6">
		<ul>
		<?php echo $all_students ?>
		</ul>
	</div>
	<div class="main_courses col-sm-6">
		<ul>
			<?php echo $all_courses ?>
		</ul>
	</div>
</div>
