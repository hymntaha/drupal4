<?php if (node_access('update', $node->nid) ) :?>  
  <div class="admin_tabs">
    <ul class="tabs primary">
      <?php if ($tabs['view']): ?>
        <li>
          <?php echo l('View', $node->path, array('attributes' => array('class' => 'active'), 'query' => drupal_get_destination())); ?>
        </li>
      <?php endif; ?>
      <?php if ($tabs['edit']): ?>
        <li>
          <?php echo l('Edit', sprintf('node/%d/edit', $node->nid), array('attributes' => array('class' => 'active'), 'query' => drupal_get_destination())); ?>
        </li>
      <?php endif; ?>
      <?php if ($tabs['clone']): ?>
        <li>
          <?php echo l('Clone', sprintf('node/%d/clone', $node->nid), array('attributes' => array('class' => 'active'), 'query' => drupal_get_destination())); ?>
        </li>
      <?php endif; ?>
      
      <? if(!empty($tabs['extra'])){
          foreach($tabs['extra'] as $link){?>
          <li><a href="<?=$link['url']?>"><?=$link['text']?></a></li>
          <?}
      }?>
    </ul>
  </div>
<?php endif; ?>