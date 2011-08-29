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
<?php dpm($row); ?>
<?php print $output; ?>
<div class="soda-story-popup" popup="<?php print $row->field_field_story_popup[0]['raw']['value']; ?>" ></div>
<div class="soda-story-link" url="<?php print $row->field_field_story_video[0]['raw']['value']; ?>" ></div>
<div class="soda-story-title" title="<?php print $row->node_title; ?>" ></div>
