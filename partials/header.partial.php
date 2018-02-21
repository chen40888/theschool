<!doctype html><html lang="he">
<head>
	<title><?php echo $title; ?></title>
	<meta charset='utf-8'/>
	<meta http-equiv='Cache-Control' content='private'>
	<meta name='apple-mobile-web-app-capable' content='yes'>
	<meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no'>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<?php echo $css_tags_html; ?>
</head>
<body class="<?php echo $page_name; ?> <?php echo $role; ?>">
<div class="wrapper">
	<header>

		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">Portfolio</a>
				</div>
				<div class="collapse navbar-collapse" id="myNavbar">
					<ul class="nav navbar-nav">
						<li class="active"><a href="/school">school</a></li>
						<?php if(User::$role != 'sales'){
							echo '<li><a href="/admin">admin</a></li>'; }?>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li>
							<img src="<?php echo 'img/users/' . User::$image; ?>">
							<h3><?php echo User::$name . ' , ' . User::$role?></h3>
							<a class="logout" href="/logout"><span class="glyphicon glyphicon-log-in"></span>logout</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</header>

