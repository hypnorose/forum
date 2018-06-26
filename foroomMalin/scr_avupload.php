<?php session_start();	include "dane.php";
$dir='avatary/';
$file=$dir.basename($_FILES['file']['name']);
$upflag=1;
   $filetype=strtolower(pathinfo($file,PATHINFO_EXTENSION));
    if(isset($_POST['submit'])){
        $check = getimagesize($_FILES['file']['tmp_name']);
        if($check!==false){
            echo "śmiga";
        }
        else {echo "nie śmiga";
             $upflag=0;
             }
    }
    if($_FILES['file']['size']>6000000){
     echo "za duzo";
        $upflag=0;
    };
   if($filetype != "jpg" && $filetype != "png" && $filetype != "jpeg"
&& $filetype != "gif" ) {
       echo $file;
    echo $filetype;
    $upflag = 0;
} 
                    
    if($upflag){
        if(move_uploaded_file($_FILES['file']['tmp_name'],$dir.$_POST['id'].".png")){
            echo "udało sie";
        }
        else echo "nie dalo rady wyslac";
    }
    else "nie da sie";
?>