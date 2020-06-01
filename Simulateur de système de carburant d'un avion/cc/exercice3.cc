#include "../hh/exercice3.hh"

/*Constructeurs*/
exercice3::exercice3()
{
  sList tmp;
  /*Mise à jour du numéro*/
  setNum(3);
  /*Mise à jour des solutions*/
  setSolutions(tmp);
}

exercice3::exercice3(sList& s)
{
  /*Mise à jour du numéro*/
  setNum(3);
  /*Mise à jour des solutions*/
  setSolutions(s);
}

/*Destructeur*/
exercice3::~exercice3(){}

/*Lancement de l'exercice*/
void exercice3::lancer_exo()
{
  /*Lancement sur le système*/
  getSys().panne_Tank2();
  getSys().panne_P21();

  /*Lancement sur la représentation du système*/
  getDrawSys().panne_Tank2();
  getDrawSys().panne_P21();
  getDrawSys().fermer_P22();
}
