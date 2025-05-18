/**
 * @jest-environment jsdom
 */

//Frontend tests on main.js

const fs = require("fs");
const path = require("path");
const { setupCartUI } = require("./main.js");

beforeEach(() => {
  // Mock fetch before DOM setup
  global.fetch = jest.fn(() =>
    Promise.resolve({
      json: () => Promise.resolve({ success: true, cart: {}, total: 0 }),
    })
  );

  const html = fs.readFileSync(path.resolve(__dirname, "index.php"), "utf8");
  document.documentElement.innerHTML = html;
  setupCartUI();
});

test("cart icon should exist", () => {
  const cartIcon = document.querySelector("#cart-icon");
  expect(cartIcon).not.toBeNull();
});

test("clicking #cart-icon toggles cart visibility", () => {
  const cartIcon = document.querySelector("#cart-icon");
  const cart = document.querySelector(".cart");

  cartIcon.dispatchEvent(new MouseEvent("click", { bubbles: true }));

  expect(cart.classList.contains("active")).toBe(true);
});
