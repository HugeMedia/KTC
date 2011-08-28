<?php
 /**
  * This template is used to print a single field in a view. It is not
  * actually used in default Views, as this is registered as a theme
  * function which has better performance. For single overrides, the
  * template is perfectly okay.
  *
  * Variables available:
  * - $view: The view object
  * - $field: The field handler object that can process the input
  * - $row: The raw SQL result that can be used
  * - $output: The processed output that will normally be used.
  *
  * When fetching output from the $row, this construct should be used:
  * $data = $row->{$field->field_alias}
  *
  * The above will guarantee that you'll always get the correct data,
  * regardless of any changes in the aliasing that might happen if
  * the view is modified.
  */
?>
<?php //print $output; ?>
<?php //print 'O'; ?>
<?php
  //$image_url = file_create_url($row->field_field_gallery_large[0]['raw']['uri']);
  $popup_url = image_style_url('gallery_popup_418w', $row->field_field_gallery_large[0]['raw']['uri']);
  $tn_url = image_style_url('gallery_thumbnail', $row->field_field_gallery_large[0]['raw']['uri']);
?>
<a href="<?php print $popup_url; ?>" rel="gallery"  class="pirobox_gall" title="<?php print $row->node_title; ?>"><img src="<?php print $tn_url; ?>" /></a>
<?php dpm($row); ?>