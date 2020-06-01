#ifndef _EXERCICE4_HH_
#define _EXERCICE4_HH_

#include "exercice.hh"

class exercice4:public exercice
{
  public :

  /*Constructeurs*/
  exercice4();
  exercice4(sList& s);

  /*Destructeur*/
  ~exercice4();

  /*Fonction de lancement de l'exercice*/
  void lancer_exo();
};

#endif
