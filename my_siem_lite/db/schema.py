import sqlite3
import os

DB_Path=os.path.join(os.path.dirname(__file__), "siem.db")
#builds full path to where database will live

def get_connection():
    conn=sqlite3.connect(DB_Path) #opens a connection to my database, if file doesnt exist yet, SQLite creates it automatically
    conn.row_factory= sqlite3.Row # makes query results act like dictionaries so you can do row["source_ip"] instead of row[2]
    conn.execute("PRAGMA foreign_keys = ON") #SQLite doesnt enforce relationships between tables be default, this help to turn that on
    return conn



def init_db():
    conn =get_connection()
    cursor= conn.cursor()
    
    cursor.execute("""
        CREATE TABLE IF NOT EXISTS events(
            id          INTEGER PRIMARY KEY AUTOINCREMENT,
            timestamp  TEXT    NOT NULL,  
            source_ip  TEXT    NOT NULL,
            event_type TEXT    NOT NULL,
            username  TEXT,
            raw_log    TEXT    NOT NULL,
            log_source TEXT    NOT NULL,
            created_at TEXT    DEFAULT (datetime('now'))   
        )
     """)
    
    # timestamp- when the event happened pulled from log
    # source_ip- IP address that triggered said event
    # event_type- what kind of even it was, ex. "failed login" or "accepted login"
    #username- which username targeted, root/admin usual targets for brute force
    #raw_log- orginial unmodified log line, raw data stored in case need to re parse later for logic changes
    # log_source- which file log came from, useful for when ingest/use multiple log files
    # created_at- when i/my system recorded it, diff from timestamp which is when it actually happened
    
    #Table for IP_Reputation. Stores ABuseIPDB data for each IP address the parser flags
    cursor.execute("""
                    CREATE TABLE IF NOT EXISTS ip_reputation(
                        ip_address        TEXT PRIMARY KEY,
                        abuse_confidence  INTEGER,
                        total_reports     INTEGER,
                        country_code       TEXT,
                        isp                TEXT,
                        is_whitelisted     INTEGER DEFAULT 0,
                        last_checked       TEXT   DEFAULT(datetime('now'))
                        )
                   """)
    
    # ip address- IP itself, primary because only one row per IP no duplicates
    # abuse_confidence- 0-100 score from AbuseIPDB, main threat indicator
    # total_reports- how many times that IP has been reported by anyone in the AbuseIPDB community
    #country code- where IP is geographically located, like "CN" or "RU"
    #isp- internet provider behind IP
    # is_whitelisted - ) means not whitelisted and 1 mean it is. SQL doesnt use boolean so we use 0 and 1
    # last_checked- when you last queried AbuseIPDB for this IP, useful so you dont hammer API checkign same Ip mutliple times
    
    
    #Table for Alerts. this is where ill be writing record every time an IP crosses a danger threshold, ex. "failing to login in 5 times within a short time frame"
    cursor.execute(""" 
            CREATE TABLE IF NOT EXISTS alerts(
                id           INTEGER PRIMARY KEY AUTOINCREMENT,
                source_ip    TEXT     NOT NULL,
                alert_type    TEXT    NOT NULL,
                severity      TEXT    NOT NULL,
                event_count   INTEGER  NOT NULL,
                details       TEXT,
                resolved     INTEGER DEFAULT 0,
                created_at   TEXT DEFAULT(datetime('now')),
                FOREIGN KEY (source_ip) REFERENCES ip_reputation(ip_address)
            )    
         """)
    
    #alert_type- what exactly triggered said alert, ex. brute force, port scan etc
    # severity- how bad it really is, levels being low, medium, high, critical
    # event_count- how many events triggered said alert, ex. excessive failed logins
    # details- just a simple plain description of what happened
    # resolved - 0 means active alert, 1 means its been dealt with
    # Foreign key- links every alert directly back to an IP through reputation table
    
    
    # i need to upload and update my github everytime i work on this
    
    conn.commit()
    conn.close()
    print("[+] The Database is initialized")
    
    
if __name__ == "__main__":
    init_db()
        #Every Python file has a built-in variable called __name__. Its value depends on how the file is being used:
#If you run it directly like python db/schema.py — Python sets __name__ to "__main__"
#If another file imports it like from db.schema import get_connection — Python sets __name__ to "db.schema" instead
#Without the if __name__ guard, every time your parser imports anything from schema.py, it would also automatically run init_db() — wiping and recreating your tables every single time. That's bad.
#With the guard, init_db() only runs when you explicitly do python db/schema.py. Importing it elsewhere does nothing extra.    
    


