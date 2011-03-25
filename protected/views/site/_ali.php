<p>
	<h2>Ali</h2>
</p>
<?php echo CHtml::image( Yii::app()->request->baseUrl . '/images/ali.jpg' ); ?>
<?php 
	$date = strtotime('10/01/2010');
	$inwords = (time()-$date)/60/60/24;
?>
<div>
	<h3><?php echo round( $inwords ); ?></h3>
</div>

<?php if( ! isset($_COOKIE['alivsmvoted'] ) ) : ?>
	<div class="vote-button">
		<?php echo CHtml::ajaxLink( (isset($_GET['lang']) && $_GET['lang'] == 'hun' ) ? 'SZAVAZOK' : 'VOTE', $this->createUrl( 'site/vote', array( 'param' => 'a' ) ), array( 'success' => 'function(data){ jQuery(".vote-button").hide();jQuery(".percentage").show();}' ), array( 'class' => 'vote' ) ); ?>
	</div>
<?php endif; ?>

<div class="percentage<?php echo isset( $_COOKIE['alivsmvoted'] ) ? ' blocky' : ''; ?>">
	<?php echo Vote::model()->count() ? round( sizeof( Vote::model()->findAll( 'vote="a"' ) ) / Vote::model()->count() * 100 ) : 50; ?>%
</div>
