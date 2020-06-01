#ifndef _VANNE_HH
#define _VANNE_HH

#include "element.hh"

class vanne:public element
{
private:
  string type;

public:

  /*Constructeurs*/
  vanne();
  vanne(const int state,const string name,const string categorie);

  /*Destructeur*/
  ~vanne();

  /*Méthode d'ouverture*/
  void ouverture();

  /*Méthode de fermeture*/
  void fermeture();

};

#endif
