#ifndef _ELEMENT_HH
#define _ELEMENT_HH

#include <string>
#include <iostream>
#include <stdexcept>

using namespace std;

class element{

private:
  int etat;                                                                     /*Etat de l'élément*/
  string nom;                                                                   /*Nom de l'élément*/

public:
  element();                                                                    /*Constructeur par défaut*/
  element(const int state,const string name);                                   /*Constructeur par passage en paramètre*/
  ~element();                                                                   /*Destructeur*/
  int getEtat();                                                                /*Renvoie l'état de l'élément*/
  string getNom();                                                              /*Renvoie le nom de l'élément*/
  void setEtat(const int state);                                                /*Permet de modifier l'état de l'élément*/
  void setNom(const string name);                                               /*Permet de modifier le nom de l'élément*/
};

#endif
