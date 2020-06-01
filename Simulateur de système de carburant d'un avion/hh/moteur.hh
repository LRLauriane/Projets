#ifndef _MOTEUR_HH
#define _MOTEUR_HH

#include "reservoir.hh"

class moteur:public element{

private:
  reservoir *tank;
public :

  /*Constructeur*/
  moteur();
  moteur(const int state,const string name,reservoir &res);

  /*Destructeur*/
  ~moteur();

  /*Getter*/
  reservoir& getReservoir();

  /*Setter*/
  void setReservoir(reservoir& res);

  /*Surcharge de l'opérateur <<*/
  friend ostream& operator <<(ostream& flux, moteur & m);
};

#endif
