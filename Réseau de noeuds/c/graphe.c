#include "../h/graphe.h"

/*####################CREATION DU GRAPHE####################*/

/*Initialisation du graphe
 * @param n, le nombre de sommets.
 * @return un graphe initialisé*/
GRAPHE init_GRAPHE(int n)
{
	GRAPHE G;
	G.nb_sommets = n;
	G.tab = malloc(n*sizeof(NOEUD));
	if(!G.tab)
	{
		fprintf(stderr,"échec allocation de mémoire pour le graphe");
		exit(EXIT_FAILURE);
	}
	for(int i=0;i<n;i++)
	{
		G.tab[i].type = 0;												/*Mise à 0 du type pour chaque noeud*/
		G.tab[i].voisins = init_LISTE();								/*Initialisation de la liste des voisins pour chaque noeud*/
	}
	return G;
}

/*Initialisation des liens du backbone
 * @param G, le graphe.
 * @return le graphe avec les liends du backbone initialisés*/
GRAPHE backbone(GRAPHE G)
{
	int nb;
	for(int i=0;i<8;i++)												/*Pour les 8 noeuds représentant le backbone*/
	{
		for(int j=0;j<8;j++)
		{
			G.tab[i].type = 1;											/*Mise à jour de son type*/

			if(i<j)
			{
				if((rand()%1001) <= (0.75*1000))						/*Tir d'un nombre aléatoire selon un probabilité de 75%*/
				{
					nb=rand()%6+5; 										/*Tir d'une valeur aléatoire entre 5 et 10 pour le poids du lien*/
					G.tab[i].voisins = add_LISTE(G.tab[i].voisins,j,nb);/*Mise à jour des listes des 2 noeuds*/
					G.tab[j].voisins = add_LISTE(G.tab[j].voisins,i,nb);

				}
			}
		}
	}

	return G;
}




/*Savoir si un noeud est déjà voisin d'un autre*/
int est_voisin(GRAPHE G,int sommet,int voisin_possible)
{
	LISTE l = G.tab[sommet].voisins;
	while(l != NULL)													/*Tant qu'on n'est pas au début de la liste*/
	{
		if(l -> noeud == voisin_possible) return 1;						/*Si le noeud est voisin du noeud donné en argument*/
		l = l ->suivant;
	}
	return 0;
}

//Compter le nombre de noeud de type 2
int nb_noeud_niv2(GRAPHE G,int sommet)
{
	LISTE l = G.tab[sommet].voisins;
	int n,nb_nn2=0;

	while(l != NULL)
	{
		n=l->noeud;
		if(G.tab[n].type == 2) nb_nn2+=1;
		l = l ->suivant;
	}

	return nb_nn2;
}

//Initialialiser les liens de noeuds de type 2 avec ceux du backbone
GRAPHE lien_niv1(GRAPHE G)
{
	int noeud1,num,num2,valeur;

	for(int i=8;i<28;i++)
	{
		G.tab[i].type = 2;

		noeud1 = rand()%2+1;											/*Choix du nombre de noeuds de niveau 1 devant se lier à un noeud de tiers 2*/

		if(noeud1 == 1)													/*Si ce choix est de 1*/
		{
			num = rand()%8;												/*Tir du numéro du noeud aléatoirement*/
			valeur = rand()%11+10;										/*Tir de la valeur du lien*/
			G.tab[i].voisins = add_LISTE(G.tab[i].voisins,num,valeur);	/*Mise à jour des 2 listes*/
			G.tab[num].voisins = add_LISTE(G.tab[num].voisins,i,valeur);
		}else if(noeud1==2)												/*Si ce choix est de 2*/
		{
			num = rand()%8;												/*Tir du numéro du premier noeud aléatoirement*/
			valeur = rand()%11+10;										/*Tir de la valeur aléatoirement du lien*/
			G.tab[i].voisins = add_LISTE(G.tab[i].voisins,num,valeur);	/*Mise à jour des 2 listes*/
			G.tab[num].voisins = add_LISTE(G.tab[num].voisins,i,valeur);
			num2 = rand()%8;											/*Tir du numéro du second noeud aléatoirement*/
			while(num==num2){num2=rand()%8;}							/*Tant que le numéro tiré est le même que le premier noeud tiré*/
			valeur = rand()%11+10;										/*Tir aléatoire de la valeur du lien*/
			G.tab[i].voisins = add_LISTE(G.tab[i].voisins,num2,valeur);	/*Mise à jour des listes*/
			G.tab[num2].voisins = add_LISTE(G.tab[num2].voisins,i,valeur);
		}

	}

	return G;
}

