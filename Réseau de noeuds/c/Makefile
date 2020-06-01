all : graphe.o main.o liste.o reseau

reseau:main.o graphe.o liste.o
	gcc -o reseau -Wall main.o graphe.o liste.o

main.o:main.c ../h/graphe.h ../h/liste.h
	gcc -c -g -Wall main.c

graphe.o:../h/graphe.h ../h/liste.h graphe.c
	gcc -c -g -Wall graphe.c

liste.o:../h/liste.h liste.c
	gcc -c -g -Wall liste.c

clean:
	rm *.o
	rm reseau
