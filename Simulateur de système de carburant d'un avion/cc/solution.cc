#include "../hh/solution.hh"

/*Constructeur par défaut*/
solution::solution()
{
  debut = NULL;
}

/*Destructeur*/
solution::~solution()
{
  mouvement * tmp;

  /*Parcours de la liste en supprimant chaque élément*/
  while(debut != NULL)
  {
    tmp = debut;
    debut = debut->suiv;
    delete tmp;
  }
}

/*Surcharge de l'opérateur <<*/
ostream& operator << (ostream& flux, solution& sol)
{
  mouvement *tmp = sol.debut;

  flux << "La suite de mouvement est :"<<endl;

  /*Parcours de la liste en affichant chaque élément*/
  while(tmp != NULL)
  {
    flux<<tmp->bouton<<","<<tmp->etat<<endl;
    tmp=tmp->suiv;
  }

  delete tmp;

  return flux;
}

/*Surcharge de l'opérateur =*/
solution& solution::operator = (solution& sol)
{
  mouvement * tmp = sol.debut;

  /*Vider la file*/
  mouvement * tmp1;

  while(debut != NULL)
  {
    tmp1 = debut;
    debut = debut->suiv;
    delete tmp1;
  }

  delete debut;

  /*Retour à une liste vide*/
  debut = NULL;

  /*Parcours de la liste passée en paramètre*/
  while(tmp != NULL)
  {
    /*Création d'un nouveau mouvement*/
    mouvement * nouveau = new mouvement;

    /*Si la liste est vide*/
    if(debut == NULL)
    {
      nouveau->bouton = tmp->bouton;
      nouveau->etat = tmp->etat;
      nouveau->suiv = NULL;
      debut = nouveau;
    }
    /*sinon ajout à la fin de la liste*/
    else
    {
      mouvement * tempo = debut;

      while(tempo->suiv != NULL){tempo=tempo->suiv;}

      nouveau->bouton = tmp->bouton;
      nouveau->etat = tmp->etat;
      nouveau->suiv = NULL;
      tempo->suiv = nouveau;

      while(tempo != NULL){tempo=tempo->suiv;}
      delete tempo;
    }

    tmp=tmp->suiv;
  }

  delete tmp;

  return *this;
}

/*Ajout d'un mouvement*/
solution& solution::add(string bouton,int etat)
{
  /*Nouveau mouvement*/
  mouvement * nouveau = new mouvement;

  /*Si la liste est vide*/
  if(debut == NULL)
  {
    nouveau->bouton = bouton;
    nouveau->etat = etat;
    nouveau->suiv = NULL;
    debut = nouveau;
  }
  /*Sinon ajout à la fin*/
  else
  {
    mouvement * tmp = debut;

    while(tmp->suiv != NULL){tmp=tmp->suiv;}

    nouveau->bouton = bouton;
    nouveau->etat = etat;
    nouveau->suiv = NULL;
    tmp->suiv = nouveau;

    while(tmp != NULL){tmp=tmp->suiv;}
    delete tmp;
  }

  return *this;
}

/*Récupération de la liste de mouvement*/
mouvement& solution::getSol(){return *debut;}
