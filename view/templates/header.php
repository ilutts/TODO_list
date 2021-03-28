<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TODO list - тестовое задание</title>
    <link rel="stylesheet" href="/css/normolize.css" />
    <link rel="stylesheet" href="/css/styles.css" />
    <script src="/js/script.js" defer></script>
  </head>
<body>
<header class="header">
  <div class="container">
    <div class="header__top">
        <a href="/" class="logo link">
            <h1 class="title">TODO list</h1>
        </a>
        
        <?php if (empty($_SESSION['isAuth'])) { ?>
          <a href="/login" class="header__link link">Авторизация</a>
        <?php } else { ?>
          <a href="/profile" class="header__link link"><?= $_SESSION['user']['surname'] . ' ' . $_SESSION['user']['name'] ?></a>
          <div class="user-id" hidden><?= $_SESSION['user']['id'] ?></div>
          <a href="/?exit" class="link">Выйти</a>
        <?php } ?> 

    </div>
</header>
