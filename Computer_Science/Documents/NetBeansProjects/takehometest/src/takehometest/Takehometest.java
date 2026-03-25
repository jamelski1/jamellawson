/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package takehometest;

/**
 *
 * @author jllawsn
 */

import java.util.Random;

class Consumer{
    private int energyNeeded = 0;
    
    int requestEnergy(){
        return energyNeeded;
}
    int receiveEnergy(int fromCarrier){
        energyNeeded -= fromCarrier;
        if (energyNeeded == 0){
            return 0;
        }
        else{
            return energyNeeded;
        }
    }
}

class Carrier{
    
    //stores the energy that the carrier has
    private int currentEnergy = 0;
    
    int getEnergy(){
        return currentEnergy;
    }
    
    void addEnergy(int packetFromCarrier){
        currentEnergy += packetFromCarrier;
    }
    
}

class Producer{
    //the amount of energy that it produces each round
    private int amountOfEnergy;
    //creates multiple carriers for 1 producer
    Carrier carrier = new Carrier();
    
    //gives the producer energy
    void produceEnergy(){
        amountOfEnergy = 100;
    }
    
    int getEnergy(){
        int temp = amountOfEnergy;
        amountOfEnergy -= amountOfEnergy;
        return temp;
    }
    
}
public class Takehometest {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        int energyWasted;
        int energyShortage;
        
        Consumer consumer = new Consumer();
        int getEnergy = consumer.requestEnergy();
        
        Producer produce = new Producer();
        int currentProduction = 0;
        
        Carrier carrier = new Carrier();
        int energyPacket = carrier.getEnergy();
        if (energyPacket == 0){
            currentProduction = produce.getEnergy();
        }
        else{
            //give energy to Carrier and reset to 0
            carrier.addEnergy(currentProduction);
        }
    }
}
