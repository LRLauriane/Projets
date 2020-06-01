#include "../hh/reservoir.hh"

/*Constructeur par défaut*/
reservoir::reservoir():element(),primaire(),secondaire(){}

/*Constructeur par passage de paramètres*/
reservoir::reservoir(const int state,const string name,pompe& prim,pompe& sec):element(state,name){

  /*Vérification de l'entier passé en argument correspondant à l'état*/
  if(state == -1) throw invalid_argument("L'entier passé en argument ne représente pas un état pour le réservoir");
  primaire = &prim;
  secondaire = &sec;
}

/*Destructeur*/
reservoir::~reservoir(){}

/*Getter de la pompe primaire*/
pompe& reservoir::getPrimaire(){return *primaire;}

/*Getter de la pompe secondaire*/
pompe& reservoir::getSecondaire(){return *secondaire;}

/*Surcharge de l'opérateur <<*/
ostream& operator << (ostream& flux,reservoir& r)
{
  flux << "Réservoir "<<r.getNom();

  if(r.getEtat()==0) flux << " vide";
  else flux << " plein";

  flux<<" associé à la pompe primaire "<< r.primaire->getNom() << " et à la pompe secondaire " << r.secondaire->getNom() << endl;
  return flux;
}
