<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">
	<div id="header">
		<div id="logo"></div>
	</div><!-- header -->
	<div style="padding:20px 100px;line-height:30px;font-size: 1.5em;">
		<?php if( isset( $this->intro ) ){ echo $this->intro; }; ?>
	</div>
	<?php echo $content; ?>
	<?php /*
	<div class="span-12">
		<div id="content">
			<?php echo $content_left; ?>
		</div><!-- content -->
	</div>
	<div class="span-12 last">
		<div id="sidebar">
			<?php echo $content_right; ?>
		</div><!-- sidebar -->
	</div>
	*/
	?>

</div><!-- page -->
	<div id="footer">
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</body>
</html>
