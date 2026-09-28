<?php
interface Identitas
{
    public function ringkasan(): string;
}

class Mahasiswa implements Identitas
{
    private string $nim;
    private string $nama;
    private float $ipk;

    public function __construct(string $nim, String $nama, float $ipk)
    {
        $this->nim = $nim;
        $this->nama = $nama;
        $this->setIpk($ipk);
    }

    public function setIpk(float $ipk): void
    {
        if($ipk <0 || $ipk > 4) {
            throw new InvalidArgumenException('IPK harus 0 sampai 4');
        }
        $this->ipk = $ipk;
    }

    public function getIpk(): float
    {
        return $this->ipk;
    }

    public function ringkasan(): string
    {
        return $this->nim . ' - '. $this->nama . ' - IPK: ' . $this->ipk;
    }

    // (Modifikasi 1)
    public function getPredikat(): string
    {
        if ($this->ipk >= 3.51) return 'Dengan Pujian';
        if ($this->ipk >= 3.00) return 'Sangat Memuaskan';
        if ($this->ipk >= 2.76) return 'Memuaskan';
        return 'Cukup';
    }
}

// (Modifikasi 2)
class MahasiswaBeasiswa extends Mahasiswa
{
    private string $namaBeasiswa;

    public function __construct(string $nim, string $nama, float $ipk, string $namaBeasiswa)
    {
        parent::__construct($nim, $nama, $ipk);
        $this->namaBeasiswa = $namaBeasiswa;
    }

    public function ringkasan(): string
    {
        return parent::ringkasan() . ' - Beasiswa: ' . $this->namaBeasiswa;
    }
}

$mhs = new Mahasiswa('4524210144' , 'Refani Usman' , 4.00);
echo $mhs->ringkasan();

// (Modifikasi 1)
echo PHP_EOL . 'Predikat: ' . $mhs->getPredikat();

// (Modifikasi 2)
echo PHP_EOL;
$mhs2 = new MahasiswaBeasiswa('4524210144', 'Refani Usman', 4.00, 'KIP Kuliah');
echo $mhs2->ringkasan();

// TAMBAHAN 
echo PHP_EOL . 'Predikat: ' . $mhs2->getPredikat();