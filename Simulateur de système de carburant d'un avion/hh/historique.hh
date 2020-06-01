#ifndef _HISTORIQUE_HH_
#define _HISTORIQUE_HH_

#include "sauvegarde.hh"
#include "sList.hh"

class historique
{
  private :
  /*Note finale de la simulation*/
  int note_finale;
  /*Enchaînement de l'exercice 1*/
  sauvegarde exo1;
  /*Enchaînement de l'exercice 2*/
  sauvegarde exo2;
  /*Enchaînement de l'exercice 3*/
  sauvegarde exo3;
  /*Enchaînement de l'exercice 4*/
  sauvegarde exo4;
  /*Enchaînement de l'exercice 5*/
  sauvegarde exo5;
  /*Méthode de vérification de la validité de l'enchaînement enregistré pour un exercice*/
  bool verification_enchainement(sList& sol,sauvegarde& exo);

  public :
  /*Constructeurs*/
  historique();
  historique(sauvegarde& exercice1,sauvegarde& exercice2,sauvegarde& exercice3,sauvegarde& exercice4,sauvegarde& exercice5);

  /*Destructeur*/
  ~historique();

  /*Getters*/
  int getNote();
  sauvegarde& getSauvExo1();
  sauvegarde& getSauvExo2();
  sauvegarde& getSauvExo3();
  sauvegarde& getSauvExo4();
  sauvegarde& getSauvExo5();

  /*Setters*/
  void setSauvExo1(sauvegarde& sauv);
  void setSauvExo2(sauvegarde& sauv);
  void setSauvExo3(sauvegarde& sauv);
  void setSauvExo4(sauvegarde& sauv);
  void setSauvExo5(sauvegarde& sauv);

  /*Surcharge des opérateurs*/
  historique& operator = (historique& h);
  friend ostream& operator << (ostream& flux, historique& h);

  /*Méthode de calcul de la note finale*/
  void calcul_note_finale(sList& sol_exo1,sList& sol_exo2,sList& sol_exo3,sList& sol_exo4,sList& sol_exo5);
};

#endif
