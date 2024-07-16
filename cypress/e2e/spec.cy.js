/* eslint-disable indent */
/* eslint-disable no-undef */
describe("Visual Regression Test", () => {
  it("should look correct", () => {
    cy.visit("http://127.0.0.1:8000/");
    cy.percySnapshot("Login Page");
  });
});