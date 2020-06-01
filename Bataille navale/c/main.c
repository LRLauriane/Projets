#include "../h/jeu.h"

int main(int argc, char**argv)
{
	int mode = 0,check;

	printf("#################### MODE DE JEU ####################\n");
	printf("1 --> Seul contre tous\n");
	printf("2 --> Equipe contre équipe\n");
	printf("Entrez le numéro du mode : ");
	check = scanf("%d",&mode);
	if(check == -1)
	{
		fprintf(stderr,"ERREUR : lecture entrée clavier\n");
		exit(EXIT_FAILURE);
	}

	while((mode != 1) && (mode != 2))
	{
		check = scanf("%d",&mode);
		if(check == -1)
		{
			fprintf(stderr,"ERREUR : lecture entrée clavier\n");
			exit(EXIT_FAILURE);
		}
	}

	//Initialisation des variables
	char *sauv;
	navalmap_t*m=malloc(sizeof(navalmap_t));
		if(!m)
		{
			fprintf(stderr,"ECHEC D'ALLOCATION\n");
			exit(EXIT_FAILURE);
		}

	int tours,coque,kerosene;
	navalmap_t*n;


	/*Initialisation du tableau de sauvegarde de l'état des bateaux*/
	initNavalMapLib ();
	sauv = lecture_fichier(argv[1]); 									/*Lecture dans le fichier d'entrée*/
	init_param(m,&tours,&coque,&kerosene,sauv); 						/*Récupération des paramètres de jeu*/
	free(sauv);


	if(mode == 1)
	{
		n = init_navalmap(m->type,m->size,m->nbShips);

		SHIP*s = malloc((n->nbShips)*sizeof(SHIP));
		if(!s)
		{
			fprintf(stderr,"ECHEC D'ALLOCATION\n");
			exit(EXIT_FAILURE);
		}

		init_ship(s,kerosene,coque,n->nbShips);
		seul_contre_tous(n,s,tours);

		free(s);
	}
	 else if (mode==2)
	 {
		m->nbShips = (m->nbShips)*2;
		n = init_navalmap(m->type,m->size,m->nbShips);
		SHIP*s1 = malloc((n->nbShips)*sizeof(SHIP));

		for(int i=0;i<n->nbShips;i++) init_ship(s1,kerosene,coque,n->nbShips);

		grp_vs_grp(n,s1,tours);

		free(s1);
	}

	free(m);
	free_navalmap(n);

	return 0;
}
