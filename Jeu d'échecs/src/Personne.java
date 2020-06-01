package src;
import java.util.Scanner;
import java.lang.Character;

public class Personne extends Joueur{

    /**
     * Constructeur
     * @param nom, nom du joueur.
     */
    public Personne(String nom,int coul)
    {
        super(nom,coul);
    }

    /**
     * Méthode demandant de saisir les coordonnées de départ et d'arrivée.
     * @param sc, l'entrée standard.
     * @return les coordonnées de départ et d'arrivée sous forme de string.
     */
    public String saisie(Scanner sc)
    {
        String lecture = sc.nextLine();

        while(lecture.length()!=4)
        {
            System.out.println("ERREUR : entrée de longueur invalide. Veuillez de nouveau entrer les coordonnées.");
            lecture = sc.nextLine();
        }

        return lecture;
    }

    /**
     * Méthode vérifiant si le caractère entré est valide.
     * @param c, le caractère à vérifier.
     * @return Vrai si le caractère est valide, faux sinon.
     */
    public boolean verif_char(char c)
    {
        if((c=='a')||(c=='b')||(c=='c')||(c=='d')
                || (c=='e')||(c=='f')||(c=='g')||(c=='h'))
            return true;

        return false;
    }

    /**
     * Méthode vérifiant si le caractère représentant un entier est valide.
     * @param c, le caractère à vérifier.
     * @return Vrai si le caractère est valide, faux sinon.
     */
    public boolean verif_int(char c)
    {
        if((c=='1')||(c=='2')||(c=='3')||(c=='4')
                || (c=='5')||(c=='6')||(c=='7')||(c=='8'))
            return true;

        return false;
    }

    /**
     * Méthode de jeu du joueur.
     * @param E, l'échiquier.
     * @param lecture, le string contenant l'entrée standard.
     * @param sc, l'entrée.
     * @return 1 si la personne a joué, 0 sinon.
     */
    public int jouer(Plateau E,String lecture,Scanner sc)
    {
        Scanner sc1;
        char ch1,ch2,ch3,ch4,abs =' ',absa = ' ';
        int ord = 0,orda = 0;
        Piece a_deplacer = null;

        /*Conversion en caractère*/
        ch1 = lecture.charAt(0);
        ch2 = lecture.charAt(1);
        ch3 = lecture.charAt(2);
        ch4 = lecture.charAt(3);

        /*Vérification des caractères*/
        while((!verif_char(ch1))||(!verif_int(ch2))||(!verif_char(ch3))
                || (!verif_int(ch4)))
        {
            System.out.println("ERREUR : entrée avec caractères invalides. Veuillez de nouveau entrer les coordonnées.");
            lecture = saisie(sc);
            ch1 = lecture.charAt(0);
            ch2 = lecture.charAt(1);
            ch3 = lecture.charAt(2);
            ch4 = lecture.charAt(3);
        }

        abs = ch1;
        ord = Character.getNumericValue(ch2);
        absa = ch3;
        orda = Character.getNumericValue(ch4);

        /*Vérification que les coordonnées d'arrivée correspondent à une pièce*/
        for(Piece p : E.getListe())
        {
            if(((p.getAbs()==abs)&&(p.getOrd()==ord))
                    &&  (p.getCoul() == getCouleur()))a_deplacer = p;
        }

        /*Déplacement si c'est le cas*/
        if(a_deplacer!=null)
        {
            if(a_deplacer instanceof Pion) {
                if(a_deplacer.est_deplacable(E,absa,orda)||((Pion) a_deplacer).est_mangeable(E,absa,orda)) {
                    a_deplacer.deplacement(E, absa, orda);

                    /*Gestion de la promotion*/
                    if(((orda == 8)&&(a_deplacer.getCoul() == 0))||((orda == 1)&&(a_deplacer.getCoul()==1)))
                    {
                        sc1 = new Scanner(System.in);
                        ((Pion) a_deplacer).promotion(E,sc1);
                    }
                    return 1;
                }
            }
            else
            {
                a_deplacer.deplacement(E, absa, orda);
                return 1;
            }
        }

        return 0;
    }
}
