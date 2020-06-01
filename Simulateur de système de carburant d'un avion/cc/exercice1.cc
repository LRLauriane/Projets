#include "../hh/exercice1.hh"

/*Constructeur par défaut*/
exercice1::exercice1()
{
  sList tmp;

  /*Mise à jour du numéro*/
  setNum(1);
  /*Mise à jour des solutions*/
  setSolutions(tmp);
}

/*Constructeur par passage de paramètres*/
exercice1::exercice1(sList& s)
{
  /*Mise à jour du numéro*/
  setNum(1);
  /*Mise à jour des solutions*/
  setSolutions(s);
}

/*Destructeur*/
exercice1::~exercice1(){}

/*Lancement de l'exercice*/
void exercice1::lancer_exo()
{
  /*Lancement des pannes sur le système*/
  getSys().panne_P11();
  getSys().panne_P21();
  getSys().panne_P22();

  /*Lancement des pannes sur la représentation du système*/
  getDrawSys().panne_P11();
  getDrawSys().panne_P21();
  getDrawSys().panne_P22();
}
