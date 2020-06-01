#ifndef _SOLUTION_HH_
#define _SOLUTION_HH_

#include "sauvegarde.hh"

class solution
{
 private:
   /*Pointeur sur le début de la liste*/
   mouvement * debut;
 public:
   /*Constructeur*/
   solution();

   /*Destructeur*/
   ~solution();

   /*Surcharge des opérateurs*/
   friend ostream& operator << (ostream& flux, solution& sol);
   solution& operator = (solution& sol);

   /*Ajout d'un mouvement*/
   solution& add(string bouton,int etat);

   /*Getteur de la liste*/
   mouvement& getSol();
};
#endif
