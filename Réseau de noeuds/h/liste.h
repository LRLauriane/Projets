#include <stdlib.h>
#include <stdio.h>

typedef struct liste{
	int noeud; //numéro du noeud
	int lien; // le numéro du lien 
	struct liste*suivant;
}*LISTE;

LISTE init_LISTE(); // numéro du noeud et du lien égal à -1 et suiv = NULL
LISTE add_LISTE(LISTE L,int noeud,int lien);
void afficher_LISTE(LISTE L);
void sup_LISTE(LISTE L); // désallouer de la mémoire pour la liste
