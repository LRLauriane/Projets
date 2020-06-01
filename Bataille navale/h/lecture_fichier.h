#include <stdio.h>
#include <stdlib.h>
#include "navalmap.h"

typedef struct {
	int id;
	int kerosene;
	int coque;
}SHIP;

//Fonction utile à la lecture dans le fichier
char* lecture_fichier(const char*chemin);

//Fonctions utiles à la conversion des données sous forme d'entier
int chartoint(char*t,int i);
int decalage (int a);

//Fonction initialisant les paramètres de jeu
void init_param(navalmap_t*m,int*nb_tours,int *coque,int *kerosene,char*sauv);
//Fonction initialisant un tableau de bateaux
void init_ship(SHIP*s,int kerosene,int coque,int nb_ship);
