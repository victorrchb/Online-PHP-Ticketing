CREATE DATABASE authentification;
USE authentification;
CREATE TABLE users (
    id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    login VARCHAR(32) NOT NULL,
    password VARCHAR(64) NOT NULL,
    PRIMARY KEY (id)
);
CREATE TABLE tokens (
    token VARCHAR(32) NOT NULL,
    login VARCHAR(32) NOT NULL,
    PRIMARY KEY (token)
);