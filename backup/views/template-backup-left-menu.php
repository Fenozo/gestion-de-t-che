<!DOCTYPE html>
<html ng-app="manager">
<head>
    <meta charset="UTF-8"/>
    <title>Management Application</title>
    <link href="<?php echo CSS_FODLER.'materialize.css';?>" rel="stylesheet">
    <link href="<?php echo CSS_FODLER.'animate.css';?>" rel="stylesheet">
    <link href="<?php echo CSS_FODLER.'icon.css';?>" rel="stylesheet">
    <link href="<?php echo CSS_FODLER.'style.css';?>" rel="stylesheet">
    <?php
        if(!empty($_SESSION['id_utilisateur']) && !empty($_SESSION['type_utilisateur'])) {
    ?>
    <script src="<?php echo JS_FODLER.'angular.min.js';?>" type="text/javascript"></script>
    <script src="<?php echo JS_FODLER.'angular-route.js';?>" type="text/javascript"></script>
    <script src="<?php echo JS_FODLER.'jquery-2.2.1.min.js';?>" type="text/javascript"></script>
    <script src="<?php echo JS_FODLER.'materialize.js';?>" type="text/javascript"></script>
    <script src="<?php echo JS_FODLER.'jasny-bootstrap.js';?>" type="text/javascript"></script>
    <?php
        $module_directory = scandir('modules/');
        foreach($module_directory as $module)
        {
            if(!in_array($module,Array('.','..')))
            {
                echo '<script type="text/javascript" src="modules/'.$module.'"></script>';
            }
        }
    ?>
    <script src="views/app.js" type="text/javascript"></script>
    <?php
        }
    ?>
</head>
<body>
<nav>
    <div class="nav-wrapper light-blue darken-4">
        <a href="#!" class="brand-logo" style="padding-left:25px; font-size:18px;">Management Application</a>
        <ul class="right hide-on-med-and-down">
            <li><a href="?logout" onclick="return confirm('Voulez-vous réellement déconnecter ?')"><i class="material-icons right">input</i>Logout</a></li>
        </ul>
        <ul class="right" style="padding:0px 15px;">
            <span style="font-weight:600;"> <?php echo date('d');?> <?php echo date('M');?> <?php echo date('Y');?></span> /
            <span style="font-weight:600;" id="digital_clock">21:20:01</span> /
            Bonjour, <?php echo $_SESSION['nom_utilisateur'];?>
        </ul>
    </div>
</nav>
<div class="row" style="padding:0; margin:0;">
    <div class="col s2" style="position:fixed; top:0; background-color:#242449; background-image:linear-gradient(to bottom,black,#242449); height:100%; z-index:9999; padding:0; margin:0;">
        <div style="position:relative; height:100%; width:100%;">
            <div>
                <div style="height:65px; background-color:#0f72c0; color:white; font-size:16px; text-align:center; padding-top:25px; font-weight:500;">
                    Management Application
                </div>
                <div style="height:75px;">
                </div>
                <div class="left_menu">
                    <li>&Eacute;quipements et mat&eacute;riels</li>
                    <li>Liste du personnel</li>
                </div>
            </div>
            <!--div style="position:absolute; bottom:15; color:white; font-size: 14x; width:100%; text-align:center; margin:0 auto;">
                neobox<br>
                <span style="font-size:10px;">solutions</span>
            </div-->
        </div>
    </div>
    <div class="col s10 right" style="margin:0; padding:0;">
        <div style="background-color:rgba(45,45,85,1); color:white; font-weight:600;">
            <div class="container" style="height:75px;">
                <ul class="submenu" style="padding:25px 35px;">
                <li><a href="#!/"><span class="valign-wrapper"><i class="material-icons">supervisor_account</i>Liste des employ&eacute;s</span></a></li>
                <li><a href="#!/equipement"><span class="valign-wrapper"><i class="material-icons">markunread_mailbox</i>Gestion des &eacute;quipements et mat&eacute;riels</span></a></li>
                <li><a href="#!/affectation"><span class="valign-wrapper"><i class="material-icons">note_add</i>Affectation des mat&eacute;riels</span></a></li>
                </ul>
            </div>
        </div>
        <div class="container" style="padding-top:25px;">
            <div ng-view></div>
        </div>
    </div>
</div>
<form method="post" action="index.php" id="logout">
    <input type="hidden" name="logout" value="login"/>
</form>
<script type="text/javascript">
        var id_utilisateur = '<?php echo $_SESSION['id_utilisateur'];?>';
        var type_utilisateur = '<?php echo $_SESSION['type_utilisateur'];?>';

        function startTime() {
            var today = new Date();
            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);
            $('#digital_clock').html(h + ":" + m + ":" + s);
            var t = setTimeout(startTime, 500);
        }

        function checkTime(i) {
            if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
            return i;
        }

        window.onload = function() {
            startTime();
        }
    </script>
</body>
</html>