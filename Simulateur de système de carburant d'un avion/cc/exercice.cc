#include "../hh/exercice.hh"

/*Getter du numéro de l'exercice*/
int exercice::getNum(){return numero;}

/*Setter du numéro de l'exercice*/
void exercice::setNum(const int nombre){numero = nombre;}

/*Getter du système*/
systeme& exercice::getSys(){return sys;}

/*Getter de la représentation du système*/
dessiner_systeme& exercice::getDrawSys(){return draw_sys;}

/*Getter des solutions de l'exercice*/
sList& exercice::getSolutions(){return solutions;}

/*Setter des solutions*/
void exercice::setSolutions(sList& s){solutions = s;}
