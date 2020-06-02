
class Wii:
    def __init__(self):
        self._measured = False
        self.done = False
        self._measureCnt = 0

    def calc_mass(self):
        val = 10
        return val

board = Wii()

def get():
    return board.calc_mass()
