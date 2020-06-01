#include "../hh/authentification.hh"

/*Constructeur par défaut*/
authentification::authentification():identifiant(0),mot_de_passe(""),base(){}

/*Constructeur par passage de paramètres*/
authentification::authentification(const int id, const string mdp,BD& bd)
{
  identifiant = id;
  mot_de_passe = mdp;
  base = &bd;
}

/*Destructeur*/
authentification::~authentification(){}

/*Méthode de vérification des informations rentrées par l'utilisateur*/
bool authentification::verif_infos()
{
  if(base->find_mdp(identifiant) == mot_de_passe)
    return true;

  return false;
}
