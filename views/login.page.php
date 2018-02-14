<div class="login_wrap">

	<div class="app-title">
		<h1>ג'ון ברייס קורסים - בטיפול</h1>
	</div>

	<div class="login">
		<div class="login-screen">
			<form id="hook_login_form" method="post" action="../Action" name="login_form" novalidate="">
				<div class="login-form">
					<div class="control-group">
						<input name="mail_or_id" type="text" class="login-field" value="" placeholder='ת"ז' id="login-card-or-mail">
						<label class="login-field-icon fui-user" for="login-card-or-mail"></label>
					</div>

					<div class="control-group">
						<input name="pass" type="password" class="login-field" value="" placeholder="סיסמה" id="login-pass">
						<label class="login-field-icon fui-lock" for="login-pass"></label>
					</div>

					<div class="login_button_wrap">
						<p>בכניסה ראשונה יש להקליד את תעודת הזהות שוב</p>
						<input id="login_button" name="login" type="submit">
						<label for="login_button" class="btn btn-primary btn-large btn-block">התחברות</label>
					</div>

					<a class="login-link" href="#">שכחת את הסיסמה?</a>
				</div>
			</form>
		</div>

		<div class="warning warning_hide">
			<?php echo $problem ?>
		</div>
	</div>
</div>
