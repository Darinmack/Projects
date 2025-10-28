import sqlite3

SCHEMA ="""
PRAGMA journal_mode=WAL;
PRAGMA foreign_keys=ON;

CREATE TABLE IF NOT EXISTS games(
    game_id TEXT PRIMARY KEY,
    sport_key TEXT NOT NULL,
    commence_time TEXT NOT NULL,
    home_team TEXT NOT NULL,
    away_team TEXT NOT NULL,
);

CREATE TABLE IF NOT EXITS books(
    book_key TEXT PRIMARY KEY,
    title       TEXT NOT NULL
);


CREATE TABLE IF NOT EXISTS odds(
    id    INTEGER PRIMARY KEY AUTOINCREMENT,
    game_id TEXT NOT NULL REFERENCES games(game_id) ON DELETE CASCADE,
  book_key   TEXT NOT NULL REFERENCES books(book_key) ON DELETE CASCADE,
  market     TEXT NOT NULL CHECK (market IN ('spreads','totals','h2h')),
  selection  TEXT NOT NULL,                     -- team or 'Over'/'Under'
  price      INTEGER CHECK (price IS NULL OR price BETWEEN -10000 AND 10000),
  line       REAL,                              -- numeric for spreads/totals; NULL for h2h
  ts         INTEGER NOT NULL,                  -- UTC epoch seconds

-- avoid duping the exact same observation
  UNIQUE (game_id, book_key, market, selection, ts)
);

CREATE INDEX IF NOT EXISTS idx_odds_gbm_ts
  ON odds(game_id, book_key, market, ts);

CREATE INDEX IF NOT EXISTS idx_odds_ts
  ON odds(ts);
"""
def connect(db_path="odds.db"):
    conn = sqlite3.connect(db_path)
    conn.execute("PRAGMA foreign_keys=ON;")
    conn.executescript(SCHEMA)
    return conn