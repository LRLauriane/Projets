#include "../hh/exercice2.hh"

/*Constructeur par défaut*/
exercice2::exercice2()
{
  sList tmp;

  /*Mise à jour du numéro*/
  setNum(2);
  /*Mise à jour des solutions*/
  setSolutions(tmp);
}

exercice2::exercice2(sList& s)
{
  /*Mise à jour du numéro*/
  setNum(2);
  /*Mise à jour des solutions*/
  setSolutions(s);
}

/*Destructeur*/
exercice2::~exercice2(){}

/*Lancement de l'exercice*/
void exercice2::lancer_exo()
{
  /*Lancement des pannes sur le système*/
  getSys().panne_P32();
  getSys().panne_P21();
  getSys().panne_P22();

  /*Lancement des pannes sur la représentation du système*/
  getDrawSys().panne_P32();
  getDrawSys().panne_P21();
  getDrawSys().panne_P22();

}
