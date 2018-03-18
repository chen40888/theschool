<!doctype html><html lang="he">
<head>
	<title><?php echo $title; ?></title>
	<meta charset='utf-8'/>
	<meta http-equiv='Cache-Control' content='private'>
	<meta name='apple-mobile-web-app-capable' content='yes'>
	<meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no'>
	<?php echo $css_tags_html; ?>
</head>
<body class="<?php echo $page_name; ?> <?php echo User::$role; ?>">
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
				</div>
				<div class="collapse navbar-collapse" id="myNavbar">
					<ul class="nav navbar-nav">
						<li class="header_links <?php echo ($page_name == 'school' ? 'active' : ''); ?>"><a href="/school">school</a></li>
						<?php if(User::$role != 'sales'){
							echo '<li class="header_links ' . ($page_name == 'admin' ? 'active' : '') .'"><a href="/admin">admin</a></li>'; }?>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li>
							<img src="<?php echo $avatar; ?>">
							<h3><?php echo User::$name . ' , ' . User::$role; ?></h3>
							<a class="logout" href="/logout"><span class="glyphicon glyphicon-log-in"></span>logout</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</header>

