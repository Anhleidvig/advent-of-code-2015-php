# 🎄 Advent of Code 2015 - PHP Edition 🎅

Welcome to my **Advent of Code 2015** solutions.
This repository houses my answers to the daily
challenges, built using **Symfony's Console component** to
create a sleek, command-line application. 🚀

## ❄️ Why This Approach?

While a simple hashbanged PHP script per day could have sufficed, I chose to go with a console app to:

- Practice my PHP and Symfony skills
- Experiment with structured CLI application design
- Have fun learning and building something reusable
- Practice new PHP features

The result? A clean, organized solution that's both functional and a joy to work with!
And every solution works with large files even if Advent of Code files are usualy small.

## 📦 Setup

1. **Clone the repo**:
   ```bash
   git clone https://github.com/Anhleidvig/advent-of-code-2015-php.git
   cd advent-of-code-2015-php
   ```

2. **Install dependencies** via Composer:
   ```bash
   composer install
   ```

## 🎮 Running Solutions

Execute a specific day's solution with ease:

```bash
php aoc2015 day-{N} day-{N}-input.txt
```

Replace `{N}` with the day number (e.g., `day-1` for Day 1). The command reads the input file and outputs the solution. Simple, yet powerful! 💪

Example:
```bash
php aoc2015 day-1 day-1-input.txt
```

## 🧪 Running Tests

Ensure everything works as expected with unit tests:

```bash
composer tests
```

This runs the test suite to validate the solutions. Keep the codebase rock-solid! 🛡️

## 📂 Project Structure

```
├── src/                # Core application logic
├── tests/              # Unit tests
├── storage/              # Input files (day-{N}-input.txt)
├── composer.json       # Dependencies
└── aoc2015             # CLI entry point
```

## 🎁 Acknowledgments

- Thanks to **Advent of Code** for the fun challenges!
