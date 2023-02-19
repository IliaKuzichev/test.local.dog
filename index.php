<?php
require_once('function.php');
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Dogs</title>

</head>
<body>
<form name="main" id="form" method="post" action="/function.php">
    <h1 class="form__title">Введи имя собаки и команду</h1>
    <ol>
        <li>mops</li>
        <li>shibu-inu</li>
        <li>dachshund</li>
        <li>plush-labr</li>
        <li>rubber-dachshund</li>
    </ol>
    <ul>
        <li>sound</li>
        <li>hunt</li>
        <li>wolk</li>
    </ul>
    <input type="text" class="form__command" name="message" title="dog">
    <input type="submit" class="form__button" value="Send">
</form>
</body>
</html>