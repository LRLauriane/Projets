DROP TABLE IF EXISTS Bagage,Billet,Compte,Travaille,Employe,Passager,Vol,Avion,Compagnie;

CREATE TABLE Compagnie(
    nom VARCHAR(30) NOT NULL,
    pays VARCHAR(30) NOT NULL,
    nbre_avions INT(3) NOT NULL,
    nbre_vols_semaine INT(3) NOT NULL,
    PRIMARY KEY(nom)
);

CREATE TABLE Avion(
  id_avion INT(3) NOT NULL,
  capacite INT(3) NOT NULL,
  nom VARCHAR(30) NOT NULL,
  PRIMARY KEY(id_avion),
  FOREIGN KEY(nom) REFERENCES Compagnie(nom)
);

CREATE TABLE Vol(
  num_vol INT(3) NOT NULL,
  depart VARCHAR(30) NOT NULL,
  arrivee VARCHAR(30) NOT NULL,
  date_vol DATE NOT NULL,
  horaires VARCHAR(30) NOT NULL,
  escale VARCHAR(3) NOT NULL,
  porte VARCHAR(2) NOT NULL,
  id_avion INT(3) NOT NULL,
  PRIMARY KEY(num_vol),
  FOREIGN KEY(id_avion) REFERENCES Avion(id_avion)
);

CREATE TABLE Passager(
  id_passager INT(3) NOT NULL,
  nom_passager VARCHAR(30) NOT NULL,
  prenom_passager VARCHAR(30) NOT NULL,
  sexe_passager VARCHAR(5) NOT NULL,
  date_naissance_passager DATE NOT NULL,
  nationalite_passager VARCHAR(100) NOT NULL,
  adr_postale_passager VARCHAR(100) NOT NULL,
  num_tel_passager VARCHAR(30) NOT NULL,
  num_passeport INT(3) NOT NULL,
  PRIMARY KEY(id_passager)
);

CREATE TABLE Employe(
  num_employe INT(3) NOT NULL,
  num_equipage INT(3) NOT NULL,
  role VARCHAR(30) NOT NULL,
  nom_employe VARCHAR(30) NOT NULL,
  prenom_employe VARCHAR(30) NOT NULL,
  sexe_employe VARCHAR(5) NOT NULL,
  date_naissance_employe DATE NOT NULL,
  nationalite_employe VARCHAR(30) NOT NULL,
  adr_postale_employe VARCHAR(50) NOT NULL,
  num_tel_employe VARCHAR(30) NOT NULL,
  PRIMARY KEY(num_employe)
);

CREATE TABLE Compte(
  identifiant INT(3) NOT NULL,
  password VARCHAR(30) NOT NULL,
  email VARCHAR(100) NOT NULL,
  id_passager INT(3) NOT NULL,
  PRIMARY KEY(identifiant),
  FOREIGN KEY(id_passager) REFERENCES Passager(id_passager)
);

CREATE TABLE Billet(
  num_billet INT(3) NOT NULL,
  date_reservation VARCHAR(30),
  siege INT(3) NOT NULL,
  classe VARCHAR(30) NOT NULL,
  prix INT(3) NOT NULL,
  num_vol INT(3) NOT NULL,
  id_passager INT(3),
  PRIMARY KEY(num_billet),
  FOREIGN KEY(num_vol) REFERENCES Vol(num_vol),
  FOREIGN KEY(id_passager) REFERENCES Passager(id_passager)
);

CREATE TABLE Bagage(
  num_bagage INT(3) NOT NULL,
  taille INT(3) NOT NULL,
  poids INT(3) NOT NULL,
  num_billet INT(3) NOT NULL,
  PRIMARY KEY(num_bagage),
  FOREIGN KEY(num_billet) REFERENCES Billet(num_billet)
);

CREATE TABLE Travaille(
  num_vol INT(3) NOT NULL,
  num_employe INT(3) NOT NULL,
  PRIMARY KEY(num_vol,num_employe),
  FOREIGN KEY(num_vol) REFERENCES Vol(num_vol),
  FOREIGN KEY(num_employe) REFERENCES Employe(num_employe)
);

source insertions.sql;
