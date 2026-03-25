/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package usephone;

/**
 *
 * @author jllawsn
 */
public class Phone {
    private int phoneNumber = 8339788;
    
    int getNumber(){
        return phoneNumber;
    }
    
    String call(int contact){
        return "Calling" + contact;
    }
}
