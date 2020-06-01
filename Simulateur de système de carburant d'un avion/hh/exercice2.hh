#ifndef _EXERCICE2_HH_
#define _EXERCICE2_HH_

#include "exercice.hh"

class exercice2 : public exercice
{
  public:
    exercice2();
    exercice2(sList& s);
    ~exercice2();
    void lancer_exo();
};

#endif
