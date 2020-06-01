#ifndef _AUTHENTIFICATION_HH_
#define _AUTHENTIFICATION_HH_

#include "BD.hh"

class authentification
{
  private:
    int identifiant;
    string mot_de_passe;
    BD * base;

  public:
    /*Constructeurs*/
    authentification();
    authentification(const int id, const string mdp,BD& bd);
    /*Destructeur*/
    ~authentification();

    /*Méthode de vérifications des informations*/
    bool verif_infos();
};
#endif
