DROP VIEW IF EXISTS gestion_vols,nb_passager_vol,gestion_billet;
REVOKE ALL PRIVILEGES,GRANT OPTION FROM 'ing.op.vol'@'localhost','gestionnaire.billet'@'localhost','gestionnaire.humains'@'localhost','admin'@'localhost','client'@'localhost';
DROP USER IF EXISTS 'ing.op.vol'@'localhost','gestionnaire.billet'@'localhost','gestionnaire.humains'@'localhost','admin'@'localhost','client'@'localhost';

/*Création des vues*/

/*Vue sur les vols*/
CREATE VIEW gestion_vols AS
SELECT Compagnie.nom,num_vol,depart,arrivee,escale,date_vol,horaires,porte,Avion.id_avion,capacite,pays,nbre_vols_semaine
FROM Vol,Avion, Compagnie
WHERE Vol.id_avion = Avion.id_avion AND Avion.nom = Compagnie.nom;

/*Vue sur le nombre de passager de chaque vol*/
CREATE VIEW nb_passager_vol AS
SELECT Vol.num_vol, COUNT(Passager.id_passager) AS nb_passagers
FROM Passager,Vol,Billet
WHERE Passager.id_passager = Billet.id_passager AND Billet.num_vol = Vol.num_vol
GROUP BY Vol.num_vol;

/*Vue sur tous les billets achetés*/
CREATE VIEW gestion_billet AS
SELECT
Passager.id_passager,
num_passeport,
num_billet,
date_reservation,
siege,
classe,
prix,
Vol.num_vol,
depart,
arrivee,
date_vol,
horaires,
nom as "Compagnie"
FROM Billet,Passager,Vol,Avion
WHERE Billet.id_passager = Passager.id_passager
AND Billet.num_vol = Vol.num_vol
AND Vol.id_avion = Avion.id_avion;

/*Création des utilisateurs*/

/*Utilisateur maintenant la base de données*/
CREATE USER 'admin'@'localhost' identified by 'Admin75!';
GRANT ALL ON * to 'admin'@'localhost' WITH GRANT OPTION;
FLUSH PRIVILEGES;

/*Utilisateur gérant les vols*/
CREATE USER 'ing.op.vol'@'localhost' identified by 'OPvol75!';
GRANT SELECT ON gestion_vols to 'ing.op.vol'@'localhost';
GRANT SELECT ON nb_passager_vol to 'ing.op.vol'@'localhost';
GRANT SELECT,INSERT,UPDATE,DELETE ON Vol to 'ing.op.vol'@'localhost';
GRANT SELECT,INSERT,UPDATE,DELETE ON Avion to 'ing.op.vol'@'localhost';
GRANT SELECT,INSERT,UPDATE,DELETE ON Compagnie to 'ing.op.vol'@'localhost';
GRANT SELECT,DELETE ON Bagage to 'ing.op.vol'@'localhost';
GRANT SELECT,DELETE ON Billet to 'ing.op.vol'@'localhost';
GRANT SELECT,DELETE ON Travaille to 'ing.op.vol'@'localhost';
FLUSH PRIVILEGES;

/*Utilisateur gérant les billets*/
CREATE USER "gestionnaire.billet"@'localhost' identified by 'Billet75..';
GRANT SELECT ON gestion_billet to 'gestionnaire.billet'@'localhost';
GRANT SELECT,INSERT,UPDATE,DELETE ON Billet to 'gestionnaire.billet'@'localhost';
GRANT SELECT,INSERT,UPDATE,DELETE ON Compagnie to 'ing.op.vol'@'localhost';
GRANT SELECT ON Vol to 'gestionnaire.billet'@'localhost';
GRANT SELECT,DELETE ON Bagage to 'gestionnaire.billet'@'localhost';
FLUSH PRIVILEGES;

/*Utilisateur gérant le personnel et les passagers*/
CREATE USER 'gestionnaire.humains'@'localhost' identified by 'RHparis75.';
GRANT SELECT,INSERT,UPDATE,DELETE ON Employe to 'gestionnaire.humains'@'localhost';
GRANT SELECT,INSERT,UPDATE,DELETE ON Bagage to 'gestionnaire.humains'@'localhost';
GRANT SELECT,INSERT,UPDATE,DELETE ON Passager to 'gestionnaire.humains'@'localhost';
GRANT SELECT,INSERT,UPDATE,DELETE ON Travaille to 'gestionnaire.humains'@'localhost';
GRANT SELECT ON Vol to 'gestionnaire.humains'@'localhost';
GRANT DELETE ON Compte to 'gestionnaire.humains'@'localhost';
GRANT SELECT,DELETE ON Billet to 'gestionnaire.humains'@'localhost';
FLUSH PRIVILEGES;

