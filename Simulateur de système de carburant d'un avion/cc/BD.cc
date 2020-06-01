#include "../hh/BD.hh"
#include <cstring>
#include <fstream>

/*Constructeur par défaut*/
BD::BD(){
  premier = NULL;
}

/*Destructeur*/
BD::~BD()
{
  data * tmp;

  /*Parcours la liste et supprime chaque élément un par un*/
  while(premier != NULL)
  {
    tmp = premier;
    premier = premier->suiv;
    delete tmp;
  }

  delete premier;
}

/*Méthode de récupération d'une information dans le fichier*/
string BD::recuperer_infos(string ligne,const int pos_ligne,const int pos_fin)
{
  char * save;
  string res;
  int i = 0;

  /*Allocation de la mémoire correspondate à la taille de l'information*/
  save = new char[pos_ligne+1];

  /*Copie de l'information*/
  for(int ite = pos_fin; ite<pos_ligne;ite++)
  {
    save[i] = ligne[ite];
    i++;
  }
  save[pos_ligne-pos_fin] = '\0';
  res = save;
  delete []save;

  return res;
}

void BD::charger(ifstream& flux)
{
  string ligne;
  char * tmp;
  int taille;
  int pos = 0;
  int i = 0;
  /*Variables de sauvegarde pour l'intialisation de la nouvelle donnée*/
  int num;
  string name;
  string prenom;
  int note;
  string password;

  /*Lis chaque ligne du fichier*/
  while(getline(flux,ligne))
  {
    /*Récupère la taille de la ligne*/
    taille = ligne.length();
    /*Allocation de la mémoire pour sauver la ligne*/
    tmp = new char[taille+1];
    /*Copie de la ligne dans la variable de suavegarde*/
    strcpy(tmp,ligne.c_str());
    tmp[taille] = '\0';

    /*Recherche de la première information*/
    while((tmp[i] != ',')&&(tmp[i] != '\0')){i++;}

    /*Si rencontre d'une virgule*/
    if(tmp[i] == ',')
    {
      /*Stockage dans le champ corrspondant*/
      num = stoi(recuperer_infos(tmp,i,pos));
      i++;
      pos = i;
    }
    /*Sinon la ligne est mal écrite*/
    else
    {
      cout << "Erreur sur la ligne lue" << endl;
      exit(0);
    }

    /*Recherche de la seconde information*/
    while((tmp[i] != ',')&&(tmp[i] != '\0')){i++;}

    if(tmp[i] == ',')
    {
      name = recuperer_infos(tmp,i,pos);
      i++;
      pos = i;
    }
    else
    {
      cout << "Erreur sur la ligne lue" << endl;
      exit(0);
    }

    /*Recherche de la troisième information*/
    while((tmp[i] != ',')&&(tmp[i] != '\0')){i++;}

    if(tmp[i] == ',')
    {
      prenom = recuperer_infos(tmp,i,pos);
      i++;
      pos = i;
    }
    else
    {
      cout << "Erreur sur la ligne lue" << endl;
      exit(0);
    }

    /*Recherche de la quatrième information*/
    while((tmp[i] != ',')&&(tmp[i] != '\0')){i++;}

    if(tmp[i] == ',')
    {
      note = stoi(recuperer_infos(tmp,i,pos));
      i++;
      pos = i;
    }
    else
    {
      cout << "Erreur sur la ligne lue" << endl;
      exit(0);
    }

    /*Recherche de la dernière information*/
    while((tmp[i] != ',')&&(tmp[i] != '\0')){i++;}

    /*Si arrivée à la fin de la ligne*/
    if(tmp[i] == '\0')
    {
      password = recuperer_infos(tmp,i,pos);
    }
    else
    {
      cout << "Erreur sur la ligne lue" << endl;
      exit(0);
    }

    /*Ajout dans la base de données*/
    ajouter(num,name,prenom,note,password);

    /*Remise à zéro pour la ligne suivante*/
    delete []tmp;
    pos = 0;
    i = 0;
  }

}

/*Méthode de remplissage du fichier contenant la base de données*/
void BD::remplir_fichier(ofstream& flux)
{
  data * tmp = premier;

  /*Parcours de la liste correspondant à la base de données*/
  while(tmp != NULL)
  {
    /*Ecriture selon un modèle dans le fichier*/
    flux << tmp->numero << "," << tmp->nom << "," << tmp->prenom << "," << tmp->note << ","<<tmp->mdp << endl;
    tmp = tmp->suiv;
  }

  delete tmp;
}

/*Getter du pointeur sur la liste*/
data& BD::getPremier(){return *premier;}

/*Méthode d'affichage des informations d'un pilote*/
void BD::afficher_pilote(const int numero)
{
  data * tmp = premier;

  while(tmp != NULL)
  {
    /*Si le numéro passé en paramètre est égal au numéro d'un pilote*/
    if(tmp->numero == numero)
    {
      /*Affiche les informations de ce tuple*/
      cout << "=========="<<tmp->nom<<" "<<tmp->prenom<<"=========="<<endl;
      cout << "Numéro de pilote : " << tmp->numero << endl;
      cout << "Note : " << tmp->note << endl;
      cout << "Mot de passe : " << tmp->mdp << endl;
      break;
    }

    tmp = tmp->suiv;
  }

  if(tmp == NULL){cout << "Le numéro de pilote n'existe pas." << endl;}

  while(tmp!=NULL){tmp=tmp->suiv;}

  delete tmp;
}

