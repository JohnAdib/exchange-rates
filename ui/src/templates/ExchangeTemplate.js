import React, { useState, useEffect } from "react";
import { Header } from "../organisms/Header";
import BoardLists from "../organisms/BoardLists";

function ExchangeTemplate(props) {
  const pageStyle = "h-screen overflow-hidden bg-blue-100";

  return (
    <div className={pageStyle}>
      <Header />
      <BoardLists data={props.data} />
    </div>
  );
}

export default ExchangeTemplate;
