#include "../hh/sList.hh"

/*Constructeur*/
sList::sList():debut(NULL){}

/*Destructeur*/
sList::~sList()
{
  resolution * tmp;

  /*Parcours de la liste en supprimant chaque élément*/
  while(debut != NULL)
  {
    tmp = debut;
    debut = debut->suiv;
    delete tmp;
  }
}

/*Getteur de la liste correspondant aux solutions*/
resolution& sList::getListe(){return *debut;}

/*Ajout d'un mouvement dans la liste*/
void sList::add (solution& s)
{
  /*Création d'un maillon contenant la solution*/
  resolution * nouveau = new resolution;

  /*Si la liste est vide*/
  if(debut == NULL)
  {
    nouveau->sol = s;
    nouveau->suiv = NULL;
    debut = nouveau;
  }
  /*Sinon ajout à la fin de la liste*/
  else
  {
    resolution * tmp = debut;

    /*Parcours de la liste jusqu'à la fin*/
    while(tmp->suiv != NULL){tmp=tmp->suiv;}

    nouveau->sol = s;
    nouveau->suiv = NULL;
    tmp->suiv = nouveau;

    while(tmp != NULL){tmp=tmp->suiv;}
    delete tmp;
  }
}

/*Surcharge de l'opérateur =*/
sList& sList::operator = (sList& s)
{
  resolution * tmp = s.debut;

  /*Vider la file*/
  resolution * tmp1;

  while(debut != NULL)
  {
    tmp1 = debut;
    debut = debut->suiv;
    delete tmp1;
  }

  delete debut;

  /*Retour à une liste vide*/
  debut = NULL;

  /*Parcours de la liste de solutions passée en argument*/
  while(tmp != NULL)
  {
    /*Création d'un maillon contenant la solution*/
    resolution * nouveau = new resolution;

    /*Si la liste est vide*/
    if(debut == NULL)
    {
      nouveau->sol = tmp->sol;
      nouveau->suiv = NULL;
      debut = nouveau;
    }
    /*sinon ajout à la fin de la liste*/
    else
    {
      resolution * tempo = debut;

      while(tempo->suiv != NULL){tempo=tempo->suiv;}

      nouveau->sol = tmp->sol;
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

/*Surcharge de l'opérateur <<*/
ostream& operator << (ostream& flux,sList& s)
{
  resolution *tmp = s.debut;

  flux << "La suite de solutions est :"<<endl;

  /*Parcours de la liste en affichant les solutions*/
  while(tmp != NULL)
  {
    flux<<tmp->sol<<endl;
    tmp=tmp->suiv;
  }

  delete tmp;

  return flux;
}
