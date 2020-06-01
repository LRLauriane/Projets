#include "../hh/vanneTT.hh"

/*Constructeurs*/
vanneTT::vanneTT():vanne(),res1(),res2(){}

vanneTT::vanneTT(const int state,const string name,const string categorie,reservoir& tank1, reservoir& tank2):vanne(state,name,categorie)
{
  res1 = &tank1;
  res2 = &tank2;
}

/*Destructeur*/
vanneTT::~vanneTT(){}

/*Affichage*/
ostream& operator <<(ostream& flux,vanneTT& v)
{
  flux << "Vanne "<<v.getNom();

  if(v.getEtat()==0) flux << " fermée";
  else flux << " ouverte";

  flux << " reliant le réservoir " << v.res1->getNom() << " et le réservoir "<< v.res2->getNom() << endl;

  return flux;
}
