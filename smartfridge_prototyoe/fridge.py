import sqlite3
import time
# connect to db
db = sqlite3.connect("smartfridge.db")

class Fridge:

    def __init__(self, id, current_item, status, user_id):
        self.id = id
        self.current_item = current_item
        self.status = status
        self.user_id = user_id

    def get_current_fridge(self):
        return self.id

    def get_current_item(self):
        return self.current_item

    def get_current_status(self):
        return self.status

    def get_fridge_user_id(self):
        return self.user_id



def make():
    cursor = db.cursor()
    fridge_id = 0
    fridge_item = ""
    fridge_item_status = ""
    fridge_user_id = 0
    fridge_data = []
    # set fridge data
    while True:
        for id, current_item, status, customer_id in db.execute("SELECT * FROM fridge"):
            fridge_id = id
            fridge_item = current_item
            fridge_item_status = status
            fridge_user_id = customer_id

            fridge1 = Fridge(fridge_id, fridge_item, fridge_item_status, fridge_user_id)
            id = fridge1.get_current_fridge()
            item = fridge1.get_current_item()
            status = fridge1.get_current_status()
            user = fridge1.get_fridge_user_id()

            fridge_data.append(id)
            fridge_data.append(item)
            fridge_data.append(status)
            fridge_data.append(user)
            return fridge_data

            time.sleep(1)

        cursor.close()

if __name__ == "__main__":
    make()
    db.close()
