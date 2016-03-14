<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6 lt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7 lt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8 lt8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>New Capital</title>
<script src="static/scripts/jquery-1.8.2.min.js"></script>
<!--<script src="static/scripts/jquery-1.9.1.js"></script>-->
<link rel="shortcut icon" type="image/x-icon" href="static/favicon.ico">
<link href="static/styles/bootstrap.css" rel="stylesheet">
<link href="static/styles/bootstrap.min.css" rel="stylesheet">
<link href="static/styles/bootstrap-select.css" rel="stylesheet">
<script src="static/scripts/bootstrap.min.js"></script>
<script src="static/scripts/bootstrap-multiselect.js"></script>
<script src="static/scripts/bootstrap-select.js"></script>
<link href="static/styles/main.css" rel="stylesheet">
<link rel="stylesheet" href="static/styles/font-awesome.min.css">

<script src="static/scripts/entel.js"></script>
<script src="static/scripts/scriptbreaker-multiple-accordion-1.js"></script>
</head>
<body>
	<div class="row">
		<div class="col-xs-12">
			<div class="page-header clearfix">
				<div class="col-md-6">
					<div class="pull-left">
						<a href="home.html"> <img class="mg-responsive profile-img-card"
							src="static/images/newcaplogo.png" style="width:110px" />
						</a>
					</div>
				</div>
				<div class="col-md-6">
					<div class="pull-right">
						<span>Bienvenido : </span>
						<div class="btn-group">
							<button data-toggle="dropdown"
								class="btn btn-default dropdown-toggle" type="button">
								<span class="fa fa-user"></span> <?php echo$_SESSION['nombre']?> <span
									class="caret"></span>
							</button>
							<ul role="menu" class="dropdown-menu">
								<li>
									<a href="logout.php"><span class="fa fa-sign-in fa-2"></span>
										Salir </a>
								</li>								
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>