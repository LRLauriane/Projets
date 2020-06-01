#include "actions.h"

/*Choix du joueur*/
typedef enum{
	ATTAQUE,
	RADARGLOB,
	RADARLOC,
	DEPLACEMENT,
	REPARATION,
	CHARGE,
	VIDE
}choix;

/*Sauvegarde du choix et de sa catégorie*/
typedef struct{
	choix c;
	int categorie;
	int id;
}CHOIX;

/*Joueur pour le mode SEUL CONTRE TOUS*/
typedef struct{
	SHIP etat; 			/*Etat du bateau du joueur*/
	int compteur; 		/*Nombre de tours*/
	coord_t ennemi; 	/*Coordonnées de l'ennemi repéré*/
	CHOIX choice; 		/*Choix du joueur*/
}JOUEUR;

/*Joueur pour le mode EQUIPE VS EQUIPE*/
typedef struct{
	int equipe; 		/*Numéro de l'équipe*/
	int compteur; 		/*Nombre de tours*/
	coord_t ennemi; 	/*Coordonnées de l'ennemi repéré*/
	CHOIX choice; 		/*Choix du joueur*/
	SHIP etat; 			/*Etat du bateau du joueur*/
	navalmap_t*map; 	/*Carte navale*/
	pthread_mutex_t*m;  /*Mutex*/
}Joueur;

/*Mode de jeu*/
void seul_contre_tous(navalmap_t*n,SHIP*s,int tours);
void grp_vs_grp(navalmap_t*n,SHIP*s,int tours);

/*#####################FONCTIONS POUR LE MODE SEUL CONTRE TOUS#####################*/
void verif_etat_bat(navalmap_t *m,SHIP *s,JOUEUR*J,int *cmp_bat); 		/*Vérification de l'état des bateaux*/
void gagne(navalmap_t*m,SHIP*s,int nb_bat); 							/*Vérification qu'il ne reste qu'un seul bateau sur la map*/
JOUEUR * ordre_de_passage(navalmap_t *n,JOUEUR *J,int nb_joueurs);		/*Ordre de passage*/
int nb_joueurs_restants(navalmap_t*n,JOUEUR *J);						/*Nombre de joueurs restants*/
CHOIX choix_du_joueur(navalmap_t*n,JOUEUR J);							/*Algorithme de décision*/
void application_choix(JOUEUR *ordre,navalmap_t*n,SHIP*s,int i);		/*Application des choix*/

/*#####################FONCTIONS POUR LE MODE EQUIPE VS EQUIPE#####################*/

/*FONCTIONS ASSOCIÉES AU JEU*/
void* choice(void *a); /*Choix des joueurs*/
Joueur**verification_etat(navalmap_t *m,SHIP *s,int *cmp_bat,int *nb_equipes,Joueur **J);		  /*Vérification de l'état des bateaux et du nombre de joueurs dans l'équipe*/
void gagne_equipe(navalmap_t*m,int*nb_bat,int cmp_bat);									 		  /*Proclamation de l'équipe gagnant*/
CHOIX * ordre_des_actions(navalmap_t *n,Joueur**J,int nb_joueurs);								  /*Tri des actions*/
int nbJoueursRestants(navalmap_t *n,Joueur**J);													  /*Calcul du nombre de joueurs restants*/
int nbJoueursRestantsParEquipe(navalmap_t *n,Joueur**J,int idE);                                  /*Calcul du nombre de joueurs par équipe*/
void apply_choice(CHOIX *c,Joueur**J,navalmap_t*n,SHIP*s,int nbE,int nbJ,int cmpJ,int tour);      /*Application de l'algorithme de décision*/

/*FONCTIONS ASSOCIÉES AU RADAR*/	
SHIP *recherche(Joueur **J,SHIP *s,int idBat,int id_equipe,int nb_joueurs,int nb_equipes,int*cmp_bat);/*Réduction du champ de recherche du radar selon l'équipe*/
void mise_a_jour_radar_global(navalmap_t *n,Joueur **J,SHIP*s,int idE,int nbJ,int nbE,int icase);	  /*Application du radar SCN*/
void mise_a_jour_radar_local(navalmap_t *n,Joueur **J,SHIP*s,int idE,int nbJ,int nbE,int icase);	  /*Application du radar SC*/

/*#####################FONCTIONS POUR LES DEUX MODES#####################*/
int est_present(navalmap_t *m,int shipID);															  /*Vérification de la présence des bateaux sur la map*/




