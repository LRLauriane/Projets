#include "../h/jeu.h"
#include <unistd.h>
#include <sys/types.h>
#include <sys/wait.h>
#include <pthread.h>

const int nbJ = 2;

/**Réduction du champ de recherche d'un bateau selon son équipe
 * @param J, le tableau des équipes et de leur joueurs.
 * @param s, le tableau de l'état des bateaux.
 * @param idBat, l'identifiant du bateau voulant appliquer un radar.
 * @param id_equipe, le numéro de l'équipe du bateau.
 * @param nb_joueurs, le nombre de joueurs.
 * @param nb_equipes, le nombre de l'équipe.
 * @param cmp_bat, la tableau de compteurs de bateaux par équipe
 * @return le tableau de bateaux réduit*/
SHIP *recherche(Joueur **J,SHIP *s,int idBat,int id_equipe,int nb_joueurs,int nb_equipes,int*cmp_bat)
{
	SHIP *s1 = malloc(((nb_joueurs)*nb_equipes)*sizeof(SHIP));
	int cmp = 0;

	for(int i = 0;i<nb_equipes;i++)
	{
		for(int j=0; j<nb_joueurs;j++)
		{
			/*Ajout des bateaux ne faisant pas parti de l'équipe du bateau*/
			if(J[i][j].equipe != id_equipe)
			{
				if(est_present(J[i][j].map,J[i][j].etat.id))
				{
					s1[cmp] = s[J[i][j].etat.id];
					cmp++;
				}
			}
			/*Ajout du bateau voulant faire le radar pour mettre à jour son état*/
			if(J[i][j].etat.id == idBat)
			{
				s1[cmp] = s[J[i][j].etat.id];
				cmp ++;
			}
		}
	}

	*cmp_bat = cmp;

	return s1;
}

/**Réduction du champ de recherche d'un bateau selon son équipe
 * @param n, la map.
 * @param J, le tableau des équipes et de leur joueurs.
 * @param s, le tableau de l'état des bateaux.
 * @param idE, le numéro de l'équipe du bateau.
 * @param nbJ, le nombre de joueurs.
 * @param nbE, le nombre de l'équipe.
 * @param icase, l'indice de la case correspondant au bateau faisant le radar.*/
void mise_a_jour_radar_global(navalmap_t*n,Joueur **J,SHIP*s,int idE,int nbJ,int nbE,int icase)
{
	int cmp_bat = 0;
	SHIP *s1,rad;

	/*Réduction du champ de recherce*/
	s1 = recherche(J,s,J[idE][icase].etat.id,idE,nbJ,nbE,&cmp_bat);

	n->nbShips = cmp_bat;

	/*Radar*/
	rad = SCN(n,J[idE][icase].etat.id,s1,&J[idE][icase].ennemi);

	for(int i=0;i<n->nbShips;i++)
	{
		/*Mise à jour du tableau de l'état des bateaux*/
		if(s1[i].id == J[idE][icase].etat.id) s[J[idE][icase].etat.id].kerosene = s1[i].kerosene;
	}

	printf("%d --> Ennemi en %d,%d avec %d de kerosene et %d de coque.\n",J[idE][icase].etat.id,J[idE][icase].ennemi.x,J[idE][icase].ennemi.y,rad.kerosene,rad.coque);

	free(s1);
}

/**Réduction du champ de recherche d'un bateau selon son équipe
 * @param n, la map.
 * @param J, le tableau des équipes et de leur joueurs.
 * @param s, le tableau de l'état des bateaux.
 * @param idE, le numéro de l'équipe du bateau.
 * @param nbJ, le nombre de joueurs.
 * @param nbE, le nombre de l'équipe.
 * @param icase, l'indice de la case correspondant au bateau faisant le radar.*/
