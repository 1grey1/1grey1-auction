<?php

/** @var string $categoryList */
/** @var array $errors */
/** @var array $postInput */

?>
<?= $categoryList ?>

<!-- -->
<form class="form container form--invalid" action="" method="post">
    <h2>Вход</h2>

    <?php $key = 'email'; ?>
    <div class="form__item<?= isset($errors[$key]) ? ' form__item--invalid' : ''?>">
        <label for="<?= $key ?>">E-mail <sup>*</sup></label>
        <input
            id="<?= $key ?>"
            type="text"
            name="<?= $key ?>"
            value="<?= $postInput[$key] ?? '' ?>"
            placeholder="Введите e-mail"
        >
        <?php if (isset($errors[$key])): ?>
            <span class="form__error"><?= $errors[$key] ?></span>
        <?php endif; ?>
    </div>

    <?php $key = 'password'; ?>
    <div class="form__item form__item--last<?= isset($errors[$key]) ? ' form__item--invalid' : ''?>">
        <label for="<?= $key ?>">Пароль <sup>*</sup></label>
        <input
            id="<?= $key ?>"
            type="password"
            name="<?= $key ?>"
            value="<?= $postInput[$key] ?? '' ?>"
            placeholder="Введите пароль"
        >
        <?php if (isset($errors[$key])): ?>
            <span class="form__error"><?= $errors[$key] ?></span>
        <?php endif; ?>
    </div>
    <button type="submit" class="button">Войти</button>
</form>
