package src;

public class Cavalier extends Piece{

    /**
     * Constructeur
     * @param C, la couleur de la pièce (0 pour blanc, 1 pour noir).
     * @param x, l'abscisse de départ de la pièce.
     * @param y, l'ordonnée de départ de la pièce.
     */
    public Cavalier(int C,char x,int y)
    {
        super(C,x,y);
    }


    @Override
    /**
     * Méthode de vérification du déplacement pour un Cavalier.
     * @param E, l'échiquier.
     * @param xa, l'abscisse d'arrivée.
     * @param ya, l'ordonnée d'arrivée.
     * @return Vrai si le Cavalier est déplaçable, faux sinon.
     */
    public boolean est_deplacable(Plateau E,char xa,int ya)
    {
        /*Sauvegarde des coordonnées de départ*/
        char xdep = getAbs();
        int ydep = getOrd();

        /*Vérification du déplacement*/
        if(((xa==xdep+1)&&(ya==ydep+2))
                ||((xa==xdep-1)&&(ya==ydep+2))
                ||((xa==xdep+1)&&(ya==ydep-2))
                ||((xa==xdep-1)&&(ya==ydep-2))
                ||((xa== xdep+2)&&(ya==ydep+1))
                ||((xa== xdep+2)&&(ya==ydep-1))
                ||((xa== xdep-2)&&(ya==ydep+1))
                ||((xa== xdep-2)&&(ya==ydep-1)))
        {
            for(Piece p : E.getListe())
            {
                if((p.getAbs() == xa)&&(p.getOrd() == ya)) return false;
            }

            return true;
        }

        return false;

    }
}
