#include "../hh/exercice5.hh"

/*Constructeur par défaut*/
exercice5::exercice5()
{
  sList tmp;

  /*Mise à jour du numéro*/
  setNum(5);

  /*Mise à jour des solutions*/
  setSolutions(tmp);
}

/*Constructeur par passage de paramètres*/
exercice5::exercice5(sList& s)
{
  /*Mise à jour du numéro*/
  setNum(5);

  /*Mise à jour des solutions*/
  setSolutions(s);
}

/*Destructeur*/
exercice5::~exercice5(){}

/*Lancement de l'exercice*/
void exercice5::lancer_exo()
{
  /*Lancement des pannes sur le système*/
  getSys().panne_Tank1();
  getSys().panne_P21();
  getSys().panne_P22();

  /*Lancement des pannes sur la représentation du système*/
  getDrawSys().panne_Tank1();
  getDrawSys().ouvrir_P11();
  getDrawSys().fermer_P12();
  getDrawSys().panne_P21();
  getDrawSys().panne_P22();
}
