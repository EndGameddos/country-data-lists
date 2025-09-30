# 🌍 Country Data Lists

[![License: MIT](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

A comprehensive dataset of countries in **CSV, JSON, and SQL formats**.
Includes basic, extended, and flag-specific information for all countries in the world.
Suitable for applications, databases, or projects requiring structured country information.

---

## Features

* **Multiple Formats:** CSV, JSON, and SQL.
* **Rich Data Fields:** ISO codes, calling codes, currencies, regions, capitals, timezones, languages, area, population, flags, TLDs, and continents.
* **Ready for Databases:** SQL files include `CREATE TABLE` and `INSERT` statements for instant import.
* **Up-to-date & Reliable:** Based on [Mledoze Countries dataset](https://github.com/mledoze/countries).
* **Easy to Extend:** Add extra fields or modify CSV/SQL templates as needed.

---

## Repository Structure

```
country-data-lists/
├── csv/
│   ├── countries_basic.csv
│   ├── countries_extended.csv
│   └── countries_with_flags.csv
├── json/
│   ├── countries_basic.json
│   ├── countries_extended.json
│   └── countries_with_flags.json
├── sql/
│   ├── countries_basic.sql
│   ├── countries_extended.sql
│   └── countries_flags.sql
├── generate.php
├── LICENSE
└── README.md
```

---

## Installation / Usage

1. Clone the repository:

```bash
git clone https://github.com/EndGameddos/country-data-lists.git
cd country-data-lists
```

2. Make sure PHP is installed:

```bash
php -v
```

3. Run the generator script:

```bash
php generate.php
```

4. CSV, JSON, and SQL files will be generated automatically in the respective folders.

---

## Data Fields

### Basic CSV/JSON

| Field          | Description                |
| -------------- | -------------------------- |
| `name`         | Country name (common)      |
| `iso2`         | ISO Alpha-2 code           |
| `iso3`         | ISO Alpha-3 code           |
| `calling_code` | International calling code |

### Extended CSV/JSON

| Field          | Description      |
| -------------- | ---------------- |
| `numeric_code` | ISO numeric code |
| `currency`     | Currency code(s) |
| `region`       | Continent/region |
| `subregion`    | Subregion        |
| `capital`      | Capital city     |
| `timezone`     | Primary timezone |
| `languages`    | Languages spoken |
| `area`         | Area in km²      |
| `population`   | Population count |
| `flag`         | Emoji flag       |
| `tld`          | Top-level domain |
| `continent`    | Continent        |

### Flags CSV/JSON

| Field          | Description                |
| -------------- | -------------------------- |
| `name`         | Country name               |
| `iso2`         | ISO Alpha-2 code           |
| `calling_code` | International calling code |
| `flag`         | Emoji flag                 |

---

## SQL Tables

* `countries_basic`
* `countries_extended`
* `countries_flags`

All tables include `CREATE TABLE` statements and `INSERT` queries, ready to import into MySQL or MariaDB.

---

## Contributing

1. Fork the repository.
2. Make your changes.
3. Submit a pull request.

Contributions and suggestions are welcome!

---

## License

This project is open source and available under the **MIT License**.

---

## Credits

* Country dataset from [Mledoze Countries GitHub](https://github.com/mledoze/countries)
* Inspired by [REST Countries API](https://restcountries.com/)
