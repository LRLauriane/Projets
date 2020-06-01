package src;

public class Tour extends Piece{

    /**Constructeur de la classe Tour
     *
     * @param C, la couleur de la pièce.
     * @param x, l'abscisse de la pièce.
     * @param y, l'ordonnée de la pièce.
     */
    public Tour(int C,char x,int y)
    {
        super(C,x,y);
    }

    @Override
    /**Méthode de vérification de la possibilité de déplacement
     * @param E, l'echiquier.
     * @param xa, l'abscisse d'arrivée.
     * @param ya, l'ordonnée d'arrivée.
     */
    public boolean est_deplacable(Plateau E,char xa,int ya)
    {
        char xdep = getAbs();
        int ydep = getOrd();
        int coul = getCoul();


        if(((xa!=xdep)&&(ya!=ydep))
                ||((xa==xdep)&&(ya==ydep)))
            return false; 												/* tester que le déplacement est soit horizontal, soit vertical*/


        for(Piece p :E.getListe()) 										// tester s'il y a déjà une pièce devant
        {
            if((p.getOrd()!=ydep)||(p.getAbs()!=xdep))
            {
                if(p.getCoul()==coul) 									// si la pièce appartient au même joueur que la tour
                {
                    if(ydep==ya) 										// déplacement horizontal
                    {
                        if(p.getOrd()==ya) { 							// si une pièce est sur la même ligne
                            if (xa > xdep) 								// déplacement vers la droite
                            {
                                if (xa >= p.getAbs()) 					// tester l'abscisse de la pièce située sur la même ligne
                                    return false;
                            }
                            if (xa < xdep) 								// déplacement vers la gauche
                            {
                                if(xa<= p.getAbs())
                                    return false;
                            }
                        }
                    }
                    if(xdep==xa) 										// déplacement vertical
                    {
                        if(p.getAbs()==xa) { 							// si une pièce est sur la même colonne
                            if (ya > ydep) 								// déplacement vers le haut
                            {
                                if (ya >= p.getOrd()) 					// tester l'ordonnée de la pièce située sur la même ligne
                                    return false;
                            }
                            if (ya < ydep) 								// déplacement vers le bas
                            {
                                if(ya <= p.getOrd())
                                    return false;
                            }
                        }
                    }
                }
                else 													// si la pièce n'appartient pas au même joueur que la tour
                {
                    if(ydep==ya) 										// déplacement horizontal
                    {
                        if(p.getOrd()==ya) { 							// si une pièce est sur la même ligne
                            if (xa > xdep) 								// déplacement vers la droite
                            {
                                if (xa > p.getAbs()) 					// tester l'abscisse de la pièce située sur la même ligne
                                    return false;
                            }
                            if (xa < xdep) 								// déplacement vers la gauche
                            {
                                if(xa< p.getAbs())
                                    return false;
                            }
                        }
                    }
                    if(xdep==xa) 										// déplacement vertical
                    {
                        if(p.getAbs()==xa) { 							// si une pièce est sur la même colonne
                            if (ya > ydep) 								// déplacement vers le haut
                            {
                                if (ya > p.getOrd()) 					// tester l'ordonnée de la pièce située sur la même ligne
                                    return false;
                            }
                            if (ya < ydep) 								// déplacement vers le bas
                            {
                                if(ya < p.getOrd())
                                    return false;
                            }
                        }
                    }
                }
            }

        }

        return true;
    }
}
