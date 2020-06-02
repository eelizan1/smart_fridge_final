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

def status_check(current_weight, warning_weight, order_weight, id):
    warning_limit = warning_weight + 5
    if current_weight <= order_weight:
        # update fridge table
        status = "Need to Re-order"
        update_status(status, id)
    elif warning_weight <= current_weight <= warning_limit:
        status = "Low"
        update_status(status, id)
    else:
        status = "Good"
        update_status(status, id)
    print(status)
    return status

def order():
    conn.execute("INSERT INTO orders(product_id, user_id, order_amount) VALUES(1, 2, 2)")
    print("ordering new item")
    conn.commit()
    print("Order complete")

def update_status(status, id):
    conn.execute("UPDATE fridge SET status = ? WHERE id = ?", (status, id))
    conn.commit()

calledOnce = False
while True:
    current_weight = wii_test.get()

    fridge_data = fridge.make()
    id = fridge_data[0]
    item = fridge_data[1]
    status = fridge_data[2]
    user = fridge_data[3]
    # print("Fridge Data: {0}, {1}, {2}, {3}".format(id, item, status, user))
    warning_weight = get_warning_weight(item)
    order_weight = get_order_weight(item)
    time.sleep(1)

    print(current_weight)
    update = status_check(current_weight, warning_weight, order_weight, id)

    if (update == "Need to Re-order") and (not calledOnce):
        print("ordering")
        order()
        calledOnce = True

conn.close()
