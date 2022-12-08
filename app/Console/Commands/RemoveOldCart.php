<?php

namespace App\Console\Commands;

use App\Models\Cart;
use Illuminate\Console\Command;

class RemoveOldCart extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cart:remove-old {--days=7 : The days after which the carts will be removed}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove old/expired carts based on a given days.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $deadline = now()->subDays($this->option('days'));

        $counter = Cart::whereDate('updated_at', '<=', $deadline)->delete();

        $this->info("Successfully deleted {$counter} old carts.");
    }
}
