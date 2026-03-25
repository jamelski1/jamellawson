/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package lawsoncountry1;

/**
 *
 * @author jllawsn
 */
public class LateLawsonCountry2 implements Country{
    int enemy = 0;
    int peaceDeclarations = 0;
    
    
    
    @Override
    public int takeAction(){
        if (peaceDeclarations < 3){
            peaceDeclarations++;
            return 0;
        }
        else{
            if (enemy == 0){
                return 1;
            } 
            else{
                return 0;
        }
    }
 }
    
    @Override
    public void informOfChoice( int choice) {
    enemy = choice;
    }
    
    @Override
    public void toNewOpponent( ) {
    peaceDeclarations = 0;
    enemy = 0;
    }
}
