<?php

namespace App\Console\Commands;

use App\Services\CreateCooperationAccount\CreateCooperationAccount;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AddDefaultCooperationAccount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:cooperation-account:default:add';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add default cooperation account to application!';

    /**
     * @var CreateCooperationAccount
     */
    protected $createCooperationAccount;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(CreateCooperationAccount $createCooperationAccount)
    {
        parent::__construct();

        $this->createCooperationAccount = $createCooperationAccount;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->startCommand();

        $user = User::first();

        $cooperationAccount = $this->createCooperationAccount->perform('Default cooperation', $user->id);

        $tableNames = [
            'users',
            'contacts',
            'contact_groups',
            'contact_reviews',
            'c_tags',
            'discounts',
            'favorites',
            'fields',
            'message_templates',
            'networks',
            'orders',
            'order_products',
            'order_services',
            'order_service_feedback',
            'packages',
            'packages_services',
            'persons',
            'person_services',
            'person_timings',
            'products',
            'product_categories',
            'product_discounts',
            'reminders',
            'score_gifts',
            'services',
            'service_categories',
            'service_discounts',
            'special_dates',
            'user_gifts',
            'user_profiles',
            'user_scores',
            'vacation_dates',
            'accounts',
            'buy_factors',
            'company_payments',
            'customer_payments',
        ];

        foreach ($tableNames as $tableName) {
            DB::statement(sprintf('UPDATE `%s` SET `co_account_id` = %d WHERE `co_account_id` IS NULL;',$tableName, $cooperationAccount->id));
        }

        $this->finishCommand();
    }

    private function startCommand(): void
    {
        $this->line("Starting {$this->getName()} command.");
    }

    private function finishCommand(): void
    {
        $this->line("End {$this->getName()} command.");
    }
}
