#!/usr/bin/env python
import io
from PIL import Image
import base64
import shodan
import requests
import sys
import mysql.connector
import time

api_key = shodan_api_key
api = shodan.Shodan(api_key)

def shodanSearch(pageNo, query, dbTable):
    
    count = 1

    connection = mysql.connector.connect(
        host='localhost',
        database='shodan-data',
        user='root',
        password=''
    )

    cursor = connection.cursor()

    for i in range(pageNo):
        try:
            #print i
            #print query
            results = api.search(query, i+1)
            
            for result in results['matches']:
                #print result
                ip = result['ip_str']
                if not 'asn' in result:
                    asn = 'NULL'
                else:
                    asn = result['asn']
                isp = result['isp']
                port = result['port']
                city = result['location']['city'] 
                region_code = result['location']['region_code'] 
                area_code = result['location']['area_code'] 
                country_code = result['location']['country_code']
                country_name = result['location']['country_name']
                postal_code = result['location']['postal_code']
                lat = result['location']['latitude']
                lon = result['location']['longitude']
                timestamp = result['timestamp']
                org = result['org']
                mime = result['opts']['screenshot']['mime'] 
                data = result['opts']['screenshot']['data']
                
                recordTuple = (ip, port, asn, isp, city, region_code, area_code, country_code, postal_code, country_name, lat, lon, timestamp, org, mime, data)
                #print str(count) + '. Taking screenshot for ' + str(ip)
                
                rdp_sql = """INSERT INTO `rdp`(`ip`, `port`, `asn`, `isp`, `city`, `region_code`, `area_code`, `country_code`, `postal_code`, `country_name`, 
                `latitude`, `longitude`, `timestamp`, `org`, `mime`, `image_data`) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)"""
                vnc_sql = """INSERT INTO `vnc`(`ip`, `port`, `asn`, `isp`, `city`, `region_code`, `area_code`, `country_code`, `postal_code`, `country_name`,
                `latitude`, `longitude`, `timestamp`, `org`, `mime`, `image_data`) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)"""
                
                if str(dbTable).lower() == 'rdp': 
                    cursor.execute(rdp_sql, recordTuple)
                elif str(dbTable).lower() == 'vnc': 
                    cursor.execute(vnc_sql, recordTuple)
                else:
                    print "Table doesn't exist. Exiting..."
                    break

                connection.commit()
                print(str(count) + ". Record inserted successfully into table for " + str(ip))
                count = count +1
                #print mime
                #saveFileFromShodan(mime, data, ip) 
        except shodan.APIError, e:
            print('Error: {}'.format(e))
        time.sleep(2)    


def saveFileFromShodan(mime, data, name):

    b = b'data:' + mime + ';base64,' + data
    z = b[b.find(b'/9'):]
    im = Image.open(io.BytesIO(base64.b64decode(z))).save('rdp/' + name + '.jpg')
    count = count + 1

def help():
    print "[-] Usage : python fetch.py [Query] [Page Numbers] [Database Table]"
    print "[-] Query : Search Query for shodan eg 'port:3389"
    print "[-] Page Numbers: Number of pages to get results from (1 Page = 100 Results)"
    print "[-] Database Table: Name of the db table(rdp or vnc)"
    print ""

def main():

    #help()
    query = raw_input("Enter Query: ")
    pagesToSearch = int(raw_input("Enter Number of Pages: "))
    dbTable = raw_input("Enter table name: ")

    print "[+] Query        : " + str(query)
    print "[+] No. of Pages : " + str(pagesToSearch)
    print "[+] Table Name   : " + str(dbTable)
    print ""
    
    shodanSearch(pagesToSearch, query, dbTable)



main()
