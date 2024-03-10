Drop Database if exists 3cx;
CREATE DATABASE 3cx;

USE 3cx;

CREATE TABLE nachtschaltung (
    id INT AUTO_INCREMENT PRIMARY KEY,
    beschriftung VARCHAR(100) NOT NULL,
    ziel VARCHAR(25) NOT NULL,
    torziel VARCHAR(25),
    aktiv BOOLEAN NOT NULL
);

INSERT INTO nachtschaltung (beschriftung, ziel, aktiv) VALUES ('TAG 🌞', '800', true);
INSERT INTO nachtschaltung (beschriftung, ziel, aktiv) VALUES ('NACHT 🌙', '130', false);
INSERT INTO nachtschaltung (beschriftung, ziel, aktiv) VALUES ('Heiko Mobil', '120', false);
INSERT INTO nachtschaltung (beschriftung, ziel, aktiv) VALUES ('Ulrike Mobil', '105', false);
INSERT INTO nachtschaltung (beschriftung, ziel, aktiv) VALUES ('Lena Mobil', '104', false);
INSERT INTO nachtschaltung (beschriftung, ziel, aktiv) VALUES ('Marie Mobil', '104', false);
