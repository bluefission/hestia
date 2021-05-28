<?php
  //https://medium.com/@hfally/how-to-create-an-environment-variable-file-like-laravel-symphonys-env-37c20fc23e72
  $variables = [
      'ADMIN_THEME_NAME' => 'admin.php',
      'LOGIN_THEME_NAME' => 'login.php',
      'DASHBOARD_DIRECTORY' => 'dashboard/',
      'HOME_MODULE' => 'dashboard/',
      'CACHE_DIRECTORY' => 'cache/'
      'APP_NAME' => 'BlueFission Opus',
      'LOGO_IMG' => 'assets/media/logos/logo.png',
      'FAVICON' => 'assets/media/logos/favicon.ico',
      'DEBUG' => 'false',
      'FORCE_HTTPS' => 'false',
      'MYSQL_DB_HOST' => 'localhost',
      'MYSQL_DB_USERNAME' => 'root',
      'MYSQL_DB_PASSWORD' => '',
      'MYSQL_DB_NAME' => 'demo',
      'MYSQL_DB_PORT' => '3306',
      'CDN_USER' => '',
      'CDN_KEY' => '',
      'CDN_FILE_ROOT' => 'https://path.to-cdn.bucket',
      'CDN_FILEMANAGER_CONTAINER_NAME' => '',
  ];

  foreach ($variables as $key => $value) {
      putenv("$key=$value");
  }