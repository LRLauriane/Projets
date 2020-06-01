package src;

public class Joueur {

    private String name;
    private int couleur;

    /**
     * Constructeur
     * @param nom, nom du joueur.
     */
    public Joueur(String nom,int coul)
    {
        name = nom;
        couleur = coul;
    }

    /**
     * Méthode de récupération du nom du joueur.
     * @return le nom du joueur.
     */
    public String getNom()
    {
        return name;
    }

    public int getCouleur()
    {
        return couleur;
    }
}
