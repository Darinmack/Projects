import os 
import sys
from flask import Flask, jsonify #import framework and helper to convert Python dict to json reponses...

sys.path.append(os.path.dirname(os.path.dirname(__file__)))
from db.schema import get_connection 

app = Flask(__name__) # creating flask applic..
# __name__ just tells FLask where app is gonna live in order to find file relative to it

@app.route("/api/alerts") # tells flask to run this function below when someone hits this url
def get_alerts():
    conn = get_connection()
    cursor = conn.cursor()
    
    
    cursor.execute("""
        SELECT * FROM alerts
        ORDER BY  created_at DESC 
    """)
    
    rows = cursor.fetchall()
    conn.close()
    
    
    alerts = [dict(row) for row in rows] # looping through every row and converting into dict
    return jsonify(alerts) #converts and returns list of dictionaries into proper readable JSON format
    
    

@app.route("/api/events")
def get_events():
    conn = get_connection()
    cursor = conn.cursor()
    
    
    cursor.execute(""" 
        SELECT * FROM events
        ORDER BY created_at DESC
    """)
    
    rows = cursor.fetchall()
    conn.close() 
    
    events = [dict(row) for row in rows]
    return jsonify(events)


@app.route("/api/reputation/<ip>")  # ip is variable
def get_reputation(ip):
    conn = get_connection()
    cursor= conn.cursor()
    
    #whatever is put into url after /api/reputation is passed into func as ip parameter
    cursor.execute("""
        SELECT * FROM ip_reputation
        WHERE ip_address= ?
    """, (ip,))
    
    
    row= cursor.fetchone()  # expect one row back due to IP address as primary key
    conn.close()
    
    
    if not row:
        return jsonify({"Error!": "IP not found!"}), 404
    #if Ip not in database send error message wit 404 status code(for when a page doesn't exist)
    return jsonify(dict(row))
    
    
if __name__ == "__main__":
    app.run(debug=True)
    #auto restart for saved changes