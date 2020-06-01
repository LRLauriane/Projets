#include "../hh/dessiner_systeme.hh"
#include <qt4/QtGui/QPen>
#include <qt4/QtGui/QBrush>

dessiner_systeme::dessiner_systeme():
tank1(20,200,150,200),tank2(270,200,150,200),tank3(520,200,150,200),
m1(75,800,40,150),m2(325,800,40,150),m3(575,800,40,150),
p11(50,345,50,50),p12(110,345,50,50),p21(300,345,50,50),p22(360,345,50,50),p31(530,345,50,50),p32(590,345,50,50),
vt12(195,275,50,50),vt23(445,275,50,50),v12(230,675,50,50),v13(445,475,50,50),v23(445,725,50,50)
{
  /*Représentation du reservoir Tank 1*/
  QPen penTank1(Qt::darkCyan, 1, Qt::SolidLine);
	QBrush brushTank1(Qt::darkCyan);
  addRect(tank1,penTank1,brushTank1);

  /*Représentation du reservoir Tank 2*/
	QPen penTank2(Qt::blue, 1, Qt::SolidLine);
	QBrush brushTank2(Qt::blue);
  addRect(tank2,penTank2,brushTank2);

  /*Représentation du reservoir Tank 3*/
	QPen penTank3(Qt::yellow, 1, Qt::SolidLine);
	QBrush brushTank3(Qt::yellow);
  addRect(tank3,penTank3,brushTank3);

  addText("Tank1",QFont("Comic Sans MS",18))->setPos(55,275);
  addText("Tank2",QFont("Comic Sans MS",18))->setPos(305,275);
  addText("Tank3",QFont("Comic Sans MS",18))->setPos(555,275);

  /*Représentation des moteurs M1,M2 et M3*/
  QPen penMoteur(Qt::gray, 1, Qt::SolidLine);
	QBrush brushMoteur(Qt::gray);
  addRect(m1,penMoteur,brushMoteur);
  addRect(m2,penMoteur,brushMoteur);
  addRect(m3,penMoteur,brushMoteur);

  addText("M1",QFont("Comic Sans MS",18))->setPos(75,865);
  addText("M2",QFont("Comic Sans MS",18))->setPos(325,865);
  addText("M3",QFont("Comic Sans MS",18))->setPos(575,865);

  /*Représentation des pompes primaires sous l'état ouvert*/
  QPen penPompe(Qt::green, 1, Qt::SolidLine);
	QBrush brushPompe(Qt::green);
  addEllipse(p11,penPompe,brushPompe);
  addEllipse(p21,penPompe,brushPompe);
  addEllipse(p31,penPompe,brushPompe);

  addText("P11",QFont("Comic Sans MS",15))->setPos(55,320);
  addText("P21",QFont("Comic Sans MS",15))->setPos(295,320);
  addText("P31",QFont("Comic Sans MS",15))->setPos(540,320);

  /*Représentation des pompes secondaires sous l'état fermé*/
  QPen penVanne(Qt::black, 1, Qt::SolidLine);
	QBrush brushVanne(Qt::black);
  addEllipse(p12,penVanne,brushVanne);
  addEllipse(p22,penVanne,brushVanne);
  addEllipse(p32,penVanne,brushVanne);

  addText("P12",QFont("Comic Sans MS",15))->setPos(115,320);
  addText("P22",QFont("Comic Sans MS",15))->setPos(360,320);
  addText("P32",QFont("Comic Sans MS",15))->setPos(590,320);

  /*Représentation des tuyaux*/
  init_tuyau();

  /*Représentation des vannes*/
  init_vanne();

}

