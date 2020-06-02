calledOnce = False

while True:
    current_weight = wii_test.get()
    fridge_data = fridge.make()
    id = fridge_data[0]
    item = fridge_data[1]
    status = fridge_data[2]
    user = fridge_data[3]

    warning_weight = get_warning_weight(item)
    order_weight = get_order_weight(item)
    time.sleep(1)

    print(current_weight)
    udpate = status_check(current_weight, warning_weight, order_weight, id)

    if (update == "Need to Re-order") and (not calledOnce):
        print("ordering")
        order()
        calledOnce = True

conn.close()