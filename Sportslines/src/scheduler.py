import time 
import os
import requests
from dotenv import load_dotenv
from db import connect
from main import snapshot_once
from moves import hot_moves

load_dotenv()
WEBHOOK= os.getenv("DISCORD_WEBHOOK")
INTERVAL= 900

def send_discord_alert(moves):
    if not WEBHOOK:
        print("No Discord webhook has been set.")
        return
    if not moves:
        return
    
    
    lines= ["***Sportlines-- Hot Moves Detected***\n"]
    for m in moves[:5]: # cappped at 5 to prevent spam
        direction= "▲" if m[5] > 0 else "▼"
        lines.append(
            f"{direction} `{m[2]}` | {m[1]} | median: {m[3]} --> latest : {m[4]} | move:{[5]:+}"
        )
        
    payload = {"content": "\n".join(lines)}
    try:
        r= requests.post(WEBHOOK, json=payload, timeout=10)
        r.raise_for_status()
        print("Discord alert sent.")
    except Exception as e:
        print(f"Discord alert failed: {e}")
        

def run ():
    print("Scheduler started. Snapshotting every 15 minutes.")
    while True:
        print("\n Taking Snapshot...")
        try:
            for sport in ["nfl" , "nba"]:
                snapshot_once(sport=sport)
        except Exception as e:
            print(f"Snapshot error: {e}")
            
            
        try:
            conn = connect()
            moves =hot_moves(conn)
            conn.close()
            if moves:
                print(f"{len(moves)} hot move(s) found- alerting Discord.")
                send_discord_alert(moves)
            else:
                print("No hot moves found.")
        except Exception as e:
            print(f"Moves check error: {e}")
            
            
        print(f"Sleeping {INTERVAL // 60} minutes...")
        time.sleep(INTERVAL)
        
        
if __name__ == "__main__":
    run()