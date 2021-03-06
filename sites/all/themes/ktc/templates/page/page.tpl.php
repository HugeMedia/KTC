<?php

/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 */
?>

  <div id="page-wrapper"><div id="page">
    <div id="header-top"><div id="header-top-inner"><?php print render($facts); ?></div></div>
    <div id="header"><div class="section clearfix">

      <?php if ($logo): ?>
        <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo">
          <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
        </a>
      <?php endif; ?>
          <?php if ($site_slogan): ?>
            <div id="site-slogan"><?php print $site_slogan; ?></div>
          <?php endif; ?>
      
      <div id="header-share">
        <?php global $base_url; ?>
        <div id="fb-icon"><a href="http://www.facebook.com"><img src="<?php print $base_url . '/' . drupal_get_path('theme', 'ktc') . '/images/fb.png'; ?>" /></a></div>
        <?php print $addthis; ?>
        <div id="fb-like"><fb:like show-faces="true" width="100" href="<?php print $base_url; ?>"></fb:like></div>
        <?php print render($search_form); ?>
      </div>
      
      <?php print render($page['header']); ?>

    </div></div> <!-- /.section, /#header -->

    <?php if ($main_menu || $secondary_menu): ?>
      <div id="navigation"><div class="section">
        <?php //dpm($page); ?>
        <?php print render($page['navigation']); ?>
        <?php //print theme('links__system_main_menu', array('links' => $main_menu, 'attributes' => array('id' => 'main-menu', 'class' => array('links', 'inline', 'clearfix')), 'heading' => t('Main menu'))); ?>
        <?php //print theme('links__system_secondary_menu', array('links' => $secondary_menu, 'attributes' => array('id' => 'secondary-menu', 'class' => array('links', 'inline', 'clearfix')), 'heading' => t('Secondary menu'))); ?>
      </div></div> <!-- /.section, /#navigation -->
    <?php endif; ?>

    <?php print $messages; ?>

    <div id="main-wrapper"><div id="main-burst"><div id="main" class="clearfix">

      <div id="content" class="column"><div class="section">
        <?php if ($page['highlighted']): ?><div id="highlighted"><?php print render($page['highlighted']); ?></div><?php endif; ?>
        <a id="main-content"></a>
        
        <?php if ($show_title): ?>
            <?php print render($title_prefix); ?>
            <?php if ($title): ?><h1 class="title" id="page-title"><?php print $title; ?></h1><?php endif; ?>
            <?php print render($title_suffix); ?>
        <?php endif; ?>
        
        <?php if ($tabs): ?><div class="tabs"><?php print render($tabs); ?></div><?php endif; ?>
        <?php print render($page['help']); ?>
        <?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
        <?php print render($page['content']); ?>
        <?php //print $feed_icons; ?>
      </div></div> <!-- /.section, /#content -->

      <?php if ($page['sidebar_first']): ?>
        <div id="sidebar-first" class="column sidebar"><div class="section">
          <?php print render($page['sidebar_first']); ?>
        </div></div> <!-- /.section, /#sidebar-first -->
      <?php endif; ?>

      <?php if ($page['sidebar_second']): ?>
        <div id="sidebar-second" class="column sidebar"><div class="section">
          <?php print render($page['sidebar_second']); ?>
        </div></div> <!-- /.section, /#sidebar-second -->
      <?php endif; ?>

    </div></div></div> <!-- /#main, /#main-burst, /#main-wrapper -->

    <div id="footer"><div class="section">
      <?php print render($footer_links); ?>
      <div id="footer-text"><span>KickTheCan.info</span><span>Consumer and Nutrition Information for Cultivating a Healthier Relationship with Soda Beverages</span></div>
      <?php print render($page['footer']); ?>
    </div></div> <!-- /.section, /#footer -->
<script type="text/javascript">   
    Cufon.replace('#site-slogan, h1.title, form.search-form label, #header-top .facts-label, #footer #footer-text span, div.node h2, div.node h1, div.node h3, div.node p, div.node #interior-footnotes ol li');
		Cufon.replace('ul#superfish-1 li a', { hover: true });
		
		//Cufon.replace('h1.title');
		//Cufon.replace('form.search-form label');
		//Cufon.replace('#header-top .facts-label');
		//Cufon.replace('#header-top .ktc-fact');
		
		// home pages
		//Cufon.replace('#home-top-right')
		
		Cufon.replace('#home-top-right div.field-name-field-home-header div.field-item p');
                Cufon.replace('#home-top-right div.field-item ul');
		Cufon.replace('#home-top-right div.field-name-body div.field-item p');
		Cufon.replace('#home-top-left ul.home-section-menu li a');
		Cufon.replace('#home-section-bottom #panels-header span');
		Cufon.replace('#home-panels table td span');
		Cufon.replace('#home-panels table td a');
                Cufon.replace('#home-panels ul');
		//Cufon.replace('form#print-mail-form label').replace('form#print-mail-form div.description').replace('form#print-mail-form #edit-fld-title');
		
		// footer
		Cufon.replace('#footer ul.menu li a', { hover: true });
                Cufon.now();
    //Cufon.replace('table a', { hover: true });
    
    //Cufon.replace('#main ul', { hover: true });
    //Cufon.replace('#superfish-1 a', { hover: true });
    //Cufon.replace('ul.home-section-menu');
    //Cufon.replace('#panels-header');
    //Cufon.replace('#footer', { hover: true });
    ////Cufon.replace('#footer ul.menu', { hover: true });
    ////Cufon.replace('#footer #footer-text');
    //Cufon.replace('#image-gallery-filter-title');
    ////Cufon.replace('div.ctools-modal-content  .modal-header');
    ////Cufon.replace('#modal-content');
    //Cufon.now();
</script> 
  </div></div> <!-- /#page, /#page-wrapper -->
