package src;

public class Undo
{
    private Pile p; /*Ensemble de deux piles : celle de pièces et celle de coordonnées*/

    /**Constructeur de la classe Undo
     *
     * @param pile, un ensemble de deux piles.
     */
    public Undo(Pile pile)
    {
        p = pile;
    }

    /**Méthode d'ajout dans la pile
     *
     * @param piece, la dernière pièce en mouvement.
     */
    public void add_mov(Piece piece)
    {
        p.push_piece(piece);
        p.push_coord(piece.getAbs(), piece.getOrd());
    }

    /**Méthode du undo
     * @param E, l'échiquier.*/
    public void sup_mov(Plateau E)
    {
        Piece p2 = null;
        char xprec = (char)p.remove_abs(); /*Récupération de l'abscisse*/
        int yprec = p.remove_ord();		   /*Récupération de l'ordonnée*/
        Piece piece = p.remove_piece();	   /*Récupération de la pièce*/
        for(Piece p1 : E.getListe())
        {
            if(p1.equals(piece)) p2 = p1;	   /*Modification de sa position*/
        }

        if(p2 != null) piece.modif_pos(xprec, yprec);	   /*Modification de sa position*/
        else
        {
            E.add_elem(piece);
            piece.modif_pos(xprec, yprec);	   /*Modification de sa position*/
            xprec = (char)p.remove_abs();
            yprec = p.remove_ord();
            piece = p.remove_piece();
            piece.modif_pos(xprec,yprec);
        }
    }

    /**Méthode de récupération de la pile
     *
     * @return la pile de pièces et la pile de cordonnées.
     */
    public Pile getPile()
    {
        return p;
    }
}
