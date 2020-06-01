package src;

public class Reine extends Piece{

    /**Constructeur de la classe Reine
     *
     * @param C, la couleur de la pièce.
     * @param x, l'abscisse de départ.
     * @param y, l'ordonnée de départ.
     */
    public Reine(int C,char x,int y)
    {
        super(C,x,y);
    }

    //méthode du fou
    public boolean est_deplacable1(Plateau E, char xa, int ya) {

        char xdep = getAbs();
        int ydep = getOrd();
        int coul = getCoul();

        int x = Math.abs(xa - xdep);
        int y = Math.abs(ya - ydep);
        if ((x != y) || ((x == 0) && (y == 0)))// le fou reste sur place ou qu'il ne se déplace pas en diagonale
        {
            return false;

        }
        for (Piece p : E.getListe()) {

            if ((p.getAbs() != xdep) || (p.getOrd() != ydep)) //pour ne pas tester la pièce elle-même
            {
                if (coul != p.getCoul()) {
                    if (xa > xdep) //déplacement à droite du fou
                    {
                        if (p.getAbs() < xa && p.getAbs() > xdep) //s'il y a une pièce entre deux
                        {
                            if (Math.abs(xa - p.getAbs()) == Math.abs(ya - p.getOrd()))
                                return false;
                        }

                    } else // déplacement à gauche du fou
                    {
                        if (p.getAbs() > xa && p.getAbs() < xdep) //s'il y a une pièce entre deux
                        {
                            if (Math.abs(xa - p.getAbs()) == Math.abs(ya - p.getOrd()))
                                return false;
                        }
                    }
                }
                if (coul == p.getCoul()) {
                    if (xa > xdep) //déplacement à droite du fou
                    {
                        if (p.getAbs() <= xa && p.getAbs() > xdep) //s'il y a une pièce entre deux
                        {
                            if (Math.abs(xa - p.getAbs()) == Math.abs(ya - p.getOrd()))
                                return false;
                        }

                    } else // déplacement à gauche du fou
                    {
                        if (p.getAbs() >= xa && p.getAbs() < xdep) //s'il y a une pièce entre deux
                        {
                            if (Math.abs(xa - p.getAbs()) == Math.abs(ya - p.getOrd()))
                                return false;
                        }
                    }
                }
            }
        }


        return true;

    }

    //méthode de la tour
    public boolean est_deplacable2(Plateau E,char xa,int ya)
    {
        char xdep = getAbs();
        int ydep = getOrd();
        int coul = getCoul();

        if(((xa==xdep)&&(ya==ydep))
                ||((xa!=xdep)&&(ya!=ydep)))
            return false; // tester que le déplacement est soit horizontal, soit vertical
        for(Piece p :E.getListe()) // tester s'il y a déjà une pièce devant
        {
            if((p.getOrd()!= ydep)||(p.getAbs()!=xdep)) {
                if (p.getCoul() == coul) // si la pièce appartient au même joueur que la tour
                {
                    if (ydep == ya) // déplacement horizontal
                    {
                        if (p.getOrd() == ya) { // si une pièce est sur la même ligne
                            if (xa > xdep) // déplacement vers la droite
                            {
                                if (xa >= p.getAbs()) // tester l'abscisse de la pièce située sur la même ligne
                                    return false;
                            }
                            if (xa < xdep) // déplacement vers la gauche
                            {
                                if (xa <= p.getAbs())
                                    return false;
                            }
                        }
                    }
                    if (xdep == xa) // déplacement vertical
                    {
                        if (p.getAbs() == xa) { // si une pièce est sur la même colonne
                            if (ya > ydep) // déplacement vers le haut
                            {
                                if (ya >= p.getOrd()) // tester l'ordonnée de la pièce située sur la même ligne
                                    return false;
                            }
                            if (ya < ydep) // déplacement vers le bas
                            {
                                if (ya <= p.getOrd())
                                    return false;
                            }
                        }
                    }
                } else // si la pièce n'appartient pas au même joueur que la tour
                {
                    if (ydep == ya) // déplacement horizontal
                    {
                        if (p.getOrd() == ya) { // si une pièce est sur la même ligne
                            if (xa > xdep) // déplacement vers la droite
                            {
                                if (xa > p.getAbs()) // tester l'abscisse de la pièce située sur la même ligne
                                    return false;
                            }
                            if (xa < xdep) // déplacement vers la gauche
                            {
                                if (xa < p.getAbs())
                                    return false;
                            }
                        }
                    }
                    if (xdep == xa) // déplacement vertical
                    {
                        if (p.getAbs() == xa) { // si une pièce est sur la même colonne
                            if (ya > ydep) // déplacement vers le haut
                            {
                                if (ya > p.getOrd()) // tester l'ordonnée de la pièce située sur la même ligne
                                    return false;
                            }
                            if (ya < ydep) // déplacement vers le bas
                            {
                                if (ya < p.getOrd())
                                    return false;
                            }
                        }
                    }
                }
            }

        }
        return true;
    }

    /**Méthode de vérification de déplacement d'une Reine
     *
     * @param E, l'échiquier.
     * @param xa, l'abscisse d'arrivée.
     * @param ya, l'ordonnée d'arrivée.
     * @return True si le déplacement est possible, false sinon.
     */
    @Override
    public boolean est_deplacable(Plateau E, char xa, int ya)
    {
        if(est_deplacable1(E,xa,ya) || est_deplacable2(E,xa,ya))/*tester que le déplacement est possible à la façon du fou ou de la tour*/
            return true;
        else
            return false;
    }



}
