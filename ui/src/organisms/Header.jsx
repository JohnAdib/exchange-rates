import React from "react";

function MenuItem(title, link) {
  const className =
    "block cursor-alias px-2 lg:px-4 rounded bg-gray-50 bg-opacity-0 hover:bg-opacity-20 focus:bg-opacity-30 text-white transition";

  return (
    <li>
      <a className={className} href={link} target="_blank">
        {title}
      </a>
    </li>
  );
}

export function Header() {
  return (
    <header className="mx-auto max-w-screen-xl w-full px-2 sm:px-4 lg:px-5 pt-2 md:pt-4 select-none">
      <div className="flex flex-wrap lg:flex-nowrap align-center rounded-lg relative py-2 px-4 lg:py-4 lg:px-6overflow-hidden bg-[#06b6d4]">
        <a
          target="_blank"
          href="https://mradib.com"
          className="block siteLogo rounded-lg overflow-hidden order-first basis-3/5 md:basis-4/5 lg:basis-auto lg:grow-0 shrink-0"
        >
          <h1 className="text-white text-xl leading-10 font-light hover:text-blue-200 transition">
            MrAdib
          </h1>
        </a>
        <nav className="lg:px-6 text-sm justify-start order-2 mt-2 lg:mt-0">
          <ul className="flex flex-wrap md:flex-nowrap gap-1 md:gap-2 justify-center leading-8 md:leading-10">
            {MenuItem("API", "http://localhost/api")}
            {MenuItem("From Euro", "http://localhost/api/latest?base=EUR")}
          </ul>
        </nav>
        <div className="lg:flex-grow order-3"></div>
        <nav className="social flex basis-2/5 md:basis-1/5 lg:basis-auto lg:grow-0 shrink-0 order-1 lg:order-last text-left">
          <ul className="flex justify-center leading-10 w-full">
            <li className="w-full">
              <a
                target="_blank"
                className="block px-2 lg:px-4 text-center rounded bg-gray-800 hover:bg-opacity-70 focus:bg-opacity-50 text-white transition link-"
                href="https://github.com/MrJavadAdib/exchange-rates"
              >
                Github
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </header>
  );
}
