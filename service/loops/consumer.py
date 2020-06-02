class ConsumerThread(threading.Thread):
    def run(self):
        global queue
        while True:
            condition.acquire()
            if not queue: 
                print("Nothing in queue")
                condition.wait()
                print("Producer added to queue")
            number = queue.pop(0)
            print("consumed", number)
            condition.release()
            time.sleep(1)