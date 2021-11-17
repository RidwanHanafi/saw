<?php 
class saw{
	var $host = "localhost";
	var $username = "morowali_esthree";
	var $password = "b7fp{=?eYZRt";
	var $database = "morowali_esthree";
	var $koneksi = "";
	function __construct(){
		$this->koneksi = mysqli_connect($this->host, $this->username, $this->password,$this->database);
		if (mysqli_connect_errno()){
			echo "Koneksi database gagal : " . mysqli_connect_error();
		}
	}
	function koneksi(){
		return $this->koneksi;
	}

    //meanmpilkan kriteria berdasarkan id_kriteria yang dipilih
	function kriteria($id_kategori)
	{
		$nama_kriteria= array();
		$data_kriteria = mysqli_query($this->koneksi,
			"SELECT kriteria.`nama_kriteria`, kriteria.`id_kriteria`
	        FROM kriteria
            INNER JOIN nilai_produk ON nilai_produk.`id_kriteria` = kriteria.`id_kriteria`
            WHERE nilai_produk.`id_kategori` = $id_kategori
            GROUP BY nama_kriteria
            ORDER BY kriteria.`id_kriteria` ASC");
		foreach ($data_kriteria as $data_kriteria) {
			$nama_kriteria[] = $data_kriteria['nama_kriteria'];
		}
		return $nama_kriteria;
	}

    // meanmpilkan nama produk berdasarkan id_kriteria yang dipilih
	function produk($id_kategori){
		$nama_produk = array();
		$query_produk = "SELECT produk.`nama_produk` , produk.`id_produk`, produk.`gambar_produk`
						FROM produk
						INNER JOIN nilai_produk ON nilai_produk.`id_produk` = produk.`id_produk`
						WHERE nilai_produk.`id_kategori` = $id_kategori
						GROUP BY nama_produk";
        $eksekusi=$this->koneksi()->query($query_produk);
		while ($row=$eksekusi->fetch_array(MYSQLI_ASSOC)){
            array_push($nama_produk,array(
            	"nama_produk"=>$row['nama_produk'],
            	"id_produk"=>$row['id_produk'],
                "gambar_produk"=>$row['gambar_produk'])
        	);
        }
		return $nama_produk;
	}


	function nilai($id_kategori,$id_produk){
        $data=array();

        $query_nilai="SELECT nilai_kriteria.`nilai` AS nilai, nilai_kriteria.`keterangan` AS keterangan, kriteria.`sifat` AS sifat, nilai_produk.`id_kriteria` AS id_kriteria 
                        FROM nilai_produk
        				JOIN kriteria ON kriteria.`id_kriteria` = nilai_produk.`id_kriteria` 
        				JOIN nilai_kriteria ON nilai_kriteria.`id_nilai_kriteria`= nilai_produk.`id_nilai_kriteria`
        				WHERE id_kategori='$id_kategori'
        				AND id_produk='$id_produk'";
        $eksekusi=$this->koneksi()->query($query_nilai);
        // while ($row=$eksekusi->fetch_array(MYSQLI_ASSOC)) {
        //     array_push($data,array(
        //         "nilai"=>$row['nilai'],
        //         "keterangan" =>$row['keterangan'],
        //         "sifat"=>$row['sifat'],
        //         "id_kriteria"=>$row['id_kriteria']
        //     ));
        // }
        foreach ($eksekusi as $datas) {
           array_push($data,array(
                "nilai"=>$datas['nilai'],
                "keterangan" =>$datas['keterangan'],
                "sifat"=>$datas['sifat'],
                "id_kriteria"=>$datas['id_kriteria']
           ));
        }
        return $data;
    }

    // 
    function nilai_kriteria($id_kriteria,$id_kategori){
    	$data =array();

    	$query_nilai_kriteria = "SELECT nilai_kriteria.`nilai` AS nilai 
    							FROM nilai_produk 
    							INNER JOIN nilai_kriteria ON nilai_produk.`id_nilai_kriteria`=nilai_kriteria.`id_nilai_kriteria` 
    							WHERE nilai_kriteria.`id_kriteria`='$id_kriteria' 
    							AND nilai_produk.`id_kategori`='$id_kategori'";
        $eksekusi = $this->koneksi()->query($query_nilai_kriteria);
        while ($row = $eksekusi->fetch_array(MYSQLI_ASSOC)) {
            array_push($data,$row['nilai']);
        }
        return $data;
    }

     //rumus normalisasai
    function Normalisasi($array,$sifat,$nilai){
        if ($sifat=='Benefit'){
            $result=$nilai/max($array);
        }elseif ($sifat=='Cost'){
            $result=min($array)/$nilai;
        }
        return round($result,3);
    }

    //mendapatkan bobot kriteria
    public function bobot($id_kategori, $id_kriteria){
        $query_bobot="SELECT bobot 
        			FROM bobot_kriteria 
        			WHERE id_kategori='$id_kategori' 
        			AND id_kriteria='$id_kriteria' ";
        $row=$this->koneksi()->query($query_bobot)->fetch_array(MYSQLI_ASSOC);
        
        return $row['bobot'];
    }

    //meyimpan hasil perhitungan
    public function simpan_hasil($id_kategori, $id_produk, $hasil){
        $query  =   "SELECT hasil
                    FROM hasil 
                    WHERE id_produk='$id_produk' 
                    AND id_kategori='$id_kategori'";
        $eksekusi = $this->koneksi()->query($query);
        $jumlah_row = mysqli_num_rows($eksekusi);

        if ($jumlah_row > 0) {
            $querySimpan="UPDATE hasil SET hasil='$hasil' WHERE id_produk='$id_produk' AND id_kategori = '$id_kategori'";
        }else{
            $querySimpan="INSERT INTO hasil(id_kategori,id_produk,hasil) VALUES ('$id_kategori','$id_produk','$hasil')";
        }
        $eksekusi = $this->koneksi()->query($querySimpan);

    }

     //m kesimpulan
    public function hasil($id_kategori){
        $hasil = array();
        $queryhasil     =   "SELECT kategori.`nama_kategori` AS nama_kategori, produk.`nama_produk` AS nama_produk, produk.`gambar_produk` AS gambar_produk, hasil.`hasil` AS hasil, produk.`id_produk` AS id_produk
                            FROM hasil 
                            INNER JOIN kategori ON kategori.`id_kategori` = hasil.`id_kategori`
                            INNER JOIN produk ON produk.`id_produk` = hasil.`id_produk`
                            WHERE kategori.`id_kategori` = $id_kategori
                            ORDER BY hasil.`hasil` DESC";
        $eksekusi = $this->koneksi()->query($queryhasil);
        while ($row=$eksekusi->fetch_array(MYSQLI_ASSOC)){
            array_push($hasil,array(
                "nama_kategori"=>$row['nama_kategori'],
                "nama_produk"=>$row['nama_produk'],
                "gambar_produk"=>$row['gambar_produk'],
                "hasil"=>$row['hasil'],
                "id_produk"=>$row['id_produk'])
            );
        }
        return $hasil;
   }

    public function total($id_kategori, $id_produk){
        $queryhasil     =   "SELECT hasil.`hasil` AS hasil
                            FROM hasil 
                            INNER JOIN kategori ON kategori.`id_kategori` = hasil.`id_kategori`
                            INNER JOIN produk ON produk.`id_produk` = hasil.`id_produk`
                            WHERE kategori.`id_kategori` = $id_kategori
                            AND produk.`id_produk`=$id_produk
                            ORDER BY hasil.`hasil` DESC";
        $eksekusi = $this->koneksi()->query($queryhasil)->fetch_array(MYSQLI_ASSOC);
        echo "<td class='td-center'>$eksekusi[hasil]</td>";
    }

    public function riwayat($id_kategori, $produk_max, $cek){
        //melihat nama kategori 
        $query_k = "SELECT * FROM kategori WHERE id_kategori='$id_kategori'";
        $data_k = $this->koneksi()->query($query_k);
        foreach ($data_k as $data_k) {
            $nama_k = $data_k['nama_kategori'];
        }

        //melihat nama produk dan gambar 
        $query_p = "SELECT * FROM produk WHERE id_produk ='$produk_max'";
        $data_p = $this->koneksi()->query($query_p);
        foreach ($data_p as $data_p) {
            $id_p = $data_p['id_produk'];
            $nama_p = $data_p['nama_produk'];
            $gambar_p = $data_p['gambar_produk'];
        }

        //tanggal sekarang
        $date_now = date("Y-m-d");
         //cek tabel jumlah rows
        $query_ri  =   "SELECT * FROM riwayat WHERE id_produk = '$id_p'";
        $ex = $this->koneksi()->query($query_ri);
        $jumlah_row = mysqli_num_rows($ex);


        if ($jumlah_row > 0 ) {
            $queryriwayat = "UPDATE riwayat SET hasil = $cek, tanggal = '$date_now' WHERE id_produk = '$id_p'";
        }else{
            $queryriwayat = "INSERT INTO riwayat(id_produk, nama_kategori, nama_produk, gambar_produk, hasil, tanggal) VALUES ('$id_p', '$nama_k','$nama_p', '$gambar_p', '$cek', '$date_now')";
        }
        $data_r = $this->koneksi()->query($queryriwayat);
    }
}
	

?>