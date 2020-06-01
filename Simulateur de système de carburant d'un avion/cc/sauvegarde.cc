#include "../hh/sauvegarde.hh"

/*Constructeur par défaut*/
sauvegarde::sauvegarde(){
  premier = NULL;
}

/*Constructeur de recopie*/
sauvegarde::sauvegarde(sauvegarde& sauv)
{
  /*Pointeur sur le premier élément de la liste*/
  mouvement * tmp = sauv.premier;
  mouvement * tempo = NULL;

  premier = NULL;

  /*Parcours de la liste*/
  while(tmp != NULL)
  {
    /*Création d'un nouveau mouvement*/
    mouvement * nouveau = new mouvement;

    /*Si la liste est vide*/
    if(premier == NULL)
    {
      /*Initialisation des champs*/
      nouveau->bouton = tmp->bouton;
      nouveau->etat = tmp->etat;
      nouveau->suiv = NULL;
      premier = nouveau;
    }
    else
    {
      tempo = premier;

      /*Parcours jusqu'à la fin de la liste*/
      while(tempo->suiv != NULL){tempo=tempo->suiv;}

      /*Ajout à la fin*/
      nouveau->bouton = tmp->bouton;
      nouveau->etat = tmp->etat;
      nouveau->suiv = NULL;
      tempo->suiv = nouveau;
    }
    /*Avancement dans la liste*/
    tmp=tmp->suiv;
  }

  while(tempo != NULL){tempo = tempo->suiv;}
  delete tempo;
  delete tmp;
}

/*Destructeur*/
sauvegarde::~sauvegarde()
{
  mouvement * tmp;

  /*Parcours de la liste en supprimant chaque élément*/
  while(premier != NULL)
  {
    tmp = premier;
    premier = premier->suiv;
    delete tmp;
  }
}

/*Ajout d'un mouvement dans la liste*/
sauvegarde& sauvegarde::add(const string bouton,const int etat)
{
  /*Création d'un mouvement*/
  mouvement * nouveau = new mouvement;

  /*Si la liste est vide*/
  if(premier == NULL)
  {
    nouveau->bouton = bouton;
    nouveau->etat = etat;
    nouveau->suiv = NULL;
    premier = nouveau;
  }
  /*Sinon ajout à la fin de la liste*/
  else
  {
    mouvement * tmp = premier;

    /*Parcours jusqu'à la fin*/
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

/*Surcharge de l'opérateur <<*/
ostream& operator <<(ostream& flux,sauvegarde& sauv)
{
  mouvement *tmp = sauv.premier;

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
sauvegarde& sauvegarde::operator = (sauvegarde& sauv)
{
  mouvement * tmp = sauv.premier;

  /*Vider la liste*/
  mouvement * tmp1;

  while(premier != NULL)
  {
    tmp1 = premier;
    premier = premier->suiv;
    delete tmp1;
  }

  delete premier;

  /*Création de la liste vide*/
  premier = NULL;

  /*Parcours de la liste de la sauvegarde passée en paramètre*/
  while(tmp != NULL)
  {
    /*Création d'un nouveau mouvement*/
    mouvement * nouveau = new mouvement;

    /*Si la liste est vide*/
    if(premier == NULL)
    {
      nouveau->bouton = tmp->bouton;
      nouveau->etat = tmp->etat;
      nouveau->suiv = NULL;
      premier = nouveau;
    }
    /*Sinon ajout à la fin de la liste*/
    else
    {
      mouvement * tempo = premier;

      /*Parcours jusqu'à la fin*/
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

/*Récupération de la liste contenant la sauvegarde de l'enchaînement durant l'exercice*/
mouvement& sauvegarde::getListe(){return *premier;}
