<?php

/**
 * @file field.tpl.php
 * Default template implementation to display the value of a field.
 *
 * This file is not used and is here as a starting point for customization only.
 * @see theme_field()
 *
 * Available variables:
 * - $items: An array of field values. Use render() to output them.
 * - $label: The item label.
 * - $label_hidden: Whether the label display is set to 'hidden'.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - field: The current template type, i.e., "theming hook".
 *   - field-name-[field_name]: The current field name. For example, if the
 *     field name is "field_description" it would result in
 *     "field-name-field-description".
 *   - field-type-[field_type]: The current field type. For example, if the
 *     field type is "text" it would result in "field-type-text".
 *   - field-label-[label_display]: The current label position. For example, if
 *     the label position is "above" it would result in "field-label-above".
 *
 * Other variables:
 * - $element['#object']: The entity to which the field is attached.
 * - $element['#view_mode']: View mode, e.g. 'full', 'teaser'...
 * - $element['#field_name']: The field name.
 * - $element['#field_type']: The field type.
 * - $element['#field_language']: The field language.
 * - $element['#field_translatable']: Whether the field is translatable or not.
 * - $element['#label_display']: Position of label display, inline, above, or
 *   hidden.
 * - $field_name_css: The css-compatible field name.
 * - $field_type_css: The css-compatible field type.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 *
 * @see template_preprocess_field()
 * @see theme_field()
 */
$is_front = drupal_is_front_page();
$node = menu_get_object();
?>

  <?if(!$is_front): ?>

    <div id="carousel" class="carousel <?=($is_front) ?  '' : 'carousel-fade' ?> slide" data-ride="carousel" data-interval="3000" data-pause="hover">
        <div class="carousel-inner">
          <?php $first = true; ?>
          <?php foreach($items as $delta => $item): ?>
            <div class="item <?php if($first){ echo "active"; $first=false; } ?>">
              <?php if(isset($element['#object']->field_slide_links[LANGUAGE_NONE][$delta]) && !empty($element['#object']->field_slide_links[LANGUAGE_NONE][$delta]['url'])): ?>
                <a href="<?=url($element['#object']->field_slide_links[LANGUAGE_NONE][$delta]['url'],array('absolute' => TRUE))?>">
                  <?php print render($item); ?>
                </a>
              <?php else: ?>
                <?php print render($item); ?>
              <?php endif;?>
              
                <div class="bar-wrapper">
                  <div class="slide-caption"><span><?=$item['#item']['title']; ?></span></div>
                  <?if($node->type !== 'product_landing'): ?>
                    <div class="pause"><a href="javascript:void(0)" id="pauseButton"><img src="/sites/all/themes/custom/sc_bs/img/pause-btn.png" /></a></div>
                  <?php endif;?>
                </div>
            </div>
          <?php endforeach; ?>
        </div>

      <!-- Indicators -->
      <ol class="carousel-indicators">
          <?php $first = true; ?>
          <?php $counter = 0; ?>
          <?php foreach($items as $item): ?>
            <li data-target="#carousel" data-slide-to="<?php echo $counter; ?>" class="<?php if($first){ echo "active"; $first=false; } ?>"></li>
            <?php $counter++;?>
          <?php endforeach; ?>
      </ol>
     
      <!-- Controls -->
        <div class="hidden-xs">
          <a class="left carousel-control" href="#carousel" data-slide="prev"><span><img src="/sites/all/themes/custom/sc_bs/img/sc_prev.png" alt="Previous"/></span></a>
          <a class="right carousel-control" href="#carousel" data-slide="next"><span><img src="/sites/all/themes/custom/sc_bs/img/sc_next.png" alt="Next"/></span></a> 
        </div>
        <div class="visible-xs">
          <a class="left carousel-control" href="#carousel" data-slide="prev"><span><img src="/sites/all/themes/custom/sc_bs/img/arrow-left.png" alt="Previous"/></span></a>
          <a class="right carousel-control" href="#carousel" data-slide="next"><span><img src="/sites/all/themes/custom/sc_bs/img/arrow-right.png" alt="Next"/></span></a> 
        </div>

    </div>
  <?else:?>
  <div class="slides">
    <?php foreach ($items as $delta): ?>
      <div class="field-item <?php print $delta % 2 ? 'odd' : 'even'; ?>">
        <div class="slide-image">
          <div class="fill" style="background-image:url('<?=image_style_url("home", $delta["#item"]["uri"])?>');"></div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <div class="pagination">
      <span class="pagination-items"></span>
  </div>

  <script type="text/javascript">

      var maxPagerLinks = 6;
      var maxHeight = 0;
      jQuery('.slide-image img').each(function(){
          if(jQuery(this).height() > maxHeight){
            maxHeight = jQuery(this).height();
          }
      });

      jQuery(".slides").cycle({
          pager: ".pagination-items",
          next: ".next",
          prev: ".prev",
          timeout: 5000,
          speed: 500,
          before: function(currSlideElement, nextSlideElement, options, forwardFlag){
              Drupal.fullscreenImage(nextSlideElement);
              jQuery(currSlideElement).removeClass("activeSlideItem");
              jQuery(nextSlideElement).addClass("activeSlideItem");

          },
          after: function(currSlideElement, nextSlideElement, options, forwardFlag){
            <?php if($is_front){ ?>
              if(jQuery(nextSlideElement).index() == 5){
                  jQuery("body").addClass("lights-out");
              }else{
                  jQuery("body").removeClass("lights-out");
              }
            <? } ?>

          },
      });

      jQuery(window).resize(function(){
          Drupal.fullscreenImage(jQuery(".activeSlideItem"));
      });

  </script>

<? endif; ?>


        