//Initialiser les liens des noeuds de type 2 avec ceux de type 2
GRAPHE lien_niv2(GRAPHE G)
{
	int noeud2,num,valeur;

	for(int i=8;i<28;i++)												/*Parcours des noeuds de tiers 2*/
	{
		noeud2 = rand()%2+2;											/*Tir aléatoire du nombre de noeuds de tiers 2*/
		while(nb_noeud_niv2(G,i) < noeud2)								/*Tant que ce nombre tiré n'est pas atteint dans la liste*/
		{
			num = rand()%20+8;											/*Tir un numéro de noeud du tiers 2 aléatoirement*/
			/*Vérification qu'il n'a pas déjà le nombre de noeuds du tiers 2 atteint, qu'ils ne sont pas déjà voisins et que ce n'est pas lui-même*/
			while((nb_noeud_niv2(G,num)==3) || (num==i) || (est_voisin(G,i,num))) num = rand()%20+8;

			valeur = rand()%11+10;										/*Tir de la valeur aléatoire du lien*/
			G.tab[i].voisins = add_LISTE(G.tab[i].voisins,num,valeur);	/*Mise à jour des listes*/
			G.tab[num].voisins = add_LISTE(G.tab[num].voisins,i,valeur);
		}

	}

	return G;
}

//Initialiser les noeuds de type 2
GRAPHE op_transit(GRAPHE G)
{
	G = lien_niv1(G);
	G = lien_niv2(G);
	return G;
}

//Compter le nombre de noeud de type 3 pour un sommet donné
int nb_noeud_niv3(GRAPHE G,int sommet)
{
	LISTE l = G.tab[sommet].voisins;
	int n,nb_nn3=0;

	while(l != NULL)
	{
		n=l->noeud;
		if(G.tab[n].type == 3) nb_nn3+=1;
		l = l ->suivant;
	}

	return nb_nn3;
}

//Initialiser les noeuds de type 3
GRAPHE op_niv3(GRAPHE G)
{
	int num,num2,valeur;

	for(int i=28;i<100;i++)												/*Parcours des noeuds de tiers 3*/
	{
		G.tab[i].type = 3;												/*Mise à jour de leur type*/

		num = rand()%20+8;												/*Tir aléatoire du numéro des noeuds de tiers 2*/
		num2 = rand()%20+8;
		/*Tant que les deux numéros sont identiques et qu'ils sont voisins du noeud en question*/
		while((num==num2) || (est_voisin(G,i,num)) || (est_voisin(G,i,num2))){num=rand()%20+8; num2=rand()%20+8;}

		valeur = rand()%36+15;											/*Tir de la valeur aléatoire du lien*/
		G.tab[i].voisins = add_LISTE(G.tab[i].voisins,num,valeur);		/*Mise à jour des listes*/
		G.tab[num].voisins = add_LISTE(G.tab[num].voisins,i,valeur);

		valeur = rand()%36+15;
		G.tab[i].voisins = add_LISTE(G.tab[i].voisins,num2,valeur);
		G.tab[num2].voisins = add_LISTE(G.tab[num2].voisins,i,valeur);
	}

	for(int i=28;i<100;i++)
	{
		if(nb_noeud_niv3(G,i)==0)										/*Si le nombre de noeuds du tiers 3 est nul*/
		{
			num = rand()%72+28;											/*Tir aléatoire du numéro du noeud*/
			/*Tant que le numéro du noeud n'est pas lui-même et que le nombre de liens avec des noeuds du tiers 3 est supérieur ou égal à 1*/
			while((num==i)||(nb_noeud_niv3(G,num)>=1)) num = rand()%72+28;
			G.tab[i].voisins = add_LISTE(G.tab[i].voisins,num,valeur);	/*Mise à jour des listes*/
			G.tab[num].voisins = add_LISTE(G.tab[num].voisins,i,valeur);
		}
	}
	return G;
}


