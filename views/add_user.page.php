<h2>הוספת משתמש חדש</h2>
<form id="valid_form" action="/add_user" method="post" enctype="multipart/form-data">
	<div id="add_student" class="form-group">
		<label>ת"ז:</label>
		<input type="number" name="id_card" maxlength="10" class="form-control" required placeholder="תעודת זהות">
	</div>
	<div class="form-group">
		<label>שם :</label>
		<input type="text" name="user_name" class="form-control" required placeholder="name">
	</div>
	<div class="form-group">
		<label for="phone">טלפון :</label>
		<input id="phone" type="number" name="phone" class="form-control" maxlength="10" required placeholder="phone">
	</div>
	<div class="form-group">
		<label>Email address</label>
		<input type="email" name="email" class="form-control" required placeholder="Enter email">
	</div>
	<div class="form-group">
		<label>סיסמה :</label>
		<input type="password" name="password" class="form-control" required placeholder="Enter password">
	</div>
	<div class="form-group">
		<label>role :
			<select name="role" class="form-control">
				<option value="sales">sales</option>
				<option value="manager">manager</option>
				<?php if(User::$role == 'owner') echo '<option value="owner">owner</option>'; ?>
			</select>
		</label>
	</div>
	<div class="form-group">
		<label>העלת תמונה :</label>
		<input class="file" type="file" required name="file">
	</div>
	<?php echo $message; ?>
		<label>
			<input value="submit" name="add_user" type="submit" class="btn btn-primary">
		</label>
</form>
