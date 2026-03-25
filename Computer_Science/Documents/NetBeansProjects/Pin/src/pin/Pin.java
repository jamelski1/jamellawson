/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package pin;

/**
 *
 * @author jllawsn
 */


import java.util.Scanner;
public class Pin {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
    
   
    /*Scanner name = new Scanner(System.in);
    
    System.out.println("Please enter your name: ");
            
    //System.out.println(name);     */   

    int varOne = 10;
    int varTwo = 11;
    
    String variable = "this";
    
    if (varOne > varTwo)
    {
        System.out.println( "varOne is bigger than varTwo");
    }
    else if (varOne < varTwo)
    {
        System.out.println("varTwo is bigger than varOne");
    }
    else
    {
        System.out.println("varOne is equal to varTwo");
    }
        
    switch(varOne)
    {
        case 10: 
            System.out.println("varOne is 10");
            break;
        case 11:
            System.out.println("varOne is 11");
            break;
    }
    
    System.out.println(variable);
    
    for (int i = 0; i < varOne; i++)
    {
        System.out.println("Index i is " + i);
    }
    int[] myArray = {1,2,3,4,5};
    
    for( int element : myArray)
    {
        System.out.println(element);
        
        element = 100;
        
        
    }
        // TODO code application logic here
    }
}
