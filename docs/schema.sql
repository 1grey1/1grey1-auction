--
-- База данных: auction
--

DROP DATABASE IF EXISTS auction;

CREATE DATABASE auction
    DEFAULT CHARACTER SET utf8
    DEFAULT COLLATE utf8_general_ci;

USE auction;

-- --------------------------------------------------------

--
-- Структура таблицы user
--

CREATE table user
(
    id            INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    created_at    TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    email         VARCHAR(128) NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    UNIQUE INDEX email_unique(email)
);

-- --------------------------------------------------------

--
-- Структура таблицы user_profile
--

CREATE table user_profile
(
    id           INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    created_at   TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    name         VARCHAR(128) NOT NULL,
    avatar_path  VARCHAR(255) NULL,
    contact_info TEXT         NOT NULL,
    user_id      INT UNSIGNED NOT NULL,
    FOREIGN KEY (user_id) REFERENCES user (id)
);

-- --------------------------------------------------------

--
-- Структура таблицы category
--

CREATE table category
(
    id         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    created_at TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    name       VARCHAR(64)  NOT NULL,
    inner_code VARCHAR(128) NOT NULL
);

-- --------------------------------------------------------

--
-- Структура таблицы lot
--

CREATE table lot
(
    id            INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    created_at    TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    title         VARCHAR(255) NOT NULL,
    photo_path    VARCHAR(255) NOT NULL,
    start_price   FLOAT        NOT NULL,
    description   TEXT         NOT NULL,
    bet_step      FLOAT        NOT NULL,
    deadline      DATE         NOT NULL,
    user_id       INT UNSIGNED NOT NULL,
    category_id   INT UNSIGNED NOT NULL,
    winner_bet_id INT UNSIGNED NULL,
    FOREIGN KEY (user_id) REFERENCES user (id),
    FOREIGN KEY (category_id) REFERENCES category (id)
);

-- --------------------------------------------------------

--
-- Структура таблицы bet
--

CREATE table bet
(
    id         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    created_at TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    amount     FLOAT        NOT NULL,
    user_id    INT UNSIGNED NOT NULL,
    lot_id     INT UNSIGNED NOT NULL,
    FOREIGN KEY (user_id) REFERENCES user (id),
    FOREIGN KEY (lot_id) REFERENCES lot (id)
);

-- --------------------------------------------------------

ALTER table lot
ADD FOREIGN KEY (winner_bet_id) REFERENCES bet (id)
