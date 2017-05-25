# smart_fridge_final

Using Raspberry Pi to repeatedly fetch product data from a fridge and execute specific operations accordingly – reorder from an ecommerce site, notify user, CRUD operations. 

Let's a user know when they are out of items in a fridge. Re-orders the item for them through an e-commerce website. Idea is to save user's time from getting the item themselves. 

Main Materials: 
 1. Mini fridge
 2. Raspberry Pi 
 3. Wii Board
 4. Soldering Iron 
 5. Jumpber Wires 
 
Design: Uses threading 
  Main Loop that checks client side and wii board for updates of data (inspired by round robin architecture)
  Producer Consumer: Producer fetches weight and consumer sends to main loop
  
 ![alt text](https://github.com/eelizan1/smart_fridge_final/blob/master/mainloop.png)
