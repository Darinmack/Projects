import os
import sys


sys.path.append(os.path.dirname(__file__))

from db.schema import init_db
from parser.ssh_parser import parse_log_file
from api_intel.abuseipdb import enrich_ip
from api_intel.detector import detect_brute_force
from api_intel import routes

def clear_tables():
    from db.schema import get_connection
    conn= get_connection()
    cursor = conn.cursor()
    cursor.execute("DELETE FROM alerts")
    cursor.execute("DELETE FROM  events")
    cursor.execute("DELETE FROM ip_reputation")
    conn.commit()
    conn.close()
    print("[] Tables cleared ")

def run_pipeline():
    print("\n=== SIEM Lite Pipeline Commencing ===\n")
    
   
    
    print("[1/5] Initializng databse...")
    init_db()
    
    print("[2/5] Wiping old data")
    clear_tables()
    
    print("\n[3/5] Parsing log files...")
    events =parse_log_file("data/auth.log")
    
    
    print("\n [4/5] Enrich IPs with threat intelligence")
    seen_ips = set()
    for event in events:
        ip = event["source_ip"]
        if ip not in seen_ips:
            enrich_ip(ip)
            seen_ips.add(ip)
            
    
    print("\n[5/5] Running Anomaly detection")
    detect_brute_force()
    
    print("\n=== Pipeline finished. Starting API server ===\n")
    routes.app.run(debug=True)
    
    
if __name__ == "__main__":
    run_pipeline()
