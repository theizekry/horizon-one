<?php

namespace Modules\Integration\Passport;

use DateInterval;
use DateTimeImmutable;
use Psr\Http\Message\ServerRequestInterface;
use Laravel\Passport\Exceptions\OAuthServerException;
use League\OAuth2\Server\Grant\ClientCredentialsGrant;
use League\OAuth2\Server\Entities\ScopeEntityInterface;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\AccessTokenEntityInterface;
use League\OAuth2\Server\Exception\UniqueTokenIdentifierConstraintViolationException;

class CustomClientCredentialsGrant extends ClientCredentialsGrant
{
    protected function validateClient(ServerRequestInterface $request)
    {
        $validatedClient = parent::validateClient($request);

        $client = app(\Laravel\Passport\ClientRepository::class)->find($validatedClient->getIdentifier());

        // 👇 Inject the user_id from client into the request so Passport links it to token
        $request->withParsedBody(array_merge(
            $request->getParsedBody() ?? [],
            ['user_id' => $client->user_id]
        ));

        return $validatedClient;
    }

    /**
     * Issue an access token.
     *
     * @param  string|null  $userIdentifier
     * @param  ScopeEntityInterface[]  $scopes
     *
     * @throws UniqueTokenIdentifierConstraintViolationException|\League\OAuth2\Server\Exception\OAuthServerException
     * @throws OAuthServerException
     *
     * @return AccessTokenEntityInterface
     */
    protected function issueAccessToken(
        DateInterval $accessTokenTTL,
        ClientEntityInterface $client,
        $userIdentifier,
        array $scopes = []
    ) {

        $clientRow = app(\Laravel\Passport\ClientRepository::class)->find($client->getIdentifier());

        $maxGenerationAttempts = self::MAX_RANDOM_TOKEN_GENERATION_ATTEMPTS;

        $accessToken = $this->accessTokenRepository->getNewToken($client, $scopes, $clientRow->user_id);
        $accessToken->setExpiryDateTime((new DateTimeImmutable)->add($accessTokenTTL));
        $accessToken->setPrivateKey($this->privateKey);

        while ($maxGenerationAttempts-- > 0) {
            $accessToken->setIdentifier($this->generateUniqueIdentifier());

            try {
                $this->accessTokenRepository->persistNewAccessToken($accessToken);

                return $accessToken;
            } catch (UniqueTokenIdentifierConstraintViolationException $e) {
                if ($maxGenerationAttempts === 0) {
                    throw $e;
                }
            }
        }
    }
}
