<?php


function ktc_preprocess_page(&$variables) {
    ctools_include('modal');
    ctools_modal_add_js();
    // init custom page vars
    //dpm($variables);
    $variables['show_title'] = TRUE;
    
    if (isset($variables['node'])) {
        $node = $variables['node'];
        if ($node->type == 'home_section_page' ||
            $node->type == 'interior_page' ||
            $node->type == 'soda_story_form_page' ||
            $node->type == 'blog_post' ) {
            $variables['show_title'] = FALSE;
        }
    }
    
    $uri = $_GET['q'];
    //dd($uri);
    if ($uri == 'image-gallery') {
        drupal_add_js(drupal_get_path('theme', 'ktc') . '/js/colorbox/colorbox/jquery.colorbox.js');
        drupal_add_js(drupal_get_path('theme', 'ktc') . '/js/ktc-gallery.js');
        drupal_add_css(drupal_get_path('theme', 'ktc') . '/js/colorbox/ktc/colorbox.css');
        $variables['show_title'] = FALSE;
    }
    elseif ($uri == 'blog' || strpos($uri, 'blog') == 0 ) {
        drupal_add_js(drupal_get_path('theme', 'ktc') . '/js/ktc-blog.js');
    }
    elseif ($uri == 'soda-stories-page') {
        drupal_add_js(drupal_get_path('theme', 'ktc') . '/js/ktc-soda-stories.js');
    }
    
    
    // search
    $variables['search_form'] = drupal_get_form('search_form');
    $variables['facts'] = ktccustom_get_fast_facts_news_flash();
    
    // share
    $variables['addthis'] = '<!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
<a class="addthis_button_compact"></a>
</div>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4dfb857c25abc3ea"></script>
<!-- AddThis Button END -->';
    
    // footer menu
    $footer_links = menu_build_tree('menu-footer-menu');
    $variables['footer_links'] = ktc_menu_tree_output($footer_links);
    
}



function ktc_preprocess_node(&$variables) {
    $node = $variables['node'];
    
    if ($node->type == 'home_section_page') {
        drupal_add_js(drupal_get_path('theme', 'ktc') .'/js/jquery.hoverIntent.js');
        drupal_add_js(drupal_get_path('theme', 'ktc') .'/js/ktc-panels.js');
        if (!empty($node->field_panel1)) {
            $panelnode = node_load($node->field_panel1['und'][0]['nid']);
            $panelview = node_view($panelnode);
            $variables['panel1'] = $panelview;
        }
        if (!empty($node->field_panel2)) {
            $panelnode = node_load($node->field_panel2['und'][0]['nid']);
            $panelview = node_view($panelnode);
            $variables['panel2'] = $panelview;
        }
        if (!empty($node->field_panel3)) {
            $panelnode = node_load($node->field_panel3['und'][0]['nid']);
            $panelview = node_view($panelnode);
            $variables['panel3'] = $panelview;
        }
        if (!empty($node->field_panel4)) {
            $panelnode = node_load($node->field_panel4['und'][0]['nid']);
            $panelview = node_view($panelnode);
            $variables['panel4'] = $panelview;
        }
        if (!empty($node->field_panel5)) {
            $panelnode = node_load($node->field_panel5['und'][0]['nid']);
            $panelview = node_view($panelnode);
            $variables['panel5'] = $panelview;
        }
        if (!empty($node->field_panel6)) {
            $panelnode = node_load($node->field_panel6['und'][0]['nid']);
            $panelview = node_view($panelnode);
            $variables['panel6'] = $panelview;
        }
    }
    
    elseif ($node->type == 'soda_story_form_page') {
        drupal_add_js(drupal_get_path('theme', 'ktc') .'/js/ktc-soda-stories.js');
        //require_once(DRUPAL_ROOT . "/modules/node/node.pages.inc")
        module_load_include('inc', 'node', 'node.pages');
        //include_once(drupal_get_path('module', 'node') . '/node.pages.inc');
        //include_once(drupal_get_path('module', 'file') . '/file.module');
        //$variables['story_form'] = module_invoke('formblock', 'block_view', 'soda_story');
        //$variables['story_form'] = drupal_get_form('soda_story_node_form');
        $variables['story_form'] = node_add('soda_story');
        //dd($variables['story_form']);
        //dpm($variables['story_form']);
    }
    
    elseif ($node->type == 'soda_story') {
        drupal_add_js(drupal_get_path('theme', 'ktc') .'/js/ktc_youtube.js');
        // grab the youtube video id from the url field
        //dpm($node);
        //$url = $node->field_story_video['und'][0]['value'];
        //$urlparts = explode('v=', $url);
        //$vid = $urlparts[1];
        //$extra = explode('&', $vid);
        $variables['vid'] = ktccustom_get_youtube_id($node->field_story_video['und'][0]['value']);
    }
    
    elseif ($node->type == 'videos_page') {
        drupal_add_js(drupal_get_path('theme', 'ktc') .'/js/ktc_youtube.js');
        drupal_add_js(drupal_get_path('module', 'ktccustom') . '/js/ktcvideos.js');
        drupal_add_css(drupal_get_path('module', 'ktccustom') . '/css/ktcvideos.css');
        $variables['most_watched'] = views_embed_view('most_viewed_videos', 'block');
        
        $cat_tree = taxonomy_get_tree(7);
        //dpm($cat_tree);
        $cats = array();
        foreach ($cat_tree as $cat) {
            $cat_obj = array();
            $cat_obj['name'] = $cat->name;
            $cats[] = $cat_obj;
        }
        $variables['cats'] = $cats;
        //dpm($variables);
    }
    
}



