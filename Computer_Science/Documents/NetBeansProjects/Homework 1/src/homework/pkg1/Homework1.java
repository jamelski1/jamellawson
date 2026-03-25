/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package homework.pkg1;

/**
 *
 * @author jllawsn
 */

import java.util.Scanner;
public class Homework1 {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        // TODO code application logic here
        System.out.print("Please input a natural number: ");
        Scanner number = new Scanner(System.in);
        int nNumber = number.nextInt();
        int orgNumber = nNumber;
        //This was just to help test the input
        //System.out.println("You entered: " + nNumber);
        
        //Outputs the number used for the hailstone sequence
        System.out.println("The hailstone sequence for " + nNumber + " is:");
        
        //initializes the count for how many steps
        //it takes to get through the hailstone sequence
        int count = 0;
        
        //Start of the Hailstone sequence
        while (true)
        {
            //this ends the hailstone sequence because it will ALWAYS reach 1.
            if(nNumber == 1)
            {
                System.out.println(nNumber);
                break;
            }
            
            //This adds a space and a comma to make the hailstone sequence
            //more readable
            System.out.print(nNumber + ", ");
            //whether the hailstone number is even or odd one number
            //is added because it takes another step through the sequence
            count += 1;
            
            //checks whether the number even
            if(nNumber%2 == 0)
            {
                //divides the number by to indicated by the hailstone sequence
                nNumber = nNumber/2;
            }
            //if it's not even it's odd
            else
            {
                //odd numbers are multiplied by 3 and adds 1 to that number
                //indicated by the hailstone sequence
                nNumber = (nNumber *3)+1;
            }
            
        }
        //This prints out the final statement indicated the how many steps
        //it takes to go through the hailstone sequence
        System.out.println("The stopping time of " + orgNumber + " is: " + count + " steps.");
        
    }
}
