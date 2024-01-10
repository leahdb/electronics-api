<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class CreateAPI extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'code:api {table} {model} {controller} {--template= : Specify a template [dashboard|app]}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates ready to use controllers';

    private string $controllerTemplatePath = 'app/commands/code/templates/dashboardControllerTemplate.txt';

    private string $fullControllerName;
    private string $fullModelName;

    private string $controllerDir;
    private string $modelDir;

    private string $controllerName;

    private string $modelName;

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
        $template = in_array($this->option('template'), ['dashboard', 'app']) ? $this->option('template') : 'dashboard';

        $this->call('code:model', [
            'table' => $this->argument('table'),
            'model' => $this->argument('model'),
        ]);

        $this->call('make:resource', [
            'name' => $this->argument('model') . 'Resource'
        ]);

        $this->call('code:controller', [
            'controller' => $this->argument('controller'),
            'model' => $this->argument('model'),
            '--template' => $template
        ]);
        return 0;
    }
}
