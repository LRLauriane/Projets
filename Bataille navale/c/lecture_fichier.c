#include <string.h>
#include <unistd.h>
#include <sys/types.h>
#include <sys/stat.h>
#include <fcntl.h>
#include "../h/lecture_fichier.h"

/**Conversion d'un caractère en entier
 * @param t, un tableau de caractères.
 * @param i, le décalage dans le tableau
 * @return les caractères convertient en nomnre.*/
int chartoint(char*t,int i)
{
	int a;
	/*Parcours des 10 caractères représentant les entiers
	  En principe, les nombres se trouvant dans le fichier ne peuvent dépasser 3 chiffres*/
	for(char j='0';j<='9';j++)
	{
		for(char k='0';k<='9';k++)
		{
			for(char l='0';l<='9';l++)
			{
				/*Si on lit 1 chiffre*/
				if((t[i+1]==j)&&((t[i+2]==';')||(t[i+2]=='\n')))
				{
					char c1[2];
					c1[0]=j; c1[1]='\0';
					a = atoi(c1);
				}
				/*Si on lit 2 chiffres*/
				else if((t[i+1]==j)&&(t[i+2]==k)&&((t[i+3]==';')||(t[i+3]=='\n')))
				{
					char c1[3];
					c1[0]=j; c1[1]=k; c1[2]='\0';
					a = atoi(c1);
				}
				/*Si on lit 3 chiffres*/
				else if((t[i+1]==j)&&(t[i+2]==k)&&(t[i+3]==l)&&((t[i+4]==';')||(t[i+4]=='\n')))
				{
					char c1[4];
					c1[0]=j; c1[1]=k; c1[2]=l; c1[3]='\0';
					a = atoi(c1);
				}
			}
		}
	}

	return a;
}

/**Suivi de lecture dans le tableau de caractères représentant le fichier
 * @param a, le nombre que l'on obtient de la conversion
 * @return le décalage à appliquer pour lire le nombre suivant dans le tableau*/
int decalage(int a)
{
	int i = 0;

	if(a < 10) i = i+2;
	else if((a >=10)&&(a<=99))i=i+3;
	else if(a >=100)i=i+4;

	return i;
}

/**Lecture dans le fichier et mise du contenu du fichier dans un tableau
 * @param chemin, le chemin du fichier
 * @return le tableau de caractères représentant le fichier*/
char* lecture_fichier(const char* chemin)
{
	int fd = open(chemin,O_RDONLY),i=0,check;							//Ouverture du fichier en lecture
		if(fd==-1) printf("ERREUR D'OUVERTURE\n");
	struct stat taille;
	stat(chemin,&taille);
	char c;
	char *sauv = malloc(taille.st_size*sizeof(char));
	if(!sauv)
	{
		fprintf(stderr,"ECHEC D'ALLOCATION DE MEMOIRE\n");
		exit(EXIT_FAILURE);
	}

	check = read(fd,&c,sizeof(char));
	if(check == -1)
	{
		fprintf(stderr,"ERREUR de lecture dans le fichier\n");
		exit(EXIT_FAILURE);
	}

	while(check > 0)
	{
		sauv[i] = c;
		i++;

		check = read(fd,&c,sizeof(char));
		if(check == -1)
		{
			fprintf(stderr,"ERREUR de lecture dans le fichier\n");
			exit(EXIT_FAILURE);
		}
	}

	close(fd);

	return sauv;
}

/**Initialisation du tableau sauvegardant l'état de chaque bateau
 * @param s, un pointeur sur le tableau de sauvegarde.
 * @param kerosene, le nombre de kerosene d'un bateau.
 * @param coque, la vie de la coque.
 * @param nb_ship, le nombre de bateaux à sauvegarder*/
void init_ship(SHIP*s,int kerosene,int coque,int nb_ship)
{
	for(int i=0;i<nb_ship;i++)
	{
		s[i].kerosene = kerosene;
		s[i].coque = coque;
	}
}

/**Initialisation des paramètres pour la création de la map et la sauvegarde des bateaux crées sur cette map
 * @param m, un pointeur de la map.
 * @param s, un tableau de bateaux.
 * @param nb_tours, le nombre de tours.
 * @param sauv, le tableau de caractères représentant le fichier.*/
void init_param(navalmap_t*m,int*nb_tours,int *coque,int *kerosene,char*sauv)
{
	int i=0;

	/*Initialisation du type de la map*/
	if((sauv[0]=='r')&&(sauv[1]=='e')&&(sauv[2]=='c')&&(sauv[3]=='t')&&(sauv[4]=='a')&&(sauv[5]=='n')&&(sauv[6]=='g')&&(sauv[7]=='l')&&(sauv[8]=='e'))
	{
		m->type = MAP_RECT;
		printf("Map rectangulaire\n");
	}
	else m->type = MAP_TOTAL;

	/*Recherche du prochain paramètre dans le tableau*/
	while((sauv[i]!=';')&&(sauv[i]!='\n')&&(sauv[i]!='\0')) i++;

	/*Initialisation de la taille de la map*/
	m->size.x = chartoint(sauv,i);
	i = i+decalage(m->size.x);

	m->size.y = chartoint(sauv,i);
	i=i+decalage(m->size.y);

	/*Initialisation du nombre de bateaux*/
	m->nbShips=chartoint(sauv,i);
	i=i+decalage(m->nbShips);

	/*Initialisation des paramètres du bateau*/
	*coque = chartoint(sauv,i);
	i=i+decalage(*coque);
	*kerosene = chartoint(sauv,i);
	i=i+decalage(*kerosene);

	/*Initialisation du nombre de tours*/
	*nb_tours=chartoint(sauv,i);

}
