<?php

/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template in this directory.
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
 * @see html.tpl.php
 *
 * @ingroup themeable
 */
 include_once drupal_get_path('theme', 'ishoj') . '/includes/sites_functions.php';
?>


    <!-- BURGER MENU START -->
    <div class="burger">
      <a class="navicon-button x">
        <div class="navicon"></div>
      </a>
    </div>
    <!-- BURGER MENU SLUT -->

    <!-- MOBIL NAVIGATION START -->
    <nav class="nav-mobile">
      <!-- MOBIL MENU START -->
      <?php
        if($logged_in) {
          print render($page['menu_mobile']);
        }
      ?>
      <!-- MOBIL MENU SLUT -->
    </nav>
    <!-- MOBIL NAVIGATION SLUT -->

    <!-- DIMMER START -->
    <div class="dimmer"></div>
    <!-- DIMMER SLUT -->

    <!-- PAGE START -->
    <div data-role="page">


      <!-- FOTOFRISE START -->
      <?php  print views_embed_view('frise','frise', $node->nid); ?>
      <!-- FOTOFRISE SLUT -->


      <!-- DRUPAL MESSAGES START -->
      <?php if ($messages): ?>
      <div class="drupal-messages">
        <div class="container">
          <div class="row">
            <div class="grid-full">
              <?php print $messages; ?>
              <?php if ($tabs): ?><div class="tabs"><?php print render($tabs); ?></div><?php endif; ?>
              <?php print render($page['help']); ?>
              <?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
            </div>
          </div>
        </div>
      </div>
      <?php endif; ?>
      <!-- DRUPAL MESSAGES SLUT -->


      <!-- <?php //if($logged_in): ?> -->
        <!-- REDAKTØRMENU START -->
        <!-- <section class="redaktormenu">
          <div class="container">
            <div class="row">
              <div class="grid-full">
                <div class="editor">
                  <div class="editorInner">
                    <?php //print render($page['editor']); ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section> -->
        <!-- REDAKTØRMENU SLUT -->
      <!-- <?php //endif; ?> -->


      <!-- CONTENT START -->
      <div data-role="content">
        <?php //print render($pcontent']); ?>

        <?php
        if(isset($node)) {

          // dsm($node);
          $output = "";

          $output .= "<!-- ARTIKEL START -->";
          $output .= "<section id=\"node-" . $node->nid . "\" class=\"" . $classes . " artikel\">";
            $output .= "<div class=\"container\">";

              if(!$logged_in) {

                $output .= "<form action=\"/user\" method=\"post\" class=\"webform-client-form\" accept-charset=\"UTF-8\"><div>";
                  $output .= "<div class=\"row\">";
                    $output .= "<div class=\"grid-half\">";
                      $output .= "<div class=\"_bruger-login\">";
                        $output .= "<div class=\"form-item webform-component\">";
                          $output .= "<label for=\"edit-name\">Brugernavn <span class=\"form-required\" title=\"Dette felt er obligatorisk.\">*</span></label>";
                          $output .= "<input type=\"text\" id=\"edit-name\" name=\"name\" value=\"\" class=\"form-text\" />";
                        $output .= "</div>";
                        $output .= "<div class=\"form-item webform-component\">";
                          $output .= "<label for=\"edit-pass\">Adgangskode <span class=\"form-required\" title=\"Dette felt er obligatorisk.\">*</span></label>";
                          $output .= "<input type=\"password\" id=\"edit-pass\" name=\"pass\" class=\"form-text\" />";
                        $output .= "</div>";
                        $output .= "<input type=\"hidden\" name=\"form_build_id\" value=\"form-wtjeQE_37ilViShLKoK4rlBMSy6NpbZRkMiTGBq5bQA\" />";
                        $output .= "<input type=\"hidden\" name=\"form_id\" value=\"user_login\" />";
                        $output .= "<div class=\"form-actions form-wrapper\" id=\"edit-actions\">";
                          $output .= "<input type=\"submit\" id=\"edit-submit\" name=\"op\" value=\"Log ind\" class=\"form-submit enter\" />";
                        $output .= "</div>";
                      $output .= "</div>";
                    $output .= "</div>";
                  $output .= "</div>";
                $output .= "</form>";
              }
              else {



            // $output .= "</div>";


              /////////////////////////////
              ////   NODE NAVIGATION   ////
              /////////////////////////////
              // $output .= "<div class=\"row\">";
              //   $output .= "<div class=\"grid-full\">";
              //     $output .= "<div class=\"row row-start-small match-heights-grid-full node-navigation\" data-match-heights-off>";
              //       $output .= views_embed_view('node_navigation','default');
              //     $output .= "</div>";
              //   $output .= "</div>";
              // $output .= "</div>";

              /////////////////////
              ////   RÆKKE 1   ////
              /////////////////////
              $output .= "<div class=\"row\">";
                $output .= "<div class=\"grid-two-thirds\">";
                // Brødkrummesti
                // $output .= "<p class=\"breadcrumbs\">" . theme('breadcrumb', array('breadcrumb'=>drupal_get_breadcrumb())) . " / " .  "<a href=\"" . url('taxonomy/term/' . $bterm->tid) . "\" title=\"Kategorien " . "</a>" . " / " . $title . "</p>";
                $output .= "</div>";
              $output .= "</div>";

              /////////////////////
              ////   RÆKKE 2   ////
              /////////////////////
              // $output .= "<div class=\"row second\">";
              //   $output .= "<div class=\"grid-two-thirds\">";
                  //   $output = $output . "<h1>" . $title . "</h1>";
              //   $output .= "</div>";
              //   $output .= "<div class=\"grid-third sociale-medier social-desktop\"></div>";
              // $output .= "</div>";



              /////////////////////
              ////   RÆKKE 3   ////
              /////////////////////
              $output .= "<div class=\"row second\">";
                $output .= "<div class=\"grid-two-thirds\">";

                  // $output .= "<h2>Logs</h2>";
                  // Liste over alle dronelogs
                  $output .= "<ul class=\"dronelog_liste\">";
                    $output .= views_embed_view('dronelog', 'liste_over_alle_logs');
                  $output .= "</ul>";


                  $output .= "<!-- ARTIKEL TOP START -->";
                  $output .= "<div class=\"artikel-top\">";
                    hide($content['field_image_flexslider']);
                    hide($content['field_os2web_base_field_image']);
                  $output .= "</div>";
                  $output .= "<!-- ARTIKEL TOP SLUT -->";

                  // UNDEROVERSKRIFT
                  $output .= "<!-- UNDEROVERSKRIFT START -->";
                  if($node->field_os2web_base_field_summary) {
                    // $output .= "<h2>" . $node->field_os2web_base_field_summary['und'][0]['safe_value'] . "</h2>";
                  }
                  $output .= "<!-- UNDEROVERSKRIFT SLUT -->";

                  // SELVBETJENINGSLØSNING
                  // $output .= "<!-- SELBETJENINGSLØSNING START -->";
                  // $output .= views_embed_view('selvbetjeningslosning','default', $node->nid);
                  // $output .= "<!-- SELBETJENINGSLØSNING SLUT -->";

                  // TEKSTINDHOLD
                  $output .= "<!-- TEKSTINDHOLD START -->";
                  hide($content['comments']);
                  hide($content['links']);
                  // $output .= render($content);
                  $output .= $node->body['und'][0]['safe_value'];
                  $output .= "<!-- TEKSTINDHOLD SLUT -->";

                  // SELVBETJENINGSLØSNING
                  $output .= "<!-- SELBETJENINGSLØSNING START -->";
                  $output .= "<p>&nbsp;</p>";
                  $output .= views_embed_view('selvbetjeningslosning','default', $node->nid);
                  $output .= "<!-- SELBETJENINGSLØSNING SLUT -->";

                  // MIKROARTIKLER
                  $output .= "<!-- MIKROARTIKLER START -->";
                  if($node->field_mikroartikler_titel1 or
                    $node->field_mikroartikler_titel2 or
                    $node->field_mikroartikler_titel3 or
                    $node->field_mikroartikler_titel4 or
                    $node->field_mikroartikler_titel5 or
                    $node->field_mikroartikler_titel6 or
                    $node->field_mikroartikler_titel7 or
                    $node->field_mikroartikler_titel8 or
                    $node->field_mikroartikler_titel9 or
                    $node->field_mikroartikler_titel10) {

                    $mikroartikel = '<div class="microArticleContainer">';

                    if($node->field_mikroartikler_titel1) {
                      $mikroartikel .= '<div class="microArticle"><h2 class="mArticle" id="mArticle1"><span class="sprites-sprite sprite-plus mikroartikel"></span>' . $node->field_mikroartikler_titel1['und'][0]['safe_value'] . '</h2>';
                      $mikroartikel .= '<div class="mArticle1 mArticle">' . $node->field_mikroartikler_tekst1['und'][0]['safe_value'] . '</div></div>';
                    }

                    if($node->field_mikroartikler_titel2) {
                      $mikroartikel .= '<div class="microArticle"><h2 class="mArticle" id="mArticle2"><span class="sprites-sprite sprite-plus mikroartikel"></span>' . $node->field_mikroartikler_titel2['und'][0]['safe_value'] . '</h2>';
                      $mikroartikel .= '<div class="mArticle2 mArticle">' . $node->field_mikroartikler_tekst2['und'][0]['safe_value'] . '</div></div>';
                    }

                    if($node->field_mikroartikler_titel3) {
                      $mikroartikel .= '<div class="microArticle"><h2 class="mArticle" id="mArticle3"><span class="sprites-sprite sprite-plus mikroartikel"></span>' . $node->field_mikroartikler_titel3['und'][0]['safe_value'] . '</h2>';
                      $mikroartikel .= '<div class="mArticle3 mArticle">' . $node->field_mikroartikler_tekst3['und'][0]['safe_value'] . '</div></div>';
                    }

                    if($node->field_mikroartikler_titel4) {
                      $mikroartikel .= '<div class="microArticle"><h2 class="mArticle" id="mArticle4"><span class="sprites-sprite sprite-plus mikroartikel"></span>' . $node->field_mikroartikler_titel4['und'][0]['safe_value'] . '</h2>';
                      $mikroartikel .= '<div class="mArticle4 mArticle">' . $node->field_mikroartikler_tekst4['und'][0]['safe_value'] . '</div></div>';
                    }

                    if($node->field_mikroartikler_titel5) {
                      $mikroartikel .= '<div class="microArticle"><h2 class="mArticle" id="mArticle5"><span class="sprites-sprite sprite-plus mikroartikel"></span>' . $node->field_mikroartikler_titel5['und'][0]['safe_value'] . '</h2>';
                      $mikroartikel .= '<div class="mArticle5 mArticle">' . $node->field_mikroartikler_tekst5['und'][0]['safe_value'] . '</div></div>';
                    }

                    if($node->field_mikroartikler_titel6) {
                      $mikroartikel .= '<div class="microArticle"><h2 class="mArticle" id="mArticle6"><span class="sprites-sprite sprite-plus mikroartikel"></span>' . $node->field_mikroartikler_titel6['und'][0]['safe_value'] . '</h2>';
                      $mikroartikel .= '<div class="mArticle6 mArticle">' . $node->field_mikroartikler_tekst6['und'][0]['safe_value'] . '</div></div>';
                    }

                    if($node->field_mikroartikler_titel7) {
                      $mikroartikel .= '<div class="microArticle"><h2 class="mArticle" id="mArticle7"><span class="sprites-sprite sprite-plus mikroartikel"></span>' . $node->field_mikroartikler_titel7['und'][0]['safe_value'] . '</h2>';
                      $mikroartikel .= '<div class="mArticle7 mArticle">' . $node->field_mikroartikler_tekst7['und'][0]['safe_value'] . '</div></div>';
                    }

                    if($node->field_mikroartikler_titel8) {
                      $mikroartikel .= '<div class="microArticle"><h2 class="mArticle" id="mArticle8"><span class="sprites-sprite sprite-plus mikroartikel"></span>' . $node->field_mikroartikler_titel8['und'][0]['safe_value'] . '</h2>';
                      $mikroartikel .= '<div class="mArticle8 mArticle">' . $node->field_mikroartikler_tekst8['und'][0]['safe_value'] . '</div></div>';
                    }

                    if($node->field_mikroartikler_titel9) {
                      $mikroartikel .= '<div class="microArticle"><h2 class="mArticle" id="mArticle9"><span class="sprites-sprite sprite-plus mikroartikel"></span>' . $node->field_mikroartikler_titel9['und'][0]['safe_value'] . '</h2>';
                      $mikroartikel .= '<div class="mArticle9 mArticle">' . $node->field_mikroartikler_tekst9['und'][0]['safe_value'] . '</div></div>';
                    }

                    if($node->field_mikroartikler_titel10) {
                      $mikroartikel .= '<div class="microArticle"><h2 class="mArticle" id="mArticle10"><span class="sprites-sprite sprite-plus mikroartikel"></span>' . $node->field_mikroartikler_titel10['und'][0]['safe_value'] . '</h2>';
                      $mikroartikel .= '<div class="mArticle10 mArticle">' . $node->field_mikroartikler_tekst10['und'][0]['safe_value'] . '</div></div>';
                    }

                    $mikroartikel .= "</div>";
                    $output .= $mikroartikel;
                  }
                  $output .= "<!-- MIKROARTIKLER SLUT -->";


                  // PERSONER
                  if($node->field_personer) {
                    $output .= "<!-- PERSONER START -->";
                    $output .= "<div class=\"personer\">";
                      $output .= views_embed_view('personer','default', $node->nid);
                    $output .= "</div>";
                    $output .= "<!-- PERSONER SLUT -->";
                  }


                  // ----------- //
                  //  B O K S E  //
                  // ----------- //

                  // BOKSE [VENSTRE]
                  $output .= '<div class="row bokse-venstre">';
                    $output .= '<div class="grid-full">';
                      $output .= '<div class="row row-start-small match-heights-grid-two-thirds" data-match-heights>';
                        $output .= views_embed_view('forsidebokse','bokse_venstre_side', $node->nid);
                      $output .= '</div>';
                    $output .= '</div>';
                  $output .= '</div>';

                  // DIVERSE BOKS
                  $output .= "<!-- DIVERSE BOKS START -->";
                  if($node->field_diverse_boks) {
                    $output .= "<div class=\"diverse-boks\">";
                    $output .= $node->field_diverse_boks['und'][0]['safe_value'];
                    $output .= "</div>";
                  }
                  $output .= "<!-- DIVERSE BOKS SLUT -->";

                  // LÆS OGSÅ
                  $output .= "<!-- LÆS OGSÅ START -->";
                  if($node->field_url) {
                    if($node->field_diverse_boks) {
                      $output .= "<hr>";
                    }
                    $output .= "<h2>Læs også</h2>";
                    $output .= "<ul>";
                    foreach ($node->field_url['und'] as $value) {
                      $output .= "<li>";
                        $output .= "<a href=\"" . $value['url'] . "\" title=\"" . $value['title'] . "\">";
                          $output .= $value['title'];
                        $output .= "</a>";
                      $output .= "</li>";
                    }
                    $output .= "</ul>";
                  }
                  $output .= "<!-- LÆS OGSÅ SLUT -->";

                  // HVAD SIGER LOVEN?
                  $output .= "<!-- HVAD SIGER LOVEN? START -->";
                  if($node->field_url_2) {
                    if(($node->field_url) or ($node->field_diverse_boks)) {
                      $output .= "<hr>";
                    }
                    $output .= "<h2>Hvad siger loven?</h2>";
                    $output .= "<ul>";
                    foreach ($node->field_url_2['und'] as $value) {
                      $output .= "<li>";
                        $output .= "<a href=\"" . $value['url'] . "\" title=\"" . $value['title'] . "\">";
                          $output .= $value['title'];
                        $output .= "</a>";
                      $output .= "</li>";
                    }
                    $output .= "</ul>";
                  }
                  $output .= "<!-- HVAD SIGER LOVEN? SLUT -->";

                  // DEL PÅ SOCIALE MEDIER
                  // Hvis noden er en indholdsside, borger.dk-artikel eller en aktivitet
                  // if(($node->type == 'os2web_base_contentpage') or ($node->type == 'os2web_borger_dk_article') or ($node->type == 'aktivitet')) {
                  //   include_once drupal_get_path('theme', 'ishoj') . '/includes/del-paa-sociale-medier.php';
                  // }

                  // SENEST OPDATERET
                  // $output .= "<!-- SENEST OPDATERET START -->";
                  // $output .= "<p class=\"last-updated\">Senest opdateret " . format_date($node->changed, 'senest_redigeret') . "</p>";
                  // $output .= "<!-- SENEST OPDATERET SLUT -->";

                  // REDIGÉR-KNAP
                  if($logged_in) {
                    $output .= "<div class=\"edit-node\"><a href=\"/node/" . $node->nid . "/edit?destination=admin/content\" title=\"Ret indhold\"><span>Ret indhold</span></a></div>";
                  }

                $output .= "</div>";
                $output .= "<div class=\"grid-third\">";

                // LOG MENU
                $output .= "<ul class=\"log-menu hide-me\">";
                  $output .= "<li class=\"forside\">";
                    $output .= "<a href=\"/\" title=\"Forside\">Forside</a>";
                  $output .= "</li>";
                  $output .= "<li class=\"log\">";
                    $output .= "<a href=\"/node/add/log\" title=\"Opret log\">Opret log</a>";
                  $output .= "</li>";
                  $output .= "<li class=\"batteri\">";
                    $output .= "<a href=\"/node/add/batteri\" title=\"Tilføj nyt batteri\">Tilføj nyt batteri</a>";
                  $output .= "</li>";
                  $output .= "<li class=\"drone\">";
                    $output .= "<a href=\"/node/add/drone\" title=\"Tilføj ny drone\">Tilføj ny drone</a>";
                  $output .= "</li>";
                  $output .= "<li class=\"kontrolstation\">";
                    $output .= "<a href=\"/node/add/kontrolstation\" title=\"Tilføj ny kontrolstation\">Tilføj ny kontrolstation</a>";
                  $output .= "</li>";
                  $output .= "<li class=\"pilot\">";
                    $output .= "<a href=\"/node/add/person\" title=\"Tilføj ny pilot\">Tilføj ny pilot</a>";
                  $output .= "</li>";
                  $output .= "<li class=\"exit\">";
                    $output .= "<a href=\"/user/logout\" title=\"Log ud\">Log ud</a>";
                  $output .= "</li>";
                $output .= "</ul>";


                // LISTE OVER PILOTER
                $output .= "<ul class=\"dronelog_pilotliste\">";
                  $output .= views_embed_view('dronelog', 'liste_over_piloter');
                $output .= "</ul>";


                // Export dronelog
                $output .= "<p>&nbsp;</p><p><strong><a href=\"http://dronelog.ishoj.dk/infotv/" . $node->nid . "/dronelog.xls\"><span class=\"excel\"></span>Download flyvelogs (alle logs)</a></strong></p>";
                $output .= "<p><strong><a href=\"http://dronelog.ishoj.dk/infotv/seneste/" . $node->nid . "/dronelog_seneste_aar.xls\"><span class=\"excel\"></span>Download flyvelogs (seneste år)</a></strong></p>";


                // $output .= "<a href=\"http://www.accuweather.com/da/dk/ishoj/123067/weather-forecast/123067\" class=\"aw-widget-legal\">";
                // $output .= "<!--";
                // $output .= "By accessing and/or using this code snippet, you agree to AccuWeather’s terms and conditions (in English) which can be found at http://www.accuweather.com/en/free-weather-widgets/terms and AccuWeather’s Privacy Statement (in English) which can be found at http://www.accuweather.com/en/privacy.";
                // $output .= "-->";
                // $output .= "</a><div id=\"awcc1477994224042\" class=\"aw-widget-current\"  data-locationkey=\"123067\" data-unit=\"c\" data-language=\"da\" data-useip=\"false\" data-uid=\"awcc1477994224042\"></div><script type=\"text/javascript\" src=\"http://oap.accuweather.com/launch.js\"></script>";

                  // MENU TIL UNDERSIDER
                  // $output .= "<nav class=\"menu-underside\">";
                  //   // til BLOCK MENU SITES
                  //   $block = module_invoke('menu_block', 'block_view', '4');
                  //   $output .= render($block['content']);
                  // $output .= "</nav>";

                  // BOKSE [HØJRE]
                  $output .= '<div class="row bokse-hoejre">';
                    $output .= '<div class="grid-full">';
                      $output .= '<div class="row _row-start-small __match-heights-grid-two-thirds" data-match-heights-off>';
                        $output .= views_embed_view('forsidebokse','bokse_hoejre_side', $node->nid);
                      $output .= '</div>';
                    $output .= '</div>';
                  $output .= '</div>';

                $output .= "</div>";
              $output .= "</div>";


              }

            $output .= "</div>";
          $output .= "</section>";
          $output .= "<!-- ARTIKEL SLUT -->";


          // Mik's kortløsning
          if($node->field_kort) {
            $erstatkortdata = '<div class="miksminimap" style="width: 100%;">' . $node->field_kort['und'][0]['value'] . '</div>';
            $output = str_replace("[kort]", $erstatkortdata, $output);
          }

          print $output;
          print render($content['links']);
          print render($content['comments']);



        }
        ?>


      </div>
      <!-- CONTENT SLUT -->



      <?php print breaking(); ?>

    </div>
    <!-- PAGE SLUT -->
