import React, { useState, useEffect } from "react";
import ReactDOM from "react-dom/client";

function Widget(props) {
  return (
    <div className="rounded">
      <header className="App-header">
        <h1 className="text-2xl font-bold">Exchange Rates</h1>
      </header>
      <p>
        Edit <code>src/App.js</code> and save to reload.
      </p>
      <a className="App-link" href="https://reactjs.org" target="_blank" rel="noopener noreferrer">
        Learn React
      </a>
    </div>
  );
}

export default Widget;
