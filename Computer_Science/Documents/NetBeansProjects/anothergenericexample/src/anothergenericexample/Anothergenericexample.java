/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package anothergenericexample;

/**
 *
 * @author jllawsn
 */
class EmptyStackException extends Exception
{
    public EmptyStackException(String msg) {super(msg);}
}

interface Stack<T>
{
    void push( T elem);
    
    T pop( ) throws EmptyStackException;
    
    boolean isEmpty();
}


class ArrayBasedStack<T> implements Stack<T>
{
    private T[] stack = (T[]) new Object[2];
    private int size = 0;
    
    @Override
    public void push(T elem) {
        stack[size++] = elem;
        
        if( size >= stack.length)
        {
            T[] newStack = (T[]) new Object[stack.length*2];
            System.arraycopy(stack, 0, newStack, 0, stack.length);
            stack = newStack;
        }
        //throw new UnsupportedOperationException("Not supported yet.");
    }

    @Override
    public T pop() throws EmptyStackException {
        
        if (size == 0)
        {
            throw new EmptyStackException("The stack is empty.");
        }
        T element = stack[--size];
        stack[size] = null;
        return element;
        }

    @Override
    public boolean isEmpty() {
        //throw new UnsupportedOperationException("Not supported yet.");
        return size == 0;
    }
    
}

public class Anothergenericexample {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) throws EmptyStackException {

        Stack<Integer> myStack = new ArrayBasedStack<Integer>();
        
        myStack.push(new Integer(2));
        myStack.push(new Integer(3));
        myStack.push(new Integer(4));
        
        while (! myStack.isEmpty()){
            System.out.println(myStack.pop());
        }
    }
}
