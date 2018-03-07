<div class="container">
<div class="jumbotron text-center">
	<h1>Administration</h1>
	<div><h3>מספר המנהלים אשר אתה יכול לראות: </h3><?php echo $count_manager; ?></div>
</div>
<!--<a href="/add_user/"><button class="btn btn-warrning">add user</button></a>-->

<div class="row slideanim">
	<div class="col-xs-12">
		<div class="panel panel-default text-center">
			<div class="panel-heading">
				<a href="/add_user/">
					<button type="button" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-plus"></span> add user</button>
				</a>
				<h1>Users :</h1>
			</div>
			<div class="panel-body student">
				<div class="row slideanim">
					<?php echo $users; ?>
				</div>
			</div>
		</div>
	</div>
</div>
