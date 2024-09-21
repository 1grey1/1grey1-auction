<?php

/** @var string $categoryList */
/** @var string $categories */
/** @var array $errors */
/** @var array $postInput */

?>
<?= $categoryList ?>

<form
    class="form form--add-lot container<?= !empty($errors) ? ' form--invalid' : ''?>"
    action="add-lot.php"
    method="post"
    enctype="multipart/form-data"
    autocomplete="off"
>
    <h2>Добавление лота</h2>

    <div class="form__container-two">
        <?php $key = 'title'?>
        <div class="form__item<?= isset($errors[$key]) ? ' form__item--invalid' : '' ?>">
            <label for="<?= $key ?>">Наименование <sup>*</sup></label>
            <input
                id="<?= $key ?>"
                type="text"
                name="<?= $key ?>"
                value="<?= $postInput[$key] ?? '' ?>"
                placeholder="Введите наименование лота"
            >
            <?php if (isset($errors[$key])): ?>
                <span class="form__error"><?= $errors[$key] ?></span>
            <?php endif; ?>
        </div>

        <?php $key = 'category_id'?>
        <div class="form__item<?= isset($errors[$key]) ? ' form__item--invalid' : '' ?>">
            <label for="<?= $key ?>">Категория <sup>*</sup></label>
            <select
                id="<?= $key ?>"
                name="<?= $key ?>"
            >
                <option selected>Выберите категорию</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                <?php endforeach; ?>
            </select>
            <?php if (isset($errors[$key])): ?>
                <span class="form__error"><?= $errors[$key] ?></span>
            <?php endif; ?>
        </div>
    </div>

    <?php $key = 'description'?>
    <div class="form__item form__item--wide<?= isset($errors[$key]) ? ' form__item--invalid' : '' ?>">
        <label for="<?= $key ?>">Описание <sup>*</sup></label>
        <textarea
            id="<?= $key ?>"
            name="<?= $key ?>"
            value="<?= $postInput[$key] ?? '' ?>"
            placeholder="Напишите описание лота"
        ></textarea>
        <?php if (isset($errors[$key])): ?>
            <span class="form__error"><?= $errors[$key] ?></span>
        <?php endif; ?>
    </div>

    <?php $key = 'photo'?>
    <div class="form__item form__item--file<?= isset($errors[$key]) ? ' form__item--invalid' : '' ?>">
        <label>Изображение <sup>*</sup></label>
        <div class="form__input-file">
            <input
                class="visually-hidden"
                type="file"
                id="<?= $key ?>"
                name="<?= $key ?>"
            >
            <label for="<?= $key ?>">Добавить</label>
            <?php if (isset($errors[$key])): ?>
                <span class="form__error"><?= $errors[$key] ?></span>
            <?php endif; ?>
        </div>
    </div>


    <div class="form__container-three">
        <?php $key = 'start_price'?>
        <div class="form__item form__item--small<?= isset($errors[$key]) ? ' form__item--invalid' : '' ?>">
            <label for="<?= $key ?>">Начальная цена <sup>*</sup></label>
            <input
                id="<?= $key ?>"
                type="text"
                name="<?= $key ?>"
                value="<?= $postInput[$key] ?? '' ?>"
                placeholder="0"
            >
            <?php if (isset($errors[$key])): ?>
                <span class="form__error"><?= $errors[$key] ?></span>
            <?php endif; ?>
        </div>

        <?php $key = 'bet_step'?>
        <div class="form__item form__item--small<?= isset($errors[$key]) ? ' form__item--invalid' : '' ?>">
            <label for="<?= $key ?>">Шаг ставки <sup>*</sup></label>
            <input
                id="<?= $key ?>"
                type="text"
                name="<?= $key ?>"
                value="<?= $postInput[$key] ?? '' ?>"
                placeholder="0"
            >
            <?php if (isset($errors[$key])): ?>
                <span class="form__error"><?= $errors[$key] ?></span>
            <?php endif; ?>
        </div>

        <?php $key = 'deadline'?>
        <div class="form__item<?= isset($errors[$key]) ? ' form__item--invalid' : '' ?>">
            <label for="<?= $key ?>">Дата окончания торгов <sup>*</sup></label>
            <input
                class="form__input-date"
                id="<?= $key ?>"
                type="text"
                name="<?= $key ?>"
                value="<?= $postInput[$key] ?? '' ?>"
                placeholder="Введите дату в формате ГГГГ-ММ-ДД"
            >
            <?php if (isset($errors[$key])): ?>
                <span class="form__error"><?= $errors[$key] ?></span>
            <?php endif; ?>
        </div>
    </div>

    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <button type="submit" class="button">Добавить лот</button>
</form>
