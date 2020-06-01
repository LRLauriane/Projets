#ifndef _TABLEAUDEBORD_HH_
#define _TABLEAUDEBORD_HH_

#include <qt4/QtGui/QPushButton>
#include <qt4/QtGui/QGridLayout>
#include <qt4/QtGui/QApplication>
#include "systeme.hh"
#include "dessiner_systeme.hh"
#include "sauvegarde.hh"

class tableauDeBord : public QWidget{
Q_OBJECT

private:
  QPushButton vt12;
  QPushButton vt23;
  QPushButton p12;
  QPushButton p22;
  QPushButton p32;
  QPushButton v12;
  QPushButton v13;
  QPushButton v23;
  QPushButton quit;
  QGridLayout layout;
  systeme * sys;
  dessiner_systeme * draw_sys;
  sauvegarde sauv;


public slots:
  /*Méthodes de changement du système et de sa représentation lors de l'appui sur un bouton du tableau de bord*/
  void appuie_p12();
  void appuie_p22();
  void appuie_p32();
  void appuie_vt12();
  void appuie_vt23();
  void appuie_v12();
  void appuie_v13();
  void appuie_v23();
  void fermer();

public:
  /*Constructeurs*/
  tableauDeBord();
  tableauDeBord(systeme& sys,dessiner_systeme& draw_sys);

  /*Destructeur*/
  ~tableauDeBord();

  /*Getter de l'enchaînement de mouvements sur le tableau de bord*/
  sauvegarde& getSauv();

  /*Getter du système*/
  systeme& getSysteme();

  /*Getter de la représentation du système*/
  dessiner_systeme& getDrawSysteme();
};

#endif
