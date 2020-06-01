#ifndef _BD_HH_
#define _BD_HH_

#include <iostream>

using namespace std;

/*Structure permettant de reprséenter les informations d'un pilote*/
struct data{
    /*Numéro*/
    int numero;
    /*Nom*/
    string nom;
    /*Prénom*/
    string prenom;
    /*Note de la simulation*/
    int note;
    /*Mot de passe*/
    string mdp;
    /*Pointeur sur le suivant*/
    data * suiv;
};

class BD {

private:
  /*Pointeur sur le premier*/
  data * premier;
  string recuperer_infos(string ligne,const int pos_ligne,const int pos_fin);

public:
  /*Constructeur par défaut*/
  BD();
  /*Destructeur*/
  ~BD();

  /*Récupérer la liste*/
  data& getPremier();

  /*Méthode permettant de charger la base de données*/
  void charger(ifstream& flux);
  /*Méthode de remplissage du fichier contenant les insertions dans la base de données*/
  void remplir_fichier(ofstream& flux);
  /*Méthode affichant les informations du pilote concerné*/
  void afficher_pilote(const int numero);
  /*Méthode récupérant le mot de passe corrrespondant au numéro de pilote*/
  string find_mdp(const int numero);
  /*Méthode récupérant la note corrrespondant au numéro de pilote*/
  int find_note(const int num);
  /*Méthode mettant à jour la note corrrespondant au numéro de pilote*/
  void setNote(const int num,const int note);
  /*Méthode ajoutant les informations d'un pilote dans la base de données*/
  BD& ajouter (const int num, const string _nom, const string _prenom, const int _note, const string _mdp);

  /*Surcharge des opérateurs*/
  /*Supression d'un tuple*/
  BD& operator > (const int numero);
  /*Affichage de la base de données*/
  friend ostream& operator <<(ostream& flux,BD& base);

};

#endif
