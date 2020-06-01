#ifndef _RESOLUTIONS_HH_
#define _RESOLUTIONS_HH_

#include "solution.hh"
#include "sList.hh"

class resolutions
{
  private:
    /*Liste des solutions pour chaque exercice*/
    sList exo1;
    sList exo2;
    sList exo3;
    sList exo4;
    sList exo5;

  public:
    /*Constructeur*/
    resolutions();
    /*Destructeurs*/
    ~resolutions();

    /*Getteurs*/
    sList& getSol_Exo1();
    sList& getSol_Exo2();
    sList& getSol_Exo3();
    sList& getSol_Exo4();
    sList& getSol_Exo5();

};
#endif
