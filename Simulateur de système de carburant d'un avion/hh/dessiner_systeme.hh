#ifndef _DESSINER_SYSTEME_HH_
#define _DESSINER_SYSTEME_HH_

#include <qt4/QtGui/QGraphicsScene>
#include <qt4/QtGui/QGraphicsRectItem>

class dessiner_systeme : public QGraphicsScene{

private:
   QRect tank1;
   QRect tank2;
   QRect tank3;
   QRect m1;
   QRect m2;
   QRect m3;
   QRect p11;
   QRect p12;
   QRect p21;
   QRect p22;
   QRect p31;
   QRect p32;
   QRect vt12;
   QRect vt23;
   QRect v12;
   QRect v13;
   QRect v23;
   /*Méthodes de dessin des tuyaux et des vannes*/
   void init_tuyau();
   void init_vanne();

public:

/*Constructeur par défaut*/
  dessiner_systeme();

/*Méthodes de dessin de l'ouverture d'une pompe ou d'une vanne*/
  void ouvrir_P11();
  void ouvrir_P21();
  void ouvrir_P31();
  void ouvrir_P12();
  void ouvrir_P22();
  void ouvrir_P32();
  void ouvrir_VT12();
  void ouvrir_VT23();
  void ouvrir_V12();
  void ouvrir_V13();
  void ouvrir_V23();

/*Méthodes de dessin de l'ouverture d'une pompe ou d'une vanne*/
  void fermer_P11();
  void fermer_P21();
  void fermer_P31();
  void fermer_P12();
  void fermer_P22();
  void fermer_P32();
  void fermer_VT12();
  void fermer_VT23();
  void fermer_V12();
  void fermer_V13();
  void fermer_V23();

/*Méthodes de dessin de la panne d'une pompe ou d'un réservoir*/
  void panne_P11();
  void panne_P12();
  void panne_P21();
  void panne_P22();
  void panne_P31();
  void panne_P32();
  void panne_Tank1();
  void panne_Tank2();
  void panne_Tank3();

 /*Méthode de remise à zéro de l'affichage*/
 void remise_a_zero();
};

#endif
