LAMOUR Lauriane
BONNET Ludivine
SAKUMA Marion
        				Projet JAVA : ÉCHEC


Manuel d’utilisation


Choisir le mode de jeu :
        - Entrer 1 pour choisir le mode joueur contre IA.
        - Entrer 2 pour choisir le mode joueur contre joueur.

Déplacement :
        - Entrer les coordonnées de la pièce ainsi que les coordonnées du déplacement
        exemple : "b2b3"


Undo :
        - Entrer “undo” pour effectuer un retour en arrière.


Promotion :
        - Lorsque la promotion est possible, entrer le type de pièce que vous voulez obtenir après promotion: Tour, Fou, Cavalier, Reine.

Quitter :
	- Entrer "quit" pour terminer le programme.

Compilation :
	Ouvrez un terminal
  Allez dans le dossier "Jeu d'échecs"
  Entrez la commande : make


Manuel technique


Conception du projet :

Nous avons choisi de créer la classe “Piece”, la superclasse des différents types de pièce correspondant chacun à une classe. De même la classe “Joueur” est la superclasse des deux type de joueur: IA et personne.
Pour différencier les deux IA en mode “IA contre IA” et ainsi leur attribuer une équipe différente, nous avons ajouté une couleur au pièce de chaque équipe.


La classe “Pile” contient toutes les fonctions applicables à une pile,  utiles au fonctionnement du undo. Elle nous permet de stocker et de récupérer les déplacement des pièces au cours de la partie. Cette classe est composée de deux piles : une pile de <Integer> permettant de sauvegarder les coordonnées de départ de la pièce qui vient de se déplacer et une pile de <Pièce> stockant en parallèle de la première pile, la pièce qui s’est déplacée.


La classe  “Plateau” gère l’initialisation du plateau  et des pièces à leur position initiale.

L'énumération “Application” contient l’affichage et l’organisation de la partie.
