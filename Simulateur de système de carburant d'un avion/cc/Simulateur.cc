#include "../hh/systeme.hh"
#include "../hh/dessiner_systeme.hh"
#include "../hh/tableauDeBord.hh"
#include "../hh/exercice1.hh"
#include "../hh/exercice2.hh"
#include "../hh/exercice3.hh"
#include "../hh/exercice4.hh"
#include "../hh/exercice5.hh"
#include "../hh/sList.hh"
#include "../hh/historique.hh"
#include "../hh/BD.hh"
#include "../hh/authentification.hh"
#include "../hh/entrainement.hh"
#include "../hh/resolutions.hh"
#include <qt4/QtGui/QApplication>
#include <qt4/QtGui/QGraphicsView>
#include <fstream>
#include <qt4/QtCore/QProcess>

int main(int argc, char* argv[]) {

try
  {
    QApplication app(argc,argv);

    /*Création de la base de données*/
    BD _base;

    /*Ouverture du fichier en lecture*/
    ifstream flux("data.txt");
    if(!flux){
     cout << "Erreur lors de l'ouverture du fichier" <<endl;
     exit(1);
    }

    /*Chargement de la base de données*/
    _base.charger(flux);
    cout << _base <<endl;
    flux.close();

    /*Authentification*/
    cout << "========== "<<"Authentification" << " ==========" <<endl;
    cout << "Veuillez entrez votre numéro : " << endl;
    string num;
    cin >> num;

    cout << "Veuillez entrez votre mot de passe : " << endl;
    string mdp;
    cin >> mdp;

    authentification * connexion = new authentification(stoi(num),mdp,_base);

    /*Vérifications des informations données*/
    while(!(connexion->verif_infos()))
    {
      delete connexion;
      cout << "Authentification échouée" << endl;
      cout << endl;
      cout << "========== "<<"Authentification" << " ==========" <<endl;
      cout << "Veuillez entrez votre numéro : " << endl;
      cin >> num;
      cout << "Veuillez entrez votre mot de passe : " << endl;
      cin >> mdp;
      connexion = new authentification(stoi(num),mdp,_base);
    }


    cout << "Authentification réussie !" << endl;
    cout << endl;

    /*MENU*/
    cout << "CHOISISSEZ UN MODE : "<<endl;
    cout << "1-Entraînement"<<endl;
    cout << "2-Exercices" << endl;
    cout <<"Entrez 1 ou 2 ou Quitter: " << endl;

    string choix;
    cin >> choix;

    while((choix != "1")&&(choix != "2")&&(choix != "Quitter"))
    {
      cout << "CHOISISSEZ UN MODE : "<<endl;
      cout << "1-Entraînement"<<endl;
      cout << "2-Exercices" << endl;
      cout <<"Entrez 1 ou 2 ou Quitter:" << endl;
      cin >> choix;
    }

    while(choix != "Quitter")
    {
      /*Entrée des pannes - Partie 1*/
      if(choix == "1")
      {
        /*Représentation*/
        dessiner_systeme scene;
        /*Système*/
        systeme sys;
        /*Entraînement*/
        entrainement practice(sys,scene);
        /*Tableau de bord*/
        tableauDeBord tab(sys,scene);
        /*Lieu d'affichage de la représentation*/
        QGraphicsView vue(&scene);

        string choice = "";

        while (choice!="FIN")
        {
            cout << endl;
            cout << "UTILISATEUR: Entrer une panne parmi " ;

            /*Choix de la panne*/
            practice.afficher_choix();
            cin >> choice;

            /*Lancement de l'entraînement*/
            if(choice != "FIN")
            {
              practice.lancer_entrainement(choice);

              if((choice == "p11")||(choice == "p12")||(choice == "p21")||(choice == "p22")
              ||(choice == "p31")||(choice == "p31")||(choice == "tank1")||(choice == "tank2")||(choice == "tank3"))
              {
                cout << practice.getSys() << endl;

                /*Affichage du tableau de bord*/
                tab.show();
                /*Affichage du système*/
                vue.show();
                /*Lancement de l'interface graphique*/
                app.exec();
              }
            }
        }

      } else if(choix == "2")
      {
        if(_base.find_note(stoi(num)) != 100)
        {
          cout << "Vous avez déjà été évalué." << endl;
          cout << "\n";
        }
        else
        {
          resolutions resolution;
          historique * _historique;

          /*Création des exercices*/
          exercice1 exo1(resolution.getSol_Exo1());
          exercice2 exo2(resolution.getSol_Exo2());
          exercice3 exo3(resolution.getSol_Exo3());
          exercice4 exo4(resolution.getSol_Exo4());
          exercice5 exo5(resolution.getSol_Exo5());


          /*Exercice 1*/
          cout << "==========Lancement de l'exercice 1==========" << endl;

          /*Mise en place des pannes*/
          exo1.lancer_exo();

          /*Affichage du tableau de bord et du système en fonction des pannes*/
          tableauDeBord tab1(exo1.getSys(),exo1.getDrawSys());
          QGraphicsView vue1(&exo1.getDrawSys());
          vue1.show();
          tab1.show();
          app.exec();

          /*Exercice 2*/
          cout << "==========Lancement de l'exercice 2==========" << endl;
          exo2.lancer_exo();
          tableauDeBord tab2(exo2.getSys(),exo2.getDrawSys());
          QGraphicsView vue2(&exo2.getDrawSys());
          vue2.show();
          tab2.show();
          app.exec();

          /*Exercice 3*/
          cout << "==========Lancement de l'exercice 3==========" << endl;
          exo3.lancer_exo();
          tableauDeBord tab3(exo3.getSys(),exo3.getDrawSys());
          QGraphicsView vue3(&exo3.getDrawSys());
          vue3.show();
          tab3.show();
          app.exec();

          /*Exercice 4*/
          cout << "==========Lancement de l'exercice 4==========" << endl;
          exo4.lancer_exo();
          tableauDeBord tab4(exo4.getSys(),exo4.getDrawSys());
          QGraphicsView vue4(&exo4.getDrawSys());
          vue4.show();
          tab4.show();
          app.exec();

          /*Exercice 5*/
          cout << "==========Lancement de l'exercice 5==========" << endl;
          exo5.lancer_exo();
          tableauDeBord tab5(exo5.getSys(),exo5.getDrawSys());
          QGraphicsView vue5(&exo5.getDrawSys());
          vue5.show();
          tab5.show();
          app.exec();

          /*Création de l'historique*/
          _historique = new historique(tab1.getSauv(),tab2.getSauv(),tab3.getSauv(),tab4.getSauv(),tab5.getSauv());
          /*Calcul de la note finale*/
          _historique->calcul_note_finale(resolution.getSol_Exo1(),resolution.getSol_Exo2(),resolution.getSol_Exo3(),resolution.getSol_Exo4(),resolution.getSol_Exo5());

          /*Affichage du score*/
          cout << "\n";
          cout << "=========="<<" VOTRE SCORE " << "=========="<<endl;
          cout << _historique->getNote()<<endl;
          cout << "\n";

          /*Mise à jour de la note dans la base de données*/
          _base.setNote(stoi(num),_historique->getNote());
          cout << _base << endl;

          /*Ouverture du fichier en écriture*/
          ofstream fichier("data.txt");
          if(!fichier)
          {
            cout << "Erreur dans l'ouverture du fichier" << endl;
            exit(1);
          }

          /*Remplissage du fichier*/
          _base.remplir_fichier(fichier);

          fichier.close();
          delete _historique;
        }
      }

      /*MENU*/
      cout << "CHOISISSEZ UN MODE : "<<endl;
      cout << "1-Entraînement"<<endl;
      cout << "2-Exercices" << endl;
      cout <<"Entrez 1 ou 2 ou Quitter : " << endl;

      cin >> choix;

      while((choix != "1")&&(choix != "2")&&(choix != "Quitter"))
      {
        cout << "CHOISISSEZ UN MODE : "<<endl;
        cout << "1-Entraînement"<<endl;
        cout << "2-Exercices" << endl;
        cout <<"Entrez 1 ou 2 ou Quitter:" << endl;
        cin >> choix;
      }
    }

    delete connexion;

  }
  catch(invalid_argument const& ia)
  {
    cerr << ia.what() << endl;
  }



  return 0;
}
