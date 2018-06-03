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
     * Exposes an endpoint to call a service function for testing.
     * http://localhost:8080/index.php/actions/rhok/test/testUrlService
     */
    public function actionTestUrlService() {

        $this->returnJson('123');
    }

}