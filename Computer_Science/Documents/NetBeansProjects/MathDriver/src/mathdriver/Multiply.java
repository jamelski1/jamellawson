/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package mathdriver;

import java.util.Random;
import java.util.Scanner;

/**
 *
 * @author jllawsn
 */
public class Multiply {
    Random random = new Random();
    Scanner scan = new Scanner(System.in);
    private int number1 = random.nextInt(13);
    private int number2 = random.nextInt(13);
    private int answer = number1 * number2;
    private int user_answer;
    
    public int getUser_answer{
    while (true){
        try{
            System.out.print("What is " + number1 " + " + number2 + "?");
            user_answer = scan.nextInt();
            break;
        }
        catch(IOException e){
            System.err.println("Caught IOException: " + e.getMessage());
        }
    }
        
}
       
}
