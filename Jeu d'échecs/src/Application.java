package src;
import java.util.Scanner;

public enum Application {

    ENVIRONNEMENT;

    public void run (String[]args)
    {
		Plateau p = new Plateau();

        System.out.println("----------Mode de jeu----------");
        System.out.println("Vous VS IA - Tapez 1");
        System.out.println("IA VS IA - Tapez 2");
        System.out.println("Veuillez entrer votre choix : ");

        /*Demande à l'utilisateur de choisir le mode*/
        Scanner sc = new Scanner(System.in);
        String lecture = sc.nextLine();
        int choix = Character.getNumericValue(lecture.charAt(0));

        /*Tant qu'un numéro correspondant à un mode n'est pas rentré*/
        while(((choix != 1)&&(choix != 2))||(lecture.length()!=1))
        {
            System.out.println("ERREUR : entrée invalide. Veuillez à nouveau entrer votre choix");
            lecture = sc.nextLine();
            choix = Character.getNumericValue(lecture.charAt(0));
        }

        if(choix == 1)
        {
            p.personne_vs_ia(sc);
            sc.close();
        }
        else if(choix == 2)
        {
            p.ia_vs_ia();

        }
    }

    public static void main(String[]args)
    {
        ENVIRONNEMENT.run(args);
    }
}