void dessiner_systeme::init_tuyau()
{
  QPen penTuyau(Qt::black, 2, Qt::SolidLine);

  QLine tuyauT1T2(170,300,270,300);
  addLine(tuyauT1T2,penTuyau);

  QLine tuyauT2T3(420,300,520,300);
  addLine(tuyauT2T3,penTuyau);

  /*Tuyaux entre Tank1 et M1*/
  QLine tuyau1T1M1(140,400,140,700);
  addLine(tuyau1T1M1,penTuyau);

  QLine tuyau2T1M1(140,650,95,650);
  addLine(tuyau2T1M1,penTuyau);

  QLine tuyau3T1M1(95,650,95,800);
  addLine(tuyau3T1M1,penTuyau);

  /*Tuyaux entre Tank1 et M2*/
  QLine tuyauT1M2(140,700,345,700);
  addLine(tuyauT1M2,penTuyau);

  /*Tuyaux entre Tank1 et M3*/
  QLine tuyau1T1M3(140,500,595,500);
  addLine(tuyau1T1M3,penTuyau);

  QLine tuyau2T1M3(595,500,595,800);
  addLine(tuyau2T1M3,penTuyau);

  /*Tuyaux entre Tank2 et M2*/
  QLine tuyauT2M2(345,400,345,800);
  addLine(tuyauT2M2,penTuyau);

  /*Tuyaux entre Tank3 et M2*/
  QLine tuyau1T3M2(555,400,555,750);
  addLine(tuyau1T3M2,penTuyau);

  QLine tuyau2T3M2(345,750,555,750);
  addLine(tuyau2T3M2,penTuyau);

  /*Tuyaux entre Tank3 et M3*/
  QLine tuyauT3M3(555,600,595,600);
  addLine(tuyauT3M3,penTuyau);

}

void dessiner_systeme::init_vanne()
{
  /*Dessin d'un cercle noir*/
  QPen penVannes(Qt::black, 1, Qt::SolidLine);
	QBrush brushVannes(Qt::black);
  addEllipse(vt12,penVannes,brushVannes);
  addEllipse(vt23,penVannes,brushVannes);
  addEllipse(v12,penVannes,brushVannes);
  addEllipse(v13,penVannes,brushVannes);
  addEllipse(v23,penVannes,brushVannes);

  /*Représentation de l'ouverture des vannes*/
  QPen penVanne(Qt::white, 1, Qt::SolidLine);
	QBrush brushVanne(Qt::white);
  addRect(QRect(215,280,10,40),penVanne,brushVanne);
  addRect(QRect(465,280,10,40),penVanne,brushVanne);
  addRect(QRect(250,680,10,40),penVanne,brushVanne);
  addRect(QRect(465,480,10,40),penVanne,brushVanne);
  addRect(QRect(465,730,10,40),penVanne,brushVanne);

  addText("VT12",QFont("Comic Sans MS",15))->setPos(195,245);
  addText("VT23",QFont("Comic Sans MS",15))->setPos(445,245);
  addText("V12",QFont("Comic Sans MS",15))->setPos(230,645);
  addText("V13",QFont("Comic Sans MS",15))->setPos(445,445);
  addText("V23",QFont("Comic Sans MS",15))->setPos(445,695);

}

void dessiner_systeme::ouvrir_P11()
{
  QPen penOpen(Qt::green, 1, Qt::SolidLine);
	QBrush brushOpen(Qt::green);
  addEllipse(p11,penOpen,brushOpen);
}

void dessiner_systeme::ouvrir_P21()
{
  QPen penOpen(Qt::green, 1, Qt::SolidLine);
	QBrush brushOpen(Qt::green);
  addEllipse(p21,penOpen,brushOpen);
}
void dessiner_systeme::ouvrir_P31()
{
  QPen penOpen(Qt::green, 1, Qt::SolidLine);
	QBrush brushOpen(Qt::green);
  addEllipse(p31,penOpen,brushOpen);
}

void dessiner_systeme::ouvrir_P12()
{
  QPen penOpen(Qt::green, 1, Qt::SolidLine);
	QBrush brushOpen(Qt::green);
  addEllipse(p12,penOpen,brushOpen);
}

