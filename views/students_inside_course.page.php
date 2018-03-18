<div class="container">
	<div class="jumbotron text-center">
	<?php if($user_role == 'sales') echo '';
		else echo '<a href="/edit_course/' .$course_id .'">
			<button type="button" class="btn btn-default btn-sm">Edit Course</button>
		</a>';
	?>

		<?php echo $course; ?>
		<div><h3>מספר הסטודנטים אשר נמצאים בקורס הם: </h3><?php echo $count; ?></div>

	</div>

	<div class="row slideanim">
		<div class="col-xs-12">
			<div class="panel panel-default text-center">
				<div class="panel-heading">
					<h1>Students In This Course :</h1>
				</div>
				<div class="panel-body student">
					<div class="row slideanim">
						<?php echo $students; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
