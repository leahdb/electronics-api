<?php

namespace App\Console\Commands;

use App\Models\DashboardQuickLink;
use App\Models\PetProfile;
use App\Models\Service;
use App\Models\Shop;
use App\Models\DashboardUser;
use Illuminate\Console\Command;

use Meilisearch\Client;


class MeiliInit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'meili:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'inits meilisearch index settings';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $client = new Client(env('MEILISEARCH_HOST'), env('MEILISEARCH_KEY'));

        $this->setIndexSearchableAttributes($client, 'pet_profiles', [PetProfile::ATTR_NAME]);

        $this->setIndexSearchableAttributes($client, 'dashboard_quick_links', [
            DashboardQuickLink::ATTR_TITLE,
            DashboardQuickLink::ATTR_KEYWORDS,
        ]);

        $this->setIndexSearchableAttributes($client, 'shops', [Shop::ATTR_NAME]);

        $this->setIndexSearchableAttributes($client, 'users', [DashboardUser::ATTR_FIRST_NAME, DashboardUser::ATTR_LAST_NAME]);

        $this->setIndexSearchableAttributes($client, 'shop_products', [
            Shop\Product::ATTR_ID,
            Shop\Product::ATTR_NAME,
            Shop\Product::ATTR_BRAND_NAME,
            Shop\Product::ATTR_DESCRIPTION,
            Shop\Product::ATTR_PRICE,
            Shop\Product::ATTR_SHOP_ID,
            Shop\Product::ATTR_SHOP_PRODUCT_CATEGORY_ID,
            Shop\Product::ATTR_DESCRIPTION2,
            Shop\Product::ATTR_DESCRIPTION3,
        ]);

        $this->setIndexSearchableAttributes($client, 'shop_services', [
            Service::ATTR_TITLE,
            Service::ATTR_DESCRIPTION1,
            Service::ATTR_DESCRIPTION2,
            Service::ATTR_PRICE,
            Service::ATTR_CATEGORY_ID,
        ]);
    }

    private function setIndexSearchableAttributes($client, $indexName, $searchableAttributes = array())
    {
        // Get an instance of your index
        $index = $client->index($indexName);
        // Update the searchable attributes setting
        $index->updateSearchableAttributes($searchableAttributes);
    }
}
