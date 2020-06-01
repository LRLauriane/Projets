#include "../hh/moteur.hh"

/*Constructeur par défaut*/
moteur::moteur():element(),tank(){}

/*Constructeur par passage de paramètres*/
moteur::moteur(const int state,const string name,reservoir& res):element(state,name){

  /*Vérification du passage d'un entier correspondant à un état*/
  if(state == -1) throw invalid_argument("L'entier passé en argument ne représente pas un état pour le moteur");
  tank = &res;
}

/*Destructeur*/
moteur::~moteur(){}

/*Getter du réservoir relié au moteur*/
reservoir& moteur::getReservoir(){return *tank;}

/*Setter du réservoir*/
void moteur::setReservoir(reservoir& res){tank = &res;}

/*Surcharge de l'opérateur*/
ostream& operator <<(ostream& flux, moteur & m)
{
  flux << "Moteur " << m.getNom();

  if(m.getEtat()==0)flux << " non fonctionnelle";
  else flux << " en fonction";

  flux << " alimenté par "<< m.tank->getNom()<<endl;

  return flux;
}