function ktc_get_gallery_categories() {
    $tree = taxonomy_get_tree(6); // hardcoding gallery category vid
    return $tree;
}



// implementation of the pager, mostly for the image gallery

function ktc_pager($variables) {
  $tags = $variables['tags'];
  $element = $variables['element'];
  $parameters = $variables['parameters'];
  $quantity = $variables['quantity'];
  global $pager_page_array, $pager_total;

  // Calculate various markers within this pager piece:
  // Middle is used to "center" pages around the current page.
  $pager_middle = ceil($quantity / 2);
  // current is the page we are currently paged to
  $pager_current = $pager_page_array[$element] + 1;
  // first is the first page listed by this pager piece (re quantity)
  $pager_first = $pager_current - $pager_middle + 1;
  // last is the last page listed by this pager piece (re quantity)
  $pager_last = $pager_current + $quantity - $pager_middle;
  // max is the maximum page number
  $pager_max = $pager_total[$element];
  // End of marker calculations.

  // Prepare for generation loop.
  $i = $pager_first;
  if ($pager_last > $pager_max) {
    // Adjust "center" if at end of query.
    $i = $i + ($pager_max - $pager_last);
    $pager_last = $pager_max;
  }
  if ($i <= 0) {
    // Adjust "center" if at start of query.
    $pager_last = $pager_last + (1 - $i);
    $i = 1;
  }
  // End of generation loop preparation.

  $li_first = theme('pager_first', array('text' => (isset($tags[0]) ? $tags[0] : t('« first')), 'element' => $element, 'parameters' => $parameters));
  $li_previous = theme('pager_previous', array('text' => '', 'element' => $element, 'interval' => 1, 'parameters' => $parameters));
  $li_next = theme('pager_next', array('text' => '', 'element' => $element, 'interval' => 1, 'parameters' => $parameters));
  $li_last = theme('pager_last', array('text' => (isset($tags[4]) ? $tags[4] : t('last »')), 'element' => $element, 'parameters' => $parameters));

  if ($li_previous) {
      $items[] = array(
        'class' => array('pager-previous'),
        'data' => $li_previous,
      );
    }

  if ($pager_total[$element] > 1) {
    //if ($li_first) {
    //  $items[] = array(
    //    'class' => array('pager-first'),
    //    'data' => $li_first,
    //  );
    //}
    

    // When there is more than one page, create the pager list.
    if ($i != $pager_max) {
      if ($i > 1) {
        $items[] = array(
          'class' => array('pager-ellipsis'),
          'data' => '…',
        );
      }
      // Now generate the actual pager piece.
      for (; $i <= $pager_last && $i <= $pager_max; $i++) {
        if ($i < $pager_current) {
          $items[] = array(
            'class' => array('pager-item'),
            'data' => theme('pager_previous', array('text' => $i, 'element' => $element, 'interval' => ($pager_current - $i), 'parameters' => $parameters)),
          );
        }
        if ($i == $pager_current) {
          $items[] = array(
            'class' => array('pager-current'),
            'data' => $i,
          );
        }
        if ($i > $pager_current) {
          $items[] = array(
            'class' => array('pager-item'),
            'data' => theme('pager_next', array('text' => $i, 'element' => $element, 'interval' => ($i - $pager_current), 'parameters' => $parameters)),
          );
        }
      }
      if ($i < $pager_max) {
        $items[] = array(
          'class' => array('pager-ellipsis'),
          'data' => '…',
        );
      }
    }
    // End generation.
    if ($li_next) {
      $items[] = array(
        'class' => array('pager-next'),
        'data' => $li_next,
      );
    }
    //if ($li_last) {
    //  $items[] = array(
    //    'class' => array('pager-last'),
    //    'data' => $li_last,
    //  );
    //}
    return theme('item_list', array(
      'items' => $items,
      'attributes' => array('class' => array('pager')),
    ));
  }
}


