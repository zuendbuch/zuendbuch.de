<?php
// $Id: page.tpl.php,v 1.6.2.1 2010/06/18 17:55:11 jarek Exp $

/**
 * @file page.tpl.php
 *
 * Theme implementation to display a single Drupal page.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $css: An array of CSS files for the current page.
 * - $directory: The directory the theme is located in, e.g. themes/garland or
 *   themes/garland/minelli.
 * - $is_front: TRUE if the current page is the front page. Used to toggle the mission statement.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Page metadata:
 * - $language: (object) The language the site is being displayed in.
 *   $language->language contains its textual representation.
 *   $language->dir contains the language direction. It will either be 'ltr' or 'rtl'.
 * - $head_title: A modified version of the page title, for use in the TITLE tag.
 * - $head: Markup for the HEAD section (including meta tags, keyword tags, and
 *   so on).
 * - $styles: Style tags necessary to import all CSS files for the page.
 * - $scripts: Script tags necessary to load the JavaScript files and settings
 *   for the page.
 * - $body_classes: A set of CSS classes for the BODY tag. This contains flags
 *   indicating the current layout (multiple columns, single column), the current
 *   path, whether the user is logged in, and so on.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 * - $mission: The text of the site mission, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $search_box: HTML to display the search box, empty if search has been disabled.
 * - $primary_links (array): An array containing primary navigation links for the
 *   site, if they have been configured.
 * - $secondary_links (array): An array containing secondary navigation links for
 *   the site, if they have been configured.
 *
 * Page content (in order of occurrance in the default page.tpl.php):
 * - $left: The HTML for the left sidebar.
 *
 * - $breadcrumb: The breadcrumb trail for the current page.
 * - $title: The page title, for use in the actual HTML content.
 * - $help: Dynamic help text, mostly for admin pages.
 * - $messages: HTML for status and error messages. Should be displayed prominently.
 * - $tabs: Tabs linking to any sub-pages beneath the current page (e.g., the view
 *   and edit tabs when displaying a node).
 *
 * - $content: The main content of the current Drupal page.
 *
 * - $right: The HTML for the right sidebar.
 *
 * Footer/closing data:
 * - $feed_icons: A string of all feed icons for the current page.
 * - $footer_message: The footer message as defined in the admin settings.
 * - $footer : The footer region.
 * - $closure: Final closing markup from any modules that have altered the page.
 *   This variable should always be output last, after all other dynamic content.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language ?>" lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>">

<head>
  <?php print $head; ?>
  <title><?php print $head_title; ?></title>
  <link type="text/css" rel="stylesheet" media="all" href="<?php print $base_path . $directory; ?>/reset.css" />
  <?php print $styles; ?>

  <!--[if lte IE 8]>
  <link type="text/css" rel="stylesheet" href="<?php print $base_path . $directory; ?>/ie8.css" media="all" />
  <![endif]-->

  <?php print $scripts; ?>
</head>
<body class="<?php print $body_classes; ?> <?php print $layout_classes; ?>">

  <div id="skip-link">
      <a href="#main-content">Skip to main content</a>
  </div>

  <div id="header-wrapper">
    <div id="header">

      <div id="branding">

        <?php if (!empty($logo)): ?>
          <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo">
            <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
          </a>
        <?php endif; ?>

        <div id="name-and-slogan">
          <?php if (!empty($site_name)): ?>
            <div id="site-name">
              <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><?php print $site_name; ?></a>
            </div>
          <?php else: /* Use h1 when the content title is empty */ ?>
            <h1 id="site-name">
              <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><?php print $site_name; ?></a>
            </h1>
          <?php endif; ?>

          <?php if (!empty($site_slogan)): ?>
            <div id="site-slogan"><?php print $site_slogan; ?></div>
          <?php endif; ?>
        </div> <!-- /name-and-slogan -->

      </div> <!-- /#branding -->
	<?php if (!empty($header_top)): ?>
            <div id="header_top" class="first">
              <?php print $header_top; ?>
            </div>
        <?php endif; ?>
      <?php /*if (!empty($navigation)):*/ ?>
        <div id="navigation" class="clear-block">
          <?php print $navigation; ?>
        </div>
      <?php /*endif;*/ ?>

    </div> <!-- /#header -->
  </div> <!-- /#header-wrapper -->

  <div id="main-wrapper">
    <div id="main">
	
      <div id="main-columns" class="clearfix">
	<?php print $content_top; // Zrec ?>
        <?php if (!empty($sidebar_first)): ?>
          <div id="sidebar-first-wrapper">
            <div id="sidebar-first" class="first">
              <?php print $sidebar_first; ?>
            </div> <!-- /#sidebar-first -->
          </div> <!-- /#sidebar-first-wrapper -->
        <?php endif; ?>

        <div id="content-wrapper">
	
          <div id="content" class="<?php if (empty($sidebar_first)): ?>first<?php endif; ?><?php if (empty($sidebar_second)): ?> last<?php endif; ?>">
            <?php if (!empty($breadcrumb)): ?><div id="breadcrumb"><?php print $breadcrumb; ?></div><?php endif; ?>
            <?php if (!empty($messages)): print $messages; endif; ?>
            <?php if (!empty($tabs)): ?><div class="tabs"><?php print $tabs; ?></div><?php endif; ?>

            <a id="main-content"></a>
            <?php //print $feed_icons; Zrec ?>

            <?php if (!empty($title) && !isset($node)): ?>
              <h1 class="page-title"><?php print $title ?></h1>
            <?php endif; ?>

            <?php if (!empty($help)): print $help; endif; ?>
            <?php //print $content_top; Zrec ?>
            <?php print $content; ?>
            <?php print $content_bottom; ?>
          </div> <!-- /#content -->
        </div> <!-- /#content-wrapper -->

        <?php if (!empty($sidebar_second)): ?>
          <div id="sidebar-second-wrapper">
            <div id="sidebar-second" class="column sidebar last">
              <?php print $sidebar_second; ?>
            </div> <!-- /#sidebar-second -->
          </div> <!-- /#sidebar-second-wrapper -->
        <?php endif; ?>
      </div> <!-- /#main-columns -->

    </div> <!-- /#main -->
  </div> <!-- /#main-wrapper -->

