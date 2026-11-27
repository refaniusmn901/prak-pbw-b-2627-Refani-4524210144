<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MahasiswaModel;

class MahasiswaController extends BaseController
{
    // Aturan validasi dipakai bersama oleh store() dan update()
    private function rules(?int $id = null): array
    {
        $nimUnik = $id
            ? "is_unique[mahasiswa.nim,id,{$id}]"
            : 'is_unique[mahasiswa.nim]';

        return [
            'nim' => [
                'rules'  => "required|numeric|min_length[8]|max_length[20]|{$nimUnik}",
                'errors' => [
                    'required'   => 'NIM wajib diisi.',
                    'numeric'    => 'NIM harus berupa angka.',
                    'min_length' => 'NIM minimal 8 digit.',
                    'max_length' => 'NIM maksimal 20 digit.',
                    'is_unique'  => 'NIM sudah terdaftar.',
                ],
            ],
            'nama' => [
                'rules'  => 'required|min_length[3]|max_length[100]',
                'errors' => [
                    'required'   => 'Nama wajib diisi.',
                    'min_length' => 'Nama minimal 3 karakter.',
                    'max_length' => 'Nama maksimal 100 karakter.',
                ],
            ],
            'email' => [
                'rules'  => 'required|valid_email',
                'errors' => [
                    'required'    => 'Email wajib diisi.',
                    'valid_email' => 'Format email tidak valid.',
                ],
            ],
            'prodi' => [
                'rules'  => 'required',
                'errors' => ['required' => 'Prodi wajib diisi.'],
            ],
            'angkatan' => [
                'rules'  => 'required|numeric|exact_length[4]',
                'errors' => [
                    'required'     => 'Angkatan wajib diisi.',
                    'numeric'      => 'Angkatan harus berupa angka.',
                    'exact_length' => 'Angkatan harus 4 digit (contoh: 2024).',
                ],
            ],
            'ipk' => [
                'rules'  => 'required|decimal|greater_than_equal_to[0]|less_than_equal_to[4]',
                'errors' => [
                    'required'              => 'IPK wajib diisi.',
                    'decimal'               => 'IPK harus berupa angka.',
                    'greater_than_equal_to' => 'IPK minimal 0.',
                    'less_than_equal_to'    => 'IPK maksimal 4.',
                ],
            ],
        ];
    }

    private function inputData(): array
    {
        return [
            'nim'      => $this->request->getPost('nim'),
            'nama'     => $this->request->getPost('nama'),
            'email'    => $this->request->getPost('email'),
            'prodi'    => $this->request->getPost('prodi'),
            'angkatan' => $this->request->getPost('angkatan'),
            'ipk'      => $this->request->getPost('ipk'),
        ];
    }

    public function index()
    {
        $model = new MahasiswaModel();
        $data['mahasiswa'] = $model->findAll();

        return view('mahasiswa/index', $data);
    }

    public function create()
    {
        return view('mahasiswa/create');
    }

    public function store()
    {
        if (! $this->validate($this->rules())) {
            return redirect()->back()->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $model = new MahasiswaModel();
        $model->insert($this->inputData());

        return redirect()->to('/mahasiswa')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $model = new MahasiswaModel();
        $mhs   = $model->find($id);

        if (! $mhs) {
            return redirect()->to('/mahasiswa')->with('error', 'Data tidak ditemukan.');
        }

        return view('mahasiswa/edit', ['mhs' => $mhs]);
    }

    public function update($id)
    {
        $model = new MahasiswaModel();

        if (! $model->find($id)) {
            return redirect()->to('/mahasiswa')->with('error', 'Data tidak ditemukan.');
        }

        if (! $this->validate($this->rules((int) $id))) {
            return redirect()->back()->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $model->update($id, $this->inputData());

        return redirect()->to('/mahasiswa')->with('success', 'Data berhasil diubah.');
    }

    public function delete($id)
    {
        $model = new MahasiswaModel();
        $model->delete($id);

        return redirect()->to('/mahasiswa')->with('success', 'Data berhasil dihapus.');
    }
}
