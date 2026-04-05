MY Siem Lite is a simply a lightweight monitoring tool built with Python. It takes SSH auth logs, parses them for suspicious activity, enriches flagged IP addresses with actual threat intelligence via the AbuseIPDB API, and generates alerts when brute force patterns are detected. All data is served through a REST API built with Flask.
Built to able to apply cybersecurity fundamentals in a practical, real world context.

### Features
- Parses SSH auth logs using regex pattern matching
- Detects brute force attacks based on previously configured thresholds
- Cross references suspicious Ips with live threat intelligence via AbuseIPDB
- Stores events, alerts, and IP reputation data in normalized  SQLite database
- Serves all data through REST APi built with Flask
- Single command pipeline execution via run.py


### Tech Stack
-Python 3.11
- SQLite : database with 3 tables
- Flask : REST API
- AbuseIPDB : threat intelligence analyzer
- Regex : log parsing and pattern matching


### Project Structure

```
my_siem_lite/
├── data/
│   └── auth.log          # SSH log input
├── db/
│   └── schema.py         # Database schema and connection
├── parser/
│   └── ssh_parser.py     # Log parser with regex patterns
├── api_intel/
│   ├── abuseipdb.py      # AbuseIPDB threat flagger
│   ├── detector.py       # Brute force anomaly detection
│   └── routes.py         # Flask REST API endpoints
└── run.py                # Full pipeline runner
```

### How To Run

1. Clone the repository
   git clone https://github.com/Darinmack/Projects.git

2. Install dependencies
   pip install flask requests python-dotenv

3. Add your AbuseIPDB API key
   Create a .env file in the project root and add:
   ABUSEIPDB_API_KEY=your_key_here

4. Run the pipeline
   python run.py

5. Access the API
   http://localhost:5000/api/alerts
   http://localhost:5000/api/events
   http://localhost:5000/api/reputation/<ip_address>

### How It Works

1. run.py kicks off the full pipeline in order
2. ssh_parser.py reads auth.log and uses regex to extract failed/accepted
   login events, storing them in the events table
3. abuseipdb.py takes each unique IP and queries the AbuseIPDB API
   for a threat confidence score, storing results in ip_reputation
4. detector.py queries the events table, counts failed logins per IP,
   and generates alerts for any IP exceeding the designated threshold
5. Flask serves all data as JSON through three REST endpoints
