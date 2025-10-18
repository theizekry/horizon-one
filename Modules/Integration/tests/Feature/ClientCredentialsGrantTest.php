<?php

namespace Modules\Integration\Tests\Feature;

use Laravel\Passport\Client;
use Laravel\Passport\Passport;
use Modules\Core\Tests\CoreTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Integration\Services\Integration\IntegrationOnboardingService;

class ClientCredentialsGrantTest extends CoreTestCase
{
    use RefreshDatabase;

    protected Client $client;

    protected function setUp(): void
    {
        parent::setUp();

        // $this->client = app(IntegrationOnboardingService::class)->generateOAuthClient();
    }

    /** @test */
    public function it_issues_access_token_with_valid_credentials()
    {
        $response = $this->postJson('/oauth/token', [
            'grant_type'    => 'client_credentials',
            'client_id'     => $this->client->id,
            'client_secret' => $this->client->secret,
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'token_type',
                'expires_in',
                'access_token',
            ]);
    }

    /** @test */
    public function it_fails_with_invalid_client_secret()
    {
        $response = $this->postJson('/oauth/token', [
            'grant_type'    => 'client_credentials',
            'client_id'     => $this->client->id,
            'client_secret' => 'invalid-secret',
        ]);

        $response->assertStatus(401)
            ->assertJson([
                'error'             => 'invalid_client',
                'error_description' => 'Client authentication failed',
            ]);
    }

    /** @test */
    public function it_fails_with_missing_parameters()
    {
        $response = $this->postJson('/oauth/token', [
            'grant_type' => 'client_credentials',
            // Missing client_id and client_secret
        ]);

        $response->assertStatus(400)
            ->assertJson([
                'error'             => 'invalid_request',
                'error_description' => 'The request is missing a required parameter, includes an invalid parameter value, includes a parameter more than once, or is otherwise malformed.',
                'hint'              => 'Check the `client_id` parameter',
                'message'           => 'The request is missing a required parameter, includes an invalid parameter value, includes a parameter more than once, or is otherwise malformed.',
            ]);
    }

    /** @test */
    public function it_accesses_protected_route_with_valid_token()
    {
        // Obtain access token
        $tokenResponse = $this->postJson('/oauth/token', [
            'grant_type'    => 'client_credentials',
            'client_id'     => $this->client->id,
            'client_secret' => $this->client->secret,
        ]);

        $accessToken = $tokenResponse->json('access_token');

        // Access protected route
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
        ])->postJson(route('api.report.generate'));

        $response->assertStatus(200);
        // Add additional assertions based on your protected route's response
    }

    /** @test */
    public function it_denies_access_to_protected_route_without_token()
    {
        $response = $this->postJson(route('api.report.generate'));

        $response->assertStatus(401);
    }

    /** @test */
    public function it_should_handle_expired_token()
    {
        // Step 1: Configure Passport to issue short-lived tokens
        Passport::tokensExpireIn(now()->addSeconds(1));

        $tokenResponse = $this->postJson('/oauth/token', [
            'grant_type'    => 'client_credentials',
            'client_id'     => $this->client->id,
            'client_secret' => $this->client->secret,
        ]);

        // Step 2: Wait for the token to expire
        sleep(2);

        $accessToken = $tokenResponse->json('access_token');

        $this->assertNotEmpty($accessToken);

        $this->withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
        ])
            ->postJson(route('api.report.generate'))
            ->assertJson([
                'message' => 'Unauthenticated.',
            ])
            ->assertUnauthorized();
    }
}
