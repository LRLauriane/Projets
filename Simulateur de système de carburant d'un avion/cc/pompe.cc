#include "../hh/pompe.hh"

/*Constructeur par défaut*/
pompe::pompe():element(){}

/*Constructeur par passage en paramètres*/
pompe::pompe(const int state,const string name):element(state,name){}

/*Destructeur*/
pompe::~pompe(){}

/*Surcharge de l'opérateur <<*/
ostream& operator <<(ostream& flux,pompe & p)
{
  flux << "Pompe " << p.getNom();

  if(p.getEtat()==0) flux<<" non fonctionnelle"<<endl;
  else if(p.getEtat()==1) flux << " en fonction"<<endl;
  else flux << " en panne"<<endl;
  return flux;
}

/*Démarrage d'une pompe*/
void pompe::demarrer(){setEtat(1);}

/*Arrêt d'une pompe*/
void pompe::arreter(){setEtat(0);}
