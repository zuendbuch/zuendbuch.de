<?php
// $Id: template.php,v 1.7.2.1 2010/06/18 17:55:11 jarek Exp $

function tarski_preprocess_page(&$vars, $hook) {
  // Add reset CSS
  drupal_add_css($data = path_to_theme() . '/reset.css', $options['type'] = 'file', $options['weight'] = CSS_SYSTEM - 1);

  // Remove useless "no-sidebars" class from $body_classes variable
  if (preg_match("/no-sidebars/i", $vars['body_classes']) == true) {
    $vars['body_classes'] = str_replace('no-sidebars', '', $vars['body_classes']);
  }

  // Add $layout_classes variable
  if ( !empty($vars['sidebar_first']) && !empty($vars['sidebar_second']) ) {
    $vars['classes_array'][] = 'two-sidebars';
  }
  elseif ( !empty($vars['sidebar_first']) || !empty($vars['sidebar_second']) ) {
    $vars['classes_array'][] = 'one-sidebar';
  }
  else {
    $vars['classes_array'][] = 'no-sidebars';
  }
  $vars['layout_classes'] = implode(' ', $vars['classes_array']);

  // Add $navigation variable, unlike built-in $primary_links variable it supports drop-down menus
  if ($vars['primary_links']) {
    $pid = variable_get('menu_primary_links_source', 'primary-links');
    $tree = menu_tree($pid);

    $vars['navigation'] = $tree;
  } else {
    $vars['navigation'] = FALSE;
  }
  $vars['navigation'] = menu_tree('primary-links');
}

/**
 * Overrides theme_more_link().
 */
function tarski_more_link($url, $title) {
  return '<div class="more-link">'. t('<a href="@link" title="@title">more ›</a>', array('@link' => check_url($url), '@title' => $title)) .'</div>';
}

