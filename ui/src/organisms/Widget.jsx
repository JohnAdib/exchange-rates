import React, { useState, useEffect } from "react";
import { SampleData } from "../pages/SampleData.js";

export default function Widget(props) {
  const [error, setError] = useState(null);
  const [isLoaded, setIsLoaded] = useState(false);
  const [apiData, setApiData] = useState([]);
  const baseCurrency = "USD";
  const everyCheckInterval = 1000 * 60; // 60 sec = 1 min

  // once on start
  useEffect(() => {
    getDataFromApi();

    const interval = setInterval(getDataFromApi, everyCheckInterval);
    // This represents the unmount function, in which you need to clear your interval to prevent memory leaks.
    return () => clearInterval(interval);
  }, []);

  function getDataFromApi() {
    fetch("http://localhost:8022/api")
      .then((res) => res.json())
      .then(
        (result) => {
          setIsLoaded(true);
          setApiData(result);
          console.log(result);
        },
        (error) => {
          setIsLoaded(true);
          setApiData(SampleData);
          setError(error);
        }
      );
  }

  if (!isLoaded) {
    return <div className="py-2 px-4 leading-10">Loading...</div>;
  }

  const myRates = apiData.latest.rates;

  const itemsEl = Object.entries(myRates).map((item, index) => {
    const currency = item[0];
    const exchangeRate = Math.round((item[1] + Number.EPSILON) * 1000) / 1000;
    if (currency === baseCurrency) {
      return "";
    }
    return (
      <li key={currency} className="flex px-2 hover:bg-black/10 transition" title={currency}>
        <div className="grow font-light">{apiData.symbols[currency]}</div>
        <div className="">{exchangeRate}</div>
      </li>
    );
  });

  let footerText = "Update " + apiData.dateUpdate;
  let footerTitle = footerText + " - Expired at " + apiData.dateUpdate;

  if (error || apiData.status !== 200) {
    footerText = (
      <span className="text-red-400">
        {footerText} - {error ? error.message : apiData.error}
      </span>
    );
  }

  return (
    <section className="widget max-w-sm m-2 border rounded leading-7 select-none border-lime-600">
      <header className="bg-lime-600 text-white px-2 leading-10">
        <h2>{apiData.symbols[baseCurrency]} Exchange Rates</h2>
      </header>
      <ul className=" rounded overflow-hidden transition hover:bg-slate-50">
        <li className="px-2 text-right font-semibold">1 {baseCurrency} =</li>
        {itemsEl}
      </ul>
      <footer
        className="px-2 rounded truncate leading-10 text-xs bg-gray-100 text-gray-500"
        title={footerTitle}
      >
        {footerText}
      </footer>
    </section>
  );
}
