#include "liste.h"

typedef struct{
	int type; /*backbone = 1, type 2 ou 3*/
	LISTE voisins;
}NOEUD;

typedef struct {
	
	int nb_sommets; /* nombre de sommets (100 dans le sujet)*/
	NOEUD *tab; /* tableau de noeuds */
	
}GRAPHE;

/*liste chaînée pour établir le tableau de l'algo de Dijkstra
 * pour un noeud spécifique*/
struct table 
{
	int sommet;
	int distance;
	int pere;
	struct table* suivant;	
};
typedef struct table* TABLE;

/*####################Création du graphe####################*/
// Initialisation du graphe
// Création de la structure GRAPHE avec n noeud et tous les noeuds avec type = 0
// \param			n			Nombre de sommets du graphe	
// \return						Graphe généré 
GRAPHE init_GRAPHE(int n); 

// Modification d'un graphe en initialisant ses liens du backbone
// \param			G			Graphe 
// \return						Graphe G avec ses liens du backbone 
GRAPHE backbone(GRAPHE G); 

//Initialiser les noeuds de type 2
// \param			G			Graphe 
// \return						Graphe G avec ses noeuds de type 2
GRAPHE op_transit(GRAPHE G);

//Initialialiser les liens de noeuds de type 2 avec ceux du backbone
// \param			G			Graphe 
// \return			Graphe G avec les liens de noeuds de type 2 avec ceux du backbone
GRAPHE lien_niv1(GRAPHE G);

//Initialiser les liens des noeuds de type 2 avec ceux de type 2
// \param			G			Graphe 
// \return			Graphe G avec les liens de noeuds de type 2 avec ceux de type 2
GRAPHE lien_niv2(GRAPHE G);

//Initialiser les noeuds de type 3
// \param			G			Graphe 
// \return						Graphe G avec noeuds de type 3 
GRAPHE op_niv3(GRAPHE G);

//Compter le nombre de noeud de type 2 voisins d'un sommet
// \param			G			Graphe
// \param			sommet		sommet en question
// \return						nombre de noeuds de type 2 voisins du sommet donné en param
int nb_noeud_niv2(GRAPHE G,int sommet);

//Compter le nombre de noeud de type 3 voisins d'un sommet
// \param			G			Graphe
// \param			sommet		sommet en question
// \return						nombre de noeuds de type 3 voisins du sommet donné en param
int nb_noeud_niv3(GRAPHE G,int sommet);

// Savoir si un noeud est voisin d'un autre
// \param			G			Graphe 
// \param			sommet			
// \param			voisin_possible				
// \return			0			si les 2 noeuds sont voisins
//					1			sinon
int est_voisin(GRAPHE G,int sommet,int voisin_possible);


/*####################Tables de routage####################*/

//calculer le minimum entre deux nombres pour l'algo de Dikstra
int minimum(int a, int b);

// Ajouter un élément dans la TABLE b
// \param			b			TABLE 
// \param			sommet			
// \param			distance
// \param			pere		
// \return						TABLE b avec le nouvel elem ajouté
TABLE ajout_element(TABLE b, int sommet, int distance, int pere);

// Compter le nombre d'éléments dans une TABLE t donnée
// \param			t			TABLE 	
// \return						nombre d'éléments dans la table t
int nb_elements_table(TABLE t);

// Savoir la distance entre deux sommets quelconques
// \param			sommet	
// \param			pere
// \param			G			Graphe		
// \return						distance entre les deux sommets donnés en param
int distance(GRAPHE G, int sommet, int pere);

// Etablir le tableau de l'algo de Dijkstra d'un sommet du Graphe G à l'initialisation 
// \param			sommet	
// \param			pere
// \param			G			Graphe		
// \return						tableau de l'algo de Dijkstra à l'initialisation
// si distance = infini, cela est traduit par distance = 2500 dans notre programme
TABLE initialisation_Dijkstra(GRAPHE G,int sommet);

// Savoir distance du sommet avec son père dans le tableau de l'algo de Dijkstra
// \param			sommet	
// \param			t			TABLE
// \return						distance inscrite dans tableau
int distance_sommet(TABLE t, int sommet);

// Savoir le père d'un sommet dans le tableau de l'algo de Dijkstra
// \param			sommet	
// \param			t			TABLE
// \return						père du sommet donné en param
int pere(TABLE t, int sommet);

// Savoir si tous les sommets ont été traités dans l'algo de Dijsktra
// \param			T		tableau de 100 entiers
// \return			1		si tous les sommets sont traités
//					0		sinon
int tous_les_sommets_traites(int T[100]);

// Tester si le sommet donné en param est traité
// \param			T		tableau de 100 entiers
// \param			sommet
// \return			1		si le sommet n'est pas traité
//					0		sinon
int sommet_non_traite(int T[100], int sommet);

// Connaître le premier sommet du tableau qui n'a pas été traité
// \param			T		tableau de 100 entiers
// \return					premier sommet non traité
int premier_sommet_a_traiter(int T[100]);

/* Connaître le prochain sommet du tableau qui n'a pas été traité
 * c'est-à-dire celui qui a la distance minimale dans le tableau et qui n'a
 * pas été traité*/
// \param			t		TABLE
// \param			T		tableau de 100 entiers
// \return					prochain sommet à traiter
int prochain_sommet_a_traiter(int T[100],TABLE t);

/* Etablir la boucle principale de Dijstra*/
// \param			t		TABLE issue de l'initialisation de Dijstra
// \param			G		Graphe
// \param			source	sommet source
// \return					tableau à la fin de l'algo de Dijkstra
TABLE b_p_d(GRAPHE G, TABLE t, int source);

void affiche_table(TABLE b);


/* Etablir l'algo de Dijstra pour chaque noeud du graphe*/
// \param			G		Graphe
// \return					tableau de la structure TABLE
TABLE* calcul_table_routage_all_noeuds (GRAPHE G);

/*####################Vérification de la connexité####################*/
void explorer_sommet(GRAPHE G,int*couleur,int sommet);

/* Savoir si un graphe est connexe*/
// \param			G		Graphe
// \return			1		si G est connexe
//					0		sinon
int est_connexe(GRAPHE G);

/*####################Etablir le chemin entre 2 noeuds####################*/
/* Etablir le plus court chemin entre un sommet source et un sommet d'arrivée*/
// \param			G		Graphe
// \return					tableau de la structure TABLE
void chemin(TABLE*T,int emetteur, int destinataire);