CREATE USER 'client'@'localhost' identified by 'Client75/';
GRANT SELECT ON gestion_vols to 'client'@'localhost';
FLUSH PRIVILEGES;

ALTER USER 'admin'@'localhost' IDENTIFIED WITH mysql_native_password BY 'Admin75!';
ALTER USER 'ing.op.vol'@'localhost' IDENTIFIED WITH mysql_native_password BY 'OPvol75!';
ALTER USER 'gestionnaire.billet'@'localhost' IDENTIFIED WITH mysql_native_password BY 'Billet75..';
ALTER USER 'gestionnaire.humains'@'localhost' IDENTIFIED WITH mysql_native_password BY 'RHparis75.';
ALTER USER 'client'@'localhost' IDENTIFIED WITH mysql_native_password BY 'Client75/';


/*Requêtes d'interrogations*/

/*Tous les vols à une date précise*/
SELECT Vol.*
FROM Vol
WHERE date_vol = "2019-12-02";

/*afficher les billets correspondant à un compte*/
SELECT Billet.*
FROM (Billet JOIN Compte ON Billet.id_passager = Compte.id_passager)
WHERE Compte.id_passager = 1;

/*afficher tous les vols au départ de Paris*/
SELECT *
FROM Vol
WHERE depart LIKE 'Paris'
ORDER BY arrivee,date_vol;

/*afficher tous les billets de vols au départ de Paris*/
SELECT B.num_vol,depart,arrivee,date_vol,horaires,escale,porte, A.nom AS "Nom de la compagnie", B.prix,classe
FROM Vol V, Billet B, Avion A
WHERE depart LIKE 'Paris'
AND V.num_vol = B.num_vol
AND V.id_avion = A.id_avion
ORDER BY arrivee,date_vol,prix;

/*Nombre d'avions utilisés par une compagnie*/
SELECT nom, COUNT(id_avion) AS "Nombre d'avions utilisés"
FROM Avion
GROUP BY nom;

/*Le vol et le nombre de bagages dont le poids est supérieur à un seuil dans chaque vol*/
SELECT num_vol,COUNT(num_bagage) as "Nbre de bagages > 25 kg"
FROM (Billet JOIN Bagage ON Billet.num_billet = Bagage.num_billet)
WHERE poids > 25
GROUP BY num_vol;

/*calculer la moyenne de prix du billet Paris-Vancouver*/
SELECT arrivee,AVG(prix) AS "Moyenne de prix"
FROM Vol V, Billet B
WHERE V.num_vol = B.num_vol
AND arrivee LIKE 'Vancouver'
GROUP BY arrivee;

/*tous les vols pour Vancouver avec un prix en dessous de la moyenne*/
SELECT B.num_vol,V.depart,V.arrivee,V.date_vol,V.horaires,V.escale,V.porte,A.nom,B.prix,Moy.Moyenne_prix_billet AS "Moyenne de prix"
FROM Vol AS V, Avion AS A, Billet AS B
INNER JOIN (SELECT V1.depart,V1.arrivee,AVG(prix) AS Moyenne_prix_billet
            FROM Vol AS V1, Billet AS B1
            WHERE V1.num_vol = B1.num_vol
            AND V1.depart LIKE 'Vancouver'
            GROUP BY depart,arrivee
            ) AS Moy
              ON depart = Moy.depart
              AND arrivee = Moy.arrivee
WHERE V.id_avion = A.id_avion
AND B.num_vol = V.num_vol
AND V.depart LIKE 'Vancouver'
AND B.prix < Moy.Moyenne_prix_billet;

/*Vols contenant au moins un passager vietnamien*/
SELECT num_vol
FROM Vol
WHERE EXISTS(
  SELECT *
  FROM Passager,Billet
  WHERE Passager.id_passager = Billet.id_passager
  AND Billet.num_vol = Vol.num_vol
  AND Passager.nationalite_passager = "Vietnamese"
)
ORDER BY num_vol;

/*Nom,prénom et identifiant de passager ayant acheté plus d'un billet pour l'année 2019*/
SELECT Passager.id_passager,nom_passager,prenom_passager,COUNT(num_billet) AS "Nombre de billets réservés en 2019"
FROM Passager,Billet,Vol
WHERE Passager.id_passager = Billet.id_passager
AND Vol.num_vol = Billet.num_vol
AND Vol.date_vol LIKE "2019%"
GROUP BY Passager.id_passager
HAVING COUNT(num_billet) > 1
ORDER BY nom_passager;

