#include "../hh/element.hh"

/*Constructeur par défaut*/
element::element():etat(0),nom(""){}

/*Constructeur par passage en paramètres des valeurs des attributs*/
element::element(const int state,const string name){

    /*Vérification que la valeur passée à l'argument permettant d'initialiser l'attribut etat correspond à ces valeurs : -1,0,1*/
    if((state!=0)&&(state!=1)&&(state!=-1)) throw invalid_argument("L'entier passé en argument ne représente pas un état pour un élément");
    else
    {
      etat = state;
      nom = name;
    }
}

/*Destructeur*/
element::~element(){}

/*Getteur de l'attribut etat*/
int element::getEtat(){ return etat; }

/*Getteur de l'attribut nom*/
string element::getNom(){ return nom; }

/*Setteur de l'attribut etat*/
void element::setEtat(const int state){ etat=state; }

/*Setteur de l'attribut nom*/
void element::setNom(const string name){ nom=name; }
