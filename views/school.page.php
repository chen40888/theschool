<div class="container">
	<div class="jumbotron text-center">
		<h1>chen's college</h1>
	</div>
	<div class="row slideanim">
		<div class="col-sm-6 col-xs-12">
			<div class="panel panel-default text-center">
				<div class="panel-heading">
					<a href="/add_student/">
						<button type="button" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-plus"></span> add student</button>
					</a>
					<h1>Students :</h1>
				</div>
				<div class="panel-body student">
					<div class="row slideanim">
						<?php echo $all_students; ?>
					</div>
				</div>
			</div>
		</div>

		<div class="col-sm-6 col-xs-12">

			<div class="panel panel-default text-center">
				<div class="panel-heading">
					<a href="/add_course/">
						<button type="button" class="btn btn-default btn-sm">
							<span class="glyphicon glyphicon-plus"></span> add course
						</button>
					</a>
					<h1>courses :</h1>
				</div>
				<div class="panel-body this_course">
					<div class="row slideanim">
						<?php echo $all_courses; ?>
					</div>
				</div>
			</div>
		</div>
</div>
