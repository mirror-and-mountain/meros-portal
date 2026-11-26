<?php 

namespace MM\Meros\Portal;

use MM\Meros\App\Providers\PackageServiceProvider;

class ServiceProvider extends PackageServiceProvider {
    protected function init(): void {
        $this->setPackageClass(MerosPortal::class);
    }

    protected function beforeBoot(): void {
        $configPath = dirname(__DIR__) . '/config';
        $this->publishesConfig($configPath, 'meros-portal-');
    }
}