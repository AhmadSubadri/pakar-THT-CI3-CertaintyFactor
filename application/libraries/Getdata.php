<?php
class Getdata extends CI_Controller{
  private $CI;
  public function __construct(){
    $CI =& get_instance();
  }

  /**
	 * Mendapatkan data dari database
	 *
	 * Mendapatkan informasi dari database
	 *
	 * @param array untuk pengambilan opsi atau gunakan @param string
	 *	- Gunakan array dengan keyword 'table' untuk menunjukan tabel yang di tuju,
	 *	- Gunakan array dengan key 'select' untuk mendefiniskan
	 *
	 */

	 public function _resultDB( $items = array() , $result ='' ){
     $CI =& get_instance();
		 $attributes = is_array($items) ? $items : array($items);
	   $_show     = !is_array($result) ? $result : 'fetch_all';

	   $query = $this->_getQuery($attributes);
	   switch ( $_show ){
			 case 'num_rows':
			 	 return $query->num_rows();
			 	 break;

       case 'row_array':
         return $query->row_array();
         break;

	     default:
	       return $query->result_array();
	       break;
	   }

	 }

   public function _getData(){
     $select = array(
       'tb_gabungan.nilai_md',
       'tb_gabungan.nilai_mb',
       'tb_gejala.id_gejala as gejala_id',
       'tb_gejala.nama_gejala as gejala_nama',
       'tb_penyakit.id_penyakit as penyakit_id',
       'tb_penyakit.definisi_penyakit as penyakit_definisi',
       'tb_penyakit.nama_penyakit as penyakit_nama',
       'tb_penyakit.penanganan_penyakit as penyakit_penanganan',
       'tb_penyakit.pencegahan_penyakit as penyakit_pencegahan'
     );

     $arr = array(
       'table'			=> 'tb_gabungan',
       'select'		=> implode(',',$select),
       'join' 		=> array(
         array(
           'table' 	=> 'tb_penyakit',
           'on'			=> 'tb_penyakit.id_penyakit = tb_gabungan.id_penyakit',
         ),
         array(
           'table' => 'tb_gejala',
           'on'		=> 'tb_gejala.id_gejala = tb_gabungan.id_gejala',
         ),
       ),
     );
     $output['check'] = $this->_resultDB($arr,'num_rows');
     $output['check'] != 0 ? $output['info'] = $this->sortirPenyakit( $this->_resultDB($arr) ): FALSE;
     return $output;
   }

   /**
   *  untuk melakukan register ke dalam database
   *  @param array
   *
   */

   public function _insertUser( $items = array() )
   {
     $CI =& get_instance();

     if ( !is_array($items) ) return "Gunakan array untuk ";
     elseif ( !isset($items['email']) ) return "Tidak dapat menemukan data dengan kata kunci email untuk di masukkan ke dalam database.";
     elseif ( !isset($items['password']) ) return "Tidak dapat menemukan data dengan kata kunci password untuk di masukkan ke dalam database.";
     elseif ( !isset($items['code']) ) return "Tidak dapat menemukan data dengan kata kunci code untuk di masukkan ke dalam database.";

     $insert['email']     = $items['email'];
     $insert['password']  = $items['password'];
     $insert['status']    = isset($items['status']) ? ( $items['status']==='waiting' || $items['status']==='verify' ? $items['status'] : 'waiting' ) : 'waiting';
     $insert['code']      = $items['code'];

     $process = $CI->db->insert('user',$insert);

     if ( $process == TRUE)
     {
       $process = $this->_userLogin('id, email', $insert);
       return $process;
     }
     else return "Gagal Menambahkan Data";
   }

   public function _userLogin($select, $str)
   {
     $arr = array(
       'select'     => $select,
       'table'			=> 'user',
       'like_array'	=> $str,
       'limit'      => 1,
     );
     $query = $this->_resultDB($arr,'row_array');
     return $query;
   }

