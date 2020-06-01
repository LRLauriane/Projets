#include <string.h>
#include <math.h>
#include <unistd.h>
#include <sys/types.h>
#include <sys/stat.h>
#include <fcntl.h>
#include "../h/actions.h"

/**Vérification de la possibilité de déplacement
 * @param m, la map.
 * @param shipID, l'identifiant du bateau voulant se déplacer.
 * @param deplacement, le vecteur de déplacement.*/
int est_deplacable(navalmap_t*m,int shipID,coord_t deplacement)
{
	if((deplacement.x==0)&&((deplacement.y == 1)||(deplacement.y == 2)||(deplacement.y == -1)||(deplacement.y == -2))
	|| (deplacement.y==0)&&((deplacement.x == 1)||(deplacement.x == 2)||(deplacement.x == -1)||(deplacement.x == -2))
	|| ((deplacement.x ==1)&&((deplacement.y == 1)||(deplacement.y == -1)))
	|| ((deplacement.x == -1)&&((deplacement.y == 1)||(deplacement.y == -1))))
		return 1;

	return 0;
}

/**Déplacement d'un bateau
 * @param s, le tableau de sauvegarde des bateaux.
 * @param m, la map.
 * @param shipID, l'id du bateau à déplacer.
 * @param pos, les coordonnées de la case d'arrivée.*/
void MOV(SHIP*s,navalmap_t*m,int shipID,coord_t deplacement)
{

	if(m->isMovePossible(m,shipID,deplacement)&&(est_deplacable(m,shipID,deplacement)))/*Vérification du la validité du mouvement*/
	{
		moveShip(m,shipID,deplacement);
		printf("%d --> MOV(%d,%d)\n",shipID,deplacement.x,deplacement.y);

		s[shipID].kerosene -=2;


		/*Vérification de la présence d'autres bateaux sur la case d'arrivée*/
		for(int i=0;i<m->nbShips;i++)
		{
			if((s[i].id!=shipID)
			&&(m->shipPosition[shipID].x==m->shipPosition[s[i].id].x)
			&&(m->shipPosition[shipID].y==m->shipPosition[s[i].id].y))
			{
				deplacement.x = -deplacement.x; deplacement.y = -deplacement.y;
				moveShip(m,shipID,deplacement);
				s[shipID].coque -= 5;
				s[i].coque -=5;
				printf("%d --> MOV(%d,%d) | Présence d'un bateau.\n",shipID,0,0);
			}
		}
	}
	else printf("%d --> MOV(%d,%d)\n",shipID,0,0);
}

/**Vérification de la possibilité d'attaquer une case
 * @param m, la map.
 * @param shipID, l'id du bateau qui veut attaquer.
 * @param arrivee, les coordonnées de la case à attaquer.
 * @return 1 si attaquable, 0 sinon.*/

int est_attaquable(navalmap_t*m,int shipID,coord_t arrivee)
{
	if(
	    ((arrivee.x == m->shipPosition[shipID].x) && (arrivee.y == m->shipPosition[shipID].y)) /*Attaque de la case où se situe la bateau*/
	  ||((arrivee.x== m->shipPosition[shipID].x+1)&&(arrivee.y== m->shipPosition[shipID].y))   /*Attaque à une case de sa position initiale*/
	  ||((arrivee.y== m->shipPosition[shipID].y+1)&&(arrivee.x== m->shipPosition[shipID].x))   /*Attaque à une case de sa position initiale*/
	  ||((arrivee.x== m->shipPosition[shipID].x-1)&&(arrivee.y== m->shipPosition[shipID].y))   /*Attaque à une case de sa position initiale*/
	  ||((arrivee.y== m->shipPosition[shipID].y-1)&&(arrivee.x== m->shipPosition[shipID].x))   /*Attaque à une case de sa position initiale*/
	  ||(arrivee.x > m->shipPosition[shipID].x+4)										   /*Attaque d'une case trop loin de sa position initiale*/
	  ||(arrivee.y > m->shipPosition[shipID].y+4)										   /*Attaque d'une case trop loin de sa position initiale*/
	  ||(arrivee.x < m->shipPosition[shipID].x-4)										   /*Attaque d'une case trop loin de sa position initiale*/
	  ||(arrivee.y < m->shipPosition[shipID].y-4)										   /*Attaque d'une case trop loin de sa position initiale*/
	  ||(arrivee.y > m -> size.y)
	  ||(arrivee.x > m -> size.x)
	  ||(arrivee.y < 0)
	  ||(arrivee.x < 0)
	  )
	    {
			return 0;
		}

	return 1;
}

