import react,{useState} from "react";

const App=()=>{
  const[usd,setUsd]=useState("");
  const[inr,setInr]=useState("");

  const exchange=83;
  const handleConversion=()=>{
    if(!usd || isNaN(usd)){
      alert("please enter usd dollars");
      return;
    }else{
      setInr((usd*exchange).toFixed(2));
    }
  }
  return (
    <div style={{ textAlign: "center", marginTop: "50px" }}>
      <h1>Currency Converter</h1>
      <div style={{ marginBottom: "20px" }}>
        <label htmlFor="usdInput" style={{ fontSize: "18px", marginRight: "10px" }}>
          Enter Amount in USD:
        </label>
        <input
          type="text"
          id="usdInput"
          value={usd}
          onChange={(e) => setUsd(e.target.value)}
          style={{ padding: "8px", fontSize: "16px", width: "150px" }}
        />
      </div>
      <button
        onClick={handleConversion}
        style={{
          padding: "10px 20px",
          fontSize: "16px",
          backgroundColor: "#007BFF",
          color: "white",
          border: "none",
          borderRadius: "5px",
          cursor: "pointer",
        }}
      >
        Convert to INR
      </button>
      <div style={{ marginTop: "20px", fontSize: "18px" }}>
        {inr && (
          <>
            <strong>Converted Amount in INR:</strong> ₹{inr}
          </>
        )}
      </div>
    </div>
  );
}

export default App;
