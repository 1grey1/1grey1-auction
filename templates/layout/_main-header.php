<?php

    /** @var string $pageContent */

?>

    <header class="main-header">
        <div class="main-header__container container">
            <h1 class="visually-hidden">YetiCave</h1>
            <a class="main-header__logo">
                <img src="./resources/img/logo.svg" width="160" height="39" alt="Логотип компании YetiCave">
            </a>
            <form class="main-header__search" method="get" action="" autocomplete="off">
                <input type="search" name="search" placeholder="Поиск лота">
                <input class="main-header__search-btn" type="submit" name="find" value="Найти">
            </form>
            <a class="main-header__add-lot button" href="add-lot.html">Добавить лот</a>
            <nav class="user-menu">
                <div class="user-menu__logged">
                    <p>Константин</p>
                    <a href="login.html">Выйти</a>
                </div>
            </nav>
        </div>
    </header>
