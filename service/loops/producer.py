# In charge of fetching current weight from the wii board

while self.status == "Connected" and not self.processor.done:
    data = self.recievedsocket.recv(25)
    intype = int(data.encode("hex")[2:4])
    if intype == INPUT_STATUS:
        self.setReportingType()
    elif intype == INPUT_READ_DATA:
        if self.calibrationRequested:
            packetLength = (int(str(data[4]).encode("hex"), 16)/16)
            self.parseCalibrationResponse(data[7:(7 + packetLength)])
            if packetLength < 16:
                self.calibrationRequested = False
    elif intype == EXTENSION_8BYTES:
        self.processor.mass(self.createBoardEvent(data[2:12]))
    else:
        print "ACK to data write recieved"