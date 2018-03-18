<form action="/edit_user/<?php echo $id?>" method="post" enctype="multipart/form-data">
	<input name="id" hidden value="<?php echo $id?>">
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
	<!--שהמשתמש נכנס לפרופיל שלו זה לא נותן לו אפשרות לשנות את התפקיד של עצמו-->
	<?php if(User::$id != $id) echo '<div class="form-group">
		<label>role :
			<select name="role" class="form-control">' . (User::$role == 'owner' ? '<option value="owner">owner</option>' : '') .
				'<option value="manager">manager</option>
				<option value="sales">sales</option>
			</select>
		</label>
	</div>';?>

	<div class="form-group">
		<label>תמונת המשתמש :</label>
		<img src="<?php echo $image; ?>" />
	</div>
	<div class="form-group">
		<label>העלת תמונה :</label>
		<input class="file" type="file" name="file">
	</div>
	<label>
		<input value="submit" name="edit_user" type="submit" class="btn btn-primary">
	</label>
</form>
<!--שהמשתמש נכנס לפרופיל שלו זה לא נותן לו אפשרות למחוק את עצמו-->
<?php if(User::$id != $id)  echo '<button class="btn btn-warrning" id="hook_delete">Delete User</button>
<div id="show_btn" class="hidden">
	<h4>are you sure you want to delete this user?</h4>
	<a class="del_btn" href="/delete_user/' . $id .'">
		<button class="btn btn-warrning">Yes</button>
	</a>
	<a class="del_btn" href="/admin/">
		<button class="btn btn-warrning">No</button>
	</a>
</div>'
?>
