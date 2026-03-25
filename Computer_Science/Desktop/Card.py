class Card:
    'class that represents a card and their four properties'
    def __init__(self, shape, color, number, filling):
        'initialize the shape, color, number, and filling of the card'
        self.shape = shape
        self.color = color
        self.number = number
        self.filling = filling
        
    def getShape(self):
        'return shape'
        return self.shape
    
    def getColor(self):
        'return color'
        return self.color
    
    def getNumber(self):
        'return number'
        return self.number
    
    def getFilling(self):
        return self.filling
    
    