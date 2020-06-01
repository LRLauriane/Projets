#include "../hh/tableauDeBord.hh"
#include <qt4/QtGui/QGraphicsView>

tableauDeBord::tableauDeBord():
vt12("VT12"),vt23("VT23"),p12("P12"),p22("P22"),p32("P32"),v12("V12"),v13("V13"),v23("V23"),quit("Quitter"),
layout(),sys(),draw_sys(),sauv(){}

tableauDeBord::tableauDeBord(systeme& sys,dessiner_systeme& draw_sys):
vt12("VT12"),vt23("VT23"),p12("P12"),p22("P22"),p32("P32"),v12("V12"),v13("V13"),v23("V23"),quit("Quitter"),layout(),sauv()
{
  /*Placement de la représentation des boutons dans la fenêtre*/
  layout.addWidget(&vt12,0,0);
  layout.addWidget(&vt23,0,1);
  layout.addWidget(&p12,1,0);
  layout.addWidget(&p22,1,1);
  layout.addWidget(&p32,1,2);
  layout.addWidget(&v12,2,0);
  layout.addWidget(&v13,2,1);
  layout.addWidget(&v23,2,2);
  layout.addWidget(&quit,3,1);

  /*Ajout à la fenêtre*/
  setLayout(&layout);

  /*Instanciation du système, de sa représentation et de l'application sur lequel s'affiche le système*/
  this->draw_sys = &draw_sys;
  this->sys = &sys;

  /*Connexion des boutons avec la méthode de modification du système et de sa représentation*/
  QWidget::connect(&p12,SIGNAL(clicked()),this,SLOT(appuie_p12()));
  QWidget::connect(&p22,SIGNAL(clicked()),this,SLOT(appuie_p22()));
  QWidget::connect(&p32,SIGNAL(clicked()),this,SLOT(appuie_p32()));
  QWidget::connect(&vt12,SIGNAL(clicked()),this,SLOT(appuie_vt12()));
  QWidget::connect(&vt23,SIGNAL(clicked()),this,SLOT(appuie_vt23()));
  QWidget::connect(&v12,SIGNAL(clicked()),this,SLOT(appuie_v12()));
  QWidget::connect(&v13,SIGNAL(clicked()),this,SLOT(appuie_v13()));
  QWidget::connect(&v23,SIGNAL(clicked()),this,SLOT(appuie_v23()));
  QWidget::connect(&quit,SIGNAL(clicked()),this,SLOT(fermer()));

}

/*Destructeur*/
tableauDeBord::~tableauDeBord(){}

/*Modifications apportées lors de l'appui sur le bouton "P12"*/
void tableauDeBord::appuie_p12()
{

  /*Cas de la pompe éteinte*/
  if(sys->getPompeP12().getEtat()==0)
  {
    /*Allumage de la pompe*/
    sys->getPompeP12().demarrer();

    /*Modification de sa représentation*/
    draw_sys->ouvrir_P12();
  }
  /*Cas de la pompe allumée*/
  else if(sys->getPompeP12().getEtat()==1)
  {
    /*Extinction de la pompe*/
    sys->getPompeP12().arreter();

    /*Modification de sa représentation*/
    draw_sys->fermer_P12();
  }

  /*Ajout du mouvement dans la sauvegarde*/
  sauv.add(sys->getPompeP12().getNom(),sys->getPompeP12().getEtat());

  /*Affichage de l'état du système*/
  cout << *sys << endl;

}

/*Modifications apportées lors de l'appui sur le bouton "P22"*/
void tableauDeBord::appuie_p22()
{
  if(sys->getPompeP22().getEtat()==0)
  {
    sys->getPompeP22().demarrer();
    draw_sys->ouvrir_P22();
  }
  else if(sys->getPompeP22().getEtat()==1)
  {
    sys->getPompeP22().arreter();
    draw_sys->fermer_P22();
  }

  sauv.add(sys->getPompeP22().getNom(),sys->getPompeP22().getEtat());
  cout << *sys << endl;

}

