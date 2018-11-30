<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h3>Tooltip Example</h3>
 <a href="#" data-toggle="tooltip" data-placement="top" title="Hooray!">Hover</a><br>
<a href="#" data-toggle="tooltip" data-placement="bottom" title="Hooray!">Hover</a><br>
<a href="#" data-toggle="tooltip" data-placement="left" title="Hooray!">Hover</a><br>
<a href="#" data-toggle="tooltip" data-placement="right" title="Hooray!">Hover</a><br>

</div>

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>

</body>
</html>

