/*
 * Jamel Lawson
 * Example Number 1
 */
package exampleone;
import java.util.Scanner;
 
public class ExampleOne {

    
    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        
        Scanner s = new Scanner(System.in);
        System.out.print("Please enter your kilometers: ");
       
        
            double kilometers = s.nextDouble();
        Scanner n = new Scanner(System.in);
        System.out.print("Please enter your miles: ");
            double miles = n.nextDouble();
            double newMiles = 0;
            double newKilometers = 0;
            
            //kilometers to miles
            newMiles += kilometers/0.62;
            
            //miles to kilometers
            newKilometers += miles/1.6;
            
            
            
            
            System.out.println("Miles" + " " + newMiles);
            System.out.println("Kilometers" + " "+ newKilometers);
        // TODO code application logic here
    }
}
