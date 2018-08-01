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
 * - $node_url: Direct URL of the current node.
 * - $display_submitted: Whether submission information should be displayed.
 * - $submitted: Submission information created from $name and $date during
 *   template_preprocess_node().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type; for example, "theming hook".
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
 * - $type: Node type; for example, story, page, blog, etc.
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
 * - $view_mode: View mode; for example, "full", "teaser".
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
 * variable is defined; for example, $node->body becomes $body. When needing to
 * access a field's raw values, developers/themers are strongly encouraged to
 * use these variables. Otherwise they will have to explicitly specify the
 * desired field language; for example, $node->body['en'], thus overriding any
 * language negotiation rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 *
 * @ingroup themeable
 */
?>


<?php
// dsm($node);
$output = "";

$output .= "<!-- ARTIKEL START -->";
$output .= "<section id=\"node-" . $node->nid . "\" class=\"" . $classes . " artikel\">";
  $output .= "<div class=\"container\">";

    /////////////////////
    ////   RÆKKE 1   ////
    /////////////////////
    $output .= "<div class=\"row\">";
      // ----------------
      $output .= "<div class=\"grid-two-thirds\">";
        // Brødkrummesti
        $output .= "<p class=\"breadcrumbs\">" . theme('breadcrumb', array('breadcrumb'=>drupal_get_breadcrumb())) . " / " . $title . "</p>";
        // Titel
        $output .= "<h1>" . $title . "</h1>";
      $output .= "</div>";
      // ----------------
    $output .= "</div>";

    /////////////////////
    ////   RÆKKE 2   ////
    /////////////////////
    $output .= "<div class=\"row second\">";
      // ----------------
      $output .= "<div class=\"grid-two-thirds\">";
        // $output .= "<h1>" . $title . "</h1>";
      $output .= "</div>";
      // ----------------
      $output .= "<div class=\"grid-third\"></div>";
    $output .= "</div>";

    /////////////////////
    ////   RÆKKE 3   ////
    /////////////////////
    $output .= "<div class=\"row second\">";
      // ----------------
      $output .= "<div class=\"grid-two-thirds\">";
        $output .= "<!-- ARTIKEL TOP START -->";
        $output .= "<div class=\"artikel-top\">";
          // FOTO
          $output .= "<!-- FOTO START -->";
          if($node->field_os2web_base_field_image) {
            hide($content['field_image_flexslider']);
            $output .= render($content['field_os2web_base_field_image']);
            if($node->field_billedtekst) {
              $output .= "<p class=\"foto-tekst\">" . $node->field_billedtekst['und'][0]['value'] . "</p>";
            }
          }
          $output .= "<!-- FOTO SLUT -->";

          // FLEXSLIDER
          $output .= "<!-- FLEXSLIDER START -->";
          if(($node->field_image_flexslider) and (!$node->field_os2web_base_field_image)) {
            $output .= "<div class=\"flexslider\">";
              $output .= "<ul class=\"slides\">";
              $length = sizeof($node->field_image_flexslider['und']);
              for ($i = 0; $i < $length; $i++) {
                $output .= "<li>" . render($content['field_image_flexslider'][$i]) . "</li>";
              }
              $output .= "</ul>";
            $output .= "</div>";
          }
          $output .= "<!-- FLEXSLIDER SLUT -->";

          // VIDEO
          $output .= "<!-- VIDEO START -->";
          if(($node->field_video) and (!$node->field_os2web_base_field_image) and (!$node->field_image_flexslider)) {
            $output .= "<div class=\"video-indlejret\">";
              $output .= "<div class=\"embed-container vimeo\">";
                $output .= $node->field_video['und'][0]['value'];
              $output .= "</div>";
            $output .= "</div>";
            if ($node->field_videotekst) {
              $output .= "<p class=\"video-tekst\">" . $node->field_videotekst['und'][0]['value'] . "</p>";
            }
          }
          $output .= "<!-- VIDEO SLUT -->";

        $output .= "</div>";
        $output .= "<!-- ARTIKEL TOP SLUT -->";

        // UNDEROVERSKRIFT
        $output .= "<!-- UNDEROVERSKRIFT START -->";
        if($node->field_os2web_base_field_summary) {
          $output .= "<h2>" . $node->field_os2web_base_field_summary['und'][0]['safe_value'] . "</h2>";
        }
        $output .= "<!-- UNDEROVERSKRIFT SLUT -->";

        // SELVBETJENINGSLØSNING
        $output .= "<!-- SELBETJENINGSLØSNING START -->";
        $output .= views_embed_view('selvbetjeningslosning','default', $node->nid);
        $output .= "<!-- SELBETJENINGSLØSNING SLUT -->";

        // TEKST INDEN FORMULAR
        if($node->body) {
          $output .= "<p>" . $node->body['und'][0]['safe_value'] . "</p><p>&nbsp;</p>";
        }

        // TEKSTINDHOLD
        $output .= "<!-- TEKSTINDHOLD START -->";
        hide($content['comments']);
        hide($content['links']);
        $output .= render($content);
        $output .= "<!-- TEKSTINDHOLD SLUT -->";

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


        // ------------------------------------------------- //
        //  S P E C I F I K K E   I N D H O L D S T Y P E R  //
        // ------------------------------------------------- //


        // --------------------------------- //
        //  S P E C I F I K K E   N O D E R  //
        // --------------------------------- //


        // ----------- //
        //  B O K S E  //
        // ----------- //

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
        // if($node->type == 'os2web_base_contentpage') {
        include_once drupal_get_path('theme', 'ishoj') . '/includes/del-paa-sociale-medier.php';
        // }

        // SENEST OPDATERET
        $output .= "<!-- SENEST OPDATERET START -->";
        $output .= "<p class=\"last-updated\">Senest opdateret " . format_date($node->changed, 'senest_redigeret') . "</p>";
        $output .= "<!-- SENEST OPDATERET SLUT -->";

        // REDIGÉR-KNAP
        if($logged_in) {
          $output .= "<div class=\"edit-node\"><a href=\"/node/" . $node->nid . "/edit?destination=admin/content\" title=\"Ret indhold\"><span>Ret indhold</span></a></div>";
        }

      $output .= "</div>";
      // ----------------
      $output .= "<div class=\"grid-third\">";
        // MENU TIL UNDERSIDER
        $output .= "<nav class=\"menu-underside\">";
          // til BLOCK MENU SITES
          $block = module_invoke('menu_block', 'block_view', '4');
          $output.= render($block['content']);
        $output .= "</nav>";
      $output .= "</div>";
    $output .= "</div>";
  $output .= "</div>";
