from datetime import datetime, timezone
from db import connect
from odds_api import get_nfl_odds

def to_iso_utc(dt_str):
     # API usually returns ISO already; this is a safety shim.
    # If it's already Z/UTC, return as-is. Otherwise, parse & convert.
    try:
        # try fromisoformat first (py3.11+ tolerates 'Z' via replace)
        s = dt_str.replace("Z", "+00:00")
        dt = datetime.fromisoformat(s)
        return dt.astimezone(timezone.utc).strftime("%Y-%m-%dT%H:%M:%SZ")
    except Exception:
        return dt_str  # fallback: store whatever was given

def now_ts():
    return int(datetime.now(timezone.utc).timestamp())

def snapshot_once():
    data = get_nfl_odds()
    conn = connect()
    cur = conn.cursor()
    ts = now_ts()

    for g in data:
        game_id = g["id"]
        commence_iso = to_iso_utc(g.get("commence_time", ""))
        cur.execute("""
            INSERT OR REPLACE INTO games(game_id, sport_key, commence_time, home_team, away_team)
            VALUES(?,?,?,?,?)
        """, (game_id, g.get("sport_key","americanfootball_nfl"), commence_iso,
              g.get("home_team",""), g.get("away_team","")))

        for b in g.get("bookmakers", []):
            book_key = b.get("key") or ""
            title    = b.get("title") or ""
            if not book_key: 
                continue
            cur.execute("INSERT OR IGNORE INTO books(book_key, title) VALUES(?,?)",
                        (book_key, title))

            for m in b.get("markets", []):
                mkt = (m.get("key") or "").lower()
                if mkt not in ("spreads","totals","h2h"):
                    continue

                for o in m.get("outcomes", []):
                    selection = o.get("name") or ""
                    price = o.get("price")
                    point = o.get("point")

                    # coerce types
                    price_int = int(price) if price is not None else None
                    line_num  = float(point) if point is not None else None

                    cur.execute("""
                      INSERT OR IGNORE INTO odds(game_id, book_key, market, selection, price, line, ts)
                      VALUES(?,?,?,?,?,?,?)
                    """, (game_id, book_key, mkt, selection, price_int, line_num, ts))

    conn.commit()
    conn.close()

if __name__ == "__main__":
    snapshot_once()
    print("Snapshot saved.")
