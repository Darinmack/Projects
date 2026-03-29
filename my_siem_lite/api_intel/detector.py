import os
import sys

sys.path.append(os.path.dirname(os.path.dirname(__file__)))
from db.schema import get_connection


def detect_brute_force(threshold=3):
    conn = get_connection()
    cursor = conn.cursor()
    
    #Select sourceIp, count... - for each ip, count the amount of rows in events table
    #event type- only for failed logins
    # group by- grouping all rows by IP so one result per IP
    # having count(*)>=? only return IPs having at least threshold failed logins(3), ?- just a placeholder
    # threshold- passes your threshold value in to replace ?. comma after threshold makes it a tuple, SQL logic/syntax
    cursor.execute(""" 
        SELECT source_ip, COUNT(*) as attempt_count  
        FROM events
        WHERE event_type= 'failed_login'
        GROUP BY source_ip
        HAVING COUNT(*) >= ?              
    """, (threshold,))
    
    suspicious_ips = cursor.fetchall()
    
    for row in suspicious_ips:
        ip =row["source_ip"]
        count = row["attempt_count"]
        
        if count >=10:
            severity = "high"  
        elif count >= 5:
            severity = "medium"
        else:
            severity = "low"
        
        cursor.execute(""" 
            INSERT INTO alerts
                (source_ip, alert_type, severity, event_count, details)        
            VALUES
                (?, ?, ?, ?, ?)     
        """, (          
            ip,
            "brute_force",
            severity,
            count,
            f"{count} failed login attempts detected from {ip}"
         ))
        
        print(f"[!] Alert generated - {severity.upper()} - {ip} - {count} attempts")
    
    conn.commit()
    conn.close()

if __name__ == "__main__":
    detect_brute_force()