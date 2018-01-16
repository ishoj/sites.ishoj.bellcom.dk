<?php

function ishoj_form_system_theme_settings_alter(&$form, $form_state) {

  /* Social media links - BEGIN */
  $social_media_items = array(
    'facebook' => 'Facebook',
    'linkedin' => 'LinkedIn',
    'twitter' => 'Twitter',
    'youtube' => 'Youtube',
  );

  $form['social_media'] = array(
    '#title' => t('Social Media Links'),
    '#type' => 'fieldset',
  );

  foreach ($social_media_items as $slug => $label) {
    $form['social_media'][$slug . '-is-enabled'] = array(
      '#title' => $label,
      '#type' => 'checkbox',
      '#default_value' => theme_get_setting($slug . '-is-enabled'),
    );
  }

  foreach ($social_media_items as $slug_2 => $label_2) {

    $form['social_media'][$slug_2 . '-wrapper'] = array(
      '#title' => $label_2,
      '#type' => 'fieldset',
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
    );

    $form['social_media'][$slug_2 . '-wrapper'][$slug_2 . '-url'] = array(
      '#title' => t('Link URL'),
      '#type' => 'textfield',
      '#default_value' =>  (strlen(theme_get_setting($slug_2 . '-url')) > 0) ? theme_get_setting($slug_2 . '-url') : '#',
    );

    $form['social_media'][$slug_2 . '-wrapper'][$slug_2 . '-link-title'] = array(
      '#title' => t('Link title text'),
      '#type' => 'textfield',
      '#default_value' =>  (strlen(theme_get_setting($slug_2 . '-link-title')) > 0) ? theme_get_setting($slug_2 . '-link-title') : '',
    );

  }
  /* Social media links - END */


  /*
   * Other municipal websites
   */
  $form['municipal-webstes'] = array(
    '#title' => t('Municipal websites'),
    '#type' => 'fieldset',
  );

  $form['municipal-webstes']['municipal-links-type'] = array(
    '#type' => 'radios',
    '#default_value' => (theme_get_setting('municipal-links-type') == 'local') ? 'local' : 'remote',
    '#options' => array(
      'local' => t('Links built locally'),
      'remote' => t('Links pulled from http://ishoj.dk/ website')
    ),
  );
}

