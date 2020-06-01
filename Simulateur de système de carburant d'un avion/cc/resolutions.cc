#include "../hh/resolutions.hh"

resolutions::resolutions():exo1(),exo2(),exo3(),exo4(),exo5()
{
  solution s1_1,s1_2,s1_3,
  s2,
  s3_1,s3_2,s3_3,s3_4,s3_5,s3_6,
  s4_1,s4_2,
  s5_1,s5_2,s5_3,s5_4,s5_5,s5_6,s5_7,s5_8,s5_9,s5_10,s5_11,s5_12,s5_13,s5_14,s5_15,s5_16,s5_17,s5_18,s5_19,s5_20;

  /*Solutions de l'exercice 1*/
  s1_1.add("p12",1);
  s1_1.add("p32",1);
  s1_1.add("v23",0);

  s1_2.add("p32",1);
  s1_2.add("v23",0);
  s1_2.add("p12",1);

  s1_3.add("p32",1);
  s1_3.add("p12",1);
  s1_3.add("v23",0);

  /*Solution de l'exercice 2*/
  s2.add("p12",1);
  s2.add("v12",0);

  /*Solutions de l'exercice 3*/
  s3_1.add("p22",1);
  s3_1.add("vt12",0);
  s3_1.add("vt23",0);

  s3_2.add("vt12",0);
  s3_2.add("p22",1);
  s3_2.add("vt23",0);

  s3_3.add("vt12",0);
  s3_3.add("vt23",0);
  s3_3.add("p22",1);

  s3_4.add("vt23",0);
  s3_4.add("vt12",0);
  s3_4.add("p22",1);

  s3_5.add("p22",1);
  s3_5.add("vt12",0);
  s3_5.add("vt23",0);

  s3_6.add("vt23",0);
  s3_6.add("p22",1);
  s3_6.add("vt12",0);

  /*Solutions de l'exercice 4*/
  s4_1.add("p32",1);
  s4_1.add("v13",0);

  s4_2.add("p22",1);
  s4_2.add("v12",0);

  /*Solutions de l'exercice 5*/
  s5_1.add("p12",1);
  s5_1.add("v12",0);
  s5_1.add("vt12",0);
  s5_1.add("vt23",0);

  s5_2.add("p12",1);
  s5_2.add("v12",0);
  s5_2.add("vt23",0);
  s5_2.add("vt12",0);

  s5_3.add("vt12",0);
  s5_3.add("vt23",0);
  s5_3.add("p12",1);
  s5_3.add("v12",0);

  s5_4.add("vt23",0);
  s5_4.add("vt12",0);
  s5_4.add("p12",1);
  s5_4.add("v12",0);

  s5_5.add("vt12",0);
  s5_5.add("p12",1);
  s5_5.add("v12",0);
  s5_5.add("vt23",0);

  s5_6.add("vt23",0);
  s5_6.add("p12",1);
  s5_6.add("v12",0);
  s5_6.add("vt12",0);

  s5_7.add("p12",1);
  s5_7.add("vt12",0);
  s5_7.add("vt23",0);
  s5_7.add("v12",0);

  s5_8.add("p12",1);
  s5_8.add("vt12",0);
  s5_8.add("v12",0);
  s5_8.add("vt23",0);

  s5_9.add("p12",1);
  s5_9.add("vt23",0);
  s5_9.add("vt12",0);
  s5_9.add("v12",0);

  s5_10.add("p12",1);
  s5_10.add("vt23",0);
  s5_10.add("v12",0);
  s5_10.add("vt12",0);

  s5_11.add("p32",1);
  s5_11.add("v23",0);
  s5_11.add("vt12",0);
  s5_11.add("vt23",0);

  s5_12.add("p32",1);
  s5_12.add("v23",0);
  s5_12.add("vt23",0);
  s5_12.add("vt12",0);

  s5_13.add("vt12",0);
  s5_13.add("vt23",0);
  s5_13.add("p32",1);
  s5_13.add("v23",0);

  s5_14.add("vt23",0);
  s5_14.add("vt12",0);
  s5_14.add("p32",1);
  s5_14.add("v23",0);

  s5_15.add("vt12",0);
  s5_15.add("p32",1);
  s5_15.add("v23",0);
  s5_15.add("vt23",0);

  s5_16.add("vt23",0);
  s5_16.add("p32",1);
  s5_16.add("v23",0);
  s5_16.add("vt12",0);

  s5_17.add("p32",1);
  s5_17.add("vt12",0);
  s5_17.add("vt23",0);
  s5_17.add("v23",0);

  s5_18.add("p32",1);
  s5_18.add("vt12",0);
  s5_18.add("v23",0);
  s5_18.add("vt23",0);

  s5_19.add("p32",1);
  s5_19.add("vt23",0);
  s5_19.add("vt12",0);
  s5_19.add("v23",0);

  s5_20.add("p32",1);
  s5_20.add("vt23",0);
  s5_20.add("v23",0);
  s5_20.add("vt12",0);

  /*Ajout des solutions dans la liste de solutions correspondantes*/
  exo1.add(s1_1);
  exo1.add(s1_2);
  exo1.add(s1_3);

  exo2.add(s2);

  exo3.add(s3_1);
  exo3.add(s3_2);
  exo3.add(s3_3);
  exo3.add(s3_4);
  exo3.add(s3_5);
  exo3.add(s3_6);

  exo4.add(s4_1);
  exo4.add(s4_2);

  exo5.add(s5_1);
  exo5.add(s5_2);
  exo5.add(s5_3);
  exo5.add(s5_4);
  exo5.add(s5_5);
  exo5.add(s5_6);
  exo5.add(s5_7);
  exo5.add(s5_8);
  exo5.add(s5_9);
  exo5.add(s5_10);
  exo5.add(s5_11);
  exo5.add(s5_12);
  exo5.add(s5_13);
  exo5.add(s5_14);
  exo5.add(s5_15);
  exo5.add(s5_16);
  exo5.add(s5_17);
  exo5.add(s5_18);
  exo5.add(s5_19);
  exo5.add(s5_20);
}

resolutions::~resolutions(){}

sList& resolutions::getSol_Exo1(){return exo1;}
sList& resolutions::getSol_Exo2(){return exo2;}
sList& resolutions::getSol_Exo3(){return exo3;}
sList& resolutions::getSol_Exo4(){return exo4;}
sList& resolutions::getSol_Exo5(){return exo5;}
