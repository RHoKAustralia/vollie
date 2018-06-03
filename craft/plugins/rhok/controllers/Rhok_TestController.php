<?php
/**
 * Created by PhpStorm.
 * User: kxie
 * Date: 3/06/2018
 * Time: 1:02 PM
 */

namespace Craft;


class Rhok_TestController extends BaseController
{

    /**
     * Exposes an endpoint to call the UrlService for testing.
     * http://localhost:8080/index.php/actions/rhok/test/testUrlService
     */
    public function actionTestUrlService($projectId, $status) {

        $isProjectValid = craft()->rhok_url->validateProjectById($projectId, $status);
        $isStatusValid = craft()->rhok_url->validateStatus($status);

        $this->returnJson([
            'isProjectValid' => $isProjectValid,
            'isStatusValid' => $isStatusValid
        ]);
    }

}