<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use MeiliSearch\Client;

class UpdateProductSearchAttributesCommand extends Command
{
    protected $signature = 'search:product:update';

    protected $description = 'Update sortable attributes and filterable attributes';

    public function handle()
    {
        $client = new Client('meiliSearch:7700');

        $client->index('products')
            ->updateSortableAttributes(Product::SORTABLE);

        $client->index('products')
            ->updateFilterableAttributes(Product::FILTERABLE);

        return 0;
    }
}