/*####################CREATION DES TABLES DE ROUTAGE####################*/
TABLE ajout_element(TABLE b, int sommet, int distance, int pere)
{

	TABLE new;
	new = malloc(sizeof(struct table));
	new->sommet = sommet;
	new->distance = distance;
	new->pere = pere;
	new->suivant = b;

	return new;
}

// retourne la distance d'un sommet à son père
int distance(GRAPHE G, int sommet, int pere)
{
	if(sommet==pere) return 0; // la distance d'un sommet à lui-même = 0
	LISTE l = G.tab[pere].voisins;
	while(l!=NULL )
	{
		if(l->noeud==sommet)
			return l->lien;
		l = l->suivant;
	}
	return 2500; // si sommet et père ne sont pas voisins donc père n'est pas le père de sommet

}



// initialisation algorithme de Dijsktra
TABLE initialisation_Dijkstra(GRAPHE G,int sommet)
{
	TABLE t = NULL;

	// distance minimale pour pouvoir déterminer le prochain sommet à traiter
	int minimum = distance(G,G.tab[sommet].voisins->noeud,sommet);


	int i;
	for(i=G.nb_sommets-1;i>=0;i--)
	{
		if(i!=sommet)//pour ne pas traiter le sommet à lui-même
		{

			if(est_voisin(G,sommet,i))
			{
				t = ajout_element(t,i,distance(G,i,sommet),sommet);
				if(distance(G,i,sommet)<minimum)
				{
					minimum = distance(G,i,sommet);
				}
			}
			else
				t = ajout_element(t,i,distance(G,i,sommet),-1);
		}
		else //traiter le sommet à lui-même
		{
			t = ajout_element(t,i,distance(G,i,sommet),sommet);
		}
	}
	return t;
}



//donner le père d'un sommet
int pere(TABLE t, int sommet)
{
	while(t!=NULL)
	{
		if(t->sommet==sommet)
			return t->pere;
		t = t->suivant;
	}

	return -5;//retourner une valeur impossible du pere pour montrer que le sommet passé en argument n'existe pas

}

int distance_sommet(TABLE t, int sommet) // récupérer la valeur distance du sommet
{

	while(t!=NULL)
	{
		if(t->sommet==sommet)
			return t->distance;
		t = t->suivant;
	}

	return -5;//retourner une valeur impossible d'une distance pour montrer que le sommet passé en argument n'existe pas


}

int tous_les_sommets_traites(int T[100]) // tester si tous les sommets sont traités
{
	for(int i=0;i<100;i++)
	{
		if(T[i]==0)
			return 0;
	}
	return 1;

}

int sommet_non_traite(int T[100], int sommet)
// tester si le sommet est traité
{

	if(T[sommet]==0)
		return 1;
	return 0;
}

int premier_sommet_a_traiter(int T[100])
{
	int i;
	for(i=0;i<100;i++)
	{
		if(sommet_non_traite(T,i))
			return i;
	}

	return -6; // tous les sommets sont déjà traités
}

int prochain_sommet_a_traiter(int T[100],TABLE t)
{
	int proch_sommet = premier_sommet_a_traiter(T);
	int dist_min;
	TABLE new = t;
	while(new!=NULL)
	{
		if(new->sommet==proch_sommet)
			dist_min = new->distance;
		new = new->suivant;
	}// parcourir la table jusqu'au premier sommet potentiel à traiter

	new = t;
	while(new!=NULL)
	{
		if((new->distance<dist_min)&&(T[new->sommet]==0))
		//distance minimum dans le tableau et non traité
		{
			proch_sommet = new->sommet;
			dist_min = new->distance;
		}
		new = new->suivant;
	}
	return proch_sommet;

}