/*Modifications apportées lors de l'appui sur le bouton "P32"*/
void tableauDeBord::appuie_p32()
{
  if(sys->getPompeP32().getEtat()==0)
  {
    sys->getPompeP32().demarrer();
    draw_sys->ouvrir_P32();
  }
  else if(sys->getPompeP32().getEtat()==1)
  {
    sys->getPompeP32().arreter();
    draw_sys->fermer_P32();
  }

  sauv.add(sys->getPompeP32().getNom(),sys->getPompeP32().getEtat());
  cout << *sys << endl;

}

/*Modifications apportées lors de l'appui sur le bouton "vt12"*/
void tableauDeBord::appuie_vt12()
{
  if(sys->getVanneVT12().getEtat()==0)
  {
    sys->getVanneVT12().ouverture();
    draw_sys->ouvrir_VT12();
  }
  else if(sys->getVanneVT12().getEtat()==1)
  {
    sys->getVanneVT12().fermeture();
    draw_sys->fermer_VT12();
  }

  sauv.add(sys->getVanneVT12().getNom(),sys->getVanneVT12().getEtat());
  cout << *sys << endl;

}

/*Modifications apportées lors de l'appui sur le bouton "vt13*/
void tableauDeBord::appuie_vt23()
{
  if(sys->getVanneVT23().getEtat()==0)
  {
    sys->getVanneVT23().ouverture();
    draw_sys->ouvrir_VT23();
  }
  else if(sys->getVanneVT23().getEtat()==1)
  {
    sys->getVanneVT23().fermeture();
    draw_sys->fermer_VT23();
  }

  sauv.add(sys->getVanneVT23().getNom(),sys->getVanneVT23().getEtat());
  cout << *sys << endl;

}

/*Modifications apportées lors de l'appui sur le bouton "v12"*/
void tableauDeBord::appuie_v12()
{
  /*Vanne fermée*/
  if(sys->getVanneV12().getEtat()==0)
  {
    /*Ouverture de la vanne*/
    sys->getVanneV12().ouverture();

    /*Modifications sur la représentation*/
    draw_sys->ouvrir_V12();

    /*Cas de l'ouverture de la vanne pour une connexion Tank1/M2*/
    if(sys->getTank1().getSecondaire().getEtat()==1)
    {
      /*Changement du reservoir alimentant le moteur en question*/
      sys->getMoteur2().setReservoir(sys->getTank2());
    }
    /*Cas de l'ouverture de la vanne pour une connexion Tank2/M1*/
    else if(sys->getTank2().getSecondaire().getEtat()==1)
    {
      /*Changement du reservoir alimentant le moteur en question*/
      sys->getMoteur1().setReservoir(sys->getTank1());
    }

  }
  /*Vanne ouverte*/
  else if(sys->getVanneV12().getEtat()==1)
  {
    /*Fermeture*/
    sys->getVanneV12().fermeture();

    /*Modifications sur la représentation*/
    draw_sys->fermer_V12();

    /*Cas de l'ouverture de la vanne pour une connexion Tank1/M2*/
    if(sys->getTank1().getSecondaire().getEtat()==1)
    {
      /*Changement du reservoir alimentant le moteur en question*/
      sys->getMoteur2().setReservoir(sys->getTank1());
    }
    /*Cas de l'ouverture de la vanne pour une connexion Tank2/M1*/
    else if(sys->getTank2().getSecondaire().getEtat()==1)
    {
      /*Changement du reservoir alimentant le moteur en question*/
      sys->getMoteur1().setReservoir(sys->getTank2());
    }
  }

  /*Ajout du mouvement dans la sauvegarde*/
  sauv.add(sys->getVanneV12().getNom(),sys->getVanneV12().getEtat());

  /*Affichage du système*/
  cout << *sys << endl;

}

