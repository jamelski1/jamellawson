/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package methodoverload;

/**
 *
 * @author jllawsn
 */
public class Area {
    
    public double height;
    public double length;
    public double base;
    public double a;
    public double radius;
    
    //triangle
    double Area(double b, double h){
        
        return (0.5 * b * h);
    }
    //rectangle
    double Area(char random, double w, double h){
        return (w * h);
    }
    //trapazoid
    double Area(double a, double b, double h){
        return (0.5*(a+b) *h);
    }
    //ellipse
    double Area(int random, double a, double b){
        return (3.14*a*b);
    }
    //square
    double Area(double a){
        return(a*a);
    }
    //parallelogram
    double Area(float random, double b, double h){
        return(b*h);
    }
    //circle
    double Area(int random, int nextrandom, double r){
        return(r*r);
    }
    //sector
    double Area(char random, char nextrandom, double r, double theta){
        return (0.5*(r*r)*theta);
    }
    
    /*char Area(int random, int nextRandom){
        return 'y';
    }*/
    
}
