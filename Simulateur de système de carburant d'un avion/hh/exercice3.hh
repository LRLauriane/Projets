#ifndef _EXERCICE3_HH_
#define _EXERCICE3_HH_

#include "exercice.hh"

class exercice3 : public exercice
{
  public :

  /*Constructeurs*/
  exercice3();
  exercice3(sList& s);

  /*Destructeur*/
  ~exercice3();

  /*Fonction de lancement de l'exercice*/
  void lancer_exo();
};
#endif
