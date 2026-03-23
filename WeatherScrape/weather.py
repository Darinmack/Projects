import requests
from bs4 import BeautifulSoup
from datetime import datetime
import sqlite3
import sys

def get_weather(zip_code="10901"):
    """
    Pull current weather conditions for a given US ZIP code
    from National Weather Service public forecast pages.
    Data is public domain from NOAA/NWS. 
    """

    # Build URL for this ZIP
    url = f"https://forecast.weather.gov/zipcity.php?inputstring={zip_code}"

    # Pretend to be Chrome on Windows so we get normal HTML
    headers = {
        "User-Agent": (
            "Mozilla/5.0 (Windows NT 10.0; Win64; x64) "
            "AppleWebKit/537.36 (KHTML, like Gecko) "
            "Chrome/120.0 Safari/537.36"
        )
    }

    # Grab page
    res = requests.get(url, headers=headers, timeout=10)
    res.raise_for_status()  # throw if 4xx/5xx

    # Parse HTML
    soup = BeautifulSoup(res.text, "html.parser")

    # Temperature (e.g. "58°F")
    temp_tag = soup.select_one("p.myforecast-current-lrg")
    temp_text = temp_tag.get_text(strip=True) if temp_tag else None

    # Condition (e.g. "Mostly Cloudy")
    cond_tag = soup.select_one("p.myforecast-current")
    cond_text = cond_tag.get_text(strip=True) if cond_tag else None

    # Humidity and Wind are in the "Current Conditions" table
    humidity_label = soup.find("td", string="Humidity")
    if humidity_label:
        humidity_value = humidity_label.find_next_sibling("td").get_text(strip=True)
    else:
        humidity_value = None

    wind_label = soup.find("td", string="Wind Speed")
    if wind_label:
        wind_value = wind_label.find_next_sibling("td").get_text(strip=True)
    else:
        wind_value = None

    data = {
        "zip": zip_code,
        "timestamp": datetime.now().isoformat(timespec="seconds"),
        "temperature": temp_text,
        "condition": cond_text,
        "humidity": humidity_value,
        "wind": wind_value,
    }

    return data

def init_db(db_path="weather.db"):
    """
    Create the SQLite DB/table if it doesn't exist yet.
    SQLite uses dynamic typing, so TEXT columns are fine for numbers. 
    """
    conn = sqlite3.connect(db_path)
    cur = conn.cursor()
    cur.execute("""
        CREATE TABLE IF NOT EXISTS weather (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            ts TEXT,
            zip TEXT,
            temperature TEXT,
            condition TEXT,
            humidity TEXT,
            wind TEXT
        )
    """)
    conn.commit()
    conn.close()

def save_to_db(row, db_path="weather.db"):
    """
    Insert one weather observation into the DB.
    """
    conn = sqlite3.connect(db_path)
    cur = conn.cursor()
    cur.execute("""
        INSERT INTO weather (ts, zip, temperature, condition, humidity, wind)
        VALUES (?, ?, ?, ?, ?, ?)
    """, (
        row["timestamp"],
        row["zip"],
        row["temperature"],
        row["condition"],
        row["humidity"],
        row["wind"],
    ))
    conn.commit()
    conn.close()

if __name__ == "__main__":
    # Step 1: make sure DB is ready
    init_db()

    # Step 2: read ZIP from command line if given, else default
    if len(sys.argv) > 1:
        zip_code = sys.argv[1]
    else:
        zip_code = "10001"  # default Manhattan ZIP

    # Step 3: scrape
    weather = get_weather(zip_code)

    # Step 4: print nicely to console
    print(f"[{weather['timestamp']}] ZIP {zip_code}")
    print(f"Temp:      {weather['temperature']}")
    print(f"Condition: {weather['condition']}")
    print(f"Humidity:  {weather['humidity']}")
    print(f"Wind:      {weather['wind']}")

    # Step 5: save to SQLite
    save_to_db(weather)
    print("Saved to weather.db")
