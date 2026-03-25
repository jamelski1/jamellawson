/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package class3;

/**
 *
 * @author jllawsn
 */
import java.util.Scanner;
public class Class3 {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        // TODO code application logic here
        
        
        //example of a "while" loop
        /*
        int varOne = 5;
        
        while (varOne > 0)
        {varOne--;
        System.out.println("Inside the while loop");
        }
        
        
        //example of a "do while" loop
        int varTwo = 5;
        do
        {
            System.out.println("varOne is greater than 0");
            varTwo--;
        }while(varTwo > 0); */
        
        
        //Checks to 
        int[] pinArray = {1234, 5678, 9012, 7654};
        
        System.out.print ("Please enter your pin: ");
        Scanner key = new Scanner(System.in);
        int pin = key.nextInt();
        System.out.println("your pin is " + pin);
        
        
        boolean accepted = false;
        
        for (int elem : pinArray)
        {
            if(elem == pin)
            {
                System.out.println("Your number IS in the array");
                accepted = true;
                break;
            }
            else if(elem == 9999)
            {
               System.out.println("Your number IS 9999");         
            }
            else
            {
                continue;
            }
        }
        
        if(accepted == false)
        {
            System.out.println("Your number is NOT in the array");
        }
        
        
    }
}