/*Vol ayant le plus bas prix pour la destination Alger*/
SELECT Vol.*
FROM Vol,Billet
WHERE prix =
(
  SELECT MIN(prix)
  FROM Vol,Billet
  WHERE Vol.num_vol = Billet.num_vol
  AND arrivee = "Alger"
)
AND Vol.num_vol = Billet.num_vol;

/*Classement des destinations*/
SELECT arrivee
FROM(
  SELECT arrivee,COUNT(num_billet) as Nb_billets
  FROM Vol,Billet
  WHERE Vol.num_vol = Billet.num_vol
  AND Vol.arrivee NOT LIKE "Paris"
  GROUP BY arrivee
) as NPPV
ORDER BY Nb_billets DESC;

/*Destination rapportant le plus d'argent*/
SELECT arrivee as Destination,Gain_total
FROM(
  SELECT arrivee,SUM(prix) as Gain_total
  FROM Vol,Billet
  WHERE Vol.num_vol = Billet.num_vol
  AND Vol.arrivee NOT LIKE "Paris"
  GROUP BY arrivee
) as GTPD1
WHERE Gain_total =
(
  SELECT MAX(GTPD2.Gain_total)
  FROM(
    SELECT arrivee,SUM(prix) as Gain_total
    FROM Vol,Billet
    WHERE Vol.num_vol = Billet.num_vol
    AND Vol.arrivee NOT LIKE "Paris"
    GROUP BY arrivee
  ) as GTPD2
);

/*Destination la plus prisé*/
SELECT arrivee,Nb_billets
FROM(
  SELECT arrivee,COUNT(num_billet) as Nb_billets
  FROM Vol,Billet
  WHERE Vol.num_vol = Billet.num_vol
  AND Vol.arrivee NOT LIKE "Paris"
  GROUP BY arrivee
) as NPPV1
WHERE Nb_billets =
(
  SELECT MAX(NPPV2.Nb_billets)
  FROM(
    SELECT arrivee,COUNT(num_billet) as Nb_billets
    FROM Vol,Billet
    WHERE Vol.num_vol = Billet.num_vol
    AND Vol.arrivee NOT LIKE "Paris"
    GROUP BY arrivee
  ) as NPPV2
);

/*Pourcentage d'employés femmes par vol*/
SELECT NEPV.num_vol,Nb_employe_femme/Nb_employe AS "Pourcentage d'employés femmes"
FROM
(
  SELECT num_vol,COUNT(Employe.num_employe) as Nb_employe_femme
  FROM Travaille,Employe
  WHERE Travaille.num_employe = Employe.num_employe
  AND Employe.sexe_employe = "F"
  GROUP BY num_vol
) as NFPV,
(
  SELECT num_vol,COUNT(Employe.num_employe) as Nb_employe
  FROM Travaille,Employe
  WHERE Travaille.num_employe = Employe.num_employe
  GROUP BY num_vol
) as NEPV
WHERE NFPV.num_vol = NEPV.num_vol;

/*Nombre de mineurs par vol*/
SELECT num_vol,COUNT(age_passager.id_passager) AS "Nombre de mineur"
FROM
(
  SELECT id_passager,2019-YEAR(date_naissance_passager) AS Age
  FROM Passager
) AS age_passager,Billet
WHERE Billet.id_passager = age_passager.id_passager
AND Age < 18
GROUP BY Billet.num_vol;

/*Vol où le nombre de billet vendus dépasse la capacité autorisé de l'avion*/
SELECT Vol.num_vol, nb_passagers as "Nombre de billets",capacite
FROM nb_passager_vol,Vol,Avion
WHERE Vol.id_avion = Avion.id_avion
AND Vol.num_vol = nb_passager_vol.num_vol
AND nb_passagers > capacite
GROUP BY nb_passager_vol.num_vol;

/*Requêtes de suppressions et de mise à jour*/

/*Suppression d'un vol*/
DELETE FROM Travaille
WHERE num_vol = 121;

DELETE FROM Bagage
WHERE num_billet IN
(
  SELECT num_billet
  FROM Billet
  WHERE num_vol = 121
);

DELETE FROM Billet
WHERE num_vol = 121;

DELETE FROM Vol
WHERE num_vol = 121;

/*Mise à jour du mot de passe d'un compte*/
UPDATE Compte
SET password = "coco78!"
WHERE identifiant = 38;
