<div class="container">
	<div class="jumbotron text-center">
		<a href="/edit_student/<?php echo Request::get('arg1')?>">
			<button type="button" class="btn btn-default btn-sm">Edit Student</button>
		</a>
		<?php echo $student; ?>
	</div>
	<!--<a href="/add_user/"><button class="btn btn-warrning">add user</button></a>-->

	<div class="row slideanim">
		<div class="col-xs-12">
			<div class="panel panel-default text-center">
				<div class="panel-heading">
					<h1>Students In This Course :</h1>
				</div>
				<div class="panel-body student">
					<div class="row slideanim">
						<?php echo $courses; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
