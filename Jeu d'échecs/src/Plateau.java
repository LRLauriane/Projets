package src;
import java.util.ArrayList;
import java.util.Scanner;

public class Plateau {

    private ArrayList<Piece> LP;
    private Undo undo;

    /**Constructeur de la classe Plateau
     * Création d'une liste de pièce.
     * Création d'une pile pour le Undo.
     */
    public Plateau() {
        LP = new ArrayList<Piece>();
        undo = new Undo(new Pile());
    }

    /**Méthode d'ajout dans la liste de pièces
     *
     * @param p, la pièce à ajouter.
     */
    public void add_elem(Piece p)
    {
        LP.add(p);
    }

    /**Méthode de supression dans la liste de pièces
     *
     * @param p, la pièce à retirer.
     */
    public void sup_elem(Piece p)
    {
        LP.remove(p);
    }

    /**Méthode d'initialisation de l'échiquier
     * Ajout de toutes les pièces de départ dans la liste.
     */
    public void init_plateau()
    {

        //Ajout des pièces blanches
        add_elem(new Pion(0,'a',2));
        add_elem(new Pion(0,'b',2));
        add_elem(new Pion(0,'c',2));
        add_elem(new Pion(0,'d',2));
        add_elem(new Pion(0,'e',2));
        add_elem(new Pion(0,'f',2));
        add_elem(new Pion(0,'g',2));
        add_elem(new Pion(0,'h',2));
        add_elem(new Roi(0,'e',1));
        add_elem(new Reine(0,'d',1));
        add_elem(new Fou(0,'c',1));
        add_elem(new Fou(0,'f',1));
        add_elem(new Cavalier(0,'b',1));
        add_elem(new Cavalier(0,'g',1));
        add_elem(new Tour(0,'a',1));
        add_elem(new Tour(0,'h',1));

        //Ajout des pièces noires
        add_elem(new Pion(1,'a',7));
        add_elem(new Pion(1,'b',7));
        add_elem(new Pion(1,'c',7));
        add_elem(new Pion(1,'d',7));
        add_elem(new Pion(1,'e',7));
        add_elem(new Pion(1,'f',7));
        add_elem(new Pion(1,'g',7));
        add_elem(new Pion(1,'h',7));
        add_elem(new Roi(1,'e',8));
        add_elem(new Reine(1,'d',8));
        add_elem(new Fou(1,'c',8));
        add_elem(new Fou(1,'f',8));
        add_elem(new Cavalier(1,'b',8));
        add_elem(new Cavalier(1,'g',8));
        add_elem(new Tour(1,'a',8));
        add_elem(new Tour(1,'h',8));

    }

    /**Méthode de récupération de la liste de pièces
     *
     * @return la liste de pièces.
     */
    public ArrayList<Piece> getListe()
    {
        return LP;
    }

    /**Méthode de récupération de la pile de sauvegarde
     *
     * @return la pile de sauvegarde des mouvements.
     */
    public Undo getUndo()
    {
        return undo;
    }

