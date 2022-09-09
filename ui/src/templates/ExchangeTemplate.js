import React, { useState, useEffect } from "react";
import { Header } from "../organisms/Header";
import { Hero } from "../organisms/Hero";
import { CallToAction } from "../organisms/CallToAction";

function ExchangeTemplate(props) {
  const pageStyle = "";

  return (
    <div className={pageStyle}>
      <Header />
      <main>
        <Hero />
        <CallToAction />
      </main>
    </div>
  );
}

export default ExchangeTemplate;
