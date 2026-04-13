#SportsLines

A real-time sports odds tracking dashboard for NBA, NFL  & MLB games.



### What it does 
- Fetches live odds (spreads, totals, moneyline) from 10+ sportsbooks via the-odds-api
- Stores timestamped snapshots in a local SQLite database
- Detects line movement by comparing latest lines against historical medians
- Serves data via a Flask REST API
- Displays games, odds, and hot moves on a React dashboard
- Sends Discord alerts when significant line moves are detected

## What it does

- Fetches live odds (spreads, totals, moneyline) from 10+ sportsbooks via the-odds-api
- Stores timestamped snapshots in a local SQLite database
- Detects line movement by comparing latest lines against historical medians
- Serves data via a Flask REST API
- Displays games, odds, and hot moves on a React dashboard
- Sends Discord alerts when significant line moves are detected

## Tech stack

- **Backend** — Python, Flask, SQLite
- **Frontend** — React
- **Data** — the-odds-api
- **Alerts** — Discord webhooks

## Setup

### Prerequisites
- Python 3.10+
- Node.js 18+
- An API key from [the-odds-api.com](https://the-odds-api.com)
- A Discord webhook URL

### 1. Clone the repo
git clone https://github.com/Darinmack/Projects.git
cd Projects/Sportslines


### 2. Set up the Python environment
python -m venv .venv
.venv\Scripts\activate
pip install -r requirements.txt


### 3. Configure environment variables
Create a `.env` file in the root directory:
ODDS_API_KEY=your_api_key_here
DISCORD_WEBHOOK=your_discord_webhook_url_here

### 4. Run the Flask backend
cd src
python app.py

### 5. Start the scheduler
In a separate terminal:
cd src
python scheduler.py

### 6. Start the React dashboard
In a separate terminal:
cd dashboard
npm start

The dashboard will open at `http://localhost:3000`

## How the line movement detection works

Every time the scheduler runs, it snapshots current odds from all available books. For each game/book/selection combination, it calculates the median line across all stored snapshots and compares it to the latest line. If the difference exceeds the threshold, it's flagged as a hot move and a Discord alert is fired.

## Project structure
Sportslines/
├── src/
│   ├── app.py          # Flask API
│   ├── db.py           # Database setup and connection
│   ├── main.py         # Odds snapshot logic
│   ├── moves.py        # Line movement detection
│   ├── odds_api.py     # the-odds-api client
│   └── scheduler.py    # Automated polling and alerts
├── dashboard/          # React frontend
├── requirements.txt
└── .env                # Not committed - see setup