void dessiner_systeme::ouvrir_P22()
{
  QPen penOpen(Qt::green, 1, Qt::SolidLine);
	QBrush brushOpen(Qt::green);
  addEllipse(p22,penOpen,brushOpen);
}

void dessiner_systeme::ouvrir_P32()
{
  QPen penOpen(Qt::green, 1, Qt::SolidLine);
	QBrush brushOpen(Qt::green);
  addEllipse(p32,penOpen,brushOpen);
}
void dessiner_systeme::ouvrir_VT12()
{
  QPen penOpen(Qt::black, 1, Qt::SolidLine);
	QBrush brushOpen(Qt::black);
  addEllipse(vt12,penOpen,brushOpen);

  QPen penVanne(Qt::white, 1, Qt::SolidLine);
	QBrush brushVanne(Qt::white);
  addRect(QRect(215,280,10,40),penVanne,brushVanne);
}

void dessiner_systeme::ouvrir_VT23(){
  QPen penOpen(Qt::black, 1, Qt::SolidLine);
	QBrush brushOpen(Qt::black);
  addEllipse(vt23,penOpen,brushOpen);

  QPen penVanne(Qt::white, 1, Qt::SolidLine);
	QBrush brushVanne(Qt::white);
  addRect(QRect(465,280,10,40),penVanne,brushVanne);
}

void dessiner_systeme::ouvrir_V12()
{
  QPen penOpen(Qt::black, 1, Qt::SolidLine);
	QBrush brushOpen(Qt::black);
  addEllipse(v12,penOpen,brushOpen);

  QPen penVanne(Qt::white, 1, Qt::SolidLine);
	QBrush brushVanne(Qt::white);
  addRect(QRect(250,680,10,40),penVanne,brushVanne);
}

void dessiner_systeme::ouvrir_V13()
{
  QPen penOpen(Qt::black, 1, Qt::SolidLine);
	QBrush brushOpen(Qt::black);
  addEllipse(v13,penOpen,brushOpen);

  QPen penVanne(Qt::white, 1, Qt::SolidLine);
	QBrush brushVanne(Qt::white);
  addRect(QRect(465,480,10,40),penVanne,brushVanne);
}

void dessiner_systeme::ouvrir_V23()
{
  QPen penOpen(Qt::black, 1, Qt::SolidLine);
	QBrush brushOpen(Qt::black);
  addEllipse(v23,penOpen,brushOpen);

  QPen penVanne(Qt::white, 1, Qt::SolidLine);
	QBrush brushVanne(Qt::white);
  addRect(QRect(465,730,10,40),penVanne,brushVanne);
}

void dessiner_systeme::fermer_P11()
{
  QPen penOpen(Qt::black, 1, Qt::SolidLine);
  QBrush brushOpen(Qt::black);
  addEllipse(p11,penOpen,brushOpen);
}

void dessiner_systeme::fermer_P21()
{
  QPen penOpen(Qt::black, 1, Qt::SolidLine);
  QBrush brushOpen(Qt::black);
  addEllipse(p21,penOpen,brushOpen);
}

void dessiner_systeme::fermer_P31()
{
  QPen penOpen(Qt::black, 1, Qt::SolidLine);
  QBrush brushOpen(Qt::black);
  addEllipse(p31,penOpen,brushOpen);
}

void dessiner_systeme::fermer_P12()
{
  QPen penOpen(Qt::black, 1, Qt::SolidLine);
	QBrush brushOpen(Qt::black);
  addEllipse(p12,penOpen,brushOpen);
}

void dessiner_systeme::fermer_P22()
{
  QPen penOpen(Qt::black, 1, Qt::SolidLine);
	QBrush brushOpen(Qt::black);
  addEllipse(p22,penOpen,brushOpen);
}

void dessiner_systeme::fermer_P32()
{
  QPen penOpen(Qt::black, 1, Qt::SolidLine);
	QBrush brushOpen(Qt::black);
  addEllipse(p32,penOpen,brushOpen);
}

