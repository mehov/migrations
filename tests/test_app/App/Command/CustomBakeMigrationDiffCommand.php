<?php
declare(strict_types=1);

namespace TestApp\Command;

use Cake\Console\Arguments;
use Cake\Core\Plugin;
use Migrations\Command\BakeMigrationDiffCommand;

class CustomBakeMigrationDiffCommand extends BakeMigrationDiffCommand
{
    public $pathFragment = 'config/MigrationsDiff/';

    /**
     * @inheritDoc
     */
    public static function defaultName(): string
    {
        return 'custom bake migration_diff';
    }

    protected function getDumpSchema(Arguments $args)
    {
        $diffConfigFolder = Plugin::path('Migrations') . 'tests' . DS . 'comparisons' . DS . 'Diff' . DS;
        $diffDumpPath = $diffConfigFolder . 'schema-dump-test_comparisons_' . env('DB') . '.lock';

        return unserialize(file_get_contents($diffDumpPath));
    }
}
