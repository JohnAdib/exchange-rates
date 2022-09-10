import React from "react";

import Widget from "./Widget";

export default {
  title: "Pages/Widget",
  component: Widget
};

const Template = (args) => <Widget {...args}></Widget>;

export const Sample1 = Template.bind({});
