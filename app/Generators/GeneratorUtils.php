<?php

namespace App\Generators;

use Illuminate\Support\Str;

class GeneratorUtils
{
    /**
     * Get template/stub file
     *
     * @param string $path
     * @return string
     */
    public static function getTemplate(string $path)
    {
        return file_get_contents(resource_path("/stubs/generators/$path.stub"));
    }

    /**
     * Generate template to php file
     *
     * @param string $destination
     * @param string $template
     * @return bool
     */
    public static function generateTemplate(string $destination, string $template)
    {
        return file_put_contents($destination, $template);
    }

    /**
     * Check folder if doesnt exist, then make folder
     *
     * @param string $path
     * @return bool
     */
    public static function checkFolder(string $path)
    {
        if (!file_exists($path)) {
            return mkdir($path, 0777, true);
        }

        return;
    }

    /**
     * Set input type by table field data type
     *
     * @param string $dataType
     * @return string
     */
    public static function setInputType(string $dataType, string $field = null)
    {
        if (
            Str::contains($dataType, 'integer') ||
            $dataType == 'float' ||
            $dataType == 'double' ||
            $dataType == 'decimal' ||
            $dataType == 'boolean'
        ) {
            return 'number';
        } elseif ($field == 'email') {
            return 'email';
        } elseif ($field == 'password') {
            return 'password';
        } elseif ($dataType == 'date') {
            return 'date';
        } elseif ($dataType == 'time') {
            return 'time';
        } elseif ($dataType == 'dateTime') {
            return 'datetime-local';
        } else {
            return 'text';
        }
    }

    /**
     * Convert string to singular pascal case
     *
     * @param string $string
     * @return string
     */
    public static function singularPascalCase(string $string)
    {
        return trim(ucfirst(Str::camel(Str::singular($string))));
    }

    /**
     * Convert string to plural pascal case
     *
     * @param string $string
     * @return string
     */
    public static function pluralPascalCase(string $string)
    {
        return trim(ucfirst(Str::camel(Str::plural($string, 2))));
    }

    /**
     * Convert string to plural snake case
     *
     * @param string $string
     * @return string
     */
    public static function pluralSnakeCase(string $string)
    {
        return trim(strtolower(Str::snake(Str::plural($string, 2))));
    }

    /**
     * Convert string to singular snake case
     *
     * @param string $string
     * @return string
     */
    public static function singularSnakeCase(string $string)
    {
        return trim(strtolower(Str::snake(Str::singular($string))));
    }

    /**
     * Convert string to plural pascal case
     *
     * @param string $string
     * @return string
     */
    public static function pluralCamelCase(string $string)
    {
        return trim(Str::camel(Str::plural($string, 2)));
    }

    /**
     * Convert string to singular pascal case
     *
     * @param string $string
     * @return string
     */
    public static function singularCamelCase(string $string)
    {
        return trim(Str::camel(Str::singular($string)));
    }

    /**
     * Convert string to plural, kebab case, and lowercase
     *
     * @param string $string
     * @return string
     */
    public static function pluralKebabCase(string $string)
    {
        return trim(Str::kebab(Str::plural($string, 2)));
    }

    /**
     * Convert string to singular, kebab case, and lowercase
     *
     * @param string $string
     * @return string
     */
    public static function singularKebabCase(string $string)
    {
        return trim(Str::kebab(Str::singular($string)));
    }

    /**
     * Convert string to singular, remove special caracters, and lowercase
     *
     * @param string $string
     * @return string
     */
    public static function cleanSingularLowerCase(string $string)
    {
        return Str::singular(trim(preg_replace('/[^A-Za-z0-9() -]/', ' ', strtolower($string))));
    }

    /**
     * Convert string to plural, remove special caracters, and uppercase every first letters
     *
     * @param string $string
     * @return string
     */
    public static function cleanPluralUcWords(string $string)
    {
        return ucwords(Str::plural(trim(preg_replace('/[^A-Za-z0-9() -]/', ' ', $string)), 2));
    }

    /**
     * Convert string to singular, remove special caracters, and uppercase every first letters
     *
     * @param string $string
     * @return string
     */
    public static function cleanSingularUcWords(string $string)
    {
        return ucwords(Str::singular(trim(preg_replace('/[^A-Za-z0-9() -]/', ' ', $string))));
    }

    /**
     * Convert string to plural, remove special caracters, and lowercase
     *
     * @param string $string
     * @return string
     */
    public static function cleanPluralLowerCase(string $string)
    {
        return strtolower(Str::plural(trim(preg_replace('/[^A-Za-z0-9() -]/', ' ', $string)), 2));
    }
}
