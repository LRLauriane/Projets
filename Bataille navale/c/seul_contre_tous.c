#include "../h/jeu.h"
#include <unistd.h>
#include <sys/types.h>
#include <sys/wait.h>

/**Vérification de l'état de chaque bateau
 * @param m, la map.
 * @param s, le tableau de sauvegarde de l'état des bateaux.
 * @param cmp_bat, le nombre de bateaux se trouvant sur la map.
 * @param enem, le tableau */
void verif_etat_bat(navalmap_t *m,SHIP *s,JOUEUR *J,int *cmp_bat)
{
	for(int i=0;i<m->nbShips;i++)
	{
			if((m->shipPosition[s[i].id].y >= 0)&&(m->shipPosition[s[i].id].x >= 0)) /*Suppression d'une seule fois du bateau coulé*/
			{
				/*Supression des bateaux coulés*/
				if((s[i].coque <= 0)||(s[i].kerosene <=0))
				{
					/*Remise à zéro des radars connaissant la position du bateau coulé*/
					for(int j=0;j<m->nbShips;j++)
					{
						if((J[j].ennemi.x == m->shipPosition[s[i].id].x)&&(J[j].ennemi.y==m->shipPosition[s[i].id].y))
						{
							J[j].ennemi.x = -1;
							J[j].ennemi.y = -1;
						}
					}

					/*Supression du bateau de la map*/
					m -> map[m->shipPosition[s[i].id].y][m->shipPosition[s[i].id].x].id = -1;
					m -> map[m->shipPosition[s[i].id].y][m->shipPosition[s[i].id].x].type = ENT_SEA;
					m->shipPosition[s[i].id].x = -100;   m->shipPosition[s[i].id].y = -100;

					/*Mise à jour du nombre de bateaux sur la map*/
					*cmp_bat -= 1;
				}
			}
	}
}

/**Vérification de la présence du bateau sur la map
 * @param m, la map.
 * @param shipID, l'id du bateau dont on veut vérifier la présence.
 * @return 1 si présent, 0 sinon.*/
int est_present(navalmap_t *m,int shipID)
{
	for(int j=0;j<m->size.y;j++)
	{
		for(int i=0;i<m->size.x;i++)
		{
			if(m->map[j][i].id == shipID) return 1;
		}
	}

	return 0;
}

/**Vérification des conditions de victoires
 * @param m, la map.
 * @param s, le tableau de sauvegarde de l'état des bateaux.
 * @param nb_bat, le nombre de bateaux sur la map.*/
void gagne(navalmap_t*m,SHIP*s,int nb_bat)
{
	if(nb_bat == 1)
	{
		for(int i = 0;i<m->nbShips;i++)
		{
			if((s[i].kerosene > 0)&&(s[i].coque > 0)) printf("Joueur %d a gagné\n",s[i].id);
		}
	}
	else
	{
		printf("EGALITE !\n");
	}
}

/**Calcul du nombre de joueurs restants
 * @param n, la map.
 * @param J, le tableau de joueurs.
 * @return le nombre de joueurs restants.*/
int nb_joueurs_restants(navalmap_t*n,JOUEUR *J)
{
	int cmp = 0;

	for(int i=0;i<n->nbShips;i++)
	{
		if(est_present(n,J[i].etat.id)) cmp+=1;
	}

	return cmp;
}

/**Algorithme de décision
 * @param n, la map.
 * @param J, les données du joueur.
 * @param le choix du jouer.*/
CHOIX choix_du_joueur(navalmap_t*n,JOUEUR J)
{
	CHOIX c;
	c.c = VIDE;
	c.categorie = 0;
	c.id = J.etat.id;

	if(J.compteur%4 == 0)
	{
		c.c = RADARGLOB;
		c.categorie = 3;
	}
	else if(J.compteur%10 == 0)
	{
		c.c = RADARLOC;
		c.categorie = 3;
	}
	else if(est_attaquable(n,J.etat.id,J.ennemi))
	{
		c.c = ATTAQUE;
		c.categorie = 1;
	}
	else if(est_chargeable(n,J.etat.id,J.ennemi))
	{
		c.c = CHARGE;
		c.categorie = 2;
	}
	else if(((J.etat.coque>0)&&(J.etat.coque <= 30))&&(J.etat.kerosene >= 60))
	{
		c.c = REPARATION;
		c.categorie = 3;
	}
	else
	{
		c.c = DEPLACEMENT;
		c.categorie = 2;
	}

	return c;

}

/**Mise en place de l'ordre d'application des actions
 * @param n, la map.
 * @param J, le tableau des joueurs.
 * @param nb_joueurs, le nombre dde joueurs restants.
 * @return le tableau des actions triés dans l'ordre de passage.*/
