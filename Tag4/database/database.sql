-- Erstellt die Datenbank, falls sie noch nicht existiert
CREATE DATABASE IF NOT EXISTS m295;
USE m295;

-- Tabelle 'cars' erstellen
CREATE TABLE IF NOT EXISTS cars (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    kraftstoff ENUM('diesel', 'benzin', 'elektro', 'hybrid') NOT NULL,
    farbe VARCHAR(50),
    bauart ENUM('limousine', 'suv', 'coupe', 'convertible') NOT NULL,
    tank INT NOT NULL,
    jahrgang YEAR NOT NULL,
    createDate DATE NOT NULL,
    active TINYINT(1) NOT NULL DEFAULT 1
);

-- Beispiel-Daten einfügen
INSERT INTO cars (name, price, kraftstoff, farbe, bauart, tank, jahrgang, createDate, active) VALUES
('Audi A4', 30000.00, 'benzin', 'Schwarz', 'limousine', 60, 2020, '2020-01-15', 1),
('BMW X5', 50000.00, 'diesel', 'Blau', 'suv', 85, 2021, '2021-05-20', 1),
('Tesla Model 3', 45000.00, 'elektro', 'Weiß', 'coupe', 0, 2022, '2022-08-10', 1);
