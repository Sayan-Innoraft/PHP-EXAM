<?php

require '../src/View/helper/loginpage_helper.php';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body class="bg-info-subtle ">
<div class="container">
  <?php
  if(isset($error_msg)){
    ?>
    <div class="alert alert-warning alert-dismissible fade show mt-3" 
         role="alert">
      <strong><?=$error_msg ?></strong> 
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
    unset($error_msg);
  }
  ?>
</div>
<form method="post" action="">
  <div class="container-sm mt-5 col-6">
    <input class="form-control mt-3 mb-3" name="email" type="text" 
           placeholder="Email id"
           aria-label="default input example">
    <input class="form-control mb-3" type="text" name="password" 
           placeholder="Password"
           aria-label="default input example">
    <button type="submit" name="login" class="btn btn-primary">Login</button>
  </div>
</form>
</body>
</html>
