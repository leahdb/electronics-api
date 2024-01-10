<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CreateModel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'code:model {model} {table}';

    private string $fullModelName;
    private string $modelDir;
    private string $modelName;

    private string $tableName;

    private string $modelTemplatePath = 'app/commands/code/templates/modelTemplate.txt';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create ready to use models';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->fullModelName = $this->argument('model');
        $this->tableName = $this->argument('table');

        $modelParts = explode('/', $this->fullModelName);

        $this->fullModelName = 'App\\Models\\' . str_replace('/', "\\", $this->fullModelName);
        $this->modelName = array_pop($modelParts);
        $this->modelDir = 'Models/' . implode('/', $modelParts);

        $columns = Schema::getColumnListing($this->tableName);


        $attrListing = array();
        $fillables = array();

        foreach ($columns as $columnName) {
            $attrListing[] = 'public const ATTR_' . strtoupper($columnName) . ' = \''.$columnName.'\';';
            $fillables[] = 'self::ATTR_' . strtoupper($columnName) . ',';
        }

        $replacementMap = array(
            ':nameSpaceContinuation' => empty($modelParts) ? '' : "\\" . implode("\\", $modelParts),
            ':modelName' => $this->modelName,
            ':table' => $this->tableName,
            ':attrs' => implode("\n\t", $attrListing),
            ':fillables' => implode("\n\t\t", $fillables),
            ':slugDefinition' => in_array('slug', $columns) ? '$this->attributes[\'slug\'] = Str::slug($value);' : ''
        );

        $template = file_get_contents(storage_path($this->modelTemplatePath));
        $template = str_replace(array_keys($replacementMap), array_values($replacementMap), $template);

        $modelFileName = app_path($this->modelDir . '/' . $this->modelName . '.php');

        file_put_contents($modelFileName, $template);

        return 0;
    }
}
