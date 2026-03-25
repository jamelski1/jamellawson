/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package usewallet;

/**
 *
 * @author jllawsn
 */
public class UseWallet {
    

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        
// Private instance variables representing the single credit card and the
    // cash amount in the wallet
    private int creditCard;
    private double cash;
    
    //public Wallet( ) { }
    // Create a wallet with the given card number and the given cash amount
    public BiFoldWallet( int cardNumber, double cashAmt )
    {
        creditCard = cardNumber;
        cash = cashAmt;
    }
    
    // Spend some cash from the wallet (if possible)
    public void spendCash( double cashSpent )
    {
        if( cashSpent >= 0 && cashSpent < cash )
        {
            cash -= cashSpent;
        }
    }
    
    // Find out how much money is in the wallet
    public double checkCash( )
    {
        return cash;
    }
    
    // Get the credit card number
    public int useCreditCard( )
    {
        return creditCard;
    }
    
    // Add money to the wallet
    public void addCash( double cashAdded )
    {
        if( cashAdded > 0 )
        {
            cash += cashAdded;
        }
    }