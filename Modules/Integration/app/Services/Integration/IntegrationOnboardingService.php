<?php

namespace Modules\Integration\Services\Integration;

use Laravel\Passport\Client;
use Laravel\Passport\ClientRepository;
use Modules\Integration\Models\Integration;

readonly class IntegrationOnboardingService
{
    public function __construct(
        private ClientRepository $clientRepository
    ) {}

    /**
     * Create a Personal Access OAuth client.
     */
    public function generateOAuthClient(Integration $integration): Client
    {
        return $this->clientRepository->create(
            userId: $integration->id,
            name: $integration->name,
            redirect: '',
        );
    }
}
