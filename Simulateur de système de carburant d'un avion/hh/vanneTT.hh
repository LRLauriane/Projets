#ifndef _VANNETT_HH_
#define _VANNETT_HH_

#include "vanne.hh"
#include "reservoir.hh"

class vanneTT : public vanne
{
  private:
    /*Premier réservoir*/
    reservoir * res1;
    /*Deuxième réservoir*/
    reservoir * res2;

  public:
    /*Constructeurs*/
    vanneTT();
    vanneTT(const int state,const string name,const string categorie,reservoir& tank1, reservoir& tank2);

    /*Destructeur*/
    ~vanneTT();

    /*Affichage*/
    friend ostream& operator <<(ostream& flux,vanneTT& v);
};
#endif
