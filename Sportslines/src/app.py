from flask import Flask, jsonify
from flask_cors import CORS
from db import connect
from moves import hot_moves

app = Flask(__name__)
CORS(app)


@app.route("/api/games")
def games():
    conn = connect()
    rows = conn.execute("""
            SELECT game_id, sport_key, commence_time, home_team, away_team
            FROM games
            ORDER BY commence_time ASC
    """).fetchall()
    conn.close()
    return jsonify([
        {
            "game_id": r[0],
            "sport_key": r[1],
            "commence_time": r[2],
            "home_team": r[3],
            "away_team": r[4]
        } for r in rows
    ])
    

@app.route("/api/odds")
def odds():
    conn =connect()
    rows =conn.execute("""
        SELECT o.game_id, o.book_key, o.market, o.selection, o.price, o.line, o.ts
        FROM odds o
        ORDER BY o.ts DESC
        LIMIT 200
    """).fetchall()
    conn.close()
    return jsonify([
        {
          "game_id": r[0],
            "book_key": r[1],
            "market": r[2],
            "selection": r[3],
            "price": r[4],
            "line": r[5],
            "ts":   r[6]  
        } for r in rows
    ])


@app.route("/api/hotmoves")
def hotmoves():
    conn = connect()
    moves = hot_moves(conn)
    conn.close()
    return jsonify([
        {
            "game_id": m[0],
            "book": m[1],
            "selection": m[2],
            "median_line": m[3],
            "latest_line": m[4],
            "move": m[5]
        } for m in moves
    ])
    

if __name__ == "__main__":
    app.run(debug=True, port=5000)