    public void personne_vs_ia(Scanner sc)
    {
			String lecture;
			IA ia = new IA("IA",1);
            Personne J = new Personne("VOUS",0);
            int a_jouer,i=1;
            Piece r1 = null;
            Piece r2 = null;

            /*Initialisation du plateau*/
            this.init_plateau();

            /*Récupération des deux Rois*/
			for (Piece p1 : this.getListe())
			{
				if(p1 instanceof Roi)
				{
					if(p1.getCoul()==0) r1 = p1;
					else r2 = p1;
				}
			}

			/*Tant que les deux ne sont pas en échec et mat*/
            while((!((Roi) r1).echec_et_mat(this)) && (!((Roi) r2).echec_et_mat(this)))
            {
                System.out.println("__________Tour "+i+"__________");
                System.out.println("Au tour de : "+J.getNom());
                System.out.print('\n');
                System.out.print("Entrez les coordonnées : ");

                /*Demande à l'utilisateur d'entrer le mouvement qu'il veut effectuer*/
                lecture = J.saisie(sc);

				if(lecture.equals("quit"))
				{
					System.exit(1);
				}
                /*Si l'utilisateur entre undo*/
                else if(lecture.equals("undo"))
                {
                    /*Tant qu'il entre undo*/
                    while(lecture.equals("undo"))
                    {
                        /*Undo*/
                        this.getUndo().sup_mov(this);
                        System.out.println("Que voulez-vous faire ?");
                        System.out.println("Annuler un coup ? Tapez undo.");
                        System.out.println("Quitter ? Tapez quit.");
                        System.out.println("Entrez votre choix : ");
                        /*Demande à nouveau ce que l'utilisateur veut faire*/
                        lecture = J.saisie(sc);
                    }

                    /*Teste si la pile est vide pour reprendre au tour de la Personne*/
                    if(this.getUndo().getPile().getPilePiece().isEmpty())
                    {
                        System.out.println("Au tour de : "+J.getNom());
                        System.out.print('\n');
                        System.out.print("Entrez les coordonnées : ");
                        lecture = J.saisie(sc);
                        J.jouer(this,lecture,sc);
                    }
                    /*Teste si la dernière pièce en mouvement appartenait à l'IA pour reprendre au tour de la Personne*/
                    else if(this.getUndo().getPile().getPilePiece().peek().getCoul() == ia.getCouleur())
                    {
                        System.out.println("Au tour de : "+J.getNom());
                        System.out.print('\n');
                        System.out.print("Entrez les coordonnées : ");
                        lecture = J.saisie(sc);
                        J.jouer(this,lecture,sc);
                    }
                }
                else
                {
                    /*Si l'utilisateur entre un mouvement à effectuer*/
                    a_jouer = J.jouer(this,lecture,sc);

                    /*Tant qu'il n'a pas jouer*/
                    while(a_jouer == 0)
                    {
                        System.out.println("ERREUR : Pas de pièce à cet endroit");
                        System.out.println("Entrez les coordonnées : ");
                        lecture = J.saisie(sc);
                        a_jouer = J.jouer(this,lecture,sc);
                    }
                }

                System.out.print('\n');
                System.out.println("Au tour de : "+ia.getNom());
                System.out.print('\n');

                /*Au tour de l'IA*/
                ia.jouer(this);

                System.out.print('\n');


                /*Récupération à des rois pour le test du while*/
				for (Piece j : this.getListe())
				{
					if(j instanceof Roi)
					{
						if(j.getCoul()==0) r1 = j;
						else r2 = j;
					}
				}

				i++; /*Changement de tour*/
            }


            /*FIN DU JEU / Déclaration du vainqueur*/
            for (Piece j : this.getListe()) {
                if (j instanceof Roi) {
                    if (j.getCoul() == 0) {
                        if (ia.getCouleur() == 0) System.out.println("VICTOIRE DES BLANCS JOUES PAR " + ia.getNom());
                        else System.out.println("VICTOIRE DES BLANCS JOUES PAR " + J.getNom());
                    } else {
                        if (ia.getCouleur() == 1) System.out.println("VICTOIRE DES NOIRS JOUES PAR " + ia.getNom());
                        else System.out.println("VICTOIRE DES NOIRS JOUES PAR " + J.getNom());
                    }
                }
            }
	}

	public void ia_vs_ia()
	{
			int i = 1;
            IA ia = new IA("ia",1);
            IA ia1 = new IA("ia1",0);
            Piece r1=null;
			Piece r2=null;

			/*Initialisation du plateau*/
            this.init_plateau();

            /*Récupération des deux rois*/
			for (Piece p1 : this.getListe())
			{
				if(p1 instanceof Roi)
				{
					if(p1.getCoul()==0)
						r1 = p1;
					else
						r2 = p1;
				}
			}


			/*Tant que les deux rois ne sont pas en échec et mat*/
            while((!((Roi) r1).echec_et_mat(this)) && (!((Roi) r2).echec_et_mat(this)))
            {
                System.out.println("__________Tour "+i+"__________");
                System.out.println("Au tour de : "+ia.getNom());
                /*Tour de la première ia*/
                ia.jouer(this);

                /*Attente de 2 secondes*/
                /*try {
                    Thread.sleep(2000);
                } catch (InterruptedException e) {
                    e.printStackTrace();
                }*/

                System.out.print('\n');
                System.out.println("Au tour de : "+ia1.getNom());

                /*Tour de la deuxième ia*/
                ia1.jouer(this);

				/*Récupération à nouveau des 2 Rois pour le test du while*/
                for (Piece j : this.getListe())
				{
					if(j instanceof Roi)
					{
						if(j.getCoul()==0)
							r1 = j;
						else
							r2 = j;
					}
				}

				i++; /*Changement de tour*/
            }

            /*FIN DU JEU / Déclaration du vainqueur*/
            for (Piece j : this.getListe()) {
                if (j instanceof Roi) {
                    if (j.getCoul() == 0) {
                        if (ia.getCouleur() == 0) System.out.println("VICTOIRE DES BLANCS JOUES PAR " + ia.getNom());
                        else System.out.println("VICTOIRE DES BLANCS JOUES PAR " + ia1.getNom());
                    } else {
                        if (ia.getCouleur() == 1) System.out.println("VICTOIRE DES NOIRS JOUES PAR " + ia.getNom());
                        else System.out.println("VICTOIRE DES NOIRS JOUES PAR " + ia1.getNom());
                    }
                }
            }
	}
}
