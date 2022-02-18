#include<ESP8266WiFi.h>
#include<ESP8266HTTPClient.h>
#include <SPI.h>
#include <NTPClient.h>
#include <MFRC522.h>
#include <Wire.h>
#include <WiFiUdp.h>
#include <Adafruit_SSD1306.h>
#include <Adafruit_GFX.h>

#define SS_PIN D4  //D2
#define RST_PIN D2 //D1
#define OLED_WIDTH 128
#define OLED_HEIGHT 64
#define OLED_ADDR   0x3C

char* ssid = "Sonu";//Give ssid here
char* pass = "Sonu@9777"; //Give password Here

//For time
WiFiUDP ntpUDP;
NTPClient timeClient(ntpUDP, "europe.pool.ntp.org", 19800, 60000);//19800 for Indian time

//For Oled Display
Adafruit_SSD1306 display(OLED_WIDTH, OLED_HEIGHT);

// Create MFRC522 instance.
MFRC522 mfrc522(SS_PIN, RST_PIN);   

void setup() {
  Serial.begin(9600);
  SPI.begin();      // Initiate  SPI bus
  mfrc522.PCD_Init();   // Initiate MFRC522
  timeClient.begin();
  
  pinMode(D0,OUTPUT);//Buzzer
  pinMode(D3,OUTPUT);//Blue
  pinMode(D4,OUTPUT);//Red
  pinMode(D8,OUTPUT);//Green 
  
  display.begin(SSD1306_SWITCHCAPVCC, OLED_ADDR);
  WiFi.disconnect();
  delay(3000);
  WiFi.begin(ssid,pass);
  digitalWrite(D4, HIGH);
  digitalWrite(D8, LOW);
  display.clearDisplay();
  display.setTextColor(WHITE);
  display.setCursor(0,0);
  display.println("Please Wait");
  display.println("Connecting....");
  display.display();
        while(WiFi.status() != WL_CONNECTED){
          display.print(".");
          display.display();
          delay(200);}
          
  display.clearDisplay();
  display.display();
  display.setCursor(0,0);
  display.setTextSize(2);
  display.print("Connected\n");
  display.print("   To\n");
  display.print("Internet");
  display.display();
  delay(4000);
  display.clearDisplay();
  display.display();
  digitalWrite(D4,LOW);
  digitalWrite(D8,HIGH);
    display.display();
    display.setCursor(0,30);
    display.setTextSize(1);
    display.println("Please Tap your Card");
    display.display();   
}
    int i=1;
    void query()
    { 
        if(i==1)
        {
            String data="Absent";
            HTTPClient http;
            //Sending data to server
            http.begin("http://192.168.43.43:80/rfid/match2.php?absentees="+data+"&tagid=NULL");//give localhost ip and port no.
            int httpnum = http.GET();
            //if(httpnum>0)
            //{
              //String payload = http.getString();
              //Serial.print(payload);
            //}
         }
      i++;
    }
    String rfid = "";
void loop() {
     while(WiFi.status() != WL_CONNECTED)
     {
        digitalWrite(D8, LOW);
        digitalWrite(D4, HIGH);
     }
      int j=0;
      timeClient.update();
      String a=timeClient.getFormattedTime();
      if(a=="13:23:00")//Time at which you want to mark all others as absent
      {
        query();
        delay(1000);
      }
  //int hour=timeClient.getHours();
  //int minute=timeClient.getMinutes();
  //int seconds=timeClient.getSeconds();
    //Serial.print(hour);
    //if(hour==22 && minute==9 && seconds==12){
      //Serial.print("Any");
      //Serial.print(i);
      //delay(1000);
      //}
  
  // Look for new cards
  if ( ! mfrc522.PICC_IsNewCardPresent()) 
  {
    return;
  }
  // Select one of the cards
  if ( ! mfrc522.PICC_ReadCardSerial()) 
  {
    return;
  }
  display.clearDisplay();
  display.display();
  display.setCursor(15,20);
  display.setTextSize(1);
  display.println("Your Tag ID is:");
  display.display();
  String content= "";
  byte letter;
  for (byte i = 0; i < mfrc522.uid.size; i++) 
  {
     (mfrc522.uid.uidByte[i] < 0x10 ? " 0" : " ");
     (mfrc522.uid.uidByte[i], HEX);
     content.concat(String(mfrc522.uid.uidByte[i] < 0x10 ? " 0" : " "));
     content.concat(String(mfrc522.uid.uidByte[i], HEX));
  }
  content.toUpperCase();
  Serial.println();
  rfid = content.substring(1);
  int num = rfid.length();
  for(int i=0; i<num; i++){
    if(rfid[i] == ' '){
      rfid[i]='_';
    }
  }
  display.display();
  display.setTextSize(1);
  display.setCursor(15,30);
  display.println(rfid);
  display.display();
  delay(3000);
  display.clearDisplay();
  display.display();
    HTTPClient http;
    //Sending data to server
    http.begin("http://192.168.43.43:80/rfid/match2.php?tagid="+rfid+"&absentees=NULL");//give localhost ip and port no.
    int httpnum = http.GET();//Requesting the server for data
    
    if(httpnum>0)
    {
      String payload = http.getString();//Gets the actual data from server
      Serial.println("");
      Serial.print(payload);
      if(payload=="You Don't Have Authentication")
      {
              display.display();
              display.setTextSize(1);
              display.print(payload);
              display.display();
              while(j<=4)
                  {
                    digitalWrite(D0,HIGH);
                    digitalWrite(D8,LOW); 
                    digitalWrite(D4,HIGH);
                    delay(300);
                    digitalWrite(D0,LOW);
                    digitalWrite(D4,LOW);
                    delay(300);
                   j++;
                  }
              delay(4000);
              display.clearDisplay();
              display.display();
              digitalWrite(D8,HIGH);
        }
        else
        {
            display.display();
            display.setTextSize(1);
            display.setCursor(0,20);
            display.print(payload);
            display.display();
            while(j<=2)
            { 
                digitalWrite(D0,HIGH);
                digitalWrite(D8,LOW);
                digitalWrite(D4,LOW);
                digitalWrite(D3,HIGH);
                delay(400);
                digitalWrite(D0,LOW);
                digitalWrite(D3,LOW);
                delay(400);
                j++;
             } 
              delay(4000);
              display.clearDisplay();
              display.display();
              digitalWrite(D8,HIGH);
        }
            display.display();
            display.setCursor(0,30);
            display.setTextSize(1);
            display.println("Please Tap your Card:");
            display.display();
    }
       else{
              display.clearDisplay();
              display.display();
              display.setCursor(15,20);
              display.setTextSize(1);
              display.setTextColor(WHITE);
              display.print("Server Not Found\n");
              display.print("  Please Try again");
              display.display();
              digitalWrite(D8,LOW); 
              digitalWrite(D4,HIGH);
            }

            
    
  }
