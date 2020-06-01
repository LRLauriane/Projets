#ifndef _SAUVEGARDE_HH_
#define _SAUVEGARDE_HH_

#include <string>
#include <iostream>
using namespace std;

/*Représentation d'un appui sur un bouton du tableau de bord*/
struct mouvement
{
  /*Bonton sur lequel le pilote a appuyé lors de la simulation*/
  string bouton;
  /*Etat de l'élément correspondant au bouton*/
  int etat;
  /*Pointeur sur le suivant*/
  struct mouvement * suiv;
};

class sauvegarde
{
  private :
  /*Pointeur sur le premier élément de la file*/
  mouvement * premier;

  public :

  /*Constructeurs*/
  sauvegarde();
  sauvegarde(sauvegarde& sauv);

  /*Destructeur*/
  ~sauvegarde();

  /*Méthode d'ajout d'un mouvement*/
  sauvegarde& add(const string bouton,const int etat);

  /*Surcharge des opérateurs*/
  friend ostream& operator <<(ostream& flux,sauvegarde& sauv);
  sauvegarde& operator = (sauvegarde& sauv);

  /*Getteur de la file correspondant à la sauvegarde*/
  mouvement& getListe();
};

#endif
