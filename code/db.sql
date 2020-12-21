DROP DATABASE IF EXISTS tasklist_db;

CREATE DATABASE tasklist_db;

USE tasklist_db;


CREATE TABLE users
(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(50),
    password TEXT NOT NULL
) ENGINE = InnoDB;


CREATE TABLE tasks
(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    task TEXT NOT NULL,
    PM INT UNSIGNED,
    performer INT UNSIGNED,
    deadline DATE,
    completed TINYINT(1),
    INDEX performer_name (performer),
    FOREIGN KEY (performer) REFERENCES users(id)
        ON DELETE CASCADE,
    INDEX PM_name (PM),
    FOREIGN KEY (PM) REFERENCES users(id)
        ON DELETE CASCADE
) ENGINE = InnoDB;
INSERT INTO users(login, password) VALUES
(
    'Nadia',
    '1111'
),
(
    'Nazar',
    '1111'
),
(
    'Maria',
    '1111'
);

INSERT INTO tasks (task, PM, performer, deadline, completed)
VALUES
(
    'Make a todoList with database',
    2,
    1,
    '2020-10-13 ',
    1
),
(
    'Do a lab',
    3,
    2,
    '2020-10-15',
    0
);

SELECT * FROM tasks;

UPDATE users SET password = MD5(password) WHERE id=1;
UPDATE users SET password = MD5(password) WHERE id=2;
UPDATE users SET password = MD5(password) WHERE id=3;

SELECT * FROM users;