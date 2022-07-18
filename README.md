<h1 align="center">
Example of a PHP application using Domain-Driven Design (DDD)
</h1>

## Project explanation
A very simple application (absolutely not complete) to publish various promo texts for billboard.
The goal is to show how to initialize a project with a DDD structure and how to make the different Bounded Contexts communicate.

## Business requirements
Provide validation of the promo structure coming from the user of the system:
1. The body of the promo structure SHOULD NOT contain email addresses.
2. The Promo structure title SHOULD NOT be written upper case.
3. The Promo structure title SHOULD NOT contain more than one exclamation point.