package src;
public abstract class Piece {

    private char abscisse;
    private int ordonne;
    private int couleur;

    /**
     * Constructeur
     * @param coul, la couleur de la pièce (0 pour blanc, 1 pour noir).
     * @param x, l'abscisse de départ de la pièce.
     * @param y, l'ordonnée de départ de la pièce.
     */
    public Piece(int coul,char x,int y)
    {
        couleur = coul;
        abscisse = x;
        ordonne = y;
    }

    /**
     * Méthode de vérification du déplacement d'un pièce.
     * @param E, l'échiquier.
     * @param xa, l'abscisse de la case d'arrivée.
     * @param ya, l'ordonnée de la case d'arrivée.
     * @return Vrai si le déplacement est possible, faux sinon.
     */
    public abstract boolean est_deplacable(Plateau E,char xa,int ya);

    /**
     * Méthode de récupération de l'abscisse de la pièce.
     * @return l'abscisse de la pièce.
     */
    public char getAbs()
    {
        return abscisse;
    }

    /**
     * Méthode de récupération de l'ordonnée de la pièce.
     * @return l'ordonnée de la pièce.
     */
    public int getOrd()
    {
        return ordonne;
    }

    /**
     * Méthode de modification de la position de la pièce.
     * @param xa, l'abscisse de la case d'arrivée.
     * @param ya, l'ordonnée de la case d'arrivée.
     */
    public void modif_pos(char xa,int ya)
    {
        abscisse = xa;
        ordonne = ya;
    }

    /**
     * Méthode de récupération de la couleur de la pièce.
     * @return l'entier représentant la couleur (0 pour blanc, 1 pour noir).
     */
    public int getCoul()
    {
        return couleur;
    }

    /**
     * Méthode de déplacement de la pièce.
     * @param E, l'échiquier.
     * @param xa, l'abscisse de la case d'arrivée.
     * @param ya, l'ordonnée de la case d'arrivée.
     */
    public void deplacement(Plateau E,char xa,int ya)
    {
		/*Initialisation de références qui sauvegarderont la pièce à manger et celle à
		 déplacer */
        Piece elem_manger = null;
        Piece elem_deplac = null;
        /*Test du déplacement de la pièce*/
        if(est_deplacable(E,xa,ya))
        {
            E.getUndo().add_mov(this);
            /*Vérification de la présence d'une pièce sur la case d'arrivée*/
            for (Piece p : E.getListe())
            {
                if ((p.getAbs() == xa) && (p.getOrd() == ya)
                        && (p.getCoul() != getCoul()))
                    elem_manger = p;
            }

            /*Vérification que la pièce a bien été trouvée*/
            if(elem_manger!=null)
            {
                E.getUndo().add_mov(elem_manger);
                E.sup_elem(elem_manger); /*Supression de la pièce dans la liste*/

                /*Vérification permettant de mettre à jour l'affichage.*/
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
            else System.out.println("Aucune pièce n'a été capturé");

            /*Modification de la position de la pièce dont le déplacement est valide*/
            modif_pos(xa,ya);

            /*Recherche de la pièce dans la liste pour mettre à jour l'affichage*/
            for (Piece p : E.getListe())
            {
                if ((p.getAbs() == xa) && (p.getOrd() == ya)
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
        else System.out.println("Le déplacement est impossible\n");
    }
}
