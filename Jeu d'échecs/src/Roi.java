package src;
import java.util.ArrayList;

public class Roi extends Piece{

    /**
     * Constructeur
     *
     * @param C, la couleur de la pièce (0 pour blanc, 1 pour noir).
     * @param x, l'abscisse de départ.
     * @param y, l'ordonnée de départ.
     */
    public Roi(int C,char x,int y)
    {
        super(C,x,y);
    }


    @Override
    /**
     * Méthode de vérification du déplacement pour un Roi.
     * @param E, l'échequier.
     * @param xa, l'abscisse d'arrivée.
     * @param ya, l'ordonnée d'arrivée.
     * @return Vrai si le Roi est déplaçable, faux sinon.
     */
    public boolean est_deplacable(Plateau E,char xa,int ya)
    {
        char xdep = getAbs();
        int ydep = getOrd();
        int coul = getCoul();

        int x = Math.abs(xa - xdep);
        int y = Math.abs(ya - ydep);


        if((x>1) || (y>1) || ((y==0)&&(x==0)))							/*Test que la valeur absolue comprise entre 0 et 1 et que le roi ne
																		soit pas déplaçable sur place*/
        {
            return false;
        }

        for(Piece p : E.getListe())
        {
            if(coul==p.getCoul()) {
                if (p.getAbs() == xa && p.getOrd() == ya) {
                    return false;										/*Ne pas manger une pièce qui appartient au roi lui-même*/
                }
            }
        }
        return true;

    }

    /**
     * Méthode pour vérifier si le Roi est en situation d'échec.
     * @param E, l'échequier.
     * @return Vrai si le Roi est en situation d'échec, faux sinon.
     */

    public boolean echec(Plateau E)
    {
        int coul = getCoul();
        for(Piece p : E.getListe())
        {
            if(coul!=p.getCoul())
            {
                if(p instanceof Pion)
                {
                    if(((Pion) p).est_mangeable(E,getAbs(),getOrd()))
                    {
                        return true;									/*Si un pion adverse peut manger le roi*/
                    }
                }
                else
                {
                    if(p.est_deplacable(E,getAbs(),getOrd()))
                    {
                        return true;									/*Ou une autre piece peut manger le roi*/

                    }
                }
            }
        }
        return false;
    }

    /**
     * Méthode pour vérifier à partir de tous les déplacemnts du roi,s'il peut sortir de sa situation d'échec.
     * @param E, l'échequier.
     * @return Vrai si le Roi ne peut plus se sortir de sa situation d'échec, faux sinon.
     */
    public boolean roi_ne_pas_sortir_pos_echec(Plateau E)
    {
		char abs,abs1 = ' ';
		int ord,ord1 = 0;
		Piece sauv = null;

        if(echec(E))
        {
            for(char i ='a';i<='h';i++) {
                for (int j = 1; j <= 8; j++) {							/*Parcours de toutes le cases du plateau*/

                    if(est_deplacable(E,i,j)){							/*Si le roi est déplaçable*/

                        abs = getAbs(); ord = getOrd();
                        this.modif_pos(i,j);

                        for(Piece p : E.getListe())
                        {
							if((p.getAbs() == i)&&(p.getOrd() == j))
							{
								abs1 = p.getAbs(); ord1 = p.getOrd();
								sauv = p;
								p.modif_pos('i',2);
							}
						}


                        if(!echec(E)) {
							this.modif_pos(abs,ord);                     /*Revenir à la position initiale*/
							if(sauv != null) sauv.modif_pos(abs1,ord1);  /*Revenir à la position initiale*/
                            System.out.println("Le Roi peut sortir de sa position d'échec");
                            return false;								/*Existence d'au moins un déplacement possible pour sortir
																		de la position d'échec*/
                        }

                        this.modif_pos(abs,ord);                        /*Revenir à la position initiale*/
						if(sauv != null) sauv.modif_pos(abs1,ord1);     /*Revenir à la position initiale*/
                    }

                }
            }
            System.out.println("Le Roi ne peut pas sortir de sa position d'échec");
            return true;
        }
        else
        {
			System.out.println("Le Roi n'est pas en échec");
            return false;
		}

    }

    /**
     * Méthode pour vérifier que parmi les pièces appartenant au joueur du roi, il en existe au moins une qui couvre le roi
     * @param E, l'échequier.
     * @return Vrai si il existe une pièce qui couvre le Roi qui ne sera plus en échec, faux sinon.
     */

