CREATE TABLE posts (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL,
    content LONGTEXT NOT NULL,
    shortDescription TEXT NOT NULL,
    createdAt DATETIME NOT NULL,
    PRIMARY KEY (id)
)

CREATE TABLE categories (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL,
    shortDescription TEXT NOT NULL,
    createdAt DATETIME NOT NULL,
    PRIMARY KEY (id)
)

CREATE TABLE posts_categories (
    postId INT UNSIGNED NOT NULL,
    categoryId INT UNSIGNED NOT NULL,
    PRIMARY KEY (postId, categoryId),
    CONSTRAINT fk_post
        FOREIGN KEY (postId)
        REFERENCES posts (id)
        ON DELETE CASCADE
        ON UPDATE RESTRICT,
    CONSTRAINT fk_category
        FOREIGN KEY (categoryId)
        REFERENCES categories (id)
        ON DELETE CASCADE
        ON UPDATE RESTRICT
)

CREATE TABLE users (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    mail VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    firstname VARCHAR(255) NOT NULL,
    lastname VARCHAR(255) NOT NULL,
    description TEXT(255) NOT NULL,
    role TEXT(280) NOT NULL,
    createdAt DATETIME NOT NULL,
    PRIMARY KEY (id)
)