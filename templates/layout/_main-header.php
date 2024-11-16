<?php

/** @var string $pageContent */
/** @var ?array $user */

?>
<header class="main-header">
    <div class="main-header__container container">
        <h1 class="visually-hidden">YetiCave</h1>
        <a class="main-header__logo" href="/">
            <img src="./resources/img/logo.svg" width="160" height="39" alt="Логотип компании YetiCave">
        </a>
        <form
            class="main-header__search"
            method="post"
            action=""
            autocomplete="off"
        >
            <?php $key = 'search'?>
            <input
                type="search"
                name="<?= $key ?>"
                placeholder="Поиск лота"
            >
            <?php $key = 'find'?>
            <input
                class="main-header__search-btn"
                type="submit"
                name="<?= $key ?>"
                value="Найти"
            >
        </form>
        <a class="main-header__add-lot button" href="add-lot.php" <?= !isset($user) ? ' disabled' : '' ?>>Добавить лот</a>
        <nav class="user-menu">

        <?php if (isset($user)): ?>
        <div class="user-menu__logged">
                    <div class="user-avatar">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <div class="user-data">
                        <a class="user_name" href="my-bets.php"><?= esc($user['user_name']) ?></a>
                        <div class="user-menu__bets">
                            <a href="my-bets.php">Мои ставки</a>
                            <a href="logout.php">Выйти</a>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <ul class="user-menu__list">
                    <li class="user-menu__item">
                        <a href="sign-up.php">Регистрация</a>
                    </li>
                    <li class="user-menu__item">
                        <a href="login.php">Вход</a>
                    </li>
                </ul>
            <?php endif; ?>

        </nav>
    </div>
</header>
