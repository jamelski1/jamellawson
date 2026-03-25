/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package usewallet;

/**
 *
 * @author jllawsn
 */
public class CreditSafeWallet extends BiFoldWallet{
    
    private int creditCard;
    private double cash;
    
    //public Wallet( ) { }
    // Create a wallet with the given card number and the given cash amount
    public CreditSafeWallet( int cardNumber, double cashAmt )
    {
        creditCard = cardNumber;
        cash = cashAmt;
    }
}
