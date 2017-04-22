import fridge
import time
import wii_test
import sqlite3

# connect to db
conn = sqlite3.connect("smartfridge.db")

# returns weight : 45
# cursor = db.cursor()
# cursor.execute(get_products_query, (item))

def get_warning_weight(name):
    for row in conn.execute("SELECT * FROM products WHERE name LIKE ?", (name,)):
        return row[4]
    # conn.execute("SELECT * FROM products WHERE name = ?", ("name",))
    # return conn.fetchone()[4]

def get_order_weight(name):
    for row in conn.execute("SELECT * FROM products WHERE name = ?", (name,)):
        return row[5]
    # cursor.execute("SELECT * FROM products WHERE name = ?", (item,))
    # return cursor.fetchone()[5]

def print_item(item):
    print(item)

def status_check(current_weight, warning_weight, order_weight):
    warning_limit = warning_weight + 5
    if current_weight <= order_weight:
        # update order's table in db
        print("ordering new item")
    elif warning_weight <= current_weight <= warning_limit:
        # update fridge table
        print("status low")
    else:
        print("Status is good")

while False:
    current_weight = wii_test.get()

    fridge_data = fridge.make()
    id = fridge_data[0]
    item = fridge_data[1]
    status = fridge_data[2]
    user = fridge_data[3]
    # print("Fridge Data: {0}, {1}, {2}, {3}".format(id, item, status, user))
    time.sleep(1)
    warning_weight = get_warning_weight(item)
    order_weight = get_order_weight(item)

    print(current_weight)
    status_check(current_weight, warning_weight, order_weight)


# cursor.close()
# db.commit()
conn.close()
