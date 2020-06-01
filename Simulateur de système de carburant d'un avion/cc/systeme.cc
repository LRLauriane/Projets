#include "../hh/systeme.hh"

/*Constructeur*/
systeme::systeme():
p11(1,"p11"),
p12(0,"p12"),
p21(1,"p21"),
p22(0,"p22"),
p31(1,"p31"),
p32(0,"p32"),
tank1(1,"tank1",p11,p12),
tank2(1,"tank2",p21,p22),
tank3(1,"tank3",p31,p32),
m1(1,"m1",tank1),
m2(1,"m2",tank2),
m3(1,"m3",tank3),
vt12(1,"vt12","vanne_tank_tank",tank1,tank2),
vt23(1,"vt23","vanne_tant_tank",tank2,tank3),
v12(1,"v12","vanne_tank_moteur",tank1,tank2,m1,m2),
v13(1,"v13","vanne_tank_moteur",tank1,tank3,m1,m3),
v23(1,"v23","vanne_tank_moteur",tank2,tank3,m2,m3)
{}

/*Destructeur*/
systeme::~systeme(){}

/*Méthode de remise à zéro*/
void systeme::remise_a_zero()
{
  p11.demarrer();
  p21.demarrer();
  p31.demarrer();
  p12.arreter();
  p22.arreter();
  p32.arreter();
  tank1.setEtat(1);
  tank2.setEtat(1);
  tank3.setEtat(1);
  m1.setEtat(1);
  m2.setEtat(1);
  m3.setEtat(1);
  vt12.ouverture();
  vt23.ouverture();
  v12.ouverture();
  v13.ouverture();
  v23.ouverture();
}

/*Affichage de l'état du système*/
ostream& operator <<(ostream& flux,systeme& systeme)
{
  flux << "--------------------ETAT DU SYSTEME--------------------"<<endl;
  flux << systeme.getTank1();
  flux << systeme.getPompeP11();
  flux << systeme.getPompeP12();
  flux << "\n";
  flux << systeme.getTank2();
  flux << systeme.getPompeP21();
  flux << systeme.getPompeP22();
  flux << "\n";
  flux << systeme.getTank3();
  flux << systeme.getPompeP31();
  flux << systeme.getPompeP32();
  flux << "\n";
  flux << systeme.getMoteur1();
  flux << systeme.getMoteur2();
  flux << systeme.getMoteur3();
  flux << "\n";
  flux << systeme.getVanneV12();
  flux << systeme.getVanneV13();
  flux << systeme.getVanneV23();
  flux << systeme.getVanneVT12();
  flux << systeme.getVanneVT23();
  flux << "\n";

  return flux;
}

/*Getteurs*/
pompe& systeme::getPompeP11(){return p11;}
pompe& systeme::getPompeP12(){return p12;}
pompe& systeme::getPompeP21(){return p21;}
pompe& systeme::getPompeP22(){return p22;}
pompe& systeme::getPompeP31(){return p31;}
pompe& systeme::getPompeP32(){return p32;}
reservoir& systeme::getTank1(){return tank1;}
reservoir& systeme::getTank2(){return tank2;}
reservoir& systeme::getTank3(){return tank3;}
moteur& systeme::getMoteur1(){return m1;}
moteur& systeme::getMoteur2(){return m2;}
moteur& systeme::getMoteur3(){return m3;}
vanneTM& systeme::getVanneV12(){return v12;}
vanneTM& systeme::getVanneV23(){return v23;}
vanneTM& systeme::getVanneV13(){return v13;}
vanneTT& systeme::getVanneVT12(){return vt12;}
vanneTT& systeme::getVanneVT23(){return vt23;}

/*Mise à jour de l'état de l'élément*/
void systeme::panne_P11(){p11.setEtat(-1);}
void systeme::panne_P12(){p12.setEtat(-1);}
void systeme::panne_P21(){p21.setEtat(-1);}
void systeme::panne_P22(){p22.setEtat(-1);}
void systeme::panne_P31(){p31.setEtat(-1);}
void systeme::panne_P32(){p32.setEtat(-1);}
void systeme::panne_Tank1(){tank1.setEtat(0);}
void systeme::panne_Tank2(){tank2.setEtat(0);}
void systeme::panne_Tank3(){tank3.setEtat(0);}
