<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-menu-fixed layout-menu-100vh"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title><?= $title ?></title>
    <?php
    if (isset($href)) {
        foreach ($href as $data) {
    ?>
        <link rel="stylesheet" href="<?php echo $data; ?>">
    <?php
        }
    }
    ?>

    <meta name="description" content="" />
  </head>

  <body>