void mise_a_jour_radar_local(navalmap_t*n,Joueur **J,SHIP*s,int idE,int nbJ,int nbE,int icase)
{
	int nb_ships = 0,cmp_bat = 0;

	/*Réduction du champ de recherche*/
	SHIP *s1 = recherche(J,s,J[idE][icase].etat.id,idE,nbJ,nbE,&cmp_bat),*radl;

	n->nbShips = cmp_bat;

	/*Création d'un tableau qui sauvegardera les positions ennemis*/
	coord_t *pos_enem = malloc(n->nbShips*sizeof(coord_t));
	if(!pos_enem)
	{
		fprintf(stderr,"ERREUR D'ALLOCATION DE MEMOIRE\n");
		exit(EXIT_FAILURE);
	}

	/*Radar*/
	radl = SC(n,J[idE][icase].etat.id,s1,pos_enem,&nb_ships);

	for(int i=0;i<n->nbShips;i++)
	{
		/*Mise à jour du tableau de l'état des bateaux*/
		if(s1[i].id == J[idE][icase].etat.id) s[J[idE][icase].etat.id].kerosene = s1[i].kerosene;
	}

	/*Dans le cas où un bateau a été repéré*/
	if(nb_ships >= 1)
	{
		J[idE][icase].ennemi = pos_enem[0];
		printf("%d --> Ennemi en %d,%d avec %d de kerosene et %d de coque.\n",J[idE][icase].etat.id,J[idE][icase].ennemi.x,J[idE][icase].ennemi.y,radl[0].kerosene,radl[0].coque);
	}
	else printf("%d --> Aucun ennemi repéré\n",J[idE][icase].etat.id);

	free(s1);
	free(radl);
	free(pos_enem);
}

/**Calcul du nombre de joueurs restants
 * @param n, la map.
 * @param J, le tableau des équipes et de leur joueurs.
 * @return le nombre de joueurs restants.*/
int nbJoueursRestants(navalmap_t *n,Joueur**J)
{
	int cmp = 0;

	for(int i=0;i<n->nbShips/2;i++)
	{
		for(int j=0;j<nbJ;j++)
			if(est_present(n,J[i][j].etat.id)) cmp++;
	}

	return cmp;
}

/**Calcul du nombre d'équipes restants
 * @param n, la map.
 * @param J, le tableau des équipes et de leur joueurs.
 * @param idE, le numéro de l'équipe.
 * @return le nombre d'équipes restantes.*/
int nbJoueursRestantsParEquipe(navalmap_t *n,Joueur**J,int idE)
{
	int cmp = 0;

	for(int i=0;i<nbJ;i++)
		if(est_present(n,J[idE][i].etat.id)) cmp ++;

	return cmp;

}

/**Mise à jour de l'état du jeu
 * @param m, la map.
 * @param s, le tableau de l'état des bateaux.
 * @param cmp_bat, le tableau des compteurs de bateaux pour chaque équipe
 * @param nb_equipes, le compteur du nombre d'équipes
 * @param J, le tableau des équipes et de leur joueurs
 * @return le tableau J mis à jour.*/
Joueur **verification_etat(navalmap_t *m,SHIP *s,int *cmp_bat,int*nb_equipes,Joueur **J)
{
	for(int i=0;i<m->nbShips;i++)
	{
		/*Si le bateau est présent sur la map*/
			if((m->shipPosition[s[i].id].x >= 0)&&(m->shipPosition[s[i].id].y >= 0))
			{
				/*Si le bateau vient de couler*/
				if((s[i].coque <=0)||(s[i].kerosene <= 0))
				{
					/*Recherche des joueurs ayant comme ennemi, le bateau qui vient de couler*/
					for(int idE=0;idE<m->nbShips/2;idE++)
					{
						for(int j=0;j<nbJ;j++)
						{
							/*Remise à zéro de la position ennemie*/
							if((J[idE][j].ennemi.x == m->shipPosition[s[i].id].x) && (J[idE][j].ennemi.y == m->shipPosition[s[i].id].y))
							{
								J[idE][j].ennemi.x = -1;
								J[idE][j].ennemi.y = -1;
							}

						}
					}

					/*Supression du bateau de la map*/
					m->map[m->shipPosition[s[i].id].y][m->shipPosition[s[i].id].x].id = -1;
					m->map[m->shipPosition[s[i].id].y][m->shipPosition[s[i].id].x].type = ENT_SEA;
					m->shipPosition[s[i].id].x = -100;	m->shipPosition[s[i].id].y = -100;
				}
			}
	}

	/*Mise à jour du nombre de joueurs dans chaque équipe*/
	printf("----------Etat des équipes----------\n");
	for(int i=0;i<m->nbShips/2;i++)
	{

		if(nbJoueursRestantsParEquipe(m,J,i) < cmp_bat[i])
		{
			while(nbJoueursRestantsParEquipe(m,J,i) < cmp_bat[i]) cmp_bat[i] -= 1;
			if(cmp_bat[i] <= 0) (*nb_equipes) -= 1;
		}

		printf("Equipe %d --> %d joueurs\n",i,cmp_bat[i]);
	}

	printf("Nombre d'équipes : %d\n",*nb_equipes);


	return J;
}

