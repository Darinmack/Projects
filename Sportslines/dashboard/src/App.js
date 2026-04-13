import { useState, useEffect} from "react";
import axios from "axios";
import "./App.css";

const API= "http://127.0.0.1:5000";

function GamesList({games}) {
  return (
    <div className="card">
      <h2>Upcoming Games</h2>
      {games.length ===0 ? (
        <p className="empty">No games found.</p>
      ) : (
        <table>
          <thead>
            <tr>
              <th>Sport</th>
              <th>Home</th>
              <th>Away</th>
              <th>Tip Off</th>
            </tr>
          </thead>
          <tbody>
            {games.map( (g) => (
              <tr key = {g.game_id}>
                <td> {g.sport_key === "basketball_nba" ? "NBA" : g.sport_key === "baseball_mlb" ? "MLB" : "NFL"}</td> 
                <td>{g.home_team}</td> 
                <td>{g.away_team}</td>
                <td> {new Date(g.commence_time).toLocaleString()} </td>
                </tr>
            ))}
          </tbody>
        </table>
      )}
      </div>
  );
}

function HotMoves({moves}) {
  return (
    <div className= "card"> 
    <h2>Hot Moves</h2>
    {moves.length ===0 ? (
      <p className = "empty"> No significant line moves detected yet. Run more snapshots. </p>
    ) : (
      <table>
        <thead>
          <tr>
            <th>Game</th>
            <th>Book</th>
            <th>Selection</th>
            <th>Median</th>
            <th>Latest</th>
            <th>Move</th>
          </tr>
        </thead>
        <tbody>
          {moves.map((m,i) => (
            <tr key={i}>
              <td>{m.game_id}</td>
              <td>{m.book}</td>
              <td>{m.selection}</td>
              <td>{m.median_line}</td>
              <td>{m.latest_line}</td>
              <td className={m.move > 0 ? "up": "down"}> 
                {m.move > 0 ? "+" : ""}{m.move}
              </td>
            </tr>
           ))}
        </tbody>
      </table>
    )}
    </div>
  );
}

function OddsTable({odds}){
  return(
    <div className="card">
      <h2>Current Odds</h2>
      {odds.length === 0 ? (
        <p classMame="empty">No odds data were found.</p>
      ) : (
        <table>
          <thead>
            <tr>
              <th>Book</th>
              <th>Market</th>
              <th>Selection</th>
              <th>Price</th>
              <th>Line</th>
            </tr>
          </thead>
          <tbody>
            {odds.slice(0,50).map((o,i) => (
              <tr key={i}>
                <td>{o.book_key}</td>
                <td>{o.market}</td>
                <td>{o.selection}</td>
                <td>{o.price> 0 ? "+": ""}{o.price}</td>
                <td>{o.line ?? "-"}</td>
              </tr>
            ))}
          </tbody>
        </table>
      )}
    </div>
  );
}


export default function App() {
  const[games, setGames]= useState([]);
  const[odds, setOdds] = useState([]);
  const[moves, setMoves]= useState([]);
  const [loading, setLoading]= useState(true);


  useEffect(() => {
    Promise.all([
      axios.get(`${API}/api/games`),
      axios.get(`${API}/api/odds`),
      axios.get(`${API}/api/hotmoves`),
    ]). then (([gRes, oRes, mRes])  => {
      setGames(gRes.data);
      setOdds(oRes.data);
      setMoves(mRes.data);
      setLoading(false);
    });
  }, []);


  if (loading) return <div className= "loading">Loading Sportslines...</div>;

  return (
    <div className="app">
      <header>
        <h1>SportsLines</h1>
        <p>Live Odds Tracking - NBA, NFL & MLB</p>
      </header>
      <main>

        <GamesList games = {games} />
        <HotMoves moves = {moves} />
        <OddsTable odds = {odds} />
      </main>
    </div>
  );

}

