#include "../hh/exercice4.hh"

/*Constructeur par défaut*/
exercice4::exercice4()
{
  sList tmp;

  /*Mise à jour du numéro*/
  setNum(4);

  /*Mise à jour des solutions*/
  setSolutions(tmp);
}

/*Construteur par passage de paramètres*/
exercice4::exercice4(sList& s)
{
  /*Mise à jour du numéro*/
  setNum(4);

  /*Mise à jour des solutions*/
  setSolutions(s);
}

/*Destructeur*/
exercice4::~exercice4(){}

/*Lancement de l'exercice*/
void exercice4::lancer_exo()
{
  /*Lancement des pannes sur le système*/
  getSys().panne_Tank1();
  getSys().panne_P11();
  getSys().panne_P12();

  /*Lancement des pannes sur la représentation du système*/
  getDrawSys().panne_Tank1();
  getDrawSys().panne_P11();
  getDrawSys().panne_P12();
}
