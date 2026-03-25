/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package polymorphicdriver;

/**
 *
 * @author jllawsn
 */
public class BiFoldWallet {
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
    
    // All Objects implement a toString method.  It is often convenient to
    // override this method so that we get a more-meaningful print message
    // than the class and hash code.  Note the annotation '@Override', which
    // tells the compiler that we think this method overrides a method from
    // the superclass.  This gives the compiler a chance to stop us if we
    // aren't overriding the method (due to a typo, for instance).
    @Override
    public String toString( ) 
    { 
        return "This is a BiFoldWallet!  Also, " + super.toString( ); 
    }
}
