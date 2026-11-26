<?php 

namespace MM\Meros\Portal;

use MM\Meros\App\Providers\PackageServiceProvider;
use MM\Meros\Portal\App\Models\PortalUser;

class ServiceProvider extends PackageServiceProvider {
    protected function init(): void {
        $this->setPackageClass(MerosPortal::class);
    }

    protected function beforeBoot(): void {
        $configPath = dirname(__DIR__) . '/config';
        $this->publishesConfig($configPath, 'meros-portal-');
        $this->configurePortalAuthProvider();
    }

    /**
     * Configures the portal authentication provider.
     *
     * @return void
     */
    private function configurePortalAuthProvider(): void {
        config([
            'auth.defaults.guard' => 'portal',

            'auth.guards.portal' => [
                'driver'   => 'session',
                'provider' => 'portals',
            ],
            'auth.providers.portals' => [
                'driver' => 'eloquent',
                'model'  => PortalUser::class,
            ],

            'auth.passwords.portal_users' => [
                'provider' => 'portals',
                'table'    => 'meros_portal_password_reset_tokens',
                'expire'   => 60,
                'throttle' => 60,
            ],

            'session.driver' => 'database',
            'session.table'  => 'meros_portal_sessions',
        ]);
    }
}