/**Vérification des conditions de victoire
 * @param m, la map.
 * @param nb_bat,la tableau de compteurs de joueurs par équipe.
 * @param cmp_bat, le nombre d'équipes encore en vie*/
void gagne_equipe(navalmap_t*m,int*nb_bat,int cmp_bat)
{
	int nbBatMax = nb_bat[0];
	int idE_gagnant = 0;

	if(cmp_bat == 1)
	{
		/*Recherche de l'équipe gagnante*/
		for(int idE = 1;idE < m->nbShips/2;idE++)
			if(nbBatMax < nb_bat[idE])
			{
				nbBatMax = nb_bat[idE];
				idE_gagnant = idE;
			}

		printf("Equipe %d a gagné\n",idE_gagnant);
	}
	else printf("EGALITE ! \n");
}

/**Algorithme de décision*/
void* choice(void *a)
{
	Joueur *J = (Joueur*)a;

	pthread_mutex_lock(J->m);

	if(J->compteur%4 == 0)
	{
		J->choice.c = RADARGLOB;
		J->choice.categorie=3;
	}
	else if(J->compteur%7 == 0)
	{
		J->choice.c = RADARLOC;
		J->choice.categorie=3;
	}
	else if(est_attaquable(J->map,J->etat.id,J->ennemi))
	{
		J->choice.c = ATTAQUE;
		J->choice.categorie=1;
	}
	else if(est_chargeable(J->map,J->etat.id,J->ennemi))
	{
		J->choice.c = CHARGE;
		J->choice.categorie=2;
	}
	else if(((J->etat.coque>0)&&(J->etat.coque <= 25))&&(J->etat.kerosene >= 60))
	{
		J->choice.c = REPARATION;
		J->choice.categorie=3;
	}
	else
	{
		J->choice.c = DEPLACEMENT;
		J->choice.categorie=2;
	}

	pthread_mutex_unlock(J->m);
}

/**Tri des actions selon leur catégorie
 * @param n, la map.
 * @param J, le tableau des équipes et de leur joueurs
 * @param nb_joueurs, le nombre de joueurs encore présent
 * @return le tableau ordonné des choix.*/
CHOIX * ordre_des_actions(navalmap_t *n,Joueur**J,int nb_joueurs)
{
	CHOIX * sauv = malloc(sizeof(CHOIX)*nb_joueurs);
	if(!sauv)
	{
		fprintf(stderr,"ERREUR : ALLOCATION DU TABLEAU DE CHOIX\n");
		exit(EXIT_FAILURE);
	}
	int cat = 1;
	int g = 0;

	while(cat <= 3)
	{
		for(int i=0;i<n->nbShips/2;i++)
		{
			for(int j=0;j<2;j++)
			{
				if(est_present(n,J[i][j].etat.id))
				{
					if(J[i][j].choice.categorie == cat)
					{
						sauv[g] = J[i][j].choice;
						g++;
					}
				}
			}
		}

		cat++;
	}

	return sauv;

}
/**Application de l'algorithme de décision
 * @param c, le tableau des choix trié selon les catégories.
 * @param J, le tableau des données des équipes et de leur joueurs.
 * @param s, le tableau de l'état des bateaux.
 * @param n, la map.
 * @param nbE, le nombre d'équipes.
 * @param nbJ, le nombre de joueurs.
 * @param cmpJ, le nombre de joueurs restants.
 * @param tour, le tour de jeu.*/
