#include "../hh/entrainement.hh"

/*Constructeur par défaut*/
entrainement::entrainement():sys(),draw_sys(){}

/*Constrcuteur par passage de paramètres*/
entrainement::entrainement(systeme& sys,dessiner_systeme& draw_sys)
{
  this->sys = &sys;
  this->draw_sys = &draw_sys;
}

/*Méthode d'affichage des choix*/
void entrainement::afficher_choix()
{
  /*Si une panne n'a pas encore été lancé sur l'élément, on l'ajoute à la liste*/
  string liste;
  if (sys->getPompeP11().getEtat()!=-1) liste = liste + sys->getPompeP11().getNom();
  if (sys->getPompeP12().getEtat()!=-1) liste = liste + " / " + sys->getPompeP12().getNom();
  if (sys->getPompeP21().getEtat()!=-1) liste = liste + " / " + sys->getPompeP21().getNom();
  if (sys->getPompeP22().getEtat()!=-1) liste = liste + " / " + sys->getPompeP22().getNom();
  if (sys->getPompeP31().getEtat()!=-1) liste = liste + " / " + sys->getPompeP31().getNom();
  if (sys->getPompeP32().getEtat()!=-1) liste = liste + " / " + sys->getPompeP32().getNom();
  if (sys->getTank1().getEtat()==1) liste = liste + " / " + sys->getTank1().getNom();
  if (sys->getTank2().getEtat()==1) liste = liste +" / " + sys->getTank2().getNom();
  if (sys->getTank3().getEtat()==1) liste = liste + " / " + sys->getTank3().getNom();
  cout << liste << " : ";
}

/*Getter du système*/
systeme& entrainement::getSys(){return *sys;}

/*Getter de la représentation du système*/
dessiner_systeme& entrainement::getDrawSys(){return *draw_sys;}

/*Méthode de lancement de l'entraînement*/
void entrainement::lancer_entrainement(string choix)
{
  /*Mise à zéro du système*/
  sys->remise_a_zero();
  draw_sys->remise_a_zero();

  if (choix=="p11")
  {
    sys->panne_P11();
    draw_sys->panne_P11();
  }
  else if (choix=="p12")
  {
    sys->panne_P12();
    draw_sys->panne_P12();
  }
  else if (choix=="p21")
  {
    sys->panne_P21();
    draw_sys->panne_P21();
  }
  else if (choix=="p22")
  {
    sys->panne_P22();
    draw_sys->panne_P22();
  }
  else if (choix=="p31")
  {
    sys->panne_P31();
    draw_sys->panne_P31();
  }
  else if (choix=="p32")
  {
    sys->panne_P32();
    draw_sys->panne_P32();
  }
  else if (choix=="tank1")
  {
    sys->panne_Tank1();
    draw_sys->panne_Tank1();
    draw_sys->ouvrir_P11();
    draw_sys->fermer_P12();
  }
  else if (choix=="tank2")
  {
    sys->panne_Tank2();
    draw_sys->panne_Tank2();
    draw_sys->ouvrir_P21();
    draw_sys->fermer_P22();
  }
  else if (choix=="tank3")
  {
    sys->panne_Tank3();
    draw_sys->panne_Tank3();
    draw_sys->ouvrir_P31();
    draw_sys->fermer_P32();
  }
  else cout << "Le choix n'existe pas." << endl;
}
