/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package lawsoncountry;

/**
 *
 * @author jllawsn
 */
public interface Country {
    // Returns 0 for making peace, and 1 for making war
    int takeAction( );
    
    // informs the country what choice their neighbor made -- 0 indicates the
    // neighbor chose peace, while 1 indicates war.
    void informOfChoice( int choice );
    
    // informing the player they are moving on to next opponent
    void toNewOpponent( );
}
