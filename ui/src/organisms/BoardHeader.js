import React from "react";

function BoardHeader(props) {
  const { data } = props;

  const headerClass =
    "flex flex-row flex-nowrap justify-center flex-none gap-2 lg:gap-4 py-1.5 px-1 leading-8 backdrop-blur-md bg-black/20 text-white";

  return (
    <header className={headerClass}>
      <h1></h1>
      <div className="grow"></div>
    </header>
  );
}

export default BoardHeader;
