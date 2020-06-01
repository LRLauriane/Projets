package src;
import java.util.Scanner;
import java.util.Random;

public class Pion extends Piece{

    /**
     * Constructeur
     * @param C, la couleur de la pièce (0 si blanc, 1 si noir).
     * @param x, l'abscisse de départ.
     * @param y, l'ordonnée de départ.
     */
    public Pion(int C,char x,int y)
    {
        super(C,x,y);
    }

    @Override
    /**
     * Méthode de vérification du déplacement de la pièce
     * @param E, l'échiquier.
     * @param xa, l'abscisse de la case d'arrivée.
     * @param ya, l'ordonnée de la case d'arrivée.
     * @return Vrai si le déplacement est valide, faux sinon.
     */
    public boolean est_deplacable(Plateau E,char xa,int ya)
    {
        char xdep = getAbs();
        int ydep = getOrd();

        /*Vérification qu'aucune pièce ne se trouve sur la case d'arrivée*/

        /*Si la pièce est blanche*/
        if(getCoul()==0)
        {
            if(((xa==xdep)&&(ya==ydep+1))||((xa==xdep)&&(ya==4)))
            {
                for(Piece p : E.getListe())
                {
                    if((p.getAbs()==xa)&&(p.getOrd()==ya)) return false;
                }

                return true;
            }
        }
        /*Si la pièce est noir*/
        else if(getCoul()==1)
        {
            if(((xa==xdep)&&(ya==ydep-1))||((xa==xdep)&&(ya==7)))
            {
                for(Piece p : E.getListe())
                {
                    if((p.getAbs()==xa)&&(p.getOrd()==ya)) return false;
                }

                return true;
            }

        }

        return false;
    }

    /**
     * Méthode vérifiant la possibilité de manger.
     * @param E, l'échiquier.
     * @param xa, l'abscisse de la case d'arrivée.
     * @param ya, l'ordonnée de la case d'arrivée.
     * @return Vrai si il y a une pièce sur la case d'arrivée, faux sinon.
     */
    public boolean est_mangeable(Plateau E,char xa,int ya)
    {
        char xdep = getAbs();
        int ydep = getOrd();

        /*Recherche dans la liste de la pièce correspondant aux coordonées d'arrivée*/
        for(Piece p : E.getListe())
        {
            /*Vérification que la pièce n'est pas de la même couleur que celle qui veut manger*/
            if((getCoul() == 0)&&(p.getCoul() == 1))
            {
                /*Vérification de manger en diagonale en 1*/
                if(  (((xa == xdep+1)&&(ya ==ydep+1))
                        || ((xa == xdep-1)&&(ya ==ydep+1)))
                        &&   ((p.getAbs()==xa)&&(p.getOrd()==ya)))
                    return true;
            }
            else if((getCoul() == 1)&&(p.getCoul() == 0))
            {
                if( (((xa == xdep+1)&&(ya ==ydep-1))
                        || ((xa == xdep-1)&&(ya ==ydep-1)))
                        &&  ((p.getAbs()==xa)&&(p.getOrd()==ya)))
                    return true;
            }
        }

        return false;
    }


    /**
     * Méthode de déplacement du Pion
     * @param E, l'échiquier.
     * @param xa, l'abscisse de la case d'arrivée.
     * @param ya, l'ordonnée de la case d'arrivée.
     */
    @Override
    public void deplacement(Plateau E,char xa,int ya)
    {
        Piece elem_manger = null;
        Piece elem_deplac = null;

        /*Vérification si les coordonnées d'arrivée correspondent à la capture*/
        if(est_mangeable(E,xa,ya))
        {
            modif_pos(xa,ya);

            /*Recherche de la présence d'une pièce*/
            for (Piece p : E.getListe()) {
                if ((p.getAbs() == xa)
                   && (p.getOrd() == ya)
                   && (p.getCoul() != getCoul()))
                    elem_manger = p;
            }

            E.getUndo().add_mov(elem_manger);
            E.sup_elem(elem_manger); /*Supression dans la liste*/

            /*Mise à jour de l'affichage*/
            if(elem_manger instanceof Pion)
                System.out.println("Pion en "+elem_manger.getAbs()+elem_manger.getOrd()+" mangée");
            if(elem_manger instanceof Tour)
                System.out.println("Tour en "+elem_manger.getAbs()+elem_manger.getOrd()+" mangée");
            if(elem_manger instanceof Cavalier)
                System.out.println("Cavalier en "+elem_manger.getAbs()+elem_manger.getOrd()+" mangée");
            if(elem_manger instanceof Fou)
                System.out.println("Fou en "+elem_manger.getAbs()+elem_manger.getOrd()+" mangée");
            if(elem_manger instanceof Roi)
                System.out.println("Roi en "+elem_manger.getAbs()+elem_manger.getOrd()+" mangée");
            if(elem_manger instanceof Reine)
                System.out.println("Reine en "+elem_manger.getAbs()+elem_manger.getOrd()+" mangée");
        }
        else System.out.println("Aucune pièce n'a été capturée");

        /*Vérification que la pièce peut se déplacer sur la case d'arrivée*/
        if(est_deplacable(E,xa,ya))
        {
            E.getUndo().add_mov(this);
            modif_pos(xa,ya);

            /*Recherche de la pièce déplacée pour mettre à jour l'affichage*/
            for (Piece p : E.getListe())
            {
                if ((p.getAbs() == xa)
                        && (p.getOrd() == ya)
                        && (p.getCoul() == getCoul()))
                    elem_deplac = p;
            }

            if(elem_deplac instanceof Pion)
                System.out.println("Pion en "+elem_deplac.getAbs()+elem_deplac.getOrd());
            if(elem_deplac instanceof Tour)
                System.out.println("Tour en "+elem_deplac.getAbs()+elem_deplac.getOrd());
            if(elem_deplac instanceof Cavalier)
                System.out.println("Cavalier en "+elem_deplac.getAbs()+elem_deplac.getOrd());
            if(elem_deplac instanceof Fou)
                System.out.println("Fou en "+elem_deplac.getAbs()+elem_deplac.getOrd());
            if(elem_deplac instanceof Roi)
                System.out.println("Roi en "+elem_deplac.getAbs()+elem_deplac.getOrd());
            if(elem_deplac instanceof Reine)
                System.out.println("Reine en "+elem_deplac.getAbs()+elem_deplac.getOrd());
        }
        else System.out.println("Le déplacement est impossible");

    }


