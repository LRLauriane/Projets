#ifndef _RESERVOIR_HH
#define _RESERVOIR_HH

#include "pompe.hh"

class reservoir:public element
{
private:
  pompe *primaire;
  pompe *secondaire;

public:

  /*Constructeurs*/
  reservoir();
  reservoir(const int state,const string name,pompe& prim,pompe& sec);

  /*Destructeur*/
  ~reservoir();

  /*Getters des attributs*/
  pompe& getPrimaire();
  pompe& getSecondaire();

  /*Surcharge de l'opérateur <<*/
  friend ostream& operator << (ostream& flux,reservoir& r);

};

#endif
