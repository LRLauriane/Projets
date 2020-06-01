package src;
import java.util.Random;

public class IA extends Joueur{

    /**
     * Constructeur
     * @param nom, nom de l'IA.
     */
    public IA(String nom,int coul)
    {
        super(nom,coul);
    }

    /**
     * Méthode de jeu pour l'IA.
     * @param E, l'échiquier.
     */
    public void jouer(Plateau E) {

        Random abs = new Random();
        Random ord = new Random();
        Random absa = new Random();
        Random orda = new Random();

        int alea, aleaa, ORDa = 0, ORD = 0;
        char ABSa = ' ', ABS = ' ';
        Piece p1 = null;

        /*Tant que les coordonnées d'entrée ne correspondent pas à une pièce*/
        while (p1 == null) {
            /*Don de valeurs aléatoires pour les coordonnées de départ et d'arrivée*/
            ORD = ord.nextInt(7) + 1;
            alea = abs.nextInt(7) + 1;

            if (alea == 1) ABS = 'a';
            else if (alea == 2) ABS = 'b';
            else if (alea == 3) ABS = 'c';
            else if (alea == 4) ABS = 'd';
            else if (alea == 5) ABS = 'e';
            else if (alea == 6) ABS = 'f';
            else if (alea == 7) ABS = 'g';
            else if (alea == 8) ABS = 'h';

            /*Recherche de la pièce correspondant aux coordonnées de départ*/
            for (Piece p : E.getListe()) {
                if ((p.getAbs() == ABS) && (p.getOrd() == ORD) && (p.getCoul() == getCouleur())) {
                    p1 = p;
                }
            }

            if (p1 != null) {
                /*Recherche des coordonnées d'arrivée*/
                ORDa = orda.nextInt(7) + 1;
                aleaa = absa.nextInt(7) + 1;

                if (aleaa == 1) ABSa = 'a';
                else if (aleaa == 2) ABSa = 'b';
                else if (aleaa == 3) ABSa = 'c';
                else if (aleaa == 4) ABSa = 'd';
                else if (aleaa == 5) ABSa = 'e';
                else if (aleaa == 6) ABSa = 'f';
                else if (aleaa == 7) ABSa = 'g';
                else if (aleaa == 8) ABSa = 'h';

                if(p1 instanceof Pion)
                {
                    if((((Pion) p1).est_mangeable(E,ABSa,ORDa)||(p1.est_deplacable(E,ABSa,ORDa))))
                    {
                        p1.deplacement(E, ABSa, ORDa);

                        /*Gestion de la promotion*/
                        if(((ORDa == 8)&&(p1.getCoul() == 0))||((ORDa == 1)&&(p1.getCoul()==1)))
                        {
                            ((Pion) p1).promo(E);
                        }
                    }
                    else p1=null;
                }
                else if (p1.est_deplacable(E, ABSa, ORDa)) {
                    p1.deplacement(E, ABSa, ORDa);
                } else p1 = null;
            }

        }
    }

}
