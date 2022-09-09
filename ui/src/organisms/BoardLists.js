import React, { useState } from "react";

function BoardLists(props) {
  const [isModalMoveVisible, setModalMoveVisible] = useState(false);

  return (
    <main className="grow py-6 px-6 w-full h-full flex flex-row flex-nowrap gap-2 snap-x overflow-x-auto"></main>
  );
}

export default BoardLists;
