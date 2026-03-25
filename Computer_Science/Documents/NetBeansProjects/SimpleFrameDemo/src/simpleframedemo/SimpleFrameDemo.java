/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package simpleframedemo;

/**
 *
 * @author jllawsn
 */

import java.awt.BorderLayout;
import javax.swing.*;
import java.awt.event.*;
public class SimpleFrameDemo implements ActionListener{
    
    public SimpleFrameDemo(){
        JFrame myFrame = new JFrame("Jamel's Simple Frame");
        
        
        myFrame.setSize(1024, 800);
        
        
        
        JTextField myField = new JTextField("A message");
        myFrame.add(myField, BorderLayout.WEST);
        
        JButton myButton = new JButton("This is a button");
        myButton.addActionListener(this);
        myFrame.add(myButton, BorderLayout.CENTER);
        
        JTextField nextField = new JTextField("This is my second message");
        myFrame.add(nextField, BorderLayout.EAST);
        
        
        //These should come at the end of the code
        myFrame.setVisible(true);
        myFrame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
    }
    
    @Override
    public void actionPerformed(ActionEvent e)
    {
        System.out.println(e.getID());
    }
    
    
    public static void main(String[] args) 
    {
        SimpleFrameDemo sd = new SimpleFrameDemo();
    }

}
