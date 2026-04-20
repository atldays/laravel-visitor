# Contributing

Thank you for contributing to `atldays/laravel-visitor`.

The goal of this package is simple:

- provide as much useful visitor information as possible
- keep the API clean, typed, and predictable
- offer a convenient Laravel-friendly interface for resolving visitor context

In practice, this means the package should help developers work with:

- IP address
- User-Agent
- language preferences
- geo information
- agent metadata
- fingerprint generation

without forcing them to manually orchestrate these concerns across multiple packages.

## Project Principles

When contributing, please keep these principles in mind:

- prefer explicit, typed APIs over loosely structured arrays
- keep the `Visitor` abstraction focused on visitor context
- avoid unnecessary magic when a clear object or method is easier to understand
- favor composability and integration with Laravel conventions
- treat developer experience as a core feature of the package

## Branching Strategy

We use **GitFlow**.

Please branch from the appropriate base and keep your changes scoped:

- `feature/*` for new functionality
- `fix/*` for bug fixes
- `hotfix/*` for urgent production fixes
- `release/*` for release preparation

If you are unsure, use a `feature/*` or `fix/*` branch depending on the intent of the change.

## Commit Style

We use **Conventional Commits**.

Please write commit messages in one of these forms:

- `feat: add visitor language DTO`
- `fix: resolve visitor facade binding`
- `docs: improve README examples`
- `test: cover fingerprint driver validation`
- `refactor: simplify visitor manager flow`
- `chore: update dependencies`

Try to keep commit history clean, intentional, and easy to scan.

## Development Expectations

Before submitting changes:

1. Make sure the code is formatted.
2. Make sure the test suite passes.
3. Keep documentation in sync with the code when behavior changes.

Useful commands:

```bash
composer test
composer format
composer format:test
```

## API Expectations

This package is intended to be an orchestration layer for visitor information.

Contributions should generally move the package toward:

- better visitor insight
- better Laravel integration
- cleaner contracts and DTOs
- easier consumption through facades, request macros, and typed objects

Contributions should generally avoid:

- leaking infrastructure details into the public API
- adding behavior unrelated to visitor context
- making the package harder to reason about
- introducing duplicate responsibilities already handled by dependent packages

## Pull Requests

When opening a pull request:

- describe the problem clearly
- explain the chosen solution briefly
- mention any API or behavioral changes
- include tests for new behavior or bug fixes
- update documentation when needed

Small, focused pull requests are preferred over large mixed changes.

## Questions

If a design choice is unclear, optimize for the main package objective:

**give developers the richest possible visitor context through the cleanest possible interface.**
