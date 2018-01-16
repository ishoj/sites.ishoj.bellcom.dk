<?php

/************************************************************************/
/***  FUNKTION: VIS AKTIVITETSLISTE UD FRA ARRANGØR_TID FRA ISHOJ.DK  ***/
/************************************************************************/
function json_aktivitetsliste($tid) {
  $output = "<div class=\"aktivitetsliste\">";
  $url = "http://www.ishoj.dk/json_aktivitetsliste_arrangoer_tid/" . $tid . "?no_login=1&hest=" . rand();
  // Arrangør: Ishøj Naturcenter = tid 3121
  $request = drupal_http_request($url);
  $json_response = drupal_json_decode($request->data);
  if($json_response) {
    $current_date = "";
    $len = count($json_response);

    foreach ($json_response as $key=>$response_data) {

      if($key > 0) {
        if($response_data['dato_dag_maaned'] != $current_date) {
              $output .= "</ul>";
            $output .= "</div>";
          $output .= "</div>";
        }
      }
      // Hvis der er flere arr. samme dag
      if($response_data['dato_dag_maaned'] == $current_date) {
        $output .= "<li>";
          $output .= "<h3><a href=\"/visaktivitet?nid=" . $response_data['nid'] . "&ds=" . $response_data['dato_datostreng'] . "\" title=\"" . $response_data['title'] . "\">" . $response_data['title'] . "</a></h3>";
          // KLOKKESLÆT
          if($response_data['dato_klokkeslaet']) {
             $output .= "Kl. " . $response_data['dato_klokkeslaet'];
          }
          // AKTIVITETSSTED
          if($response_data['sted']) {
             $output .= ", " . $response_data['sted'];
          }
        $output .= "</li>";
      }
      // Hvis der kun er ét arr. på dagen
      else {
        $output .= "<div class=\"aktivitet\">";
          $output .= "<div class=\"date\">" . $response_data['dato_dag_maaned'] . "</div>";
          $output .= "<div class=\"circle\"><div></div></div>";
          $output .= "<div class=\"description\">";
            $output .= "<ul>";

              $output .= "<li>";
                $output .= "<h3><a href=\"/visaktivitet?nid=" . $response_data['nid'] . "&ds=" . $response_data['dato_datostreng'] . "\" title=\"" . $response_data['title'] . "\">" . $response_data['title'] . "</a></h3>";
                // KLOKKESLÆT
                if($response_data['dato_klokkeslaet']) {
                   $output .= "Kl. " . $response_data['dato_klokkeslaet'];
                }
                // AKTIVITETSSTED
                if($response_data['sted']) {
                   $output .= ", " . $response_data['sted'];
                }
              $output .= "</li>";
      }
      // sidste arr.
      if($key == ($len - 1)) {
            $output .= "</ul>";
          $output .= "</div>";
        $output .= "</div>";
      }

      $current_date = $response_data['dato_dag_maaned'];
    }
  }
  $output .= "</div>";
  return $output;
}


/********************************************************************************/
/***  FUNKTION: VIS ANDRE KOMMUNALE HJEMMESIDER -- FRA ISHOJ.DK ELLER LOKALT  ***/
/********************************************************************************/
function json_andre_kommunale_hjemmesider() {
  $dropdown_begin = '<form>';
  $dropdown_begin .= '<label for="hjemmesider">Andre hjemmesider</label>';
  $dropdown_begin .= '<select name="hjemmesider" id="hjemmesider" class="sprite-menu">';
  $dropdown_begin .= '<option value="0" selected="">Vælg en hjemmeside</option>';

  $dropdown_end = '</select>';
  $dropdown_end .= '</form>';

  $output = "";

  if (theme_get_setting('municipal-links-type') == 'local') {
    $vid = taxonomy_vocabulary_machine_name_load('andre_kommunale_hjemmesider')->vid;
    $taxonomy_tree = taxonomy_get_tree($vid);

    $output .= $dropdown_begin;

    foreach ($taxonomy_tree as $tax_item) {
      $tax_term = taxonomy_term_load($tax_item->tid);
      $tax_title = $tax_term->name;
      $tax_url = $tax_term->field_url['und'][0]['url'];

      $result .= sprintf("%s - %s\n", $tax_title, $tax_url);
      $output .= '<option value="' . $tax_url . '">' . $tax_title . '</option>';
    }

    $output .= $dropdown_end;
  } else {
    $url = "http://www.ishoj.dk/json-andre-kommunale-hjemmesider?hest=" . rand();
    $request = drupal_http_request($url);

    if ($request) {
      $json_response = drupal_json_decode($request->data);
      $output .= $dropdown_begin;

      foreach ($json_response as $response_data) {
        $output .= '<option value="' . $response_data['url'] . '">' . $response_data['title'] . '</option>';
      }

      $output .= $dropdown_end;
    }
  }
  return $output;
}


/*****************************************************/
/***  FUNKTION: VIS KRISEINFORMATION FRA ISHOJ.DK  ***/
/*****************************************************/
function breaking() {
  $output = "";
  $url_breaking = "http://www.ishoj.dk/json_krisekommunikation?hest=" . rand();
  $request_breaking = drupal_http_request($url_breaking);

  if($request_breaking) {
    $json_response_breaking = drupal_json_decode($request_breaking->data);

    foreach ($json_response_breaking as $response_data_breaking) {
      $output .= "<!-- BREAKING START -->";
      $output .= "<div class=\"breaking\">";
        $output .= "<div class=\"container\">";
          $output .= "<div class=\"row\">";
            $output .= "<div class=\"grid-full\">";
              $output .= "<div class=\"breaking-inner\">";
                $output .= "<a class=\"breaking-close\" href=\"#\" title=\"Luk\"></a>";
                $output .= "<h2><a title=\"BREAKING: " . $response_data_breaking['title'] . "\" href=\"http://ishoj.dk" . $response_data_breaking['php'] . "\">BREAKING: " . $response_data_breaking['title'] . "</a></h2>";
              $output .= "</div>";
            $output .= "</div>";
          $output .= "</div>";
        $output .= "</div>";
      $output .= "</div>";
      $output .= "<!-- BREAKING SLUT -->";
    }
  }
  return $output;
}

?>