JOUEUR * ordre_de_passage(navalmap_t *n,JOUEUR *J,int nb_joueurs)
{
	int cat = 1,j=0;
	JOUEUR * sauv = malloc(sizeof(JOUEUR)*nb_joueurs);
	if(!sauv)
	{
		fprintf(stderr,"ERREUR : ALLOCATION DANS LA FONCTION ORDRE DE PASSAGE \n");
		exit(EXIT_FAILURE);
	}

	while(cat <= 3)
	{
		for(int i=0;i<n->nbShips;i++)
		{
			if(est_present(n,J[i].etat.id))
			{
				if(J[i].choice.categorie == cat)
				{
					sauv[j] = J[i];
					j++;
				}
			}
		}
		cat ++;
	}

	return sauv;
}

/**Application du choix d'un joueur
 * @param ordre, la tableau des actions triés selon leur catégorie.
 * @param n, la map.
 * @param i, l'indice de la case du joueur.*/
void application_choix(JOUEUR *ordre,navalmap_t*n,SHIP*s,int i)
{
	SHIP rad; 															/*Variable de récupération du bateau trouvé par le radar*/
	SHIP* radl;															/*Variable de récupération des bateaux se trouvant entre 1 et 3 de distance du bateau*/
	coord_t pos;														/*Vecteur de mouvement*/
	coord_t *pos_enem;													/*Tableau de la position des ennemis*/
	int nb_ships = 0;														/*Nombre de bateaux ennemis trouvés*/

	if(ordre[i].choice.c == RADARGLOB)
	{
		rad = SCN(n,ordre[i].etat.id,s,&ordre[i].ennemi);
		printf("%d --> Ennemi en %d,%d avec %d de kerosene et %d de coque.\n",ordre[i].etat.id,ordre[i].ennemi.x,ordre[i].ennemi.y,rad.kerosene,rad.coque);
	}
	else if(ordre[i].choice.c == RADARLOC)
	{
		pos_enem = malloc(n->nbShips*sizeof(coord_t));
		if(!pos_enem)
		{
			fprintf(stderr,"ERREUR D'ALLOCATION DE MEMOIRE\n");
			exit(EXIT_FAILURE);
		}

		radl = SC(n,ordre[i].etat.id,s,pos_enem,&nb_ships);

		if(nb_ships >= 1)
		{
			ordre[i].ennemi = pos_enem[0];
			printf("%d --> Ennemi en %d,%d avec %d de kerosene et %d de coque.\n",i,ordre[i].ennemi.x,ordre[i].ennemi.y,radl[0].kerosene,radl[0].coque);
		}
		else printf("%d --> Aucun ennemi repéré\n",ordre[i].etat.id);

		free(pos_enem);
		free(radl);
	}
	else if(ordre[i].choice.c == ATTAQUE) ATK(s,n,ordre[i].etat.id,ordre[i].ennemi);
	else if(ordre[i].choice.c == CHARGE) BST(n,s,ordre[i].etat.id,ordre[i].ennemi);
	else if(ordre[i].choice.c == REPARATION) RPR(s,ordre[i].etat.id);
	else if(ordre[i].choice.c == DEPLACEMENT)
	{
		pos.x = (rand()%5)-2;
		pos.y = (rand()%5)-2;
		MOV(s,n,ordre[i].etat.id,pos);
	}
}


/** Mode seul contre tous
 * @param n, la map.
 * @param s, le tableau de l'état des bateaux.
 * @param tours, le nombre de tours de jeu*/
