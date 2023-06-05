<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AuthModel;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthController extends BaseController
{

    public function __construct()
    {
        // parrent::
        $Model = new AuthModel();
    }

    public function register()
    {
        $Model = new AuthModel();
        // var_dump($Model);
        $user = $this->request->getPost("user");
        $pass = $this->request->getPost("pass");
        $jabatan = $this->request->getPost("jabatan");

        $validation = \Config\Services::validation();

        $valid = $this->validate([
            'user' => [
                'rules' => 'required',
                'label' => 'Username',
                'errors' => [
                    'required' => "{field} masih kosong"

                ]
            ],
            'pass' => [
                'rules' => 'required',
                'label' => 'Password',
                'errors' => [
                    'required' => "{field} masih kosong"

                ]
            ],
            'jabatan' => [
                'rules' => 'required',
                'label' => 'Jabatan',
                'errors' => [
                    'required' => "{field} masih kosong"

                ]
            ]
        ]);

        if (!$valid) {
            $response = [
                'status' => 400,
                'error' => "true",
                'message' => $validation->getErrors(),
            ];
            return $this->response->setJSON($response);
        } else {
            $cekUsername = $Model->cekUsername($user);
            if (count($cekUsername->getResultArray()) < 1) {
                $password_hash = password_hash($pass, PASSWORD_BCRYPT);
                $data = [
                    'username' => $user,
                    'password' => $password_hash,
                    'jabatan' => $jabatan,
                ];
                $Model->insert($data);
                $response = [
                    'status' => 200,
                    'error' => "false",
                    'message' => "Berhasil Menambahkan Data",
                    'data' => $data,
                ];
                return $this->response->setJSON($response);
            } else {
                $response = [
                    'status' => 400,
                    'error' => "true",
                    'message' => "Username Sudah Terdaftar",
                ];
                return $this->response->setJSON($response);
            }
        }
    }

    public function login()
    {
        $Model = new AuthModel();

        $user = $this->request->getPost("user");
        $pass = $this->request->getPost("pass");

        $validation = \Config\Services::validation();

        $valid = $this->validate([
            'user' => [
                'rules' => 'required',
                'label' => 'Username',
                'errors' => [
                    'required' => "{field} masih kosong"

                ]
            ],
            'pass' => [
                'rules' => 'required',
                'label' => 'Password',
                'errors' => [
                    'required' => "{field} masih kosong"

                ]
            ],
        ]);


        if (!$valid) {
            $response = [
                'status' => 400,
                'error' => "true",
                'message' => $validation->getErrors(),
            ];
            return $this->response->setJSON($response);
        } else {
            $cekUsername = $Model->cekUsername($user);

            if (count($cekUsername->getResultArray()) < 1) {
                $response = [
                    'status' => 400,
                    'error' => "true",
                    'message' => "Username Tidak Ada",
                ];
                return $this->response->setJSON($response);
            } else {
                $data = $cekUsername->getRowArray();
                $password_hash = $data['password'];
                if (password_verify($pass, $password_hash)) {
                    $session = time();
                    $expire_time = $session + 3600;

                    $token = [
                        'data' => $data,
                        'iat' => $session,
                        'exp' => $expire_time,
                    ];

                    $token = JWT::encode($token, getenv("TOKEN_KEY"), 'HS256');

                    $response = [
                        'status' => 200,
                        'error' => "false",
                        'message' => "Berhasil Login",
                        'data' => $data,
                        'token' => $token,
                    ];
                    return $this->response->setJSON($response);
                } else {
                    $response = [
                        'status' => 400,
                        'error' => "true",
                        'message' => "Password Salah",
                    ];
                    return $this->response->setJSON($response);
                }
            }
        }
    }

    public function logout()
    {
        $Model = new AuthModel();
        $token = $this->request->getHeader('Authorization');
        $key = getenv('TOKEN_KEY');

        $token2 = explode(" ", $token)[2];


        $data = JWT::decode($token2, new Key($key, 'HS256'));

        // var_dump($data->data->username);
        // exit;


        $cekUsername = $Model->cekUsername($data->data->username);
        if (count($cekUsername->getResultArray()) == 1) {
            $response = [
                'status' => 200,
                'error' => "false",
                'data' => $data->data,
                'message' => "Berhasil Logout",
            ];
            return $this->response->setJSON($response);
        } else {
            $response = [
                'status' => 400,
                'error' => "true",
                'message' => "Username Tidak Ada",
            ];
            return $this->response->setJSON($response);
        }
        // if($data)
        //
    }
}
