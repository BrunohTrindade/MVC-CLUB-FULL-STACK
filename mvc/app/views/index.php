<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $title ?></title>
</head>
<body>
  <h2>Curso de MVC</h2>
  <div><?php require VIEW_PATH.$this->controller->view; ?></div>
</body>
</html>