$output .= "</section>";
$output .= "<!-- ARTIKEL SLUT -->";

// DIMMER DEL SIDEN
$output .= "<!-- DIMMER DEL SIDEN START -->";
// OPRET DEL-PÅ-SOCIALE-MEDIER-KNAPPER,
// HVIS NODEN ER AF TYPEN INDHOLD, BORGER.DK-ARTIKEL ELLER AKTIVITET
// if(($node->type == 'os2web_base_contentpage') or ($node->type == 'os2web_borger_dk_article') or ($node->type == 'aktivitet')) {
  $options = array('absolute' => TRUE);
  $nid = $node->nid; // Node ID
  $abs_url = url('node/' . $nid, $options);
  $output .= "<div class=\"dimmer-delsiden hidden\">";
    $output .= "<a class=\"breaking-close\" href=\"#\" title=\"Luk\"></a>";
      $output .= "<ul>";
        $output .= "<li class=\"sociale-medier\"><a class=\"sprite sprite-facebook\" href=\"https://www.facebook.com/sharer/sharer.php?u=" . $abs_url . "\" title=\"Del siden på Facebook\"><span><span class=\"screen-reader\">Del siden på Facebook</span></span></a></li>";
        $output .= "<li class=\"sociale-medier\"><a class=\"sprite sprite-twitter\" href=\"https://twitter.com/home?status=" . $title . " " . $abs_url . "\" title=\"Del siden på Twitter\"><span><span class=\"screen-reader\">Del siden på Twitter</span></span></a></li>";
        $output .= "<li class=\"sociale-medier\"><a class=\"sprite sprite-googleplus\" href=\"https://plus.google.com/share?url=" . $abs_url . "\" title=\"Del siden på Google+\"><span><span class=\"screen-reader\">Del siden på Google+</span></span></a></li>";
        $output .= "<li class=\"sociale-medier\"><a class=\"sprite sprite-linkedin\" href=\"https://www.linkedin.com/shareArticle?url=" . $abs_url . "&title=" . $title . "&summary=&source=&mini=true\" title=\"Del siden på LinkedIn\"><span><span class=\"screen-reader\">Del siden på LinkedIn</span></span></a></li>";
        $output .= "<li class=\"sociale-medier\"><a class=\"sprite sprite-mail\" href=\"mailto:?subject=" . $title . "&body=" . $abs_url . "\" title=\"Send som e-mail\"><span><span class=\"screen-reader\">Send som e-mail</span></span></a></li>";
        $output .= "<li class=\"sociale-medier\"><a class=\"sprite sprite-link\" href=\"#\" title=\"Del link\"><span><span class=\"screen-reader\">Del link</span></span></a></li>";
      $output .= "</ul>";
      $output .= "<div class=\"link-url\">";
      $output .= "<textarea>" . $abs_url . "</textarea>";
    $output .= "</div>";
  $output .= "</div>";
// }
$output .= "<!-- DIMMER DEL SIDEN SLUT -->";


// Mik's kortløsning
if($node->field_kort) {
  $erstatkortdata = '<div class="miksminimap" style="width: 100%;">' . $node->field_kort['und'][0]['value'] . '</div>';
  $output = str_replace("[kort]", $erstatkortdata, $output);
}

print $output;
print render($content['links']);
print render($content['comments']);


?>
