	<input hidden name="id" value="<?php echo $id?>">
	<div id="add_student" class="form-group">
		<label>ת"ז:</label>
		<input type="number" name="id_card" min="2" class="form-control" value="<?php echo $id_card;?>" required placeholder="תעודת זהות">
	</div>
	<div class="form-group">
		<label>שם :</label>
		<input type="text" name="student_name" class="form-control" required value="<?php echo $name;?>">
	</div>
	<div class="form-group">
		<label for="phone">טלפון :</label>
		<input id="phone" type="number" name="phone" class="form-control" value="<?php echo $phone;?>" required>
	</div>
	<div class="form-group">
		<label>Email address</label>
		<input type="email" name="email" class="form-control" required value="<?php echo $email;?>">
	</div>
	<div class="form-group">
		<label>תמונת המשתמש :</label>
		<img src="<?php echo $image; ?>" />
	</div>

	<div class="form-group">
		<label>העלת תמונה :</label>
		<input class="file" type="file" name="file" />
	</div>

