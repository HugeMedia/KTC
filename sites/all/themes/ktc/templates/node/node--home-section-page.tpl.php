<?php

/**
 * @file
 * Default theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all,
 *   or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct url of the current node.
 * - $display_submitted: Whether submission information should be displayed.
 * - $submitted: Submission information created from $name and $date during
 *   template_preprocess_node().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type, i.e., "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type, i.e. story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode, e.g. 'full', 'teaser'...
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined, e.g. $node->body becomes $body. When needing to access
 * a field's raw values, developers/themers are strongly encouraged to use these
 * variables. Otherwise they will have to explicitly specify the desired field
 * language, e.g. $node->body['en'], thus overriding any language negotiation
 * rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 */
?>
<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <div class="content"<?php print $content_attributes; ?>>
    <?php
      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
      //print render($content);
    ?>
    <div id="home-section-top">
      <div id="home-top-left">
        <?php print render($content['field_home_banner']); ?>
        <?php
          $menu = menu_navigation_links('menu-home-section-menu');
          print theme('links__menu_home_section_menu', array('links' => $menu, 'attributes'=>array('class'=>array('links', 'home-section-menu'))));
        ?>
      </div>
    
      <div id="home-top-right">
        <div id="home-top-right-inner">
        <?php
          print render($content['field_home_header']);
          print render($content['body']);
        ?>
        </div>
      </div>
    </div>
    
    <div id="home-section-bottom">
      <?php if ($panel1['field_panel_expanded']['#items'][0]['value'] != 1): ?>
        <div id="panels-header"><span class="panels-title">RESOURCES</span><span class="panels-title-paren">(rollover to expand)</span></div>
      <?php else: ?>
      <div id="panels-header">&nbsp;</div>
      <?php endif; ?>
      <div id="home-panels">
        <?php if (!empty($panel1)): ?>
          <?php
            $large_panel = render($panel1['field_panel_large']);
            $mini_images = render(ktccustom_get_mini_images('block_1', 'Billboards'));
            $mini_images2 = render(ktccustom_get_mini_images('block_4', 'Generic Ads'));
            $mini_images3 = render(ktccustom_get_mini_images('block_5', 'Vending Machines'));
            $large_panel = str_replace('[[images]]', $mini_images . $mini_images2 . $mini_images3, $large_panel);
          ?>
        <div class="panel-wrapper">
          <?php if ($panel1['field_panel_expanded']['#items'][0]['value'] == 1): ?>
            <div class="home-section-panel" id="panel-1"><?php print render($panel1['field_panel_small']); ?></div>
            <div class="panel-shown panel-open-right" id="panel-1-expanded"><div class="panel-close"></div><?php print $large_panel; ?></div>
          <?php else: ?>
              <div class="home-section-panel" id="panel-1"><?php print render($panel1['field_panel_small']); ?></div>
              <div class="panel-expanded panel-open-right" id="panel-1-expanded"><div class="panel-close"></div><?php print $large_panel; ?></div>
          <?php endif; ?>
        </div>
        <?php endif; ?>
      
        <?php if (!empty($panel2)): ?>
        <?php
            $large_panel = render($panel2['field_panel_large']);
            $mini_images = render(ktccustom_get_mini_images('block_3', ''));
            $large_panel = str_replace('[[images]]', $mini_images, $large_panel);
          ?>
        <div class="panel-wrapper">
          <div class="home-section-panel" id="panel-2"><?php print render($panel2['field_panel_small']); ?></div>
          <div class="panel-expanded panel-open-right" id="panel-2-expanded"><div class="panel-close"></div><?php print $large_panel; ?></div>
        </div>
        <?php endif; ?>
      
        <?php if (!empty($panel3)): ?>
        <div class="panel-wrapper">
          <div class="home-section-panel panel-last" id="panel-3"><?php print render($panel3['field_panel_small']); ?></div>
          <?php if (isset($panel3['field_panel_large'])): ?>
            <div class="panel-expanded panel-open-left" id="panel-3-expanded"><div class="panel-close"></div><?php print render($panel3['field_panel_large']); ?></div>
          <?php endif; ?>
        </div>
        <?php endif; ?>
      
        <?php if (!empty($panel4)): ?>
        <div class="panel-wrapper">
          <div class="home-section-panel" id="panel-4"><?php print render($panel4['field_panel_small']); ?></div>
          <div class="panel-expanded panel-open-right" id="panel-4-expanded"><div class="panel-close"></div><?php print render($panel4['field_panel_large']); ?></div>
        </div>
        <?php endif; ?>
      
        <?php if (!empty($panel5)): ?>
        <div class="panel-wrapper">
          <?php if (isset($panel5['field_panel_large'])): ?>
            <div class="home-section-panel" id="panel-5"><?php print render($panel5['field_panel_small']); ?></div>
            <div class="panel-expanded panel-open-right" id="panel-5-expanded"><div class="panel-close"></div><?php print render($panel5['field_panel_large']); ?></div>
          <?php else: ?>
            <div class="home-section-panel panel-no-padding" id="panel-5"><?php print render($panel5['field_panel_small']); ?></div>
          <?php endif; ?>
        </div>
        <?php endif; ?>
      
        <?php if (!empty($panel6)): ?>
        <?php //dpm($panel6); ?>
        <div class="panel-wrapper">
          <?php if (isset($panel6['field_panel_large'])): ?>
            <div class="home-section-panel panel-last" id="panel-6"><?php print render($panel6['field_panel_small']); ?></div>
            <div class="panel-expanded panel-open-left" id="panel-6-expanded"><div class="panel-close"></div><?php print render($panel6['field_panel_large']); ?></div>
          <?php else: ?>
            <div class="home-section-panel panel-no-padding panel-last" id="panel-6"><?php print render($panel6['field_panel_small']); ?></div>
          <?php endif; ?>
        </div>
        <?php endif; ?>
      </div>
    </div>
    
  </div>

</div>
