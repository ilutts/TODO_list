<main class="main">
    <div class="container">
        <h1 class="main__title">Авторизация</h1>

        <?php if (!empty($_SESSION['errorLogin'])): ?>
            <h2><?= $_SESSION['errorLogin'] ?></h2>
        <?php endif ?>

        <form class="form form--login" action="/" method="post">
            <input type="text" class="input input--login" name="login" required placeholder="Логин" value="">
            <input type="password" class="input input--login" name="password" required placeholder="Пароль" value="">
            <button class="btn btn--solid btn--login" type="submit" name="submit">Войти в личный кабинет</button>
        </form>
    </div> 
</main>