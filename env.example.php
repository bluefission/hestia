<?php
  //https://medium.com/@hfally/how-to-create-an-environment-variable-file-like-laravel-symphonys-env-37c20fc23e72
  $variables = [
      'ADMIN_THEME_NAME' => 'admin.php',
      'LOGIN_THEME_NAME' => 'login.php',
      'APP_NAME' => 'New Application',
      'DASHBOARD_DIRECTORY' => 'dashboard/',
      'HOME_MODULE' => 'dashboard/',
      'LOGO_IMG' => 'assets/media/logos/logo.png',
      'FAVICON' => 'assets/media/logos/favicon.ico',
      'DEBUG' => 'false',
      'FORCE_HTTPS' => 'false',
      'DB_HOST' => 'localhost',
      'DB_USERNAME' => 'root',
      'DB_PASSWORD' => '',
      'DB_NAME' => 'demo',
      'DB_PORT' => '3306',
      'CDN_FILE_ROOT' => 'https://path.to-cdn.bucket',
      'CDN_FILEMANAGER_CONTAINER_NAME' => '',
      'CDN_USER' => '',
      'CDN_KEY' => '',
  ];

  foreach ($variables as $key => $value) {
      putenv("$key=$value");
  }