import React, { useState, useEffect } from "react";
import { Header } from "../organisms/Header";
import { Hero } from "../organisms/Hero";
import { CallToAction } from "../organisms/CallToAction";
import { Faqs } from "../organisms/Faqs";
import { Footer } from "../organisms//Footer";

function ExchangeTemplate(props) {
  const pageStyle = "";

  return (
    <div className={pageStyle}>
      <Header />
      <main>
        <Hero />
        <CallToAction />
        <Faqs />
      </main>
      <Footer />
    </div>
  );
}

export default ExchangeTemplate;
