import requests #making http call to abuse servers
import os
import sys
from dotenv import load_dotenv #import func to read .env file


sys.path.append(os.path.dirname(os.path.dirname(__file__)))
from db.schema import get_connection

load_dotenv()
API_KEY= os.getenv("ABUSEIPDB_API_KEY") #grabbing API Key and storing for easy/ready to go use

def check_ip(ip_address):
    url = "https://api.abuseipdb.com/api/v2/check"
    
    headers = {
        "Key": API_KEY,
        "Accept" : "application/json"
    }
    
    params = {
        "ipAddress" : ip_address,
        "maxAgeInDays" : 90
    }
    
    response = requests.get(url, headers= headers, params= params)
    
    if response.status_code != 200:
        print(f"[!]API error for {ip_address}: { response.status_code}")
        return None
    
    data = response.json()
    return data["data"]


def enrich_ip(ip_address):
    data = check_ip(ip_address)
    
    if not data:
        return None
    
    conn = get_connection()
    cursor = conn.cursor()
    
    cursor.execute("""
           INSERT INTO ip_reputation
                (ip_address, abuse_confidence, total_reports, country_code, isp, is_whitelisted, last_checked)
            VALUES
                (:ip, :score, :reports, :country, :isp, :whitelisted, datetime('now'))
            ON CONFLICT(ip_address) DO UPDATE SET
                abuse_confidence = :score,
                total_reports =  :reports,
                country_code =   :country,
                isp           =  :isp,
                is_whitelisted = :whitelisted,
                last_checked  =  datetime('now') 
     """, {
            "ip":      data["ipAddress"],
            "score":   data["abuseConfidenceScore"],
            "reports": data["totalReports"],
            "country": data["countryCode"],
            "isp":     data["isp"],
            "whitelisted": 1 if data["isWhitelisted"] else 0 
    })
    
    conn.commit()
    conn.close()
    
    
    print(f"[+] Enriched {ip_address} - abuse score: {data['abuseConfidenceScore']}")
    return data 
    
    

if __name__ == "__main__":
    enrich_ip("45.33.32.156")
    enrich_ip("192.168.1.105")
    enrich_ip("203.0.113.42")
    enrich_ip("198.51.100.77")
    
    # result = check_ip("45.33.32.156")
    #print(result)
    