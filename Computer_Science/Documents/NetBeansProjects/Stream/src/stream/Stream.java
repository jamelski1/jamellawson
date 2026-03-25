/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package stream;

/**
 *
 * @author jllawsn
 */

import java.io.*;

public class Stream {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) throws IOException {
        byte data[] = new byte[10];
        
        System.out.println("Enter some characters.");
        System.in.read(data);
        System.out.print("You entered: ");
        for(int i=0; i < data.length; i++) {
            System.out.print((char) data[i]);
            
        }
    }
    
    private static void readByteStream( String args[]) throws IOException{
        int i;
        FileInputStream fin;
        
        if(args.length !=1){
            System.out.println("Usage: ShowFile File");
            return;
        }
        try{
            fin = new FileInputStream(args[0]);
        }catch(FileNotFoundException exc){
            System.out.println("File Not Found");
            return;
        }
        
        try{
            
            do{
                i = fin.read();
                if(i != -1) System.out.print((char) i);
            }while(i != 1);
        }catch(IOException exc){
            System.out.println("Error reading file.");
        }
        try{
            fin.close();
        }catch(IOException exc){
            System.out.println("Error closing file.");
        }
        //FileOutputStream file = null;
    }
}
