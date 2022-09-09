import React, { useState, useEffect } from "react";
import BoardHeader from "../organisms/BoardHeader";
import BoardLists from "../organisms/BoardLists";

function ExchangeTemplate(props) {
  const pageStyle = "h-screen overflow-hidden bg-blue-100";

  return (
    <div className={pageStyle}>
      <BoardHeader />
      <BoardLists data={props.data} />
    </div>
  );
}

export default ExchangeTemplate;
