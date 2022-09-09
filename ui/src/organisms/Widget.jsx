import React, { useState, useEffect } from "react";

export default function Widget(props) {
  const [error, setError] = useState(null);
  const [isLoaded, setIsLoaded] = useState(false);
  const [apiData, setApiData] = useState([]);

  // Note: the empty deps array [] means
  // this useEffect will run once
  // similar to componentDidMount()
  useEffect(() => {
    fetch("http://localhost:8022/api")
      .then((res) => res.json())
      .then(
        (result) => {
          setIsLoaded(true);
          setApiData(result);
        },
        // Note: it's important to handle errors here
        // instead of a catch() block so that we don't swallow
        // exceptions from actual bugs in components.
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

    const itemsEl = Object.entries(myRates).map((currency, index) => (
      <li key={currency[0]} className="flex px-2 hover:bg-black/10 transition" title={currency[0]}>
        <div className="grow">{apiData.symbols[currency[0]]}</div>
        <div>{currency[1]}</div>
      </li>
    ));

    return (
      <div className="mx-auto max-w-sm p-2">
        <ul className=" rounded bg-slate-100 leading-7 select-none">{itemsEl}</ul>
      </div>
    );
  }
}
