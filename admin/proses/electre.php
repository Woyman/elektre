<?php 

class electre
{   public $jenis;
    public $konek;
    function __construct(){
                
    }

    function matrixX()
    {
        $t = $this->getTableJenisProduk($this->jenis); $tNilai = $t['nilai']; $indexKriteria = $t['id_tableKriteria'];
        $res['alternatif'] = $this->getAllNameAlternatif();
        $res['kriteria'] = $this->getAllNameKriteria();

        foreach($res['alternatif'] as $indexA => &$alt )
        {            
            $idAlternatif = $alt['id_alternatif'];
            foreach($res['kriteria'] as $index => &$k )
            {                   
                $idK = $k[$indexKriteria];
                $qGetNilai = "SELECT * FROM $tNilai WHERE id_alternatif='$idAlternatif' AND id_kriteria='$idK' ";
                $getNilai = mysqli_query($this->konek, $qGetNilai);
                while($n = mysqli_fetch_assoc($getNilai))
                {
                    $nilai[] = $n['nilai'];
                }
                $alt['nilai'] = $nilai;                
            }
            unset($nilai);
        }

        return $res;
    }

    // =========== ALTERNATIF ==================

    function getAllAlternatif()
    {           
        // $result = array(); 
        $jenis = $this->jenis;
        $q = "SELECT * FROM alternatif LEFT JOIN merk ON alternatif.id_merk = merk.id_merk WHERE jns_produk = '$jenis' ";
        $qGetAlternatif = mysqli_query($this->konek, $q);
        
        while($alt = mysqli_fetch_assoc($qGetAlternatif))
        {
            $res[] = $alt;
        }

        return $res;
    }

    function getAllNameAlternatif()
    {            
        $alternatif = $this->getAllAlternatif();
        foreach($alternatif as $index=>&$alt )
        {
            unset($alternatif[$index]['foto']);
            unset($alternatif[$index]['deskripsi']);
            $alt['nama'] = $alt['nama_merk'].' '.$alt['seri_produk'];                        
        }
        return $alternatif;
    }


    // =========== KRITERIA ==================

    function getAllNameKriteria()
    {   
        $t = $this->getTableJenisProduk($this->jenis);
        $tKriteria = $t['kriteria'];                      
        $q = "SELECT * FROM $tKriteria";
        $getKriteria = mysqli_query($this->konek, $q);
        while($k = mysqli_fetch_assoc($getKriteria))
        {
            $res[] = $k;
        }
        return $res;
    }

    function setJenis($jenis)
    {
        $this->jenis = $jenis;
    }

    function setKonek($konek)
    {
        $this->konek = $konek;
    }


    function getAllNilai($idAlternatif,$jenis)
    {   
        $table = getTableJenisProduk($jenis);
        $tKriteria = $table['kriteria'];        
        $tNiali = $table['nilai'];        
        $q = "";
    }   

    function getTableJenisProduk($jenis)
    {
        if($jenis == 'laptop' )
        {
            $table['kriteria'] = 'kriteria_laptop';
            $table['id_tableKriteria'] = 'id_k_laptop';
            $table['nilai']  = 'nilai_kriteria_laptop';
        }else{
            $table['kriteria'] = 'kriteria_smartphone';
            $table['nilai']  = 'nilai_kriteria_smartphone';
            $table['id_tableKriteria'] = 'id_k_smartphone';
        }
        return $table;
    }

}
?>