/**
 * @defgroup pagerpieces Pager pieces
 * @{
 * Theme functions for customizing pager elements.
 *
 * Note that you should NOT modify this file to customize your pager.
 */

/**
 * Returns HTML for the "first page" link in a query pager.
 *
 * @param $variables
 *   An associative array containing:
 *   - text: The name (or image) of the link.
 *   - element: An optional integer to distinguish between multiple pagers on
 *     one page.
 *   - parameters: An associative array of query string parameters to append to
 *     the pager links.
 *
 * @ingroup themeable
 */
function ktc_pager_first($variables) {
  $text = $variables['text'];
  $element = $variables['element'];
  $parameters = $variables['parameters'];
  global $pager_page_array;
  $output = '';

  // If we are anywhere but the first page
  if ($pager_page_array[$element] > 0) {
    $output = theme('pager_link', array('text' => $text, 'page_new' => pager_load_array(0, $element, $pager_page_array), 'element' => $element, 'parameters' => $parameters));
  }

  return $output;
}

/**
 * Returns HTML for the "previous page" link in a query pager.
 *
 * @param $variables
 *   An associative array containing:
 *   - text: The name (or image) of the link.
 *   - element: An optional integer to distinguish between multiple pagers on
 *     one page.
 *   - interval: The number of pages to move backward when the link is clicked.
 *   - parameters: An associative array of query string parameters to append to
 *     the pager links.
 *
 * @ingroup themeable
 */
function ktc_pager_previous($variables) {
  $text = $variables['text'];
  $element = $variables['element'];
  $interval = $variables['interval'];
  $parameters = $variables['parameters'];
  global $pager_page_array;
  $output = '';

  // If we are anywhere but the first page
  if ($pager_page_array[$element] > 0) {
    $page_new = pager_load_array($pager_page_array[$element] - $interval, $element, $pager_page_array);

    // If the previous page is the first page, mark the link as such.
    if ($page_new[$element] == 0) {
      $output = theme('pager_first', array('text' => $text, 'element' => $element, 'parameters' => $parameters));
    }
    // The previous page is not the first page.
    else {
      $output = theme('pager_link', array('text' => $text, 'page_new' => $page_new, 'element' => $element, 'parameters' => $parameters));
    }
  }

  return $output;
}

/**
 * Returns HTML for the "next page" link in a query pager.
 *
 * @param $variables
 *   An associative array containing:
 *   - text: The name (or image) of the link.
 *   - element: An optional integer to distinguish between multiple pagers on
 *     one page.
 *   - interval: The number of pages to move forward when the link is clicked.
 *   - parameters: An associative array of query string parameters to append to
 *     the pager links.
 *
 * @ingroup themeable
 */
function ktc_pager_next($variables) {
  $text = $variables['text'];
  $element = $variables['element'];
  $interval = $variables['interval'];
  $parameters = $variables['parameters'];
  global $pager_page_array, $pager_total;
  $output = '';

  // If we are anywhere but the last page
  if ($pager_page_array[$element] < ($pager_total[$element] - 1)) {
    $page_new = pager_load_array($pager_page_array[$element] + $interval, $element, $pager_page_array);
    // If the next page is the last page, mark the link as such.
    if ($page_new[$element] == ($pager_total[$element] - 1)) {
      $output = theme('pager_last', array('text' => $text, 'element' => $element, 'parameters' => $parameters));
    }
    // The next page is not the last page.
    else {
      $output = theme('pager_link', array('text' => $text, 'page_new' => $page_new, 'element' => $element, 'parameters' => $parameters));
    }
  }

  return $output;
}

/**
 * Returns HTML for the "last page" link in query pager.
 *
 * @param $variables
 *   An associative array containing:
 *   - text: The name (or image) of the link.
 *   - element: An optional integer to distinguish between multiple pagers on
 *     one page.
 *   - parameters: An associative array of query string parameters to append to
 *     the pager links.
 *
 * @ingroup themeable
 */
function ktc_pager_last($variables) {
  $text = $variables['text'];
  $element = $variables['element'];
  $parameters = $variables['parameters'];
  global $pager_page_array, $pager_total;
  $output = '';

  // If we are anywhere but the last page
  if ($pager_page_array[$element] < ($pager_total[$element] - 1)) {
    $output = theme('pager_link', array('text' => $text, 'page_new' => pager_load_array($pager_total[$element] - 1, $element, $pager_page_array), 'element' => $element, 'parameters' => $parameters));
  }

  return $output;
}


