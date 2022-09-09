import React, { useState, useEffect } from "react";

export default function Widget(props) {
  const [error, setError] = useState(null);
  const [isLoaded, setIsLoaded] = useState(false);
  const [apiData, setApiData] = useState([]);
  const baseCurrency = "USD";

  useEffect(() => {
    fetch("http://localhost:8022/api")
      .then((res) => res.json())
      .then(
        (result) => {
          setIsLoaded(true);
          setApiData(result);
        },
        (error) => {
          setIsLoaded(true);
          setError(error);
        }
      );
  }, []);

  if (error) {
    return <div>Error: {error.message}</div>;
  } else if (!isLoaded) {
    return <div>Loading...</div>;
  } else if (apiData.status !== 200) {
    return <div>Error: {apiData.error}</div>;
  } else {
    const myRates = apiData.latest.rates;

    const itemsEl = Object.entries(myRates).map((item, index) => {
      const currency = item[0];
      if (currency === baseCurrency) {
        return "";
      }
      return (
        <li key={currency} className="flex px-2 hover:bg-black/10 transition" title={currency}>
          <div className="grow font-light">{apiData.symbols[currency]}</div>
          <div className="">{item[1]}</div>
        </li>
      );
    });

    return (
      <section className="widget max-w-sm m-2 border rounded border-lime-600">
        <header className="bg-lime-600 text-white px-2 leading-10">
          <h2>{apiData.symbols[baseCurrency]} Exchange Rate</h2>
        </header>
        <ul className=" rounded overflow-hidden leading-7 select-none transition hover:bg-slate-50">
          <li className="px-2 text-right font-semibold">1 {baseCurrency} =</li>
          {itemsEl}
        </ul>
      </section>
    );
  }
}
