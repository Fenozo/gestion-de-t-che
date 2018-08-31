<?php
/*
    Created dir
*/
function create_dir($dir= false,$to_created = false){
   if($to_created){
        $to_created  =$to_created;
   }else{
       $to_created  ='upload_3';
   }
   if($dir ==false){
       $dir= "../upload/";
   }else{
       $dir=$dir;
   }
$c =0;

  if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
                if($to_created ==$file){
                    $c++;
                }         
        }
        closedir($dh);
    }
}

    if($c==0){
        mkdir($dir.''.$to_created ,0777,true);
    }else{
        
    }
}


/*
* Uploaded fichier
*/
function move_file($rp){
    if($rp){
        $repertoire = $rp;
    }else{
        $repertoire = '../upload';
    }
   

    if(isset($_GET['file'])){
        $file = $_GET['file'];
         $to_created =  $file;
         create_dir(false,$to_created);
        
        if(!empty($_FILES)){
                $path = $repertoire."/".$to_created."/".$_FILES['file']['name'];
            if(move_uploaded_file($_FILES['file']['tmp_name'],$path)){
                    echo "OK successfull";
                }
        }
    }

}

move_file();

?>