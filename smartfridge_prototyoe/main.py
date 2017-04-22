import wii_test
import fridge
import time

# weight = wii_test.get()
# print(weight)

while False:
    item = fridge.fridge1.get_current_item()
    print(item)
    time.sleep(1)

