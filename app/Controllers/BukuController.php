<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BukuModel;

class BukuController extends BaseController
{
    public function index()
    {
        $Model = new BukuModel();
        $data = $Model->findAll();
        $response = [
            'status' => 200,
            'error' => "false",
            'message' => "Berhasil Mengambil Data",
            'totaldata' => count($data),
            'data' => $data,
        ];
        // var_dump($data);
        return $this->response->setJSON($response);
    }

    public function show($id = null)
    {
        $Model = new BukuModel();
        $data = $Model->find($id);
        $response = [
            'status' => 200,
            'error' => "false",
            'message' => "Berhasil Mengambil Data",
            'data' => $data,
        ];
        // var_dump($data);
        return $this->response->setJSON($response);
    }

    public function create()
    {
        $Model = new BukuModel();
        $judul = $this->request->getPost("judul");
        $penulis = $this->request->getPost("penulis");
        $penerbit = $this->request->getPost("penerbit");
        $tahun = $this->request->getPost("tahun");
        $stok = $this->request->getPost("stok");
        $user = $this->request->getPost("user");

        $validation = \Config\Services::validation();

        $valid = $this->validate([
            'judul' => [
                'rules' => 'required',
                'label' => 'Judul Buku',
                'errors' => [
                    'required' => "{field} masih kosong"

                ]
            ],
            'penulis' => [
                'rules' => 'required',
                'label' => 'Penulis Buku',
                'errors' => [
                    'required' => "{field} masih kosong"

                ]
            ],
            'penerbit' => [
                'rules' => 'required',
                'label' => 'Penerbit Buku',
                'errors' => [
                    'required' => "{field} masih kosong"

                ]
            ],
            'tahun' => [
                'rules' => 'required',
                'label' => 'Tahun Terbit Buku',
                'errors' => [
                    'required' => "{field} masih kosong"

                ]
            ],
            'stok' => [
                'rules' => 'required',
                'label' => 'Stok Buku',
                'errors' => [
                    'required' => "{field} masih kosong"

                ]
            ]
        ]);

        if (!$valid) {
            $response = [
                'status' => 404,
                'error' => true,
                'message' => $validation->getErrors(),
            ];
            return $this->response->setJSON($response);
        } else {
            $data = $Model->insert([
                'judul_buku' => $judul,
                'penulis_buku' => $penulis,
                'penerbit_buku' => $penerbit,
                'tahun_penerbit' => $tahun,
                'stok' => $stok,
                'id_users' => $user,
            ]);
            $response = [
                'status' => 201,
                'error' => "false",
                'data' => $data,
                'message' => "Berhasil Menambah Data"
            ];
            return $this->response->setJSON($response);
        }
    }

    public function delete($id = null)
    {
        $Model = new BukuModel();

        $data = $Model->find($id);
        if ($data) {
            $Model->delete($data);
            $response = [
                'status' => 200,
                'error' => "false",
                'data' => $data,
                'message' => "Berhasil Menghapus Data"
            ];
            return $this->response->setJSON($response);
        } else {
            $response = [
                'status' => 201,
                'error' => "false",
                'message' => "Gagal Menghapus Data, Data Tidak Ditemukan!"
            ];
            return $this->response->setJSON($response);
        }
    }

    public function update($id = null)
    {
        $Model = new BukuModel();

        $data = $Model->find($id);
        if ($data) {

            $judul = $this->request->getPost("judul");
            $penulis = $this->request->getPost("penulis");
            $penerbit = $this->request->getPost("penerbit");
            $tahun = $this->request->getPost("tahun");
            $stok = $this->request->getPost("stok");
            $user = $this->request->getPost("user");

            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'judul' => [
                    'rules' => 'required',
                    'label' => 'Judul Buku',
                    'errors' => [
                        'required' => "{field} masih kosong"

                    ]
                ],
                'penulis' => [
                    'rules' => 'required',
                    'label' => 'Penulis Buku',
                    'errors' => [
                        'required' => "{field} masih kosong"

                    ]
                ],
                'penerbit' => [
                    'rules' => 'required',
                    'label' => 'Penerbit Buku',
                    'errors' => [
                        'required' => "{field} masih kosong"

                    ]
                ],
                'tahun' => [
                    'rules' => 'required',
                    'label' => 'Tahun Terbit Buku',
                    'errors' => [
                        'required' => "{field} masih kosong"

                    ]
                ],
                'stok' => [
                    'rules' => 'required',
                    'label' => 'Stok Buku',
                    'errors' => [
                        'required' => "{field} masih kosong"

                    ]
                ]
            ]);

            if (!$valid) {
                $response = [
                    'status' => 404,
                    'error' => true,
                    'message' => $validation->getErrors(),
                ];
                return $this->response->setJSON($response);
            } else {
                $dataInput  = [
                    'judul_buku' => $judul,
                    'penulis_buku' => $penulis,
                    'penerbit_buku' => $penerbit,
                    'tahun_penerbit' => $tahun,
                    'stok' => $stok,
                    'id_users' => $user,
                ];
                $Model->update($id, $dataInput);
                $response = [
                    'status' => 201,
                    'error' => "false",
                    'data' => $data,
                    'message' => "Berhasil Mengubah Data"
                ];
                return $this->response->setJSON($response);
            }
        } else {
            $response = [
                'status' => 201,
                'error' => "false",
                'message' => "Gagal Mengubah Data, Data Tidak Ditemukan!"
            ];
            return $this->response->setJSON($response);
        }
    }
}
