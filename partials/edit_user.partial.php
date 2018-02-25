<h2>הוספת משתמש חדש</h2>
<form action="/edit_user" method="post" enctype="multipart/form-data">
	<input name="id" value="<?php echo $id?>">
	<div id="add_student" class="form-group">
		<label>ת"ז:</label>
		<input type="number" name="id_card" min="2" class="form-control" value="<?php echo $id_card;?>" required>
	</div>
	<div class="form-group">
		<label>שם :</label>
		<input type="text" name="user_name" class="form-control" value="<?php echo $name;?>" required>
	</div>
	<div class="form-group">
		<label for="phone">טלפון :</label>
		<input id="phone" type="number" name="phone" value="<?php echo $phone;?>" class="form-control" required>
	</div>
	<div class="form-group">
		<label>Email address</label>
		<input type="email" name="email" class="form-control" value="<?php echo $email;?>" required>
	</div>
	<div class="form-group">
		<label>סיסמה :</label>
		<input type="password" name="password" class="form-control" value="<?php echo $password;?>" required>
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
		<label>תמונת המשתמש :</label>
		<img src="<?php echo $image; ?>" />
	</div>
	<div class="form-group">
		<label>העלת תמונה :</label>
		<input type="file" required name="file">
	</div>
	<?php echo $error_message; ?>

	<label>
		<input value="submit" name="edit_user" type="submit" class="btn btn-primary">
	</label>
</form>
