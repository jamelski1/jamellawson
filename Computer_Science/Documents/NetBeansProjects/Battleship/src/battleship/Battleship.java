/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package battleship;
import java.util.Scanner;
/**
 *
 * @author jllawsn
 */
public class Battleship {

    /**
     * @param args the command line arguments
     */
    private int carrier = 5;
    
    public static void main(String[] args)
    throws java.io.IOException
    {
        BattleshipBoard board = new BattleshipBoard(10,10);
        System.out.println("Let's get started.");
        System.out.println("You get 3 ships:");
        System.out.println("A carrier, A baattleship, and A patrol boat");
        System.out.println("The length of the ships are:");
        System.out.println("5 spaces long, 3 spaces, and 2 respectively.");
        System.out.println("All positions are given the format:");
        System.out.println("Row<LETTER>Column<NUMBER>(e.g. B5");
        
        boolean ship1 = false;
        boolean ship2 = false;
        boolean ship3 = false;
        boolean itWorked;
        boolean VoH1;
        
        while (!ship1)
        {
            System.out.print("Would you like your ship to be Verticle or Horizontal?");
            Scanner orientation = new Scanner(System.in);
            String newOrientation = orientation.next();
            boolean realOrientation;
            if((newOrientation.charAt(0) == 'V') || (newOrientation.charAt(0) == 'v'))
            {
                System.out.println("You chose Verticle.");
                //to be used by addShip class in Battleship Board true means it's verticle
                VoH1 = true;
            }
            else if(newOrientation.charAt(0)== 'H'|| (newOrientation.charAt(0) == 'h'))
            {
                System.out.println("You chose Horizontal.");
                //to be used by addShip class in Battleship Board true means it's verticle
                VoH1 = false;
            }
            else
            {
                System.out.println("Please enter 'H' for Horizontal");
                System.out.println("or 'V' for Verticle");
                continue;
            }
            
            System.out.print("Please enter the start position of you shift e.g. A1: ");
            Scanner placement = new Scanner(System.in);
            String newPlacement = placement.next();
            int x;
            int y;
            x = newPlacement.charAt(0);
            y = newPlacement.charAt(1);
            System.out.print(x);
            
            //uses the add ship method
            itWorked = board.addShip(VoH1, x , y, 5);
            if (itWorked) {
                System.out.println("Ship 1 was placed");
                ship1 = true;
            }
            else
            {
                System.out.println("Ship 1 was not placed");
                System.out.println("Please try placing your ship somewhere else.");
            }
        }
        
    }

}
