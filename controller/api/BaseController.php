<?php

class BaseController {

    /**
     * __call magic method.
     */
    public function __call($name, $arguments) {
        $this->sendOutput(ResponseEnum::STATUS_CODE_404);
    }

    /**
     * Get URI elements.
     * 
     * @return array
     */
    protected function getUriSegments() {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        return explode('/', $uri);
    }

    /**
     * Get queryStringParams.
     * 
     * @return array
     */
    protected function getQueryStringParams() {
        return parse_str($_SERVER['QUERY_STRING'], $query);
    }

    /**
     * Send API output.
     *
     * @param ResponseEnum $defaultResponseEnum
     * @param mixed  $data
     */
    protected function sendOutput($defaultResponseEnum, $current_status_message = "", $data = null) {
        $status_code = 0;
        $status_message = $current_status_message;
        $content_type_json = "";
        if ($defaultResponseEnum == ResponseEnum::STATUS_CODE_200) {
            $this->printOutput(json_encode($data), array(CONTENT_TYPE_JSON, SUCCESS_200));
        } else {
            switch ($defaultResponseEnum) {
                case ResponseEnum::STATUS_CODE_422:
                    $status_code = STATUS_CODE_422;
                    $status_message = METHOD_NOT_SUPPORTED;
                    $content_type_json = UNPROCESSABLEE_ENTITY_422;
                    break;
                case ResponseEnum::STATUS_CODE_400:
                    $status_code = STATUS_CODE_400;
                    if ($status_message === "") {
                        $status_message = BAD_REQUEST;
                    }
                    $content_type_json = BAD_REQUEST_400;
                    break;
                case ResponseEnum::STATUS_CODE_404:
                    $status_code = STATUS_CODE_404;
                    $status_message = PAGE_NOT_FOUND;
                    $content_type_json = NOT_FOUND_404;
                    break;
                case ResponseEnum::STATUS_CODE_403:
                    $status_code = STATUS_CODE_403;
                    if ($status_message === "") {
                        $status_message = DATA_NOT_FOUND;
                    }
                    $content_type_json = NO_DATA_FOUND_403;
                    break;
                case ResponseEnum::STATUS_CODE_409:
                    $status_code = STATUS_CODE_409;
                    if ($status_message === "") {
                        $status_message = DUPLICATE_DATA;
                    }
                    $content_type_json = DUPLICATE_DATA_409;
                    break;
            }

            $this->printOutput(
                    json_encode(
                            array(STATUS => $this->getStatus($status_code, $status_message))
                    ),
                    array(CONTENT_TYPE_JSON, $content_type_json)
            );
        }
    }

    protected function getStatus($status_code, $status_message) {
        return array(STATUS_CODE => $status_code, STATUS_MESSAGE => $status_message);
    }

    /**
     * Send API output.
     *
     * @param mixed $data
     * @param string $httpHeaders
     */
    protected function printOutput($data, $httpHeaders = []) {
        header_remove('Set-Cookie');

        if (is_array($httpHeaders) && count($httpHeaders)) {
            foreach ($httpHeaders as $httpHeader) {
                header($httpHeader);
            }
        }

        echo $data;
        exit;
    }

}
