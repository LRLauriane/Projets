#include "../hh/historique.hh"

/*Constructeur par défaut*/
historique::historique():note_finale(0),exo1(),exo2(),exo3(),exo4(),exo5(){}

/*Constructeur par passage de paramètres*/
historique::historique(sauvegarde& exercice1,sauvegarde& exercice2,sauvegarde& exercice3,sauvegarde& exercice4,sauvegarde& exercice5)
{
  note_finale = 0;
  exo1 = exercice1;
  exo2 = exercice2;
  exo3 = exercice3;
  exo4 = exercice4;
  exo5 = exercice5;
}

/*Destructeur*/
historique::~historique(){}

/*Getteur de la note*/
int historique::getNote(){return note_finale;}

/*Getteur de l'enchaînement de l'exercice 1*/
sauvegarde& historique::getSauvExo1(){return exo1;}

/*Getteur de l'enchaînement de l'exercice 2*/
sauvegarde& historique::getSauvExo2(){return exo2;}

/*Getteur de l'enchaînement de l'exercice 3*/
sauvegarde& historique::getSauvExo3(){return exo3;}

/*Getteur de l'enchaînement de l'exercice 4*/
sauvegarde& historique::getSauvExo4(){return exo4;}

/*Getteur de l'enchaînement de l'exercice 5*/
sauvegarde& historique::getSauvExo5(){return exo5;}


/*Setteur de l'enchaînement de l'exercice 1*/
void historique::setSauvExo1(sauvegarde& sauv){exo1 = sauv;}

/*Setteur de l'enchaînement de l'exercice 2*/
void historique::setSauvExo2(sauvegarde& sauv){exo2 = sauv;}

/*Setteur de l'enchaînement de l'exercice 3*/
void historique::setSauvExo3(sauvegarde& sauv){exo3 = sauv;}

/*Setteur de l'enchaînement de l'exercice 4*/
void historique::setSauvExo4(sauvegarde& sauv){exo4 = sauv;}

/*Setteur de l'enchaînement de l'exercice 5*/
void historique::setSauvExo5(sauvegarde& sauv){exo5 = sauv;}

/*Surcharge de l'opérateur =*/
historique& historique::operator = (historique& h)
{
  exo1 = h.exo1;
  exo2 = h.exo2;
  exo3 = h.exo3;
  exo4 = h.exo4;
  exo5 = h.exo5;

  return * this;
}

/*Surcharge de l'opérateur <<*/
ostream& operator << (ostream& flux, historique& h)
{
  flux << "L'historique est le suivant : " << endl;
  flux << "Exercice 1 : " << endl;
  flux << h.exo1 << endl;
  flux << "Exercice 2 : " << endl;
  flux << h.exo2 << endl;
  flux << "Exercice 3 : " << endl;
  flux << h.exo3 << endl;
  flux << "Exercice 4 : " << endl;
  flux << h.exo4 << endl;
  flux << "Exercice 5 : " << endl;
  flux << h.exo5 << endl;

  return flux;
}

bool historique::verification_enchainement(sList& sol,sauvegarde& exo)
{
  resolution * res = &sol.getListe();
  mouvement * sauv = &exo.getListe();

  /*Tant que la liste des solutions n'est pas vide*/
  while(res != NULL)
  {
    /*Récupération de la solution dans la liste de solutions*/
    mouvement * tmp = &res->sol.getSol();

    /*Tant que la file de mouvements enregistré pour l'exercice 1 et la liste contenant la solution n'est pas vide*/
    while((sauv != NULL)&&(tmp != NULL))
    {
      /*Si il n'y a pas de correspondance pour les deux champs entre la solution et l'enchaînement enregistré*/
      if((tmp->bouton != sauv->bouton)||(tmp->etat != sauv->etat)) break;

      /*Avancement dans la liste contenant la solution et la file de mouvements*/
      sauv = sauv->suiv;
      tmp = tmp->suiv;
    }

    /*Test si la fin de la boucle s'est faite arrêtée ou pas*/
    if((sauv == NULL)&&(tmp == NULL))
    {
      while(res != NULL){res = res->suiv;}
      while(sauv != NULL){sauv = sauv->suiv;}

      /*Preuve de la correspondance d'une solution avec l'enchaînement*/
      return true;
    }

    /*Retour au début de la file*/
    sauv = &exo.getListe();

    /*Avancement dans la liste de solutions*/
    res = res -> suiv;
  }

  return false;
}

/*Calcul de la note finale de la simulation*/
void historique::calcul_note_finale(sList& sol_exo1,sList& sol_exo2,sList& sol_exo3,sList& sol_exo4,sList& sol_exo5)
{
  /*Si l'enchaînement correspond à une solution, on augmente la note*/
  if(verification_enchainement(sol_exo1,exo1)) note_finale += 2;
  if(verification_enchainement(sol_exo2,exo2)) note_finale += 2;
  if(verification_enchainement(sol_exo3,exo3)) note_finale += 2;
  if(verification_enchainement(sol_exo4,exo4)) note_finale += 2;
  if(verification_enchainement(sol_exo5,exo5)) note_finale += 2;

}
