import React, { useState, useEffect } from "react";
import { SampleData } from "./SampleData.js";
import { CountdownCircleTimer } from "react-countdown-circle-timer";

export default function Widget(props) {
  const [error, setError] = useState(null);
  const [isLoaded, setIsLoaded] = useState(false);
  const [reloading, setReloading] = useState(false);
  const [apiData, setApiData] = useState([]);
  const [baseCurrency, setBaseCurrency] = useState("USD");

  // once on start
  useEffect(() => {
    const everyCheckInterval = 1000 * 60; // 60 sec = 1 min
    getDataFromApi();
    // set interval
    function getDataFromApi() {
      const apiUrl = "http://localhost:8022/api?base=" + baseCurrency;
      fetch(apiUrl)
        .then((res) => res.json())
        .then(
          (result) => {
            setIsLoaded(true);
            setReloading(false);
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
    const interval = setInterval(getDataFromApi, everyCheckInterval);
    // This represents the unmount function,
    // in which you need to clear your interval to prevent memory leaks.
    return () => clearInterval(interval);
  }, [baseCurrency]);

  if (!isLoaded) {
    return <div className="py-2 px-4 leading-10">Loading...</div>;
  }

  const myRates = apiData.latest.rates;
  const itemsEl = Object.entries(myRates).map((item, index) => {
    const currency = item[0];
    const exchangeRate = item[1];
    const exchangeRateShow =
      exchangeRate < 0.1 ? exchangeRate : Math.round((item[1] + Number.EPSILON) * 1000) / 1000;

    if (currency === baseCurrency) {
      return "";
    }
    return (
      <li
        key={currency}
        className="flex px-4 hover:bg-black/10 transition cursor-pointer"
        title={currency}
        onClick={() => {
          setBaseCurrency(currency);
          setReloading(true);
        }}
      >
        <div className="font-light truncate">{apiData.symbols[currency]}</div>
        <div className="grow"></div>
        <div className="">{reloading ? "-" : exchangeRateShow}</div>
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

  const renderTime = ({ remainingTime }) => {
    if (remainingTime === 0) {
      return <div className="timer">...</div>;
    }
    return remainingTime;
  };
  const UrgeWithPleasureComponent = () => (
    <CountdownCircleTimer
      isPlaying
      size={32}
      strokeWidth={3}
      duration={60}
      colors={["#65a30d", "#F7B801", "#A30000", "#A30000"]}
      colorsTime={[40, 20, 10, 0]}
      onComplete={() => ({ shouldRepeat: true, delay: 1 })}
    >
      {renderTime}
    </CountdownCircleTimer>
  );

  return (
    <section className="widget max-w-sm m-2 border rounded leading-7 bg-white select-none border-lime-600">
      <header className="bg-lime-600 text-white px-4 leading-10">
        <h2 className="truncate">
          <span className="font-bold">{apiData.symbols[baseCurrency]}</span> Exchange Rates
        </h2>
      </header>
      <ul className=" rounded overflow-hidden transition hover:bg-slate-50">
        <li className="px-4 text-right font-semibold">1 {baseCurrency} =</li>
        {itemsEl}
      </ul>
      <footer
        className="px-4 rounded flex flex-nowrap gap-2 truncate leading-10 text-xs bg-gray-100 text-gray-500"
        title={footerTitle}
      >
        <div className="grow truncate">{footerText}</div>
        <div className="flex-none py-1">
          <UrgeWithPleasureComponent></UrgeWithPleasureComponent>
        </div>
      </footer>
    </section>
  );
}
