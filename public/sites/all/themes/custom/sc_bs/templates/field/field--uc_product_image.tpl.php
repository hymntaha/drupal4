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

?>

<div id="carousel" class="carousel carousel-fade slide" data-ride="carousel" data-interval=5000 data-pause="hover">
  <div class="carousel-inner">
    <?php $first = true; ?>
    <?php foreach($items as $delta => $item): ?>
      <div class="item <?php if($first){ echo "active"; $first=false; } ?>">
        <?php print render($item); ?>
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
  <a class="left carousel-control" href="#carousel" data-slide="prev"><span><img src="/sites/all/themes/custom/sc_bs/img/arrow-left.png" alt="Previous"/></span></a>
  <a class="right carousel-control" href="#carousel" data-slide="next"><span><img src="/sites/all/themes/custom/sc_bs/img/arrow-right.png" alt="Next"/></span></a> 
</div>


        




