<?php include 'connection.php' ?>

<?php
    session_start();
    $_SESSION['user']=$_POST['user'];
    $_SESSION['pass']=$_POST['pass'];
   
    if(isset($_SESSION['user']) && isset($_SESSION['pass']) && $_SESSION['user']!="" && $_SESSION['pass']!="" && $_SESSION['auth']==0){
        
        $_SESSION['auth']=1;
        $user=mysqli_real_escape_string($con,$_SESSION['user']);

        $pass=mysqli_real_escape_string($con,$_SESSION['pass']);


        $query="SELECT Aadhar_id,AES_DECRYPT(Password,'AbhayGuptaPathologyLab') AS Password FROM patient;";
        if(!mysqli_query($con,$query)){
            
            session_unset();
            session_destroy();
            header("Location: index.php");
            exit();
        }
        else{
            $t=0;
        $result=mysqli_query($con,$query);
        while($a=mysqli_fetch_assoc($result)){
            if($_SESSION['user']==$a['User_id'] && $_SESSION['pass']==$a['Password']){
                $t=1;
                header("Location: patient.php");
                exit();
                
            }
            else if($_SESSION['user']==$a['User_id'] && $a['Password']===NULL){
                
            }
            
            
        }
            if($t==0){
                session_unset();
                session_destroy();
                header("Location: index.php");
                exit();
            
            }
        }
    }
else{
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
    
}
?>