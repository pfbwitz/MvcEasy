<?php require_once($_SERVER['DOCUMENT_ROOT'] . "/Functions/RequestValidation.php"); ?>
<!doctype html>
<html lang=''>
<head>
    <meta charset='utf-8'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php AutoLoader::loadStyles(); ?>
    <?php AutoLoader::loadScripts(); ?>
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
	 <link rel="stylesheet" href="/script/cssmenu/menu.css">
    <script src="/script/cssmenu/menu.js"></script>
    <title><?php echo PAGE_TITLE; ?></title>
</head>
    <body>
       <?php AutoLoader::LoadMenu(); ?>
        <div id = "content">
			<?php
				$env = Loaders_ConfigLoader::getCurrentEnvironment();
				if($env != ENV_PRD){
					echo "<div style='float:right;'><span>Omgeving:</span> <span style='font-weight: bold;color: red;'>" . 
					$env . "</span></div><br />";
				}
			?>
            <div style='position:relative;top:0px;left:0px;padding-left:5px;'>
                <?php if($this->isLoggedIn()) : ?>
                    <span style="float:right;font-size:8pt;">
                        <a href="/Security/" style="font-size: 8pt;color:#aaa">
							<?php echo "logged in as: " . $this->user->username; ?>
						</a> - 
                    <a href="/Security/" style='font-size:8pt;'>Logout</a></span>
                <?php endif; ?>
                <span style="font-weight:bold;font-size: 16pt;color:#999;"><?php echo PAGE_TITLE; ?></span><br />
            </div>
            <?php $this->loadView(); ?>
        </div>
        <div id="filler" style="position:relative;top:80px;height: 20px;">       
    </body>
</html>

