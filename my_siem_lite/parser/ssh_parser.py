import re  # regex lib. 
import os
import sys # modify pyth search path

sys.path.append(os.path.dirname(os.path.dirname(__file__)))
#add the project root folder to python search path for proper import
from db.schema import get_connection, init_db
#talk to databse, pullin from there, making sure tables/info exists


PATTERNS = {
    
    "failed_login": re.compile(
        r"(\w{3}\s+\d+\s[\d:]+).*Failed password for (?:invalid user )?(\S+) from ([\d.]+)" 
        ),
    
     "accepted_login": re.compile(
        r"(\w{3}\s+\d+\s[\d:]+).*Accepted (?:password|publickey) for (\S+) from ([\d.]+)"
    ),
    
}
#go back and detect new event type later
# add new pattern to PATTERNS dict

def parse_line(line):
    for event_type, pattern in PATTERNS.items():  # loop thru patterns dict. each loop gives name like "failed login" + compiled pattern to search wit
        match = pattern.search(line) # runs pattern against one log line. returns match if found, otherwise none
        if match:
            timestamp, username, source_ip= match.groups()
            return {
                "timestamp" : timestamp,
                "source_ip": source_ip,
                "event_type": event_type,
                "username": username,
                "raw_log": line.strip(), 
            }
    return None



def parse_log_file(filepath):
    #check if log file exist. if not, print error warning and return empyty list
    if not os.path.exists(filepath):
        print(f"[!]File not found: {filepath}")
        return[]
    
    #strips folder and gives filename so data/auth.log goes to auth.log
    log_source = os.path.basename(filepath)
    #empty list filled as parse lines
    parsed_events =[]
    
    # just open database
    conn = get_connection()
    cursor = conn.cursor()
    
    #open file and read it
    with open(filepath, "r") as f:
        for line in f:
            #call func on each line
            event = parse_line(line)
            if event:
                #adds filename to event dict before storing
                event["log_source"]=log_source
                # storing in database
                cursor.execute("""
                    INSERT INTO events
                         (timestamp, source_ip, event_type, username, raw_log, log_source)
                    VALUES
                        (:timestamp, :source_ip, :event_type, :username, :raw_log, :log_source)
                 """, event)
                #adds event to list in order to return it at the end
                parsed_events.append(event)
    
    #commit and close            
    conn.commit()
    conn.close()
    # len- counts how many events found/prints it
    print(f"[+] Parsed {len(parsed_events)} events from {log_source}")
    return parsed_events

# calls init_db(), table exists(yes) parse log file and print every event found
if __name__ == "__main__":
    init_db()
    events = parse_log_file("data/auth.log")
    for event in events:
        print(event)    
            
                