<?php
// Autoload Composer packages
require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\Loader\ArrayLoader;

/**
 * Returns a Translator instance for the given language.
 */
function getTranslator(string $lang = 'da'): Translator {
    static $translators = [];

    if (!isset($translators[$lang])) {
        $translator = new Translator($lang);
        $translator->addLoader('array', new ArrayLoader());

        // Load translations file
        $file = __DIR__ . "/translations/messages.$lang.php";
        if (file_exists($file)) {
            $translator->addResource('array', require $file, $lang);
        }

        $translators[$lang] = $translator;
    }

    return $translators[$lang];
}

/**
 * Localizes a date string (e.g., from the database) by translating the month.
 */
function localizeDate(string $date, string $lang = 'da'): string {
    $timestamp = strtotime($date);
    if ($timestamp === false) {
        return $date; // fallback: return original string
    }

    $translator = getTranslator($lang);
    $parts = explode(' ', date("j F Y", $timestamp));

    // Translate month
    $parts[1] = $translator->trans($parts[1]);

    return implode(' ', $parts);
}