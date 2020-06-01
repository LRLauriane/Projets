#ifndef _SLIST_HH_
#define _SLIST_HH_

#include "solution.hh"

/*Maillon contenant une solution*/
struct resolution
{
  solution sol;
  struct resolution * suiv;
};

class sList
{
  private:
    /*Pointeur sur le début de la liste*/
    resolution * debut;
  public:
    /*Constructeur*/
    sList();
    /*Destructeur*/
    ~sList();

    /*Récupération de la liste de solutions*/
    resolution& getListe();

    /*Ajout dans la liste d'une solution*/
    void add (solution& s);

    /*Surcharge des opérateurs*/
    sList& operator = (sList& s);
    friend ostream& operator << (ostream& flux,sList& s);
};

#endif
