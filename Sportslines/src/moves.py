# src/moves.py
import sqlite3, statistics
from datetime import datetime, timezone

def now_ts():
    return int(datetime.now(timezone.utc).timestamp())

def latest_lines(conn, market, since_ts):
    q = """
    WITH latest AS (
      SELECT game_id, book_key, selection, MAX(ts) AS max_ts
      FROM odds
      WHERE market = ? AND ts >= ?
      GROUP BY game_id, book_key, selection
    )
    SELECT o.game_id, o.book_key, o.selection, o.line, o.price, o.ts
    FROM odds o 
    JOIN latest l ON o.game_id=l.game_id 
                 AND o.book_key=l.book_key
                 AND o.selection=l.selection 
                 AND o.ts=l.max_ts
    """
    return conn.execute(q, (market, since_ts)).fetchall()

def median_past_line(conn, game_id, book_key, selection, market, since_ts, until_ts):
    q = """
    SELECT line FROM odds
     WHERE game_id=? AND book_key=? AND selection=? AND market=?
       AND ts BETWEEN ? AND ? AND line IS NOT NULL
     ORDER BY ts DESC LIMIT 50
    """
    vals = [r[0] for r in conn.execute(q, (game_id, book_key, selection, market, since_ts, until_ts))]
    if len(vals) < 2: return None
    return statistics.median(vals)

def hot_moves(conn, market="spreads", threshold=1.0, hours=3):
    until = now_ts()
    since = until - hours*3600
    rows = latest_lines(conn, market, since)
    out = []
    for game_id, book, sel, line, price, ts in rows:
        if line is None:
            continue
        med = median_past_line(conn, game_id, book, sel, market, since, until)
        if med is None:
            continue
        move = round(line - med, 2)
        if abs(move) >= threshold:
            out.append((game_id, book, sel, med, line, move))
    return sorted(out, key=lambda x: -abs(x[5]))

if __name__ == "__main__":
    conn = sqlite3.connect("odds.db")
    for market, threshold in [("spreads", 1.0), ("totals", 1.0)]:
        print(f"\nHOT MOVES ({market})")
        for (gid, book, sel, med, latest, mv) in hot_moves(conn, market=market, threshold=threshold, hours=3):
            print(f"{gid} | {book:10s} | {sel:8s} | median={med} latest={latest} move={mv:+}")
