--
-- Création de l'utilisateur
--
DROP USER IF EXISTS 'userSmartphones'@'localhost';
CREATE USER 'userSmartphones'@'localhost' IDENTIFIED BY '.Etml-';
GRANT SELECT, INSERT, UPDATE, DELETE ON `db_smartphones`.* TO 'userSmartphones'@'localhost';