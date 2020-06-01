#ifndef _VANNETM_HH_
#define _VANNETM_HH_

#include "vanne.hh"
#include "reservoir.hh"
#include "moteur.hh"

class vanneTM : public vanne
{
  private:
    /*Premier réservoir*/
    reservoir * res1;
    /*Deuxième réservoir*/
    reservoir * res2;
    /*Premier moteur*/
    moteur * moteur1;
    /*Deuxième moteur*/
    moteur * moteur2;

  public:
    /*Constructeurs*/
    vanneTM();
    vanneTM(const int state,const string name,const string categorie,reservoir& tank1, reservoir& tank2, moteur& m1, moteur& m2);

    /*Destructeur*/
    ~vanneTM();

    /*Affichage*/
    friend ostream& operator <<(ostream& flux,vanneTM& v);
};
#endif