<div id="footer-wrapper">
  <div id="footer">

    <?php if (!empty($footer_column_first) || !empty($footer_column_second) || !empty($footer_column_third) || !empty($footer_column_fourth)): ?>
      <h2 class="element-invisible"><?php print t('Footer'); ?></h2>
      <div id="footer-columns" class="columns-4">
        <?php if (!empty($footer_column_first)): ?>
          <div id="footer-column-first" class="column first">
            <div class="region">
              <?php print $footer_column_first; ?>
            </div>
          </div> <!-- /#footer-column-first -->
        <?php endif; ?>

        <?php if (!empty($footer_column_second)): ?>
          <div id="footer-column-second" class="column <?php if (empty($footer_column_first)): ?> first<?php endif; ?><?php if (empty($footer_column_third) && empty($footer_column_fourth)): ?> last<?php endif; ?>">
            <div class="region">
              <?php print $footer_column_second; ?>
            </div>
          </div> <!-- /#footer-column-second -->
        <?php endif; ?>

        <?php if (!empty($footer_column_third)): ?>
          <div id="footer-column-third" class="column <?php if (empty($footer_column_first) && empty($footer_column_second)): ?> first<?php endif; ?><?php if (empty($footer_column_fourth)): ?> last<?php endif; ?>">
            <div class="region">
              <?php print $footer_column_third; ?>
            </div>
          </div> <!-- /#footer-column-third -->
        <?php endif; ?>

        <?php if (!empty($footer_column_fourth)): ?>
          <div id="footer-column-fourth" class="column last <?php if (empty($footer_column_first) && empty($footer_column_second) && empty($footer_column_third)): ?> first<?php endif; ?>">
            <div class="region">
              <?php print $footer_column_fourth; ?>
            </div>
          </div> <!-- /#footer-column-fourth -->
        <?php endif; ?>
      </div><!-- /#footer-columns -->
    <?php endif; ?>

    <div id="closure">

      <div id="info">
        Drupal theme by <a href="http://www.kiwi-themes.com">Kiwi Themes</a>, based on <a href="http://tarskitheme.com/about/">Tarski</a> project.
      </div>

      <?php if ($secondary_links): ?>
        <div id="secondary-menu">
          <?php print theme('links', $secondary_links, array('class' => 'secondary-links')); ?>
        </div> <!-- /#secondary-menu -->
      <?php endif; ?>

    </div> <!-- /#closure -->

    </div> <!-- /#footer -->
  </div> <!-- /#footer-wrapper -->
  
  <?php print $closure; ?>

</body>
</html>