// sommet source de départ
TABLE b_p_d(GRAPHE G, TABLE t, int source)
{
	TABLE new = t;
	int T[G.nb_sommets]; //tableau pour gérer les sommets traités
	int i;
	for(i=0;i<G.nb_sommets;i++)
	{
		if(i==source)
			T[i] = 1;//mettre comme étant sommet traité le sommet source
		else
			T[i] = 0;
	}
	int sommet_a_traiter = prochain_sommet_a_traiter(T,new); //sommet non traité précédemment et minimum

	while(tous_les_sommets_traites(T)==0)
	{
		T[sommet_a_traiter] = 1;
		while(new!=NULL)
		{
			if(est_voisin(G,sommet_a_traiter,new->sommet)
			&&(sommet_non_traite(T,new->sommet))) // si c'est le cas on compare la distance
			{
				if((distance(G,new->sommet,sommet_a_traiter) + distance_sommet(t,sommet_a_traiter))
				<distance_sommet(t,new->sommet)) // si la distance est plus petite on modifie sinon non
					{
					new->distance = distance(G,new->sommet,sommet_a_traiter) + distance_sommet(t,sommet_a_traiter);
					new->pere = sommet_a_traiter;
					}
			}
			new = new ->suivant;
		}
		new = t;
		sommet_a_traiter = prochain_sommet_a_traiter(T,t);
	}
	return t;
}


void affiche_table(TABLE b)
{
	while(b!=NULL)
	{
		printf("sommet : %2d, distance : %d, père : %d\n",b->sommet,b->distance,b->pere);
		b = b->suivant;
	}

}



//algo de dijkstra à appliquer pour tous les noeuds du graphe
TABLE* calcul_table_routage_all_noeuds (GRAPHE G)
{
	TABLE * routage = malloc(100*sizeof(TABLE));

	int i ;
	for(i=0;i<G.nb_sommets;i++)
	{
		routage[i] = initialisation_Dijkstra(G,i);
	}

	for(i=0;i<G.nb_sommets;i++)
	{
		routage[i] = b_p_d(G,routage[i],i);

	}
	return routage;

}
/*####################ETABLIR LE CHEMIN ENTRE 2 NOEUDS####################*/
void chemin(TABLE*T,int emetteur, int destinataire)
{

	if(emetteur>99 ||emetteur <0
	||destinataire>99 ||destinataire <0)
	{
		printf("Le destinataire et l'emetteur doivent être compris en 0 et 100");
		return;
	}
	TABLE emet = T[emetteur];
	int dest = destinataire;

	printf("Chemin entre %d et %d : ",emetteur,destinataire);
	while(pere(emet,dest)!=emetteur)
	{
		printf("%d <-- ",dest);
		dest = pere(emet,dest);
	}

	printf("%d <-- %d\n",dest,emetteur);
}

/*####################VERIFICATION DE LA CONNEXITE####################*/
void explorer_sommet(GRAPHE G,int*couleur,int sommet)
{
	couleur[sommet] =1;													/*Mise à 1 de la case correspondant au noeud pour indiquer qu'il a été visité*/
	LISTE l = G.tab[sommet].voisins;
	while(l!=NULL)														/*Parcours de ses voisins*/
	{
		if(couleur[l->noeud]==0)										/*Si le voisin n'a pas encore été visité, le marquer*/
			explorer_sommet(G,couleur,l->noeud);						/*Exploration de ses voisins*/
		l = l->suivant;
	}
}

/*Dis si le graphe est connexe ou non*/
int est_connexe(GRAPHE G)
{
	int* couleur = calloc(G.nb_sommets,sizeof(int));					/*Allocation d'un tableau de taille du nombre de sommets mis à 0*/
	explorer_sommet(G,couleur,0);										/*Exploration du graphe*/
	for(int i=0;i<G.nb_sommets;i++)										/*Parcours du tableau pour savoir si tous les noeuds ont été visités*/
	{
		if(couleur[i]!=1)
		{
			free(couleur);
			return 0;
		}
	}

	free(couleur);
	return 1;
}
