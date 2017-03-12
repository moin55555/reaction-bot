<?php
 //Pilih Salah Satu
 // True = Aktif
 // False = Mati
$fungsine=array('suka' => false,
       'super' => true,
        'haha' => false,
         'wow' => false,
          'sedih' => false,
           'marah' => false);

###########################################################################################################################################
/* TOLONG HARGAI KAMI JANGAN HAPUS KATA2 DI BAWAH INI ,SOALNYA KAMI INGIN TERKENAL JUGA */
/* CODED By Wangur
/* Recoded By JakRapp */
/* Twitter -> @JakRapp_ */
/* Instagram -> jakrapp_ */
/* Blogger -> http://www.jakrapp.com */
###########################################################################################################################################

$mbot = new mbot($jakrapp);
$mbot-> fungsi=$fungsine;

class mbot{
private $jakrapp;
public $fungsi;
function __construct($dataLog){
 //Data Login
  $this->pass = 'Password Facebook Kalian';
   $this->email = 'Email / Username Facebook Kalian';
    }


private function get_contents($url,$type=null,$fields=null){
   $opts = array(
            42 => false,
            19913 => 1,
            10002 => $url,
            52 => false,
            10018 => 'Opera/9.80 (Series 60; Opera Mini/6.5.27309/34.1445; U; en) Presto/2.8.119 Version/11.10',
           78 => 5,
           13 => 5,
           47 => false,
            );
   $ch=curl_init();
   if($type){
       if($type == 1){
              $opts[10082] = 'coker_log';
              }
       if($type == 3){
              $opts[42] = false;
             
             }
       $opts[10031] = 'coker_log';
    }
  if($fields){
      $opts[47] = false;
      $opts[10015] = $fields;
      }
   curl_setopt_array($ch,$opts);
   $result = curl_exec($ch);
   curl_close($ch);
   return $result;
  }


public function home(){
   $url = $this->getUrl('m','home.php');
   $getToken = $this->get_contents($url,3); 
   $konten = strstr($getToken,'class="_3-8w">');
   $ft_id = explode('/reactions/picker/',$konten);
   $limit=count($ft_id);
 echo'<b>Type Reaction: '.$this->ubah($this->fungsi,true).'</b><hr>';
 
for($i=0; $i<=$limit; $i++){
$id=$this->cut($ft_id[$i],'ft_id=','&');
 echo $id;
       if($id){
       if($this->getLog($id)){
      
        echo'<font color="green">[ Ok ]</font>';
          $this -> getReaction($id);
           }else{
       echo' <font color="red">Success..</font>';
  }
echo'<br>';
}
}
  
   }

private function saveFile($x,$y){
   $f = fopen($x,'w');
        fwrite($f,$y);
        fclose($f);
   }
private function getUrl($domain,$dir,$uri=null){
    if($uri){
         foreach($uri as $key =>$value){
             $parsing[] = $key . '=' . $value;
                }
             $parse = '?' . implode('&',$parsing);
                }
     return 'https://'.$domain.'.facebook.com/'.$dir.$parse; 
       }

public function cut($content,$start,$end){
if($content && $start && $end) {
$r = explode($start, $content);
if (isset($r[1])){
$r = explode($end, $r[1]);
return $r[0];
}
return '';
}
}

public function getReaction($edo){
$gerr ='https://mobile.facebook.com/reactions/picker/?ft_id='.$edo;
    echo'<br>';
    $sukaa= $this->get_contents($gerr,3); 
    $suka= $this->cut($sukaa,'tanggapan</h1>','<div id="static');
    $ha= explode('/ufi/reaction/',$suka);
    $liha= count($ha);
  // echo $suka;

for($hai=0; $hai<=$liha; $hai++){
  $getha= $this -> cut($ha[$hai],$this->ubah($this->fungsi,false),'"');
   
    if($getha){
      $hajarm='https://mobile.facebook.com/ufi/reaction/?ft_ent_identifier='.$edo.'&amp;reaction_'.$this->ubah($this->fungsi,false).''.$getha;
      $hajar= str_replace('&amp;','&',$hajarm);
//   echo $hajar;
      echo'<br>';
      echo $this->get_contents($hajar,3);
      
    }
}
}
public function ubah($jak,$info){
 if($jak[suka]=='true'){
 $tipe='type=1';
$kirik='Suka';
  }else if($jak[super]=='true'){
   $tipe='type=2';
$kirik='Super';
    }else if($jak[haha]=='true'){
     $tipe='type=4';
$kirik='Haha';
      }else if($jak[wow]=='true'){
       $tipe='type=3';
$kirik='Wow';
        }else if($jak[sedih]=='true'){
         $tipe='type=7';
$kirik='Sedih';
          }else if($jak[marah]=='true'){
           $tipe='type=8';
$kirik='Marah';
            }
         if($info=='true'){
        return $kirik;
      }else{
    return $tipe;
  }
}

public function getLog($y){
   if(file_exists('log.txt')){
       $log=file_get_contents('log.txt');
       }else{
       $log=' ';
       }

  if(ereg($y,$log)){
       return false;
       }else{
if(strlen($log) > 5000){
   $n = strlen($log) - 5000;
   }else{
  $n= 0;
   }
       $this->saveFile('log.txt',substr($log,$n).' '.$y);
       return true;
      }
 }

public function login(){
  $login = array(
     'pass' => $this -> pass,
     'email' => $this -> email,
     'login'  => 'Login',
             );
  $this->get_contents($this->getUrl('m','login.php'),1,$login);
   }

}

if($mbot->home()){
    echo $mbot->home();
    }else{
    $mbot->login();
    }

?>