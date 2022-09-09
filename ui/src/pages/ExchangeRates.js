import React from "react";
import { SampleData } from "./SampleData.js";
import Storage from "../tools/Storage";
import ExchangeTemplate from "../templates/ExchangeTemplate";

function ExchangeRates(props) {
  const storage = new Storage();

  function getData() {
    const myData = storage.get("latestExchangeRate");
    // console.log(myData);
    if (myData) {
      return myData;
    }

    // try to connect to backend and get data
    // implement soon
    // setData(myData)

    return SampleData;
  }

  function setData(data) {
    if (!data) {
      return;
    }
    console.log(data);
    storage.set("latestExchangeRate", data);
  }

  return <ExchangeTemplate data={getData()} />;
}

export default ExchangeRates;
