DROP DATABASE IF EXISTS tasklist;

CREATE DATABASE tasklist;

USE tasklist;


CREATE TABLE users
(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    login TEXT NOT NULL,
    password TEXT NOT NULL
) ENGINE = InnoDB;


CREATE TABLE tasks
(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    task TEXT NOT NULL,
    PM INT UNSIGNED,
    performer INT UNSIGNED,
    deadline TEXT NOT NULL,
    completed INT UNSIGNED,
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
    '2020-13-10',
    1
),
(
    'Do a lab',
    3,
    2,
    '2020-15-10',
    0
);

SELECT * FROM users;
SELECT * FROM tasks;