/**
 * Returns HTML for a link to a specific query result page.
 *
 * @param $variables
 *   An associative array containing:
 *   - page_new: The first result to display on the linked page.
 *   - element: An optional integer to distinguish between multiple pagers on
 *     one page.
 *   - parameters: An associative array of query string parameters to append to
 *     the pager link.
 *   - attributes: An associative array of HTML attributes to apply to a pager
 *     anchor tag.
 *
 * @ingroup themeable
 */
function ktc_pager_link($variables) {
  $text = $variables['text'];
  $page_new = $variables['page_new'];
  $element = $variables['element'];
  $parameters = $variables['parameters'];
  $attributes = $variables['attributes'];

  $page = isset($_GET['page']) ? $_GET['page'] : '';
  if ($new_page = implode(',', pager_load_array($page_new[$element], $element, explode(',', $page)))) {
    $parameters['page'] = $new_page;
  }

  $query = array();
  if (count($parameters)) {
    $query = drupal_get_query_parameters($parameters, array());
  }
  if ($query_pager = pager_get_query_parameters()) {
    $query = array_merge($query, $query_pager);
  }

  // Set each pager link title
  if (!isset($attributes['title'])) {
    static $titles = NULL;
    if (!isset($titles)) {
      $titles = array(
        t('« first') => t('Go to first page'),
        t('‹ previous') => t('Go to previous page'),
        t('next ›') => t('Go to next page'),
        t('last »') => t('Go to last page'),
      );
    }
    if (isset($titles[$text])) {
      $attributes['title'] = $titles[$text];
    }
    elseif (is_numeric($text)) {
      $attributes['title'] = t('Go to page @number', array('@number' => $text));
    }
  }

  return l($text, $_GET['q'], array('attributes' => $attributes, 'query' => $query));
}



function ktc_menu_tree_output($tree, $level = 0) {
    //dpm($tree);
    $build = array();
  $items = array();

  // Pull out just the menu links we are going to render so that we
  // get an accurate count for the first/last classes.
  foreach ($tree as $data) {
    if ($data['link']['access'] && !$data['link']['hidden']) {
      $items[] = $data;
    }
  }

  $router_item = menu_get_item();
  $num_items = count($items);
  foreach ($items as $i => $data) {
    $class = array();
    if ($i == 0) {
      $class[] = 'first';
    }
    if ($i == $num_items - 1) {
      $class[] = 'last';
    }
    // Set a class for the <li>-tag. Since $data['below'] may contain local
    // tasks, only set 'expanded' class if the link also has children within
    // the current menu.
    if ($data['link']['has_children'] && $data['below']) {
      $class[] = 'expanded';
    }
    elseif ($data['link']['has_children']) {
      $class[] = 'collapsed';
    }
    else {
      $class[] = 'leaf';
    }
    // Set a class if the link is in the active trail.
    if ($data['link']['in_active_trail']) {
      $class[] = 'active-trail';
      $data['link']['localized_options']['attributes']['class'][] = 'active-trail';
    }
    
    $class[] = 'level_' . $level;
    if ($data['link']['href'] == 'advocacy-login') {
        //dd('asdfadsf');
        $data['link']['localized_options']['attributes']['class'][] = 'ctools-use-modal';
    }
    // Normally, l() compares the href of every link with $_GET['q'] and sets
    // the active class accordingly. But local tasks do not appear in menu
    // trees, so if the current path is a local task, and this link is its
    // tab root, then we have to set the class manually.
    //dd($data['link']['href']);
    if ($data['link']['href'] == $router_item['tab_root_href'] && $data['link']['href'] != $_GET['q']) {
      $data['link']['localized_options']['attributes']['class'][] = 'active';
    }

    // Allow menu-specific theme overrides.
    $element['#theme'] = 'menu_link__' . $data['link']['menu_name'];
    $element['#attributes']['class'] = $class;
    $element['#title'] = $data['link']['title'];
    $element['#href'] = $data['link']['href'];
    $element['#localized_options'] = !empty($data['link']['localized_options']) ? $data['link']['localized_options'] : array();
    
    // bw : my way of removing child elements that are not in the active trail. better way??
    if ($data['link']['in_active_trail']) {
        $element['#below'] = $data['below'] ? ktc_menu_tree_output($data['below'], $level+1) : $data['below'];
    }
    else {
        $element['#below'] = NULL;
    }
    $element['#original_link'] = $data['link'];
    // Index using the link's unique mlid.
    $build[$data['link']['mlid']] = $element;
  }
  if ($build) {
    // Make sure drupal_render() does not re-order the links.
    $build['#sorted'] = TRUE;
    // Add the theme wrapper for outer markup.
    // Allow menu-specific theme overrides.
    $build['#theme_wrappers'][] = 'menu_tree__' . strtr($data['link']['menu_name'], '-', '_');
  }

  return $build;
}