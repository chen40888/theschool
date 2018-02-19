<h2>הוספת משתמש חדש</h2>
<form action="/add_student" method="post">
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
		<input type="file" required name="file">
	</div>
	<div class="form-group">
		<div class="col-md-6">

		<div class="funkyradio">
			<?php echo $courses?>
		</div>
		</div>
	<label>
		<input value="submit" name="add_student" type="submit" class="btn btn-primary">
	</label>
</form>
