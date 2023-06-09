<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Auth implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $key = getenv('TOKEN_KEY');
        $header = $request->getServer('HTTP_AUTHORIZATION'); //cek athorization pada bagian header
        if (!$header) {
            return Services::response()
                ->setJSON([
                    'status' => 401,
                    'error' => 401,
                    'message' => 'Token Required',
                ])
                ->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);  //cek token ada atau tidak
        }

        $token = explode(' ', $header)[1];

        try {
            JWT::decode($token, new Key($key, 'HS256')); //endcode token yang ada pada .env ke lalu menghash nya ke H256
        } catch (\Throwable $th) {
            return Services::response()
                ->setJSON([
                    'status' => 401,
                    'error' => 401,
                    'message' => 'Expired Token',
                ])
                ->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED); // jika token expirate
        }
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