void seul_contre_tous(navalmap_t*n,SHIP*s,int tours)
{
	coord_t pos;														/*Positionnement d'un bateau*/
	int cmp_bat = n->nbShips; 											/*Nombre de bateaux restant sur la map*/
	int nb_ships = 0;													/*Compteur de bateaux pour le radar*/
	int fd[2]; 															/*Tableau de file descriptor*/
	int nbBat = 0;														/*Comtpeur du nombre de joueurs*/
	JOUEUR *J = malloc((n->nbShips)*sizeof(JOUEUR));
	if(!J)
	{
		fprintf(stderr,"ERREUR : ALLOCATION DU TABLEAU DE JOUEURS\n");
		exit(EXIT_FAILURE);
	}
	JOUEUR J1;
	pid_t pid;
	int check,tube;

																		/*Initialisation de la position des bateaux*/
	for(int i=0;i<n->nbShips;i++)
	{
		pos.x = (rand()%(n->size.x));
		pos.y = (rand()%(n->size.y));

		while(n->map[pos.y][pos.x].type != ENT_SEA)
		{
			pos.x = (rand()%(n->size.x));
			pos.y = (rand()%(n->size.y));
		}

		printf("%d %d\n",pos.x,pos.y);

		placeShip(n,i,pos);
		s[i].id = i;
	}

																		/*Initialisation du tableau de joueurs*/
	for(int i=0;i<n->nbShips;i++)
	{
		J[i].etat = s[i];
		J[i].ennemi.x = -1;
		J[i].ennemi.y = -1;
		J[i].compteur = 0;
		J[i].choice.c = VIDE;
		J[i].choice.categorie = 0;
		J[i].choice.id = s[i].id;
	}

	J1.etat.id = -1;													/*Intialisation de la variable de sauvegarde*/
	J1.etat.kerosene = -1;
	J1.etat.coque = -1;
	J1.ennemi.x = -1;
	J1.ennemi.y = -1;
	J1.compteur = 0;
	J1.choice.c = VIDE;
	J1.choice.categorie = 0;



	tube = pipe(fd);													/*Création du tube*/
	if(tube == -1)
	{
		fprintf(stderr,"ERREUR : ECHEC DE LA CREATION DU TUBE\n");
		exit(EXIT_FAILURE);
	}

	for(int j = 1; j<=tours;j++)
	{
		printf("----------Tour %d----------\n",j);

		for(int i = 0;i<n->nbShips;i++)
		{
			if((est_present(n,s[i].id))&&(cmp_bat> 1)) 					/*Vérification de la présence du bateau et du nombre de bateaux restants*/
			{
				pid = fork();

				if(pid==-1)
				{
					fprintf(stderr,"ERREUR : ECHEC DE CREATION DU PROCESSUS\n");
					exit(EXIT_FAILURE);
				}
				else if(pid==0)											/*Création du processus fils*/
				{

					check = read(fd[0],&J1,sizeof(JOUEUR));				/*Réception des données du joueur*/
					if(check==-1)
					{
						fprintf(stderr,"ERREUR : ECHEC DE LECTURE DANS LE TUBE\n");
						exit(EXIT_FAILURE);
					}
					check = read(fd[0],n,sizeof(navalmap_t*)); 			/*Réception de la map*/
					if(check==-1)
					{
						fprintf(stderr,"ERREUR : ECHEC DE LECTURE DANS LE TUBE\n");
						exit(EXIT_FAILURE);
					}
					J1.choice = choix_du_joueur(n,J1);					/*Algorithme de décision*/


					check = write(fd[1],&J1,sizeof(JOUEUR));			/*Envoi des données du joueur*/
					if(check==-1)
					{
						fprintf(stderr,"ERREUR : ECHEC D'ECRITURE DANS LE TUBE\n");
						exit(EXIT_FAILURE);
					}

					exit(0);
				}
				else
				{
		            J[i].compteur = j; 									/*Compteur mis à jour lors du changement de tour*/
		            J[i].etat = s[i];									/*Etat mis à jouer à chaque tour*/

					check = write(fd[1],&J[i],sizeof(JOUEUR)); 			/*Envoi de l'état du bateau*/
					if(check==-1)
					{
						fprintf(stderr,"ERREUR : ECHEC D'ECRITURE DANS LE TUBE\n");
						exit(EXIT_FAILURE);
					}
					check = write(fd[1],n,sizeof(navalmap_t*));			/*Envoi de la map*/
					if(check==-1)
					{
						fprintf(stderr,"ERREUR : ECHEC D'ECRITURE DANS LE TUBE\n");
						exit(EXIT_FAILURE);
					}

					wait(NULL);

					check = read(fd[0],&J[i],sizeof(JOUEUR));			/*Réception du choix du joueur*/
					if(check==-1)
					{
						fprintf(stderr,"ERREUR : ECHEC DE LECTURE DANS LE TUBE\n");
						exit(EXIT_FAILURE);
					}

			        nbBat += 1;
																		/*Application de l'action selon le choix*/
					if(nbBat == nb_joueurs_restants(n,J))
					{
						JOUEUR *ordre = ordre_de_passage(n,J,nb_joueurs_restants(n,J)); /*Ordre des actions*/

						for(int i = 0;i<nb_joueurs_restants(n,J);i++)
						{
							printf("## Joueur : %d ## %d kerosene | %d coque ##\n",ordre[i].etat.id,ordre[i].etat.kerosene,ordre[i].etat.coque);

							application_choix(ordre,n,s,i);

							printf("\n");
						}

						for(int i = 0;i<nb_joueurs_restants(n,J);i++)	/*Mise à jour de l'état du bateau du joueur*/
							for(int j=0;j<n->nbShips;j++)
								if(ordre[i].etat.id == J[j].etat.id) J[j]= ordre[i];

							nbBat = 0;
							free(ordre);
					}
				}

			}
			verif_etat_bat(n,s,J,&cmp_bat);					    /*Vérification de l'état de chaque bateau*/
		}
	}

		printf("##########FIN DU JEU##########\n");
		gagne(n,s,cmp_bat);									/*Vérification des conditions de victoire*/

		close(fd[0]); close(fd[1]);
		free(J);
}
