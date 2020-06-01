#ifndef _EXERCICE1_HH_
#define _EXERCICE1_HH_

#include "exercice.hh"

class exercice1 : public exercice
{
  public :

  /*Constructeurs*/
  exercice1();
  exercice1(sList& s);

  /*Destructeur*/
  ~exercice1();

  /*Fonction de lancement de l'exercice*/
  void lancer_exo();
};
#endif
