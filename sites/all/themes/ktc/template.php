<?php


function ktc_preprocess_page(&$variables) {
    // init custom page vars
    $variables['show_title'] = TRUE;
    
    if (isset($variables['node'])) {
        $node = $variables['node'];
        if ($node->type == 'home_section_page' ||
            $node->type == 'interior_page') {
            $variables['show_title'] = FALSE;
        }
    }
    
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
}