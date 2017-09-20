<?php

// Example usage from root Fixo folder:
// php create_translations.php data/translations-source.csv lang/

require 'vendor/league/csv/autoload.php';

use League\Csv\Reader;

$source_file = $argv[1];
$output_folder = $argv[2];

echo 'Reading ' . $source_file;
$reader = Reader::createFromPath($source_file);
$reader->setHeaderOffset(0);

$translations = array();

foreach($reader->getRecords() as $row)
{
    $translations['en'][$row['en']] = $row['en'];
    $translations['it'][$row['en']] = $row['it'];
    $translations['no'][$row['en']] = $row['no'];
    $translations['de'][$row['en']] = $row['de'];
}

echo "\nOutputting translation files to " . $output_folder;

foreach ($translations as $language => $language_translations)
{
    $fh = fopen("$output_folder$language.php", "w");
    if (!is_resource($fh)) {
        return false;
    }

    fwrite($fh, "<?php\n");
    fwrite($fh, "\$translations = array(");

    foreach ($language_translations as $key => $value)
    {
        fwrite($fh, sprintf("\n    '%s' => '%s',", $key, $value));
    }

    fwrite($fh, "\n);");
    fclose($fh);
}

echo "\nComplete.";
