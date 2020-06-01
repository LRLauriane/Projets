#ifndef _EXERCICE5_HH_
#define _EXERCICE5_HH_

#include "exercice.hh"

class exercice5:public exercice
{
  public :

  /*Constructeurs*/
  exercice5();
  exercice5(sList& s);

  /*Destructeur*/
  ~exercice5();

  /*Fonction de lancement de l'exercice*/
  void lancer_exo();
};

#endif
