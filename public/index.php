<?php

$request = $_SERVER['REQUEST_URI'];
// Routes to the files.
switch ($request) {
  case '':
  case '/':
      require __DIR__ . '/../src/View/pages/home_page.php';
      break;
  case '/login':
    require __DIR__ . '/../src/View/pages/login_page.php';
    break;
  case '/logout':
    require __DIR__ . '/../src/View/pages/logout.php';
    break;
  default:
    echo '<h1>404 Not Found path '. $request .'</h1>';
}