/**Attaque d'une case
 * @param s, le tableau de sauvegarde de l'état des bateaux.
 * @param m, la map.
 * @param shipID, l'id du bateau qui attaque.
 * @param arrivee, les coordonnées de la case à attaquer.*/
void ATK(SHIP*s,navalmap_t*m,int shipID,coord_t arrivee)
{
	int nb_ship;
	int *id_ship;

	if(est_attaquable(m,shipID,arrivee))
	{
		s[shipID].kerosene -= 5;
		printf("%d --> ATK(%d,%d)\n",shipID,arrivee.x,arrivee.y);

		/*Recherche de la présence d'un bateau aux coordonnées de la case attaquée*/
		for(int i=0;i<m->nbShips;i++)
		{
			if((arrivee.x== m->shipPosition[s[i].id].x)&&(arrivee.y== m->shipPosition[s[i].id].y))
			{
				s[i].coque -= 40;
				printf("Bateau %d touche en plein dans le mille\n",i);

				/*Vérification des cases autour de la case visée*/
				id_ship = m->getTargets(m,arrivee,1,&nb_ship);
				if(nb_ship>0)
				{
					for(int i = 0;i<nb_ship;i++)
					{
						s[id_ship[i]].coque -= 20;
						printf("Bateau %d touche\n",id_ship[i]);
					}

				}
				free(id_ship);
			}
		}

	}
}

/**Radar scannant toute la map
 * @param m, la map/
 * @param shipID, l'id du bateau contenant le radar.
 * @param s, le tableau de sauvegarde de l'état des bateaux.
 * @param pos_enem, la position du premier bateau ennemi.
 * @return l'état du premier bateau ennemi.*/
SHIP SCN(navalmap_t*m,int shipID,SHIP *s, coord_t *pos_enem){

	 int dmin,d,id_le_plus_proche;
	 coord_t ship;

	 dmin = 100;
	 ship.x = m->shipPosition[shipID].x; ship.y = m->shipPosition[shipID].y;
	 id_le_plus_proche = -1;
	 (*pos_enem).x = -1; (*pos_enem).y = -1;

	 s[shipID].kerosene = s[shipID].kerosene - 3;

	 for(int i=0;i<m->nbShips;i++)
	 {
		 /*Si le bateau est présent sur la map*/
		 if((s[i].id!=shipID)&&((m->shipPosition[s[i].id].x >= 0)&&(m->shipPosition[s[i].id].y >=0)))
		 {
			 /*Calcul de la distance avec l'ennemi*/
			d = sqrt(pow(ship.x-m->shipPosition[s[i].id].x,2)+pow(ship.y-m->shipPosition[s[i].id].y,2));

			if(d<dmin)
			{
				dmin = d;
				pos_enem->x = m->shipPosition[s[i].id].x; pos_enem->y = m->shipPosition[s[i].id].y;
				id_le_plus_proche = i;
			}
		}
	 }

	 return s[id_le_plus_proche];

}

/**Radar scannant la map à un distance comprise entre 1 et 3
 * @param m, la map.
 * @param shipID, l'id du bateau contenant le radar.
 * @param s, le tableau de sauvegarde de l'état des bateaux.
 * @param pos_enem, la position des bateaux ennemis.
 * @return l'état des bateaux ennemis.*/
