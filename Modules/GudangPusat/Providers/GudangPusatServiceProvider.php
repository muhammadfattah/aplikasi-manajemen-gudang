<?php

namespace Modules\GudangPusat\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Modules\GudangPusat\Repositories\Admin\CabangRepository;
use Modules\GudangPusat\Repositories\Admin\Interfaces\CabangRepositoryInterface;
use Modules\GudangPusat\Repositories\Admin\Interfaces\KategoriBarangRepositoryInterface;
use Modules\GudangPusat\Repositories\Admin\Interfaces\OutletRepositoryInterface;
use Modules\GudangPusat\Repositories\Admin\Interfaces\PermintaanBarangRepositoryInterface;
use Modules\GudangPusat\Repositories\Admin\Interfaces\PermintaanReturRepositoryInterface;
use Modules\GudangPusat\Repositories\Admin\Interfaces\StokBarangRepositoryInterface;
use Modules\GudangPusat\Repositories\Admin\Interfaces\SupplierRepositoryInterface;
use Modules\GudangPusat\Repositories\Admin\KategoriBarangRepository;
use Modules\GudangPusat\Repositories\Admin\OutletRepository;
use Modules\GudangPusat\Repositories\Admin\PermintaanBarangRepository;
use Modules\GudangPusat\Repositories\Admin\PermintaanReturRepository;
use Modules\GudangPusat\Repositories\Admin\StokBarangRepository;
use Modules\GudangPusat\Repositories\Admin\SupplierRepository;

class GudangPusatServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'GudangPusat';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'gudangpusat';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
        $this->registerRepositories();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path($this->moduleName, 'Config/config.php') => config_path($this->moduleNameLower . '.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/config.php'),
            $this->moduleNameLower
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/' . $this->moduleNameLower);

        $sourcePath = module_path($this->moduleName, 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', $this->moduleNameLower . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/' . $this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (\Config::get('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }
        return $paths;
    }

    private function registerRepositories()
    {
        $this->app->bind(
            SupplierRepositoryInterface::class,
            SupplierRepository::class
        );

        $this->app->bind(
            CabangRepositoryInterface::class,
            CabangRepository::class
        );

        $this->app->bind(
            KategoriBarangRepositoryInterface::class,
            KategoriBarangRepository::class
        );

        $this->app->bind(
            OutletRepositoryInterface::class,
            OutletRepository::class
        );

        $this->app->bind(
            StokBarangRepositoryInterface::class,
            StokBarangRepository::class
        );

        $this->app->bind(
            PermintaanBarangRepositoryInterface::class,
            PermintaanBarangRepository::class
        );

        $this->app->bind(
            PermintaanReturRepositoryInterface::class,
            PermintaanReturRepository::class
        );
    }
}
