<?php
namespace Att\Api\WebRTC;

/*
 * Copyright 2014 AT&T
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

require_once __DIR__ . '../../Srvc/APIService.php';
require_once __DIR__ . '/../Restful/HttpPatch.php';

use InvalidArgumentException;
use Att\Api\OAuth\OAuthToken;
use Att\Api\Restful\HttpPut;
use Att\Api\Restful\RestfulRequest;
use Att\Api\Srvc\APIService;
use Att\Api\Srvc\Service;
use Att\Api\Srvc\ServiceException;

/**
 * Used to interact with version 1 of the WebRTC API Gateway.
 *
 * @category API
 * @package  WebRTC
 * @author   pk9069
 * @license  http://www.apache.org/licenses/LICENSE-2.0
 * @version  Release: @package_version@
 */
class WebRTCService extends APIService
{

    /**
     * Creates an WebRTCService object that can be used to interact with
     * the WebRTC API Gateway.
     *
     * @param string     $fqdn  fully qualified domain name to which requests
     *                          will be sent
     * @param OAuthToken $token OAuth token used for authorization
     */
    public function __construct($fqdn, OAuthToken $token)
    {
        parent::__construct($fqdn, $token);
    }

    /**
     * Associates a token with the specified user id.
     *
     * @param string $userId user id to associate with token
     *
     * @return void
     * @throws ServiceException if request was not successful
     */
    public function associateToken($userId)
    {
        $endpoint = $this->getFqdn() . '/RTC/v1/userIds/' . urlencode($userId);

        $req = new RestfulRequest($endpoint);

        $result = $req
            ->setAuthorizationHeader($this->getToken())
            ->setHeader('Content-Type', 'application/json')
            ->sendHttpPut(new HttpPut(''));

        $code = $result->getResponseCode();
        if ($code != 204) {
            throw new ServiceException($result->getResponseBody(), $code);
        }
    }
}

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
?>
