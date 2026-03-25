/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package class4;

/**
 *
 * @author jllawsn
 */
public class NumberGuessingGameDriver {
    public static void main(String[] args){
        int variable = 0;
        NumberGuessingGame ng;
        ng = new NumberGuessingGame( );
        boolean rightGuess = ng.guessNumber(10);
        System.out.println(rightGuess);
    }
    
}