	 private function _getQuery( $attributes )
	 {
     $CI =& get_instance();
		 if ( func_num_args() == 0 ) return exit('Terjadi kesalahan dalam mendefinisikan data!');

		 /* SETTING DEFAULT DATA UNTUK PROSES */
	   $table 	= array_key_exists('table',$attributes) ? $attributes['table'] : $attributes[0];
	   $select	= array_key_exists('select',$attributes) ? $attributes['select'] : '*';

		 if ( array_key_exists('where_in',$attributes) )
		 {
			 $key = array_key_exists('key',$attributes['where_in']) ? $attributes['where_in']['key'] : FALSE;
			 $val = array_key_exists('data',$attributes['where_in']) ? $attributes['where_in']['data'] : FALSE;


			 switch ( $key===FALSE & $val===FALSE )
			 {
         case TRUE:
            return exit('Terjadi kesalahan pada penggunaan fungsi where_in! Gunakan data dengan kunci array "key" pada kolom yang di seleksi dan "data" pada data yang akan di cari.');
            break;
         default:
            $CI->db->where_in($key, $val);
            break;
       }

			 unset($key, $val, $check_key, $check_val);
		 }

     if ( array_key_exists('like',$attributes) )
		 {
			 $key = array_key_exists('key',$attributes['like']) ? $attributes['like']['key'] : FALSE;
			 $val = array_key_exists('data',$attributes['like']) ? $attributes['like']['data'] : FALSE;


			 switch ( $key===FALSE & $val===FALSE )
			 {
         case TRUE:
            return exit('Terjadi kesalahan pada penggunaan fungsi like! Gunakan data dengan kunci array "key" pada kolom yang di seleksi dan "data" pada data yang akan di cari.');
            break;
         default:
            $CI->db->like($key, $val);
            break;
       }

			 unset($key, $val, $check_key, $check_val);
		 }

     if ( array_key_exists('like_array',$attributes) )
     {
       switch ( !is_array($attributes['like_array']) ) {
         case TRUE:
           return exit('Tidak dapat melanjutkan perintah. Gunakan array untuk menggunakan fungsi ini!');
           break;

         default:
           foreach ($attributes['like_array'] as $key => $val)
           {
             $CI->db->like($key,$val);
           }
           unset($key, $val);
           break;
       }
     }

		 if ( array_key_exists('join',$attributes) )
		 {
			 switch (is_array($attributes['join']))
			 {
				 case TRUE:
				 	foreach ($attributes['join'] as $num => $value)
					{
						$key = array_key_exists('table',$value) ? $value['table'] : FALSE;
						$val = array_key_exists('on',$value) ? $value['on'] : FALSE;
						switch ( $key===FALSE & $val===FALSE )
						{
							case TRUE:
								return exit('Terjadi kesalahan pada penggunaan fungsi join! Gunakan data dengan kunci array "table" pada tabel yang akan di gabungkan dan "on" pada data penghubung antara tabel primary keys dan tabel foreign keys.');
								break;

							default:
								$CI->db->join($key, $val);
								break;
						}

						unset($key, $val);
				 	}
					unset($num, $value);
				 	break;

				 default:
				 	$key = array_key_exists('table',$attributes['join']) ? $attributes['join']['table'] : FALSE;
					$val = array_key_exists('on',$attributes['join']) ? $attributes['join']['on'] : FALSE;

					switch ( $key===FALSE & $val===FALSE )
					{
						case TRUE:
						 return exit('Terjadi kesalahan pada penggunaan fungsi join! Gunakan data dengan kunci array "table" pada tabel yang akan di gabungkan dan "on" pada data penghubung antara tabel primary keys dan tabel foreign keys.');
						 break;
						default:
						 $CI->db->join($key, $val);
						 break;
					 }

				 unset($key, $val);
			 }
		 }

     if ( array_key_exists('limit',$attributes) )
     {
       switch ( is_array($attributes['limit']) ) {
         case TRUE:
           return exit('Tidak dapat memasukkan data array.');
           break;

         default:
           $CI->db->limit($attributes['limit']);
           break;
       }
     }

	   $CI->db->select($select);
	   $CI->db->from($table);
	   return $CI->db->get();
	 }

   private function sortirPenyakit( $items = array() )
   {
     if (!function_exists('sortByProb'))
     {
       function sortByProb( $a, $b )
       {
         return $a['id_penyakit'] == $b['id_penyakit'] ? 0 : ( $b['id_penyakit'] != $a['id_penyakit'] ? -1 : 1 );
       }
     }

     usort($items, 'sortByProb');
     unset($a,$b);

     list($first) = array_keys($items);

     foreach ($items as ['id_penyakit' => $id_penyakit,
 												'nama_penyakit' => $nama_penyakit,
 												'definisi_penyakit' => $definisi_penyakit,
                        'penanganan_penyakit' => $penanganan_penyakit,
                        'pencegahan_penyakit' => $pencegahan_penyakit,
 												'id_gejala' => $id_gejala,
 												'nama_gejala'	=> $nama_gejala,
 												'nilai_mb' => $nilai_mb,
 												'nilai_md' => $md])
       {
         $no						= isset($oldPenyakit) ? ( $oldPenyakit==$id_penyakit ? $no+1 : 0 ) : 0;
         $oldPenyakit	= isset($oldPenyakit) ? ( $oldPenyakit==$id_penyakit ? $oldPenyakit : $id_penyakit ) : $id_penyakit;
         $num					= $id_penyakit;

         if ($no==0)
         {
           $data[$num]['id_penyakit'] 					= $id_penyakit;
           $data[$num]['nama_penyakit']				= $nama_penyakit;
           $data[$num]['definisi_penyakit']  			= $definisi_penyakit;
           $data[$num]['penanganan_penyakit']	= $penanganan_penyakit;
           $data[$num]['penanganan_penyakit'] = $penanganan_penyakit;
         }

         $data[$num]['id_gejala'][$no]							= $id_gejala;
         $data[$num]['nama_gejala'][$no]						= $nama_gejala;

         $data[$num]['nilai_mb'][$no]											= $nilai_mb;
         $data[$num]['nilai_md'][$no]											= $nilai_md;
       }
       unset($no, $oldPenyakit, $num, $nilai_md, $nilai_mb, $nama_gejala, $id_gejala, $nama_penyakit, $definisi_penyakit, $penanganan_penyakit, $pencegahan_penyakit, $id_penyakit);

       return $data;
     }
   }

?>
