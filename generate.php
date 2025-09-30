<?php
// Fetch country data from static JSON
$data = file_get_contents("https://raw.githubusercontent.com/mledoze/countries/master/countries.json");
$countries = json_decode($data, true);
if (!is_array($countries)) {
    die("Failed to fetch country data.");
}

// Open CSV files
$csv_basic = fopen('csv/countries_basic.csv', 'w');
$csv_extended = fopen('csv/countries_extended.csv', 'w');
$csv_flags = fopen('csv/countries_with_flags.csv', 'w');

// Open SQL files
$sql_basic = fopen('sql/countries_basic.sql', 'w');
$sql_extended = fopen('sql/countries_extended.sql', 'w');
$sql_flags = fopen('sql/countries_with_flags.sql', 'w');

// Create table statements
fwrite($sql_basic, "CREATE TABLE IF NOT EXISTS countries_basic (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    iso2 CHAR(2),
    iso3 CHAR(3),
    calling_code VARCHAR(20)
);\n\n");

fwrite($sql_extended, "CREATE TABLE IF NOT EXISTS countries_extended (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    iso2 CHAR(2),
    iso3 CHAR(3),
    numeric_code VARCHAR(10),
    calling_code VARCHAR(20),
    currency VARCHAR(50),
    region VARCHAR(50),
    subregion VARCHAR(50),
    capital VARCHAR(255),
    timezone VARCHAR(100),
    languages TEXT,
    area DOUBLE,
    population BIGINT,
    flag VARCHAR(10),
    tld VARCHAR(10),
    continent VARCHAR(50)
);\n\n");

fwrite($sql_flags, "CREATE TABLE IF NOT EXISTS countries_flags (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    iso2 CHAR(2),
    calling_code VARCHAR(20),
    flag VARCHAR(10)
);\n\n");

// CSV headers
fputcsv($csv_basic, ['name', 'iso2', 'iso3', 'calling_code'], ',', '"', "\\");
fputcsv($csv_extended, ['name','iso2','iso3','numeric_code','calling_code','currency','region','subregion','capital','timezone','languages','area','population','flag','tld','continent'], ',', '"', "\\");
fputcsv($csv_flags, ['name','iso2','calling_code','flag'], ',', '"', "\\");

// Insert data
foreach ($countries as $c) {
    $name = addslashes($c['name']['common'] ?? '');
    $iso2 = $c['cca2'] ?? '';
    $iso3 = $c['cca3'] ?? '';
    $numeric = $c['ccn3'] ?? '';
    $calling = isset($c['idd']['root']) ? $c['idd']['root'] . ($c['idd']['suffixes'][0] ?? '') : '';
    $currency = isset($c['currencies']) ? implode(',', array_keys($c['currencies'])) : '';
    $region = $c['region'] ?? '';
    $subregion = $c['subregion'] ?? '';
    $capital = addslashes($c['capital'][0] ?? '');
    $timezone = addslashes($c['timezones'][0] ?? '');
    $languages = isset($c['languages']) ? addslashes(implode(',', $c['languages'])) : '';
    $area = $c['area'] ?? 0;
    $population = $c['population'] ?? 0;
    $flag = $c['flag'] ?? '';
    $tld = isset($c['tld'][0]) ? $c['tld'][0] : '';
    $continent = isset($c['continents'][0]) ? $c['continents'][0] : '';

    // CSV
    fputcsv($csv_basic, [$name, $iso2, $iso3, $calling], ',', '"', "\\");
    fputcsv($csv_extended, [$name,$iso2,$iso3,$numeric,$calling,$currency,$region,$subregion,$capital,$timezone,$languages,$area,$population,$flag,$tld,$continent], ',', '"', "\\");
    fputcsv($csv_flags, [$name,$iso2,$calling,$flag], ',', '"', "\\");

    // SQL
    fwrite($sql_basic, "INSERT INTO countries_basic (name, iso2, iso3, calling_code) VALUES ('$name', '$iso2', '$iso3', '$calling');\n");

    fwrite($sql_extended, "INSERT INTO countries_extended (name, iso2, iso3, numeric_code, calling_code, currency, region, subregion, capital, timezone, languages, area, population, flag, tld, continent) VALUES ('$name', '$iso2', '$iso3', '$numeric', '$calling', '$currency', '$region', '$subregion', '$capital', '$timezone', '$languages', $area, $population, '$flag', '$tld', '$continent');\n");

    fwrite($sql_flags, "INSERT INTO countries_flags (name, iso2, calling_code, flag) VALUES ('$name', '$iso2', '$calling', '$flag');\n");
}

// Close files
fclose($csv_basic);
fclose($csv_extended);
fclose($csv_flags);
fclose($sql_basic);
fclose($sql_extended);
fclose($sql_flags);

echo "All CSV and SQL files generated successfully!\n";
