<form action="/edit_user/<?php echo $id; ?>" method="post" enctype="multipart/form-data">
	<input name="id" hidden value="<?php echo $id; ?>">
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
	<div class="form-group <?php echo $hide_class; ?>">
		<label>role :
			<select name="role" class="form-control">
<!--				אם הוא לא owner הוא מקבל class="hide" לכל אחד מודפס Selected על הרול שלו-->
				<option <?php echo $hide_owner_class . ' ' . $selected_owner; ?> value="owner">owner</option>
				<option <?php echo $selected_manager; ?> value="manager">manager</option>
				<option <?php echo $selected_sales; ?> value="sales">sales</option>
			</select>
		</label>
	</div>

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
<div class="<?php echo $hide_class; ?>">
<button class="btn btn-warrning" id="hook_delete">Delete User</button>
<div id="show_btn" class="hidden">
	<h4>are you sure you want to delete this user?</h4>
	<a class="del_btn" href="/delete_user/<?php echo $id; ?>">
		<button class="btn btn-warrning">Yes</button>
	</a>
	<a class="del_btn" href="/admin/">
		<button class="btn btn-warrning">No</button>
	</a>
</div>
</div>
