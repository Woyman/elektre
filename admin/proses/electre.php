<?php 

class electre
{   public $jenis;
    public $konek;

    function setJenis($jenis)
    {
        $this->jenis = $jenis;
    }

    function setKonek($konek)
    {
        $this->konek = $konek;
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

    function matrixR()
    {
        $m_X = $this->matrixX();

        $kriteria = $m_X['kriteria'];
        $alternatif = $m_X['alternatif'];

        foreach($kriteria as $index=> &$k )
        { 
            $x[$index] = 0;
                
                foreach($alternatif as &$alt )
                {
                    $x[$index] += pow($alt['nilai'][$index], 2);
                }
            
            $x[$index] =  sqrt($x[$index]);

                foreach($alternatif as &$alt )
                {
                    $alt['nilai'][$index] =  round($alt['nilai'][$index]/$x[$index], 4) ;
                }

        }

        $m_R['kriteria'] = $kriteria;
        $m_R['alternatif'] = $alternatif;

        return $m_R;
    }

    function matrixV($bobot)
    {
        $m_R = $this->matrixR();
        $kriteria = $m_R['kriteria'];
        $alternatif = $m_R['alternatif'];

        foreach($bobot as $index => &$b)
        {
            foreach($alternatif as &$alt )
            {
                $alt['nilai'][$index] = $alt['nilai'][$index]* $b;
            }
        }

        $m_V['alternatif'] = $alternatif;
        $m_V['kriteria'] = $kriteria;
        $m_V['bobot'] = $bobot;
        return $m_V;
    }

    function hitungCDdanDD($m_V)
    {
        $m_v = $this->matrixV($m_V['bobot']);
        $alternatif = $m_v['alternatif'];
        $kriteria = $m_v['kriteria'];

        $jmlAlt = count($alternatif);
        $jmlKri = count($kriteria);
        $arr_baru = array();
        $arr_CD = array();
        $arr_DD = array();
        
        foreach($alternatif as $index=> &$alt )
        {            
            for($i = 0; $i<$jmlAlt; $i++ )
            {                
                if($i != $index)
                {   
                    $cd = array();
                    $dd = array();

                    for($a = 0; $a<$jmlKri; $a++)
                    {   
                        $nilaiAlt = $alt['nilai'][$a];
                        $nilaiI = $alternatif[$i]['nilai'][$a];

                        if($nilaiAlt > $nilaiI ){
                            $cd[] = $a;
                        }else{
                            $dd[] = $a;
                        }                    
                    }
                    $arr_baru[$index][$i]['cd'] = $cd;
                    $arr_baru[$index][$i]['dd'] = $dd;
                  
                }else{
                    $arr_baru[$index][$i] = 0;
                }                    
            }            
        }        

        // concordance
        foreach($arr_baru as $indArr => &$arr )
        {
            foreach($arr as $iAr => &$ar)
            {
                if(is_array($ar))
                {
                    $ar['nilaiCD'] = 0;                        
                    foreach($ar['cd'] as $indexCd => $cd )
                    {                           
                        $ar['nilaiCD'] = $ar['nilaiCD'] + $m_v['bobot'][$cd];
                    }
                }else{  
                    $ar['nilaiCD'] = "--";                        
                }
            }
        }

        // discordance

        echo "<pre>";
        print_r($arr_baru);
        


    }
}
?>