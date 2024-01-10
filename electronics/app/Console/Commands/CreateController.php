<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class CreateController extends Command
{

    private $dashboardControllerTemplate = 'app/commands/code/templates/dashboardControllerTemplate.txt';
    private $appControllerTemplate = 'app/commands/code/templates/appControllerTemplate.txt';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'code:controller {controller} {model} {--template= : Specify a template [dashboard|app]}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates ready to use controllers';

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
        $selectedTemplate = $this->dashboardControllerTemplate;

        $template = in_array($this->option('template'), ['dashboard', 'app']) ? $this->option('template') : 'dashboard';
        if ($template == 'app') {
            $selectedTemplate = $this->appControllerTemplate;
        }

        $this->fullControllerName = $this->argument('controller');
        $this->fullModelName = $this->argument('model');

        $userDefinedController = $this->fullControllerName;
        $userDefinedControllerParts = explode('/', $userDefinedController);

        $this->controllerName = array_pop($userDefinedControllerParts);

        $userDefinedControllerDir = implode('/', $userDefinedControllerParts);

        $this->fullControllerName = 'App\\Http\\Controllers\\' . str_replace('/', "\\", $userDefinedControllerDir . "\\" . $this->controllerName);
        $this->controllerDir = 'Http/Controllers/' . $userDefinedControllerDir;

        $modelParts = explode('/', $this->fullModelName);

        $this->fullModelName = 'App\\Models\\' . str_replace('/', "\\", $this->fullModelName);
        $this->modelName = array_pop($modelParts);
        $this->modelDir = 'Models/' . implode('/', $modelParts);

        $replacementMap = array(
            ':nameSpaceContinuation' => empty($userDefinedControllerParts) ? '' : "\\" . implode("\\", $userDefinedControllerParts),
            ':fullModelName' => $this->fullModelName,
            ':modelName' => $this->modelName,
            ':controllerName' => $this->controllerName,
            ':varModel' => '$'.Str::camel($this->modelName)
        );

        $template = file_get_contents(storage_path($selectedTemplate));
        $template = str_replace(array_keys($replacementMap), array_values($replacementMap), $template);

        $controllerFileName = app_path($this->controllerDir . '/' . $this->controllerName . '.php');

        file_put_contents($controllerFileName, $template);
        return 0;
    }
}
