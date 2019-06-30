<?php

namespace Joyching\I18n\Console\Commands;

use Joyching\I18n\Export;
use Illuminate\Console\Command;

class ExportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'i18n-tool:export {--locale=all}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Exports the i18n files to CSV files';

    private $export;

    public function __construct(Export $export)
    {
        parent::__construct();
        
        $this->export = $export;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $locale = $this->option('locale');

        if ($locale !== 'all') {
            $this->export->setLocale($locale);
        }

        $result = $this->export->toCsv();

        if (! $result) {
            $this->error('Export failed.');

            return;
        }

        $this->info('Export success.');
    }
}
