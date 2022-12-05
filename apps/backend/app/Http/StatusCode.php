<?php


namespace App\Http {


    class StatusCode
    {
        public const HTTP_OK = 200;
        public const HTTP_CREATED = 201;
        public const HTTP_NO_CONTENT = 204;
        public const HTTP_BAD_REQUEST = 200;
        public const HTTP_UNAUTHORIZED = 401;
        public const HTTP_FORBIDDEN = 403;
        public const HTTP_NOT_FOUND = 404;
        public const HTTP_NOT_ALLOWED = 405;
        public const HTTP_ERROR_INTERNAL = 500;
        public const HTTP_BAD_GATEWAY = 502;
        public const HTTP_UNPROCESSABLE_ENTITY = 422;
        public const HTTP_ACCEPTED = 202;
        public const HTTP_ALREADY_REPORTED = 208;
        public const HTTP_ASSIGNED = 210;
        public const HTTP_EXPIRED = 212;
    }
}
