#ifndef _SYSTEME_HH_
#define _SYSTEME_HH_

#include "moteur.hh"
#include "vanneTT.hh"
#include "vanneTM.hh"

class systeme{

private:
  pompe p11;
  pompe p12;
  pompe p21;
  pompe p22;
  pompe p31;
  pompe p32;
  reservoir tank1;
  reservoir tank2;
  reservoir tank3;
  moteur m1;
  moteur m2;
  moteur m3;
  vanneTT vt12;
  vanneTT vt23;
  vanneTM v12;
  vanneTM v13;
  vanneTM v23;


public:
  /*Constructeur*/
  systeme();

  /*Destrcuteur*/
  ~systeme();

  /*Méthode de remise à zéro du système*/
  void remise_a_zero();

  /*Surcharge de l'opérateur <<*/
  friend ostream& operator <<(ostream& flux,systeme& systeme);

  /*Getteurs des éléments du système*/
  pompe& getPompeP11();
  pompe& getPompeP12();
  pompe& getPompeP21();
  pompe& getPompeP22();
  pompe& getPompeP31();
  pompe& getPompeP32();
  reservoir& getTank1();
  reservoir& getTank2();
  reservoir& getTank3();
  moteur& getMoteur1();
  moteur& getMoteur2();
  moteur& getMoteur3();
  vanneTM& getVanneV12();
  vanneTM& getVanneV13();
  vanneTM& getVanneV23();
  vanneTT& getVanneVT12();
  vanneTT& getVanneVT23();

  /*Méthodes de lancement des pannes pour chaque élément*/
  void panne_P11();
  void panne_P12();
  void panne_P21();
  void panne_P22();
  void panne_P31();
  void panne_P32();
  void panne_Tank1();
  void panne_Tank2();
  void panne_Tank3();

};

#endif