    /**
     * Méthode de demande de changement de pièce.
     * @param sc, l'entrée standard.
     * @return le string représentant l'entrée standard.
     */
    public String demande(Scanner sc)
    {
        String lecture = "";

        System.out.println("Par quel pièce voulez-vous remplacer votre pion ?");
        System.out.println("Choix : Reine, Tour, Fou ou Cavalier");

        lecture = sc.nextLine();

        return lecture;
    }

    /**
     * Méthode de changement de la pièce par une autre.
     * @param E, l'échiquier.
     * @param chaine, le string représentant l'entrée standard.
     * @param coul, la couleur de la pièce.
     */
    public void changement(Plateau E, String chaine, int coul)
    {
        Piece p1 = null;

        for(Piece p : E.getListe())
        {
            /*Recherche de la picèe à promouvoir*/
            if((p.getAbs()==getAbs())&&((p.getOrd()==getOrd())))
                p1 = p;
        }

        /*Si la chaine contient "Reine"*/
        if(chaine.equals("Reine"))
        {
            E.add_elem(new Reine(coul,getAbs(),getOrd()));
            E.sup_elem(p1);
        }
        else if(chaine.equals("Fou")) /*Si la chaine contient "Fou"*/
        {

            E.add_elem(new Fou(coul,getAbs(),getOrd()));
            E.sup_elem(p1);
        }
        else if(chaine.equals("Cavalier")) /*Si chaine contient "Cavalier"*/
        {

            E.add_elem(new Cavalier(coul,getAbs(),getOrd()));
            E.sup_elem(p1);
        }
	else if(chaine.equals("Tour")) /*Si chaine contient "Tour"*/
        {

            E.add_elem(new Tour(coul,getAbs(),getOrd()));
            E.sup_elem(p1);
        }
    }

    /**
     * Methode de gestion de la promotion.
     * @param E, l'échiquier.
     */
    public void promotion(Plateau E,Scanner sc)
    {
        if(((getCoul()==0)&&(getOrd()==8)) || ((getCoul()==1)&&(getOrd()==1)))
        {
            String lecture = demande(sc);
            changement(E,lecture,getCoul());
        }
    }

    /**Méthode de gestion de la promotion pour l'IA
     * @param E, l'échiquier.
     */
    public void promo(Plateau E)
    {
        Random alea = new Random();
        int choix = alea.nextInt(3);
        Piece p1 = null;

        for(Piece p : E.getListe())
        {
            /*Trouver la pièce à promouvoir*/
            if((p.getAbs()==getAbs())&&((p.getOrd()==getOrd())))
                p1 = p;
        }

        if(choix == 0)
        {
            E.add_elem(new Fou(p1.getCoul(),p1.getAbs(),p1.getOrd()));
            E.sup_elem(p1);
        }
        else if(choix == 1)
        {
            E.add_elem(new Cavalier(p1.getCoul(),p1.getAbs(),p1.getOrd()));
            E.sup_elem(p1);
        }
        else if(choix == 2)
        {
            E.add_elem(new Reine(p1.getCoul(),p1.getAbs(),p1.getOrd()));
            E.sup_elem(p1);
        }
	else if(choix == 3)
        {

            E.add_elem(new Tour(p1.getCoul(),getAbs(),getOrd()));
            E.sup_elem(p1);
        }
    }
}
