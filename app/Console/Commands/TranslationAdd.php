<?php

namespace App\Console\Commands;

use App\Models\Translation;
use Illuminate\Console\Command;

class TranslationAdd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'translations:add {model} {id} {field} {locale} {translation}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a translation to a model field';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $model = 'App\\Models\\' . $this->argument('model');
        $id = $this->argument('id');
        $field = $this->argument('field');
        $translation = $this->argument('translation');

        $locale = $this->argument('locale') ?: 'en';

        // Validate the model and id
        if (class_exists($model)) {
            $record = $model::find($id);

            if ($record) {
                Translation::updateOrCreate(
                    [
                        'model_type' => $model,
                        'model_id' => $id,
                        'locale' => $locale,
                        'field_name' => $field
                    ],
                    [
                        'field_value' => $translation
                    ]
                );

                $this->info('Translation added successfully.');
            } else {
                $this->error('Record with id ' . $id . ' not found in model ' . $model);
            }
        } else {
            $this->error('Model ' . $model . ' does not exist.');
        }

        return 0;
    }
}
