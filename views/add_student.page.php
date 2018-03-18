<h2>הוספת משתמש חדש</h2>
<?php echo $message; ?>
<form action="/add_student" method="post" enctype="multipart/form-data">
	<div class="col-xs-6">
		<div class="form-group">
			<div>
				<div class="funkyradio">
					<?php echo $courses ?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-6">
		<div id="add_student" class="form-group">
			<label>ת"ז:</label>
			<input type="number" name="id_card" min="2" class="form-control" required placeholder="תעודת זהות">
		</div>
		<div class="form-group">
			<label>שם :</label>
			<input type="text" name="student_name" class="form-control" required placeholder="name">
		</div>
		<div class="form-group">
			<label for="phone">טלפון :</label>
			<input id="phone" type="number" name="phone" class="form-control" required placeholder="phone">
		</div>
		<div class="form-group">
			<label>Email address</label>
			<input type="email" name="email" class="form-control" required placeholder="Enter email">
		</div>

		<div class="form-group">
			<label>העלת תמונה :</label>
			<input class="file" type="file" required name="file"/>
		</div>
	</div>
	<div class="form-group">
		<label>
			<input value="submit" name="add_student" type="submit" class="btn btn-primary">
		</label>
	</div>
</form>
