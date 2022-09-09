import { render, screen } from "@testing-library/react";
import Widget from "./Widget";
import { act } from "react-dom/test-utils";

test("loading", () => {
  render(<Widget />);
  // loading
  const loadingText = screen.getByText(/Loading.../i);
  expect(loadingText).toBeInTheDocument();
});
