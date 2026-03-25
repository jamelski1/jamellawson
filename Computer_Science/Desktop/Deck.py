import Card
import random

class Deck:
    'represents a deck of 81 cards'
    
    #shapes, colors, numbers, and fillings are Deck class variables
    shapes = ['circle', 'square', 'triangle']
    colors = ['red', 'green', 'blue']
    numbers = ['1', '2', '3']
    fillings = ['stripes', 'dots', 'clear']
    
    def __init__(self):
        'initialize deck of 81 cards'
        self.deck = [] #deck is initially empty
        
        for shape in Deck.shapes:
            for color in Deck.colors:
                for number in Deck.numbers:
                    for filling in Deck.fillings:
                        #add card with given shape, color, number and filling
                        self.deck.append(Card(shape,color,number,filling))
                        
    def shuffle(self):
        'shuffles the deck'
        shuffle(self.deck)
        
    def dealCard(self):
        'deal (pop and return) card from the top of the deck'
        return self.deck.pop()