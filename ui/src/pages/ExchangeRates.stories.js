import React from "react";

import ExchangeRates from "./ExchangeRates";

export default {
  title: "Pages/ExchangeRates",
  component: ExchangeRates
};

const Template = (args) => <ExchangeRates {...args}></ExchangeRates>;

export const Kanban = Template.bind({});
