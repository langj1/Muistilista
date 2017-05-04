CREATE TABLE Kayttaja(
tunnus varchar(50) PRIMARY KEY,
salasana varchar(50) NOT NULL
);

CREATE TABLE Tehtava(
id SERIAL PRIMARY KEY,
kayttaja varchar(50) REFERENCES Kayttaja(tunnus),
nimi varchar(50) NOT NULL,
tarkeys INTEGER NOT NULL,
lisatieto varchar(500)
);

CREATE TABLE Luokka(
kayttaja varchar(50) REFERENCES Kayttaja(tunnus),
nimi varchar(50) PRIMARY KEY
);

CREATE TABLE Luokitus(
luokka varchar(50) REFERENCES Luokka(nimi),
tehtava varchar(50) REFERENCES Tehtava(nimi)
);

CREATE TABLE Ylaluokka(
luokka INTEGER REFERENCES Luokka(id)
);