/*Méthode de recherche du mot de passe correspond au numéro*/
string BD::find_mdp(const int numero)
{
  data * tmp = premier;
  string ret = "";

  /*Parcours de la liste*/
  while(tmp != NULL)
  {
    /*Si le numéro du tuple correspond à celui passée en argument*/
    if(tmp->numero == numero)
    {
      ret = tmp->mdp;
      break;
    }

    tmp = tmp->suiv;
  }

  if(tmp == NULL) cout << "Le numéro n'existe pas" << endl;

  while(tmp!=NULL){tmp=tmp->suiv;}
  delete tmp;

  return ret;
}

/*Méthode de recherche de la note correspondant au numéro*/
int BD::find_note(const int num)
{
  data * tmp = premier;
  int res = -1;

  /*Parcours de la liste*/
  while(tmp != NULL)
  {
    /*Si le numéro du tuple correspond à celui passé en paramètre*/
    if(tmp->numero == num)
    {
      res = tmp->note;
      break;
    }

    tmp = tmp->suiv;
  }

  if(tmp == NULL) cout << "Le numéro n'existe pas" << endl;

  while(tmp!=NULL){tmp=tmp->suiv;}
  delete tmp;

  return res;
}

/*Méthode de mise à jour de la note correspondant au numéro*/
void BD::setNote(const int num,const int note)
{
  data * tmp = premier;

  while(tmp != NULL)
  {
    /*Si le numéro passé en paramètre est égal au numéro d'un pilote*/
    if(tmp->numero == num)
    {
      tmp->note = note;
      break;
    }

    tmp = tmp->suiv;
  }

  if(tmp == NULL){cout << "Le numéro de pilote n'existe pas." << endl;}

  while(tmp!=NULL){tmp=tmp->suiv;}

  delete tmp;
}

/*Méthode d'ajout des informations d'un pilote dans la BD*/
BD& BD::ajouter (const int num, const string _nom, const string _prenom, const int _note, const string _mdp)
{
    /*Création d'un nouveau maillon*/
    data * nouveau = new data;

    /*Intialisation des champs*/
    nouveau-> numero = num;
    nouveau-> nom = _nom;
    nouveau-> prenom = _prenom;
    nouveau-> note = _note;
    nouveau-> mdp = _mdp;

    /*Si la liste est vide*/
    if(premier == NULL)
    {
      nouveau->suiv = NULL;
      premier = nouveau;
    }
    /*Sinon ajout selon un ordre croissant des numéros de pilote*/
    else
    {
      data * tmp = premier;
      data * tempo = NULL;

      /*Recherche du précédent du nouveau maillon*/
      while(tmp->suiv != NULL)
      {
        /*Précédent trouvé*/
        if(nouveau->numero<tmp->suiv->numero)
        {
          tempo = tmp->suiv;
          nouveau->suiv = tempo;
          tmp->suiv = nouveau;
          break;
        }

        tmp = tmp->suiv;
      }

      /*Numéro du nouveau maillon est le plus grand = ajout à la fin de la liste*/
      if(tmp->suiv == NULL)
      {
        nouveau->suiv = NULL;
        tmp->suiv = nouveau;
      }

      while(tmp!=NULL){tmp=tmp->suiv;}
      while(tempo!=NULL){tempo=tempo->suiv;}

      delete tmp;
      delete tempo;
    }

    return *this;
}

/*Méthode de supression d'un tuple*/
BD& BD::operator > (const int numero)
{
  data * tmp = premier;
  data * tempo = premier;
  data * save;

  /*Parcours de la liste*/
  while(tmp!= NULL)
  {
    /*Tuple trouvé*/
    if(tmp->numero == numero)
    {
      /*Si le tuple est le premier de la liste*/
      if(tempo->numero == tmp->numero)
      {
        /*et si le suivant est le pointeur NULL*/
        if(tempo->suiv == NULL)
        {
          premier = NULL;
          delete tmp;
          break;
        }
        else
        {
          premier = tempo->suiv;
          delete tmp;
          break;
        }
      }
      else
      {
        /*Parcours de la liste pour trouver le précédent du tuple à supprimer*/
        while(tempo != NULL)
        {
          if(tempo->suiv->numero== tmp->numero) break;
          tempo=tempo->suiv;
        }

        /*Sauvegarde du tuple à supprimer*/
        save = tmp;
        tempo->suiv = tmp->suiv;
        delete save;
        break;
      }
    }

    tmp = tmp->suiv;
  }

  if(tmp==NULL){cout << "Le numéro de pilote n'existe pas."<<endl;}

  while(tmp!=NULL){tmp=tmp->suiv;}
  while(tempo!=NULL){tempo=tempo->suiv;}

  delete tmp;
  delete tempo;

  return *this;
}

/*Méthode d'affichage de la base de données*/
ostream& operator <<(ostream& flux,BD& base)
{
  data * tmp = base.premier;

  flux << "La base de donnée est la suivante : "<<endl;

  while(tmp != NULL)
  {
    flux << "=========="<<tmp->nom<<" "<<tmp->prenom<<"=========="<<endl;
    flux << "Numéro de pilote : " << tmp->numero << endl;
    flux << "Note : " << tmp->note << endl;
    flux << "Mot de passe : " << tmp->mdp << endl;
    tmp = tmp->suiv;
  }

  delete tmp;

  return flux;
}