void dessiner_systeme::fermer_VT12()
{
  QPen penOpen(Qt::black, 1, Qt::SolidLine);
	QBrush brushOpen(Qt::black);
  addEllipse(vt12,penOpen,brushOpen);

  QPen penVanne(Qt::white, 1, Qt::SolidLine);
	QBrush brushVanne(Qt::white);
  addRect(QRect(200,295,40,10),penVanne,brushVanne);
}

void dessiner_systeme::fermer_VT23()
{
  QPen penOpen(Qt::black, 1, Qt::SolidLine);
	QBrush brushOpen(Qt::black);
  addEllipse(vt23,penOpen,brushOpen);

  QPen penVanne(Qt::white, 1, Qt::SolidLine);
	QBrush brushVanne(Qt::white);
  addRect(QRect(450,295,40,10),penVanne,brushVanne);
}

void dessiner_systeme::fermer_V12()
{
  QPen penOpen(Qt::black, 1, Qt::SolidLine);
	QBrush brushOpen(Qt::black);
  addEllipse(v12,penOpen,brushOpen);

  QPen penVanne(Qt::white, 1, Qt::SolidLine);
	QBrush brushVanne(Qt::white);
  addRect(QRect(235,695,40,10),penVanne,brushVanne);
}

void dessiner_systeme::fermer_V13()
{
  QPen penOpen(Qt::black, 1, Qt::SolidLine);
	QBrush brushOpen(Qt::black);
  addEllipse(v13,penOpen,brushOpen);

  QPen penVanne(Qt::white, 1, Qt::SolidLine);
	QBrush brushVanne(Qt::white);
  addRect(QRect(450,495,40,10),penVanne,brushVanne);
}

void dessiner_systeme::fermer_V23()
{
  QPen penOpen(Qt::black, 1, Qt::SolidLine);
	QBrush brushOpen(Qt::black);
  addEllipse(v23,penOpen,brushOpen);

  QPen penVanne(Qt::white, 1, Qt::SolidLine);
	QBrush brushVanne(Qt::white);
  addRect(QRect(450,745,40,10),penVanne,brushVanne);
}

void dessiner_systeme::panne_P11()
{
  QPen penPanne(Qt::red, 1, Qt::SolidLine);
	QBrush brushPanne(Qt::red);
  addEllipse(p11,penPanne,brushPanne);
}

void dessiner_systeme::panne_P12()
{
  QPen penPanne(Qt::red, 1, Qt::SolidLine);
	QBrush brushPanne(Qt::red);
  addEllipse(p12,penPanne,brushPanne);
}
void dessiner_systeme::panne_P21()
{
  QPen penPanne(Qt::red, 1, Qt::SolidLine);
	QBrush brushPanne(Qt::red);
  addEllipse(p21,penPanne,brushPanne);
}
void dessiner_systeme::panne_P22()
{
  QPen penOpen(Qt::red, 1, Qt::SolidLine);
	QBrush brushOpen(Qt::red);
  addEllipse(p22,penOpen,brushOpen);
}
void dessiner_systeme::panne_P31()
{
  QPen penOpen(Qt::red, 1, Qt::SolidLine);
	QBrush brushOpen(Qt::red);
  addEllipse(p31,penOpen,brushOpen);
}
void dessiner_systeme::panne_P32()
{
  QPen penOpen(Qt::red, 1, Qt::SolidLine);
	QBrush brushOpen(Qt::red);
  addEllipse(p32,penOpen,brushOpen);
}
void dessiner_systeme::panne_Tank1()
{
  QPen penTank1(Qt::darkRed, 1, Qt::SolidLine);
	QBrush brushTank1(Qt::darkRed);
  addRect(tank1,penTank1,brushTank1);
  addText("Tank1",QFont("Comic Sans MS",18))->setPos(55,275);
  addText("P11",QFont("Comic Sans MS",15))->setPos(55,320);
  addText("P12",QFont("Comic Sans MS",15))->setPos(115,320);
}

