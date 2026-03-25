/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package polymorphicdriver;

/**
 *
 * @author jllawsn
 */
public class TriFoldWallet extends BiFoldWallet {
        // Besides the members of BiFoldWallet, we'll add an instance variable
    // for TriFoldWallet.
    private int cardTwo;
    
    // We have to include an explicit call to super in the constructor.  If
    // we don't, Java tries to insert a no-parameter constructor call.  In this
    // case, such a constructor does not exist, which would cause a compile
    // error.
    public TriFoldWallet( int card1, double cash, int card2 )
    {     
        // implicit if not included: super( );
        super( card1, cash );
        cardTwo = card2;
    }
    
    // An accessor method to get the credit card number from the TriFoldWallet.
    public int getCardTwo( ) { return cardTwo; }
    
    // No need to define any more methods.  By inheritance, we get the methods
    // from BiFoldWallet "for free" -- so we can still get our (first) credit
    // card, check cash, etc. with a TriFoldWallet.
}
