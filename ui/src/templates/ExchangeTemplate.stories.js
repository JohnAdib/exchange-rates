import React from "react";

import ExchangeTemplate from "./ExchangeTemplate";
import { SampleData } from "../pages/SampleData.js";

export default {
  title: "Templates/ExchangeTemplate",
  component: ExchangeTemplate
};

const Template = (args) => <ExchangeTemplate {...args}></ExchangeTemplate>;

export const Kanban = Template.bind({});
Kanban.args = {
  data: SampleData
};