void dessiner_systeme::panne_Tank2()
{
  QPen penTank2(Qt::darkRed, 1, Qt::SolidLine);
	QBrush brushTank2(Qt::darkRed);
  addRect(tank2,penTank2,brushTank2);
  addText("Tank2",QFont("Comic Sans MS",18))->setPos(305,275);
  addText("P22",QFont("Comic Sans MS",15))->setPos(360,320);
  addText("P21",QFont("Comic Sans MS",15))->setPos(295,320);
}
void dessiner_systeme::panne_Tank3()
{
  QPen penTank3(Qt::darkRed, 1, Qt::SolidLine);
	QBrush brushTank3(Qt::darkRed);
  addRect(tank3,penTank3,brushTank3);
  addText("Tank3",QFont("Comic Sans MS",18))->setPos(555,275);
  addText("P31",QFont("Comic Sans MS",15))->setPos(540,320);
  addText("P32",QFont("Comic Sans MS",15))->setPos(590,320);
}

void dessiner_systeme::remise_a_zero()
{
  /*Représentation du reservoir Tank 1*/
  QPen penTank1(Qt::darkCyan, 1, Qt::SolidLine);
	QBrush brushTank1(Qt::darkCyan);
  addRect(tank1,penTank1,brushTank1);

  /*Représentation du reservoir Tank 2*/
	QPen penTank2(Qt::blue, 1, Qt::SolidLine);
	QBrush brushTank2(Qt::blue);
  addRect(tank2,penTank2,brushTank2);

  /*Représentation du reservoir Tank 3*/
	QPen penTank3(Qt::yellow, 1, Qt::SolidLine);
	QBrush brushTank3(Qt::yellow);
  addRect(tank3,penTank3,brushTank3);

  addText("Tank1",QFont("Comic Sans MS",18))->setPos(55,275);
  addText("Tank2",QFont("Comic Sans MS",18))->setPos(305,275);
  addText("Tank3",QFont("Comic Sans MS",18))->setPos(555,275);

  /*Représentation des moteurs M1,M2 et M3*/
  QPen penMoteur(Qt::gray, 1, Qt::SolidLine);
	QBrush brushMoteur(Qt::gray);
  addRect(m1,penMoteur,brushMoteur);
  addRect(m2,penMoteur,brushMoteur);
  addRect(m3,penMoteur,brushMoteur);

  addText("M1",QFont("Comic Sans MS",18))->setPos(75,865);
  addText("M2",QFont("Comic Sans MS",18))->setPos(325,865);
  addText("M3",QFont("Comic Sans MS",18))->setPos(575,865);

  /*Représentation des pompes primaires sous l'état ouvert*/
  QPen penPompe(Qt::green, 1, Qt::SolidLine);
	QBrush brushPompe(Qt::green);
  addEllipse(p11,penPompe,brushPompe);
  addEllipse(p21,penPompe,brushPompe);
  addEllipse(p31,penPompe,brushPompe);

  addText("P11",QFont("Comic Sans MS",15))->setPos(55,320);
  addText("P21",QFont("Comic Sans MS",15))->setPos(295,320);
  addText("P31",QFont("Comic Sans MS",15))->setPos(540,320);

  /*Représentation des pompes secondaires sous l'état fermé*/
  QPen penVanne(Qt::black, 1, Qt::SolidLine);
	QBrush brushVanne(Qt::black);
  addEllipse(p12,penVanne,brushVanne);
  addEllipse(p22,penVanne,brushVanne);
  addEllipse(p32,penVanne,brushVanne);

  addText("P12",QFont("Comic Sans MS",15))->setPos(115,320);
  addText("P22",QFont("Comic Sans MS",15))->setPos(360,320);
  addText("P32",QFont("Comic Sans MS",15))->setPos(590,320);

  /*Représentation des tuyaux*/
  init_tuyau();

  /*Représentation des vannes*/
  init_vanne();
}
