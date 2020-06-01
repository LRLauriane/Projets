#include "../hh/vanne.hh"

/*Constructeur par défaut*/
vanne::vanne():element(),type(""){}

/*Constructeur par passage de paramètres*/
vanne::vanne(const int state,const string name,const string categorie):element(state,name),type(categorie){
  if(state == -1) throw invalid_argument("L'entier passé en argument ne représente pas un état pour une vanne");
}

vanne::~vanne(){}

/*Ouvertue de la vanne*/
void vanne::ouverture(){setEtat(1);}

/*Fermeture de la vanne*/
void vanne::fermeture(){setEtat(0);}
