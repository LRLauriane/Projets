package src;
import java.util.Stack;
import java.util.EmptyStackException;

public class Pile
{

    private Stack <Integer> Coord; /*Pile de coordonnées des pièces ayant bougé*/
    private Stack <Piece> Piece;   /*Pile de pièces ayant bougé*/

    /**Constructeur de la classe Pile
     * Deux piles : une pile d'entiers pour sauvegarder les coordonnées et une autre pour sauvegarder les pièces.
     */
    public Pile() {

        Piece = new Stack<Piece>();
        Coord = new Stack<Integer>();
    }

    /**Méthode de récupération de la pile contenant les coordonnées
     *
     * @return la pile contenant les coordonnées.
     */
    public Stack<Integer> getPileCoord()
    {
        return Coord;
    }

    /**Méthode de récupération de la pile contenant les pièces
     *
     * @return la pile contenant les pièces.
     */
    public Stack<Piece> getPilePiece()
    {
        return Piece;
    }

    /**Méthode d'ajout dans le pile de coordonnées
     *
     * @param x,l'abscisse de départ de la pièce qui a bougé.
     * @param y,l'ordonnée de départ de la pièce qui a bougé.
     */
    public void push_coord(char x,int y)
    {
        int codeascii = (int)x;
        Coord.push(y);
        Coord.push(codeascii);
    }

    /**Méthode d'ajout dans la pile de pièces
     *
     * @param p, la pièce qui était en mouvement.
     */
    public void push_piece(Piece p)
    {
        Piece.push(p);
    }

    /**Méthode de récupération de la dernière pièce en mouvement
     *
     * @return la dernière pièce en mouvement.
     */
    public Piece remove_piece ()
    {
        Piece p = null;

        if(!Piece.isEmpty()) p = Piece.pop();
        else
        {
            System.out.println("ERREUR : Supression dans une pile vide");
            throw new EmptyStackException();
        }

        return p;
    }

    /**Méthode de récupération de l'abscisse de la dernière pièce en mouvement
     *
     * @return l'abscisse de la dernière pièce en mouvement.
     */
    public int remove_abs()
    {
        int abs = 0;

        if(!Coord.isEmpty()) abs = Coord.pop();
        else
        {
            System.out.println("ERREUR : Supression dans une pile vide");
            throw new EmptyStackException();
        }

        return abs;
    }


    /**Méthode de récupération de l'ordonnée de la dernière pièce en mouvement
     *
     * @return l'ordonnée de la dernière pièce en mouvement.
     */
    public int remove_ord()
    {
        int ord = 0;

        if(!Coord.isEmpty()) ord = Coord.pop();

        return ord;
    }

}
