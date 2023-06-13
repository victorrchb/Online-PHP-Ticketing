CREATE DATABASE events;
USE events;
CREATE TABLE events (
    id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(64) NOT NULL,
    description VARCHAR(256),
    image VARCHAR(512),
    date DATETIME NOT NULL,
    active BIT(1) DEFAULT 1,
    PRIMARY KEY (id)
);
CREATE TABLE tickets (
    id VARCHAR(32) NOT NULL,
    event_id SMALLINT UNSIGNED NOT NULL,
    user_id VARCHAR(10) NOT NULL,
    user_firstname VARCHAR(64) NOT NULL,
    user_lastname VARCHAR(64) NOT NULL,
    user_mail VARCHAR(256) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY(event_id) REFERENCES events(id)
);