/*Modifications apportées lors de l'appui sur le bouton "v13"*/
void tableauDeBord::appuie_v13()
{
  if(sys->getVanneV13().getEtat()==0)
  {
    sys->getVanneV13().ouverture();
    draw_sys->ouvrir_V13();

    /*Cas de l'ouverture de la vanne pour une connexion Tank1/M3*/
    if(sys->getTank1().getSecondaire().getEtat()==1)
    {
      sys->getMoteur3().setReservoir(sys->getTank3());
    }
    /*Cas de l'ouverture de la vanne pour une connexion Tank3/M1*/
    else if(sys->getTank3().getSecondaire().getEtat()==1)
    {
      sys->getMoteur1().setReservoir(sys->getTank1());
    }

  }
  else if(sys->getVanneV13().getEtat()==1)
  {
    sys->getVanneV13().fermeture();
    draw_sys->fermer_V13();

    /*Cas de l'ouverture de la vanne pour une connexion Tank1/M3*/
    if(sys->getTank1().getSecondaire().getEtat()==1)
    {
      sys->getMoteur3().setReservoir(sys->getTank1());
    }
    /*Cas de l'ouverture de la vanne pour une connexion Tank3/M1*/
    else if(sys->getTank3().getSecondaire().getEtat()==1)
    {
      sys->getMoteur1().setReservoir(sys->getTank3());
    }
  }

  sauv.add(sys->getVanneV13().getNom(),sys->getVanneV13().getEtat());
  cout << *sys << endl;

}

/*Modifications apportées lors de l'appui sur le bouton "v23"*/
void tableauDeBord::appuie_v23()
{
  if(sys->getVanneV23().getEtat()==0)
  {
    sys->getVanneV23().ouverture();
    draw_sys->ouvrir_V23();

    /*Cas de l'ouverture de la vanne pour une connexion Tank2/M3*/
    if(sys->getTank2().getSecondaire().getEtat()==1)
    {
      sys->getMoteur3().setReservoir(sys->getTank3());
    }
    /*Cas de l'ouverture de la vanne pour une connexion Tank3/M2*/
    else if(sys->getTank3().getSecondaire().getEtat()==1)
    {
      sys->getMoteur2().setReservoir(sys->getTank2());
    }
  }
  else if(sys->getVanneV23().getEtat()==1)
  {
    sys->getVanneV23().fermeture();
    draw_sys->fermer_V23();

    /*Cas de l'ouverture de la vanne pour une connexion Tank2/M3*/
    if(sys->getTank2().getSecondaire().getEtat()==1)
    {
      sys->getMoteur3().setReservoir(sys->getTank2());
    }
    /*Cas de l'ouverture de la vanne pour une connexion Tank3/M2*/
    else if(sys->getTank3().getSecondaire().getEtat()==1)
    {
      sys->getMoteur2().setReservoir(sys->getTank3());
    }
  }

  sauv.add(sys->getVanneV23().getNom(),sys->getVanneV23().getEtat());
  cout << *sys << endl;

}

/*Fermer les deux fenêtres*/
void tableauDeBord::fermer()
{
  /*Effacer la zone*/
  draw_sys->clear();
  /*Récupération des fenêtres sur lequel s'affiche le système*/
  QList <QGraphicsView *> vue = draw_sys->views();

  /*Fermeture de la fenêtre*/
  for(int i=0;i<vue.length();i++)
  {
    vue[i]->close();
  }

  /*Fermeture de la fenêtre contenant le tableau de bord*/
  close();
}

/*Récupération de la sauvegarde*/
sauvegarde& tableauDeBord::getSauv(){return sauv;}

/*Récupération du système*/
systeme& tableauDeBord::getSysteme(){return *sys;}

/*Récupération de la représentation du système*/
dessiner_systeme& tableauDeBord::getDrawSysteme(){return *draw_sys;}
