<?php
namespace Mostafa0alii\DashboardGenerator;
use Illuminate\Console\Command;
use Symfony\Component\Console\Output\ConsoleOutput;
class DashboardInstall extends Command {
    protected $signature = 'dashboard:init';
    protected $description = 'Dashboard Theme Installation';
    protected $views = [
        'layouts/master.blade.php'                              =>                  'layouts/master.blade.php',
        'layouts/common/includes/head.blade.php'                =>                  'layouts/common/includes/head.blade.php',
        'layouts/common/includes/main-header.blade.php'         =>                  'layouts/common/includes/main-header.blade.php',
        'layouts/common/includes/main-sidebar.blade.php'        =>                  'layouts/common/includes/main-sidebar.blade.php',
        'layouts/common/includes/footer.blade.php'              =>                  'layouts/common/includes/footer.blade.php',
        'layouts/common/includes/footer-script.blade.php'       =>                  'layouts/common/includes/footer-scripts.blade.php',
        'layouts/common/partials/messages.blade.php'            =>                  'layouts/common/partials/messages.blade.php',
    ];
    public function __construct() {
        parent::__construct();
    }
    
    public function handle() {
        $this->info('Starting Dashboard Init...');
        $output = new ConsoleOutput();
        $output->writeln('Creationg Dashboard Directories...');
        $this->ensureDirectory();
        $output->writeln('Exporting Dashboard Views...');
        $this->exportViews();
        
        
        
        return Command::SUCCESS;
    }

    /*public function ensureDirectory() {
        $directories = [
            $this->getViewPath('layouts'),
            $this->getViewPath('layouts/common'),
            $this->getViewPath('layouts/common/includes'),
            $this->getViewPath('layouts/common/partials'),
            public_path('assets'),
            public_path('assets/css'),
            public_path('assets/css/plugins'),
            public_path('assets/js'),
            public_path('assets/images'),
            public_path('assets/fonts'),
        ];
        foreach ($directories as $directory) {
            if (!is_dir($directory))
                mkdir($directory, 0755, true);
        }
    }*/

    protected function ensureDirectory() {
        $directories = [
            $this->getViewPath('layouts'),
            $this->getViewPath('layouts/common'),
            $this->getViewPath('layouts/common/includes'),
            $this->getViewPath('layouts/common/partials'),
            public_path('assets'),
            public_path('assets/css'),
            public_path('assets/css/plugins'),
            public_path('assets/js'),
            public_path('assets/images'),
            public_path('assets/fonts'),
        ];

        $directoryBar = $this->output->createProgressBar(count($directories));
        $directoryBar->setBarCharacter('<fg=green>•</>');
        $directoryBar->setProgressCharacter('<fg=green>></>');
        $directoryBar->setEmptyBarCharacter('<fg=red>-</>');
        $directoryBar->setFormat('%current%/%max% [%bar%] %percent:3s%% %remaining:6s% remaining');
        $directoryBar->start();

        foreach ($directories as $directory) {
            if (!is_dir($directory)) 
                mkdir($directory, 0755, true);
            $directoryBar->advance();
        }
        $directoryBar->finish();
    }

    protected function exportViews() {
        $viewBar = $this->output->createProgressBar(count($this->views));
        $viewBar->setBarCharacter('<fg=green>•</>');
        $viewBar->setProgressCharacter('<fg=green>></>');
        $viewBar->setEmptyBarCharacter('<fg=red>-</>');
        $viewBar->setFormat('%current%/%max% [%bar%] %percent:3s%% %remaining:6s% remaining');
        $viewBar->start();

        foreach ($this->views as $key => $value) {

            if(file_exists($view = $this->getViewPath($value) && ! $this->option('force'))) {
                if(! $this->confirm("The [{$view}] view already exists. Do you want to replace it?")) {
                    continue;
                }
            }
            copy(__DIR__.'/../resources/views/'.$key, $view);
            $viewBar->advance();
        }
        $viewBar->finish();
    }

    protected function getViewPath($path) {
        return implode(DIRECTORY_SEPARATOR, [config('view.path')[0] ?? resource_path('views'), $path]);
    }

}