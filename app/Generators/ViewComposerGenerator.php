<?php

namespace App\Generators;

use Illuminate\Support\Facades\Schema;

class ViewComposerGenerator
{
    /**
     * Generate view composer on viewServiceProvider, if any belongsTo relation.
     *
     * @param array $request
     * @return void
     */
    public function execute(array $request)
    {
        $template = "";

        $model = GeneratorUtils::setModelName($request['model']);
        $viewPath = GeneratorUtils::getModelLocation($request['model']);

        foreach ($request['data_types'] as $i => $dataType) {
            if ($dataType == 'foreignId') {
                $table = GeneratorUtils::pluralSnakeCase($request['constrains'][$i]);

                $relatedModel = GeneratorUtils::setModelName($request['constrains'][$i]);
                $relatedModelPath = GeneratorUtils::getModelLocation($request['constrains'][$i]);

                if ($relatedModelPath != '') {
                    $relatedModelPath = "\App\Models\\$relatedModelPath\\$relatedModel";
                } else {
                    $relatedModelPath = "\App\Models\\" . GeneratorUtils::singularPascalCase($request['constrains'][$i]);
                }

                $allColums = Schema::getColumnListing($table);

                if (sizeof($allColums) > 0) {
                    $fieldsSelect = "'id', '$allColums[1]'";
                } else {
                    $fieldsSelect = "'id'";
                }

                if ($i > 1) {
                    $template .= "\t\t";
                }

                $template .= str_replace(
                    [
                        '{{modelNamePluralKebabCase}}',
                        '{{constrainsPluralCamelCase}}',
                        '{{constrainsSingularPascalCase}}',
                        '{{fieldsSelect}}',
                        '{{relatedModelPath}}',
                        '{{viewPath}}',
                    ],
                    [
                        GeneratorUtils::pluralKebabCase($model),
                        GeneratorUtils::pluralCamelCase($relatedModel),
                        GeneratorUtils::singularPascalCase($request['constrains'][$i]),
                        $fieldsSelect,
                        $relatedModelPath,
                        $viewPath != '' ? str_replace('\\', '.', strtolower($viewPath)) . "." : '',
                    ],
                    GeneratorUtils::getTemplate('view-composer')
                );
            }
        }

        $template .= "\t\t// don`t remove this comment, it will generate view composer";

        $path = app_path('Providers/ViewServiceProvider.php');
        $viewProviderFile = file_get_contents($path);

        $viewProviderTemplate = str_replace(
            '// don`t remove this comment, it will generate view composer',
            $template,
            $viewProviderFile
        );

        GeneratorUtils::generateTemplate($path, $viewProviderTemplate);
    }
}