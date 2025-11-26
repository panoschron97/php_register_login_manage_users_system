CREATE DATABASE IF NOT EXISTS database_register_login;
--
USE database_register_login;
--
CREATE TABLE IF NOT EXISTS users
(
id INTEGER AUTO_INCREMENT,
username VARCHAR(15) NOT NULL,
password VARCHAR(60) NOT NULL,
email VARCHAR(50) NOT NULL,
PRIMARY KEY(id),
CONSTRAINT username_unq UNIQUE(username),
CONSTRAINT email_unq UNIQUE(email),
CONSTRAINT email_chk 
CHECK(email REGEXP "^[a-zA-Z0-9][a-zA-Z0-9.!#$%&'*+-/=?^_`{|}~]*?[a-zA-Z0-9._-]?@[a-zA-Z0-9][a-zA-Z0-9._-]*?[a-zA-Z0-9]?\\.[a-zA-Z]{2,63}$")
);
--
DELIMITER //
CREATE TRIGGER lowercase_username_password
BEFORE INSERT ON users
FOR EACH ROW
BEGIN
SET NEW.username = LOWER(NEW.username);
SET NEW.password = LOWER(NEW.password);
SET NEW.email = LOWER(NEW.email);
END; 
// DELIMITER ;
--
INSERT INTO users SET username = "TEST", password = "TEST123", email = "TEST@HOTMAIL.COM";
COMMIT;
--
SELECT * FROM users;
SELECT password, LENGTH(password) AS length_of_password FROM users;
--
ALTER TABLE users AUTO_INCREMENT = 1;
----------
USE database_register_login;
--
DELETE FROM users;
COMMIT;
--
TRUNCATE TABLE users;
--
DROP TRIGGER IF EXISTS lowercase_username_password;
--
ALTER TABLE users DROP CONSTRAINT email_chk, 
DROP CONSTRAINT email_unq,
DROP CONSTRAINT username_unq,
MODIFY id INTEGER NOT NULL,
DROP PRIMARY KEY;
--
DROP TABLE IF EXISTS users;
--
DROP DATABASE IF EXISTS database_register_login;