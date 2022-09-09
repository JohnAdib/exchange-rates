import React, { useState, useEffect } from "react";
import { Header } from "../organisms/Header";
import BoardHeader from "../organisms/BoardHeader";
import BoardLists from "../organisms/BoardLists";

function ExchangeTemplate(props) {
  const pageStyle = "h-screen overflow-hidden bg-blue-100";

  return (
    <div className={pageStyle}>
      <Header />
      <BoardHeader />
      <BoardLists data={props.data} />
    </div>
  );
}

export default ExchangeTemplate;