void apply_choice(CHOIX*c,Joueur**J,navalmap_t*n,SHIP *s,int nbE,int nbJ,int cmpJ,int tour)
{
	coord_t pos;

	for(int j=0;j<cmpJ;j++)					/*Parcours du tableau de choix*/
	{
		for(int nE=0;nE<nbE;nE++)				/*Parcours du tableau des équipes*/
		{
			for(int nJ=0;nJ<nbJ;nJ++)
			{
				if(c[j].id == J[nE][nJ].choice.id)
				{
					printf("## Equipe : %d ## Joueur : %d --> %d coque | %d kerosene ##\n",J[nE][nJ].equipe,J[nE][nJ].etat.id,J[nE][nJ].etat.coque,J[nE][nJ].etat.kerosene);

					if(J[nE][nJ].choice.c == RADARGLOB)
					{
						mise_a_jour_radar_global(n,J,s,nE,nbJ,nbE,nJ);
						n->nbShips = nbE*2;
					}
					else if(J[nE][nJ].choice.c == RADARLOC)
					{
						mise_a_jour_radar_local(n,J,s,nE,nbJ,nbE,nJ);
						n->nbShips = nbE*2;
					}
					else if(J[nE][nJ].choice.c == ATTAQUE)ATK(s,n,J[nE][nJ].etat.id,J[nE][nJ].ennemi);
					else if(J[nE][nJ].choice.c == CHARGE) BST(n,s,J[nE][nJ].etat.id,J[nE][nJ].ennemi);
					else if(J[nE][nJ].choice.c == REPARATION) RPR(s,J[nE][nJ].etat.id);
					else if(J[nE][nJ].choice.c == DEPLACEMENT)
					{
						pos.x = (rand()%5)-2;
						pos.y = (rand()%5)-2;
						MOV(s,n,J[nE][nJ].etat.id,pos);
					}

					J[nE][nJ].etat = s[J[nE][nJ].etat.id];
					J[nE][nJ].compteur = tour;

					printf("\n");
				}
			}
		}
	}
}

/**Mode equipe vs equipe
 * @param n, la map.
 * @param s, le tableau de l'état des bateaux.
 * @param tours, le nombre de tours de jeu.*/