    public boolean aucune_piece_couvre_roi(Plateau E)
    {
		char abs,abs1 =' ';
		int ord,ord1 = 0;
		Piece sauv = null;

        if(echec(E)) {
            for (char i = 'a'; i <= 'h'; i++) {
                for (int j = 1; j <= 8; j++) {							/* Parcours de toutes les cases du plateau*/
                    for(Piece p : E.getListe())
                    {
                        if(p.getCoul()==getCoul())						/*Recherche des pièces de la même couleur que le Roi*/
                        {
                            if(! (p instanceof Roi)) {					/*Sauf le roi lui-même*/

                                if (p.est_deplacable(E, i, j)) {

									abs = p.getAbs(); ord = p.getOrd();
									p.modif_pos(i,j);

									                                    /*Checker si une pièce est capturée*/
									for(Piece p1 : E.getListe())
									{
										if((p1.getAbs() == i)&&(p1.getOrd() == j))
										{
										    abs1 = p1.getAbs(); ord1 = p1.getOrd();
											sauv = p1;
											p1.modif_pos('i',2);
										}
									}

                                    if (!echec(E)) {					            /*Test s'il y a échec après déplacement*/
										p.modif_pos(abs,ord);                       /*Revenir à la position initiale*/
										if(sauv != null) sauv.modif_pos(abs1,ord1); /*Revenir à la position initiale*/
                                        return false;
                                    }
                                   p.modif_pos(abs,ord);                            /*Revenir à la position initiale*/
								   if(sauv != null) sauv.modif_pos(abs1,ord1);      /*Revenir à la position initiale*/
                                }
                            }
                        }

                    }
                }
            }
            System.out.println("Le Roi ne peut être couvert");
            return true;
        }
        else
        {
			System.out.println("Le Roi n'est pas en échec");
			return false;
		}

    }

    /**
     * Méthode pour vérifier que parmi les pièces mettant en danger le roi, il existe une pièce du joueur du roi qui peut
     * capturer la pièce qui met en danger le roi
     * @param E, l'échequier.
     * @return Vrai si il existe une piece qui peut manger la piece mettant en danger, ainsi le roi n'est plus en
     * échec, Faux sinon
     */
    public boolean aucune_piece_mange_piece_mettant_danger(Plateau E)
    {
            ArrayList<Piece> sauv = new ArrayList<Piece>();
            Piece capturee = null;
            char abs,abs1 = ' ';
            int ord,ord1=0;

            /*Trouver la pièce mettant en échec le roi*/

            for(Piece p : E.getListe())
            {
                if(p.getCoul()!= getCoul())
                {
                    /*Vérification que la pièce peut se déplacer sur la case du Roi*/
                    if(p instanceof Pion)
                    {
                        if(((Pion)p).est_mangeable(E,getAbs(),getOrd())) sauv.add(p);
                    }
                    else if(p.est_deplacable(E,getAbs(),getOrd())) sauv.add(p);
                }
            }

            System.out.println(sauv);

            /*Si il existe une pièce qui met en danger le roi*/
            if(!(sauv.isEmpty()))
            {
                for(Piece p1 : sauv) {
                    /*Vérification qu'aucune pièce adverse ne peut la manger*/
                    for (Piece p : E.getListe()) {
                        if ((p != p1) && (p.getCoul() != p1.getCoul())) {
                            if (p instanceof Pion) {
                                if (((Pion)p).est_mangeable(E, p1.getAbs(), p1.getOrd()))
                                {

                                    abs = p.getAbs(); ord = p.getOrd();
                                    abs1 = p1.getAbs();	ord1 = p1.getOrd();

                                    /*Simulation de la capture*/
                                    p.modif_pos(p1.getAbs(),p1.getOrd()); /*Placement de la pièce mangeuse sur la case de la pièce mangée*/
                                    p1.modif_pos('i',2);		  /*Placement provisoire de la pièce mangée à une position impossible*/

                                    if(!echec(E))						  /*Test s'il y a échec après ces déplacements*/
                                    {
                                        p.modif_pos(abs,ord);			  /*Retour à la position initiale de la pièce mangeuse*/
                                        p1.modif_pos(abs1,ord1);		  /*Retour à la position initiale de la pièce capturée*/
                                        return false;
                                    }

                                    p.modif_pos(abs,ord);				  /*Retour à la position initiale de la pièce mangeuse*/
                                    p1.modif_pos(abs1,ord1);			  /*Retour à la position initiale de la pièce capturée*/
                                }
                            }
                            else if (p.est_deplacable(E, p1.getAbs(), p1.getOrd()))
                            {
                                abs = p.getAbs(); ord = p.getOrd();
                                abs1 = p1.getAbs(); ord1 = p1.getOrd();

                                p.modif_pos(p1.getAbs(),p1.getOrd());	  /*Placement de la pièce mangeuse sur la case de la pièce mangée*/
                                p1.modif_pos('i',2);                      /*Placement provisoire de la pièce mangée à une position impossible*/

                                if(!echec(E))							  /*Test de l'échec*/
                                {
                                    p.modif_pos(abs,ord);				  /*Retour à la position initiale de la pièce mangeuse*/
                                    p1.modif_pos(abs1,ord1);			  /*Retour à la position initiale de la pièce capturée*/
                                    return false;
                                }

                                p.modif_pos(abs,ord);					  /*Retour à la position initiale de la pièce mangeuse*/
                                p1.modif_pos(abs1,ord1);				  /*Retour à la position initiale de la pièce capturée*/
                            }
                        }
                    }
                }
            }

            return true;
        }

    /**
     * Méthode pour tester si le roi est en échec et mat
     * @param E, l'échequier.
     * @return Vrai si le roi est en situation d'échec et mat, Faux sinon
     */
    public boolean echec_et_mat(Plateau E)
    {
        if(echec(E) &&
           roi_ne_pas_sortir_pos_echec(E) &&
           aucune_piece_couvre_roi(E) &&
           aucune_piece_mange_piece_mettant_danger(E))
            return true;
        else
            return false;
    }

}
