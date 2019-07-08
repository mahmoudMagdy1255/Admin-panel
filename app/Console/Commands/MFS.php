<?php

namespace App\Console\Commands;

use Artisan;
use Illuminate\Console\Command;

class MFS extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'mfs';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Migrate Fresh And Seed Data';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle() {

		$this->info('Drop All Database Tables And Migrating Again');

		Artisan::call("migrate:fresh");

		$this->info('Seed Data To Database Tables');

		Artisan::call("db:seed");

	}
}
