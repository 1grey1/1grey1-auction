<?php

/** @var string $categoryList */
/** @var array $errors */
/** @var array $postInput */

?>
<?= $categoryList ?>

<form
    class="form container form--invalid"
    action="sign-up.php"
    method="post"
    autocomplete="off"
    enctype="application/x-www-form-urlencoded"
>
    <h2>Регистрация нового аккаунта</h2>

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

        <?php if (isset($errors['email'])): ?>
            <span class="form__error"><?= $errors['email'] ?></span>
        <?php endif; ?>
    </div>

    <?php $key = 'password'; ?>
    <div class="form__item<?= isset($errors[$key]) ? ' form__item--invalid' : ''?>">
        <label for="<?= $key ?>">Пароль <sup>*</sup></label>
        <input
            id="<?= $key ?>"
            type="password"
            name="<?= $key ?>"
            value="<?= $postInput[$key] ?? '' ?>"
            placeholder="Введите пароль"
        >

        <?php if (isset($errors['password'])): ?>
            <span class="form__error"><?= $errors['password'] ?></span>
        <?php endif; ?>
    </div>

    <?php $key = 'name'; ?>
    <div class="form__item<?= isset($errors[$key]) ? ' form__item--invalid' : ''?>">
        <label for="<?= $key ?>">Имя <sup>*</sup></label>
        <input
            id="<?= $key ?>"
            type="text"
            name="<?= $key ?>"
            value="<?= $postInput[$key] ?? '' ?>"
            placeholder="Введите имя"
        >

        <?php if (isset($errors['name'])): ?>
            <span class="form__error"><?= $errors['name'] ?></span>
        <?php endif; ?>
    </div>

    <?php $key = 'contact_info'; ?>
    <div class="form__item<?= isset($errors[$key]) ? ' form__item--invalid' : ''?>">
        <label for="<?= $key ?>">Контактные данные <sup>*</sup></label>
        <textarea
            id="<?= $key ?>"
            name="<?= $key ?>"
            placeholder="Напишите как с вами связаться"
        ><?= $postInput[$key] ?? '' ?></textarea>

        <?php if (isset($errors[$key])): ?>
            <span class="form__error"><?= $errors[$key] ?></span>
        <?php endif; ?>
    </div>

    <?php if (!empty($errors)): ?>
        <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <?php endif; ?>

    <button type="submit" class="button">Зарегистрироваться</button>
    <a class="text-link" href="#">Уже есть аккаунт</a>
</form>
