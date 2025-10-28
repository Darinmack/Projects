import os, requests
from dotenv import load_dotenv
#request HTTP client used to call odss API
#dotenv loads variables from local .env file 

load_dotenv() # reads .env and inject ODDS_API_KEY into process env
API_KEY=os.getenv("ODSS_API_KEY") # pulls val at import time
BASE = "https://api.the-odds-api.com/v4"
TIMEOUT= 25 #just to stop program from hanging/stuck in case of stalling

def get_nfl_odss(markets="spreads,totals,h2h", regions="us", odds_format="american"):
    if not API_KEY:
        raise RuntimeError("Missing ODDS_API_KEY in .env")
    url= f"{BASE}/sports/americanfootball_nfl/odds/"
    params = {
        "apiKey": API_KEY,
        "regions": regions,
        "markets":markets,
        "oddsFormat":odds_format
    }
    r = requests.get(url, params=params, timeout=TIMEOUT)
    r.raise_for_status()
    return r.json() # parses the response body as JSON and returns it