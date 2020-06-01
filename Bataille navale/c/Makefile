.PHONY: all lib debug

all:lib main

main:main.o actions.o lecture_fichier.o seul_contre_tous.o equipe_vs_equipe.o
	gcc -I. -o SoD main.c -L. -lnm -Wall -lm -pthread

lib:
	gcc -g -c -fPIC -pthread *.c
	ar rcs libnm.a *.o

debug:
	gcc -g -o SoD main.c -L. -lnm

clean:
	rm -f *.o
	rm SoD
	rm libnm.a
