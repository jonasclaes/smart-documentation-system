<?php

namespace App\Console\Commands;

use App\Models\RevisionRequestCategory;
use Illuminate\Console\Command;

class CreateCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sds:create-revision-request-category
                            {name : The category name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new revision request category';

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
        $revisionRequestCategory = RevisionRequestCategory::create([
            "name" => $this->argument('name')
        ]);

        if ($revisionRequestCategory) {
            return Command::SUCCESS;
        } else {
            return Command::FAILURE;
        }
    }
}
