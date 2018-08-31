<html ng-app="webextra">
<head>
    <meta charset="UTF-8"/>
    <title>Management Application</title>
    <link href="<?php echo CSS_FODLER.'materialize.css';?>" rel="stylesheet">
    <link href="<?php echo CSS_FODLER.'animate.css';?>" rel="stylesheet">
    <link href="<?php echo CSS_FODLER.'icon.css';?>" rel="stylesheet">
    <link href="<?php echo CSS_FODLER.'style.css';?>" rel="stylesheet">
</head>
<body style="background: no-repeat url(images/background.jpg); background-size:cover; overflow:hidden;">
<div class="container" style="padding-top:150px; width:575px;">
	<div class="white" style="padding:40px 75px; border-bottom:none; height:100%; border-radius:5px;">
		<h4 style="text-align:left; font-size:20px; padding-top:13px;">Veuillez vous authentifier</h4>
	    <form method="post">
	        <input type="text" name="pseudo" placeholder="Votre pseudo"/>
	        <input type="password" name="password" placeholder="Votre mot de passe"/>
	        <input type="hidden" name="login" value="login"/>
	        <button class="waves-effect waves-light btn brown darken-3">Se connecter</button>
			<h4 style="text-align:center; font-size:13px; padding-top:13px;">Management Application - &copy; 2017</h4>
	    </form>
    </div>
</div>
</body>
</html>