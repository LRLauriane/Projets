#ifndef _EXERCICE_HH_
#define _EXERCICE_HH_

#include "systeme.hh"
#include "dessiner_systeme.hh"
#include "sList.hh"

class exercice
{
 private :

 /*Numéro de l'exercice*/
 int numero;
 /*Système sur lequel va se lancer l'exercice*/
 systeme sys;
 /*Représentation graphique de ce système*/
 dessiner_systeme draw_sys;
 /*Liste des solutions possibles de l'exercice*/
 sList solutions;

 public :

 /*Getter du numéro de l'exercice*/
 int getNum();

 /*Setter du numéro de l'exercice*/
 void setNum(const int nombre);

/*Getter du système sur lequel s'applique l'exercice*/
 systeme& getSys();

 /*Getter de la représentation graphique du système*/
 dessiner_systeme& getDrawSys();

 /*Getter de la liste de solutions*/
 sList& getSolutions();

 /*Setter de la liste de solutions*/
 void setSolutions(sList& s);

 /*Lancement de l'exercice sur le système*/
 virtual void lancer_exo() = 0;
};

#endif
