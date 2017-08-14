<?foreach ($data as $array): ?>
	<div class="row">
		<?foreach ($array as $object): ?>
			<? if(isset($object['image']->uri)): ?>
				<div class="col-md-4">
					<a href="<?=$object['url']?>"><img class="img-responsive" src="<?=file_create_url($object['image']->uri)?>" /></a>
					<p><?=$object['text']?></p>
				</div>
			<? endif; ?>
		<?endforeach; ?>
	</div>
<?endforeach; ?>

