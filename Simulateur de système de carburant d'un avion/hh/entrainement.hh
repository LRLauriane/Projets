#ifndef _ENTRAINEMENT_HH_
#define _ENTRAINEMENT_HH_

#include "systeme.hh"
#include "dessiner_systeme.hh"
#include <iostream>

using namespace std;

class entrainement
{
  private:
    /*Système*/
    systeme * sys;
    /*Représentation du système*/
    dessiner_systeme * draw_sys;


  public:
    /*Constructeur*/
    entrainement();
    entrainement(systeme& sys,dessiner_systeme& draw_sys);

    /*Getteur*/
    systeme& getSys();
    dessiner_systeme& getDrawSys();

    /*Méthode d'affichage des choix*/
    void afficher_choix();

    /*Méthode de lancement de l'entraînement selon le choix*/
    void lancer_entrainement(string choix);
};

#endif
