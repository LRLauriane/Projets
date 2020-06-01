#ifndef _POMPE_HH
#define _POMPE_HH

#include "element.hh"

class pompe:public element{

public :

  /*Constructeurs*/
  pompe();
  pompe(const int state,const string name);

  /*Destructeur*/
  ~pompe();

  /*Surcharge de l'opérateur <<*/
  friend ostream& operator <<(ostream& flux,pompe & p);

  /*Méthode de démarrage*/
  void demarrer();

  /*Méthode d'arrêt*/
  void arreter();

};

#endif
