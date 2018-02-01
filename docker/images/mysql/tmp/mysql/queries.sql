CREATE TABLE Tests (
id INT(11) PRIMARY KEY AUTO_INCREMENT,
name TEXT 
);

CREATE TABLE Suites (
id INT(11) PRIMARY KEY AUTO_INCREMENT,
name TEXT  
);

CREATE TABLE Suites_Tests (
id INT(11) PRIMARY KEY AUTO_INCREMENT,
id_Suite INT(11),
id_Test INT(11),
FOREIGN KEY (id_Suite)
        REFERENCES Suites(id)
        ON DELETE CASCADE,
FOREIGN KEY (id_Test)
        REFERENCES Tests(id)
        ON DELETE CASCADE
);

INSERT INTO Tests (name) VALUES ('nazwa_testowa_1');
INSERT INTO Tests (name) VALUES ('nazwa_testowa_2');

INSERT INTO Suites (name) VALUES ('nazwa_suite_1');
INSERT INTO Suites (name) VALUES ('nazwa_suite_2');

INSERT INTO Suites_Tests (id_Suite, id_Test) VALUES (1, 1);
INSERT INTO Suites_Tests (id_Suite, id_Test) VALUES (1, 2);