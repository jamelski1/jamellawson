/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package methodoverload;

/**
 *
 * @author jllawsn
 */
public class MethodOverload {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
       Area find = new Area();
       System.out.println(find.Area(8.0, 3.0));
       System.out.println(find.Area(8, 3));
        
        
        
    }
}