SHIP* SC(navalmap_t *m, int shipID, SHIP *s,coord_t*pos_enems,int*nbships){

	 int k=0;
	 SHIP *T=malloc(m->nbShips*sizeof(SHIP));
	 int d;
	 coord_t ship;

	 ship.x = m->shipPosition[shipID].x; ship.y = m->shipPosition[shipID].y;

	 s[shipID].kerosene -=5;

	 for(int i=0;i<m->nbShips;i++)
	 {
		 /*Si le bateau est présent sur la map*/
		 if((s[i].id!=shipID)&&((m->shipPosition[s[i].id].x >= 0)&&(m->shipPosition[s[i].id].y >=0)))
		 {
			 /*Calcul de la distance avec l'ennemi*/
			d = sqrt(pow(ship.x-m->shipPosition[s[i].id].x,2)+pow(ship.y-m->shipPosition[s[i].id].y,2));

			/*Si la distance est compris entre 1 et 3*/
			if((d==1)||(d==2)||(d==3))
			{
				T[k] = s[i];
				pos_enems[k].x = m->shipPosition[s[i].id].x; pos_enems[k].y = m->shipPosition[s[i].id].y;
				k++;
				(*nbships)++;
			}
		}
	 }

	return T;
}

/**Vérification de la possibilité du chargement d'un bateau
 * @param m, la map.
 * @param shipID, l'id du bateau voulant chargé.
 * @param arrivee, les coordonnées de la case d'arrivée.
 * @return 1 si chargeable, 0 sinon.*/
int est_chargeable(navalmap_t*m,int shipID,coord_t arrivee)
{
	if(((arrivee.x == m->shipPosition[shipID].x)&&(arrivee.y == m->shipPosition[shipID].y + 4)) /*Même colonne et à distance de 4 en ligne*/
	|| ((arrivee.x == m->shipPosition[shipID].x)&&(arrivee.y == m->shipPosition[shipID].y + 5)) /*Même colonne et à distance de 5 en ligne*/
	|| ((arrivee.x == m->shipPosition[shipID].x)&&(arrivee.y == m->shipPosition[shipID].y - 4)) /*Même colonne et à distance de -4 en ligne*/
	|| ((arrivee.x == m->shipPosition[shipID].x)&&(arrivee.y == m->shipPosition[shipID].y - 5)) /*Même colonne et à distance de -5 en ligne*/
	|| ((arrivee.x == m->shipPosition[shipID].x + 4)&&(arrivee.y == m->shipPosition[shipID].y))	/*Même ligne et à distance de 4 en colonne*/
	|| ((arrivee.x == m->shipPosition[shipID].x + 5)&&(arrivee.y == m->shipPosition[shipID].y)) /*Même ligne et à distance de 5 en colonne*/
	|| ((arrivee.x == m->shipPosition[shipID].x - 4)&&(arrivee.y == m->shipPosition[shipID].y))	/*Même ligne et à distance de -4 en colonne*/
	|| ((arrivee.x == m->shipPosition[shipID].x - 5)&&(arrivee.y == m->shipPosition[shipID].y)))/*Même ligne et à distance de -5 en colonne*/
		return 1;

	return 0;
}
/**Charge d'un bateau sur une case ciblée
 * @param m, la map.
 * @param s, le tableau de sauvegarde des états des bateaux.
 * @param shipID, l'id du bateau chargeant.
 * @param arrivee, les coordonnées de la case ciblée*/
void BST(navalmap_t*m,SHIP *s,int shipID,coord_t arrivee)
{
	s[shipID].kerosene -= 3;

	if(est_chargeable(m,shipID,arrivee)) /*Vérification de la possibilité de charget la case*/
	{
		printf("%d --> a chargé en %d,%d\n",shipID,arrivee.x,arrivee.y);

		if(m->map[arrivee.y][arrivee.x].id != -1) /*Vérification de la présence d'un bateau sur la case ciblée*/
		{
			for(int i=0;i<m->nbShips;i++)
			{
				if(s[i].id == m->map[arrivee.y][arrivee.x].id)
				{
					s[i].coque -= 50;
					s[shipID].coque -= 5;
					printf("%d --> a touché le bateau %d\n",shipID,s[i].id);
				}
			}
		}
	}
	else printf("%d --> ne peut chargé en %d,%d\n",shipID,arrivee.x,arrivee.y);
}

/**Réparation d'un bateau
 * @param s, la tableau de sauvegarde des états des bateaux.
 * @param shipID, l'id du bateau à réparer.*/
void RPR(SHIP *s,int shipID)
{
	s[shipID].kerosene -= 20;
	s[shipID].coque += 25;
	printf("%d --> a été réparé : %d coque | %d kerosene\n",shipID,s[shipID].coque,s[shipID].kerosene);
}
