package src;

public class Fou extends Piece {

    /**
     * Constructeur
     *
     * @param C, la couleur de la pièce (0 pour blanc, 1 pour noir).
     * @param x, l'abscisse de départ.
     * @param y, l'ordonnée de départ.
     */
    public Fou(int C, char x, int y) {
        super(C, x, y);
    }

    @Override
    /**
     * Méthode de vérification du déplacement pour un Fou.
     * @param E, l'échequier.
     * @param xa, l'abscisse d'arrivée.
     * @param ya, l'ordonnée d'arrivée.
     * @return Vrai si le Fou est déplaçable, faux sinon.
     */

    public boolean est_deplacable(Plateau E, char xa, int ya) {

        char xdep = getAbs();
        int ydep = getOrd();
        int coul = getCoul();

        int x = Math.abs(xa - xdep);
        int y = Math.abs(ya - ydep);

        if((x!=y)||((x==0)&&(y==0)))									// le fou reste sur place ou qu'il ne se déplace pas en diagonale
        {
            return false;

        }

        for(Piece p : E.getListe())
        {

            if((p.getAbs()!=xdep) || (p.getOrd()!=ydep)) 				//pour ne pas tester la pièce elle-même
            {
                if(coul!=p.getCoul())
                {
                    if (xa > xdep) 										//déplacement à droite du fou
                    {
                        if(p.getAbs()<xa && p.getAbs()>xdep) 			//s'il y a une pièce entre deux
                        {
                            if(Math.abs(xa-p.getAbs())==Math.abs(ya-p.getOrd()))
                                return false;
                        }

                    }
                    else 												// déplacement à gauche du fou
                    {
                        if(p.getAbs()>xa && p.getAbs()<xdep) 			//s'il y a une pièce entre deux
                        {
                            if(Math.abs(xa-p.getAbs())==Math.abs(ya-p.getOrd()))
                                return false;
                        }
                    }
                }
                if(coul==p.getCoul())
                {
                    if (xa > xdep) 										//déplacement à droite du fou
                    {
                        if(p.getAbs()<=xa && p.getAbs()>xdep) 			//s'il y a une pièce entre deux
                        {
                            if(Math.abs(xa-p.getAbs())==Math.abs(ya-p.getOrd()))
                                return false;
                        }

                    }
                    else 												// déplacement à gauche du fou
                    {
                        if(p.getAbs()>=xa && p.getAbs()<xdep) 			//s'il y a une pièce entre deux
                        {
                            if(Math.abs(xa-p.getAbs())==Math.abs(ya-p.getOrd()))
                                return false;
                        }
                    }
                }
            }
        }



        return true;

    }


}
