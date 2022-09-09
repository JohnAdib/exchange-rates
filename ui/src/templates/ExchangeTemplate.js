import React, { useState, useEffect } from "react";
import { Header } from "../organisms/Header";
import { Hero } from "../organisms/Hero";

function ExchangeTemplate(props) {
  const pageStyle = "h-screen overflow-hidden";

  return (
    <div className={pageStyle}>
      <Header />
      <main>
        <Hero />
      </main>
    </div>
  );
}

export default ExchangeTemplate;
