#include <stdlib.h>
#include <stdio.h>
#include "lecture_fichier.h"

/*Fonctions de jeu*/

/*Fonctions liées à l'attaque*/
int est_attaquable(navalmap_t*m,int shipID,coord_t arrivee);
void ATK(SHIP*s,navalmap_t*m,int shipID,coord_t arrivee);

/*Fonctions liées au déplacement*/
int est_deplacable(navalmap_t*m,int shipID,coord_t deplacement);
void MOV(SHIP*s,navalmap_t*m,int shipID,coord_t deplacement);

/*Fonctions de radar*/
/*Radar de toute la map*/
SHIP* SC(navalmap_t *m, int shipID, SHIP *s,coord_t*pos_enems,int*nbships);
/*Radar local*/
SHIP SCN(navalmap_t*m,int shipID,SHIP *s,coord_t*pos_enem);

/*Fonctions liées à la charge*/
int est_chargeable(navalmap_t*m,int shipID,coord_t arrivee);
void BST(navalmap_t*m,SHIP *s,int shipID,coord_t arrivee);

/*Fonction de réparation*/
void RPR(SHIP *s,int shipID);
