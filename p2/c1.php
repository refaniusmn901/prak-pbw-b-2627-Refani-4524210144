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
}

$mhs = new Mahasiswa('4524210144' , 'Refani Usman' , 4.00);
echo $mhs->ringkasan();