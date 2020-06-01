#include "../h/graphe.h"

#define N 100

int main()
{
	GRAPHE G;
	TABLE* b;

	/*Initialisation des noeuds*/
	G = init_GRAPHE(N);
	G = backbone(G);
	G = op_transit(G);
	G = op_niv3(G);

	if(est_connexe(G) == 1) printf("Le graphe est connexe\n");
	else printf("Le graphe n'est pas connexe\n");

	/*Vérification de la connexité du graphe*/
	while(!est_connexe(G))
	{
		G = init_GRAPHE(N);
		G = backbone(G);
		G = op_transit(G);
		G = op_niv3(G);
		if(est_connexe(G) == 1) printf("Le graphe est connexe\n");
		else printf("Le graphe n'est pas connexe\n");
	}

	/*Affichage du réseau*/
	for(int i=0;i<G.nb_sommets;i++)
	{
		printf("Noeud : %d Type: %d\n",i,G.tab[i].type);
		afficher_LISTE(G.tab[i].voisins);
		printf("###########################################\n");
	}

	/*Calcul de la table de routage de chaque noeud*/
	b = calcul_table_routage_all_noeuds(G);

	/*Affichage de chaque table de routage*/
	for(int i=0;i<G.nb_sommets;i++)
	{
		affiche_table(b[i]);
		printf("##########################################\n");
	}

	/*Affichage du chemin entre 2 noeuds*/
	chemin(b,99,0);

	/*Libération de la mémoire*/
	for(int i=0;i<G.nb_sommets;i++)
	{
		while(b[i] != NULL)
		{
			free(b[i]);
			b[i] = b[i]->suivant;
		}
		sup_LISTE(G.tab[i].voisins);
	}
	free(G.tab);
	free(b);


	return 0;

}
