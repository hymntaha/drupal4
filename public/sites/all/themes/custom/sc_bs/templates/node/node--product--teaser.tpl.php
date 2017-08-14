<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
    <div class="content clearfix"<?php print $content_attributes; ?>>
    	<a href="<?=drupal_get_path_alias('node/'.$node->nid)?>"><img class="img-responsive" src="<?=file_create_url($node->uc_product_image['und'][0]['uri'])?>" /></a>
    	<h4><?=$title ?></h4>
    	<?hide($content['links']);?>
    	<?=render($content);?>
    </div>
</div>