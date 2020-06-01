#include "../hh/vanneTM.hh"

/*Constructeurs*/
vanneTM::vanneTM():vanne(),res1(),res2(),moteur1(),moteur2(){}

vanneTM::vanneTM(const int state,const string name,const string categorie,reservoir& tank1, reservoir& tank2, moteur& m1, moteur& m2):vanne(state,name,categorie)
{
  res1 = &tank1;
  res2 = &tank2;
  moteur1 = &m1;
  moteur2 = &m2;
}

/*Destructeur*/
vanneTM::~vanneTM(){}

/*Affichage*/
ostream& operator <<(ostream& flux,vanneTM& v)
{
  flux << "Vanne "<<v.getNom();

  if(v.getEtat()==0) flux << " fermée";
  else flux << " ouverte";

  flux << " reliant le réservoir " << v.res1->getNom() << " et le moteur "<< v.moteur2->getNom();
  flux <<" et reliant le réservoir  "<<v.res2->getNom() << " et le moteur " <<v.moteur1->getNom() << endl;

  return flux;
}
