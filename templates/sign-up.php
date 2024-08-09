<?php

/** @var string $categoryList */
/** @var array $errors */

?>
<?= $categoryList ?>

<!-- form--invalid -->
<form
    class="form container form--invalid"
    action="sign-up.php"
    method="post"
    autocomplete="off"
    enctype="application/x-www-form-urlencoded"
>
    <h2>Регистрация нового аккаунта</h2>
    <div class="form__item<?= isset($errors['email']) ? ' form__item--invalid' : ''?>">
        <label for="email">E-mail <sup>*</sup></label>
        <input
            id="email"
            type="text"
            name="email"
            value="<?= $_POST['email'] ?? '' ?>"
            placeholder="Введите e-mail"
        >

        <?php if (isset($errors['email'])): ?>
            <span class="form__error"><?= $errors['email'] ?></span>
        <?php endif; ?>
    </div>

    <div class="form__item<?= isset($errors['password']) ? ' form__item--invalid' : ''?>">
        <label for="password">Пароль <sup>*</sup></label>
        <input
            id="password"
            type="password"
            name="password"
            value="<?= $_POST['password'] ?? '' ?>"
            placeholder="Введите пароль"
        >

        <?php if (isset($errors['password'])): ?>
            <span class="form__error"><?= $errors['password'] ?></span>
        <?php endif; ?>
    </div>

    <div class="form__item<?= isset($errors['name']) ? ' form__item--invalid' : ''?>">
        <label for="name">Имя <sup>*</sup></label>
        <input
                id="name"
                type="text"
                name="name"
                value="<?= $_POST['name'] ?? '' ?>"
                placeholder="Введите имя"
        >

        <?php if (isset($errors['name'])): ?>
            <span class="form__error"><?= $errors['name'] ?></span>
        <?php endif; ?>
    </div>

    <div class="form__item<?= isset($errors['contact_info']) ? ' form__item--invalid' : ''?>">
        <label for="message">Контактные данные <sup>*</sup></label>
        <textarea
                id="message"
                name="contact_info"
                placeholder="Напишите как с вами связаться"
        ></textarea>

        <?php if (isset($errors['contact_info'])): ?>
            <span class="form__error"><?= $errors['contact_info'] ?></span>
        <?php endif; ?>
    </div>

    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <button type="submit" class="button">Зарегистрироваться</button>
    <a class="text-link" href="#">Уже есть аккаунт</a>
</form>
