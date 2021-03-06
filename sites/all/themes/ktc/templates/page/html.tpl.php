<?php

/**
 * @file
 * Default theme implementation to display the basic html structure of a single
 * Drupal page.
 *
 * Variables:
 * - $css: An array of CSS files for the current page.
 * - $language: (object) The language the site is being displayed in.
 *   $language->language contains its textual representation.
 *   $language->dir contains the language direction. It will either be 'ltr' or 'rtl'.
 * - $rdf_namespaces: All the RDF namespace prefixes used in the HTML document.
 * - $grddl_profile: A GRDDL profile allowing agents to extract the RDF data.
 * - $head_title: A modified version of the page title, for use in the TITLE
 *   tag.
 * - $head_title_array: (array) An associative array containing the string parts
 *   that were used to generate the $head_title variable, already prepared to be
 *   output as TITLE tag. The key/value pairs may contain one or more of the
 *   following, depending on conditions:
 *   - title: The title of the current page, if any.
 *   - name: The name of the site.
 *   - slogan: The slogan of the site, if any, and if there is no title.
 * - $head: Markup for the HEAD section (including meta tags, keyword tags, and
 *   so on).
 * - $styles: Style tags necessary to import all CSS files for the page.
 * - $scripts: Script tags necessary to load the JavaScript files and settings
 *   for the page.
 * - $page_top: Initial markup from any modules that have altered the
 *   page. This variable should always be output first, before all other dynamic
 *   content.
 * - $page: The rendered page content.
 * - $page_bottom: Final closing markup from any modules that have altered the
 *   page. This variable should always be output last, after all other dynamic
 *   content.
 * - $classes String of classes that can be used to style contextually through
 *   CSS.
 *
 * @see template_preprocess()
 * @see template_preprocess_html()
 * @see template_process()
 */
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN"
  "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language; ?>" version="XHTML+RDFa 1.0" dir="<?php print $language->dir; ?>"<?php print $rdf_namespaces; ?>
      xmlns:og="http://ogp.me/ns#"
      xmlns:fb="http://www.facebook.com/2008/fbml">

<head profile="<?php print $grddl_profile; ?>">
  <?php print $head; ?>
  <title><?php print $head_title; ?></title>
  <meta property="og:site_name" content="KickTheCan"/>
  <meta property="og:type" content="article"/>
  <meta property="fb:admins" content="788964277"/>
  <meta property="og:image" content="http://dev.kickthecan.info/KTC_site_lockup.jpg" />
  <meta property="keywords" content="Sugary Drinks, Soda, Soda Tax, Sugar-Sweetened Beverages, Beverages, CCPHA, Harold Goldstein, Healthy Beverage Campaign, Advocacy, California Center for Public Health Advocacy, Healthy vending machines, Soda policy, Sugar-Sweetened beverage policy, California Soda Campaign, Soda campaign, Sugary Drink campaign, Beverage industry tactics, Soda advertising, Soda industry" />
  <meta property="description" content="KICK THE CAN.INFO  provides trustworthy and up-to-date information about the negative health effects of soda and other sugary drinks, summarizes sugary drink related policy activity around the country, links to key reports, studies and media coverage, shows a collection of sugary drink related photos and videos, and provides information about beverage industry strategies. "; />
  <?php print $styles; ?>
  <?php print $scripts; ?>
</head>
<body class="<?php print $classes; ?>" <?php print $attributes;?>>
  <div id="skip-link">
    <a href="#main-content" class="element-invisible element-focusable"><?php print t('Skip to main content'); ?></a>
  </div>
  <?php print $page_top; ?>
  <?php print $page; ?>
  <?php print $page_bottom; ?>
  
   <div id="fb-root"></div>
<script type="text/javascript">
    Cufon.now();
    window.fbAsyncInit = function() {
        FB.init({
            appId: '788964277', // Your Facebook ID
            status: true, 
            cookie: true,
            xfbml: true
        });
    };
    (function() {
        var e = document.createElement('script'); e.async = true;
        e.src = document.location.protocol +
            '//connect.facebook.net/en_US/all.js';
        document.getElementById('fb-root').appendChild(e);
    }());
    
</script>
  
</body>
</html>
