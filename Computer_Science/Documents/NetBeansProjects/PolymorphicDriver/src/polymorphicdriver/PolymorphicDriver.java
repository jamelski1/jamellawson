/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package polymorphicdriver;

/**
 *
 * @author jllawsn
 */
public class PolymorphicDriver {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        // Why is this legal?  tw is a reference to an Object, but I'm
        // assigning it a reference to a TriFoldWallet...
        BiFoldWallet tw = new TriFoldWallet( 10, 90, 11 );
        
        // What will this print?  Object's toString prints the class name,
        // followed by the hash code.  TriFoldWallet prints "This is a
        // Bifold Wallet!" + Object's output.  What does this print?
        System.out.println( tw.toString( ) );
    }
}