void grp_vs_grp(navalmap_t*n,SHIP*s,int tours)
{
	coord_t pos;
	int check,tube;
	int l = 0;
	int nbE = n->nbShips/2;												/*Nombre d'équipes*/
	int *nbBat = malloc(nbE*sizeof(int));								/*Tableau de compteurs des joueurs par équipe*/
	if(!nbBat)
	{
		fprintf(stderr,"ERREUR : ALLOCATION DU TABLEAU DE COMPTEURS\n");
		exit(EXIT_FAILURE);
	}
	int cmpE = n->nbShips/2;											/*Compteur du nombre d'équipes*/
	int fd[2];															/*Tableau de descripteurs de fichier*/
	int cmp_bat;
	int cmpJ = 0;														/*Compteur de joueurs*/
	pid_t pid;
	pthread_t tid[nbJ];													/*Numéro des threads*/
	pthread_mutex_t mut;
	Joueur **J = malloc(nbE*sizeof(Joueur*));							/*Tableau des équipes et de leur joueurs*/
	if(!J)
	{
		fprintf(stderr,"ERREUR : ALLOCATION DU TABLEAU DE JOUEURS DANS LE MODE EQUIPE VS EQUIPE\n");
		exit(EXIT_FAILURE);
	}
	for(int i=0;i<nbE;i++)
	{
		J[i] = malloc(nbJ*sizeof(Joueur));
		if(!J[i])
		{
			fprintf(stderr,"ERREUR : ALLOCATION DU TABLEAU DE JOUEURS DANS LE MODE EQUIPE VS EQUIPE\n");
			exit(EXIT_FAILURE);
		}
	}

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

		 placeShip(n,i,pos);
		 s[i].id = i;													/*Initialisation des identifiants*/
		 printf("%d %d %d\n",n->shipPosition[i].x,n->shipPosition[i].y,n->map[pos.y][pos.x].id);
	  }


																		/*Initialisation du tableau des équipes*/
	  pthread_mutex_init(&mut,NULL);

	  for(int i=0;i<nbE;i++)
	  {
		  nbBat[i] = nbJ;

		  for(int j=0;j<nbJ;j++)
		  {
			  J[i][j].equipe = i;
			  J[i][j].compteur = 0;
			  J[i][j].m = &mut;
			  J[i][j].ennemi.x = -1;
			  J[i][j].ennemi.y = -1;
			  J[i][j].map = n;
			  J[i][j].choice.c = VIDE;
			  J[i][j].choice.categorie = 0;
			  J[i][j].choice.id = s[l].id;
			  J[i][j].etat = s[l];
			  l++;
			  printf("%d %d\n",J[i][j].equipe,J[i][j].etat.id);
		  }
	  }


	  tube = pipe(fd);															/*Création du tube*/
	  if(tube == -1)
		{
			fprintf(stderr,"ERREUR : ECHEC DE LA CREATION DU TUBE\n");
			exit(EXIT_FAILURE);
		}

	  for(int i=1;i<=tours;i++)
	  {
		  printf("----------Tour %d----------\n",i);

		  if(cmpE > 1)													/*Vérification du nombre d'équipes*/
		  {
			  for(int idE=0;idE<nbE;idE++)
			  {
				  pid = fork();

					  if(pid == -1)
					  {
						  fprintf(stderr,"ERREUR : ECHEC DE CREATION DU PROCESSUS\n");
						  exit(EXIT_FAILURE);
					  }
					  else if(pid == 0)
					  {
						  check = read(fd[0],J[idE],sizeof(Joueur)*nbJ);/*Récupération de l'équipe qui joue*/
						  if(check == -1)
						  {
							  fprintf(stderr,"ERREUR : ECHEC DE LECTURE DANS LE TUBE\n");
							  exit(EXIT_FAILURE);
						  }
																		/*Création des threads*/
						  for(int j=0;j<nbJ;j++)
						  {
							  if((est_present(n,J[idE][j].etat.id))&&(nbBat[idE] > 0))
							  {
								  pthread_create(&(tid[j]),NULL,choice,&(J[idE][j]));
							  }
						  }


																		/*Destruction des threads*/
						  for(int j=0;j<nbJ;j++)
						  {
							if((est_present(n,J[idE][j].etat.id))&&(nbBat[idE] > 0))
							{
								pthread_join(tid[j],NULL);
							}
						  }

						  check = write(fd[1],J[idE],sizeof(Joueur)*nbJ); /*Envoi des données de l'équipe*/
						  if(check == -1)
						  {
							  fprintf(stderr,"ERREUR : ECHEC D'ECRITURE DANS LE TUBE\n");
							  exit(EXIT_FAILURE);
						  }


						exit(0);
					  }
					  else
					  {
						  check = write(fd[1],J[idE],sizeof(Joueur)*nbJ);	/*Envoi des données de l'équipe*/
						  if(check == -1)
						  {
							  fprintf(stderr,"ERREUR : ECHEC D'ECRITURE DANS LE TUBE\n");
							  exit(EXIT_FAILURE);
						  }

						  wait(NULL);

						  read(fd[0],J[idE],sizeof(Joueur)*nbJ);		/*Réception des données de l'équipe*/
						  if(check == -1)
						  {
							  fprintf(stderr,"ERREUR : ECHEC DE LECTURE DANS LE TUBE\n");
							  exit(EXIT_FAILURE);
						  }

						  cmpJ += nbJoueursRestantsParEquipe(n,J,idE);  /*Calcul du nombre de joueurs*/

						  if(cmpJ == nbJoueursRestants(n,J))
						  {
							  CHOIX *c = ordre_des_actions(n,J,cmpJ);	/*Connaissance de l'ordre des actions*/

							  apply_choice(c,J,n,s,nbE,nbJ,cmpJ,i);

							  cmpJ = 0;
							  free(c);
						  }
					   }
				}

				J = verification_etat(n,s,nbBat,&cmpE,J);
			}
	  }

	  gagne_equipe(n,nbBat,cmpE);

	  free(nbBat);
	  for(int i=0;i<nbE;i++)free(J[i]);
	  free(J);
	  close(fd[0]); close(fd[1]);
	  pthread_mutex_destroy(&mut);
}
