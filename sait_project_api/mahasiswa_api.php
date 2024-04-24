<?php
require_once "config.php";
$request_method=$_SERVER["REQUEST_METHOD"];
switch ($request_method) {
   case 'GET':
         if(!empty($_GET["nim"]) && !empty($_GET["kode_mk"]))
         {
            $nim = $_GET["nim"];
            $kode_mk = $_GET["kode_mk"];
            get_nilai_all_by_nim_mk($nim, $kode_mk);
         }
         elseif(!empty($_GET["nim"]))
         {
            $nim = $_GET["nim"];
            get_nilai_by_nim($nim);
         }
         elseif(!empty($_GET["allmahasiswa"]))
         {
            $data = $_GET["allmahasiswa"];
            get_data_mhs($data);
         }
         else
         {
            get_nilai_all();
         }
         break;
   case 'POST':
         if (!empty($_GET["nim"]) && !empty($_GET["kode_mk"])) 
         {
            $nim = $_GET["nim"];
            $kode_mk = $_GET["kode_mk"];
            update_mhs($nim, $kode_mk);
         }
         else
         {
            insert_mhs();
         }     
         break; 
   case 'DELETE':
          $nim= $_GET["nim"];
          $kode_mk = $_GET["kode_mk"];
            delete_mhs($nim, $kode_mk);
            break;
   default:
      // Invalid Request Method
         header("HTTP/1.0 405 Method Not Allowed");
         break;
      break;
 }


   function get_data_mhs($data)
   {
      global $mysqli;
      $query="SELECT nim, nama FROM mahasiswa";
      $data=array();
      $result=$mysqli->query($query);
      while($row=mysqli_fetch_object($result))
      {
         $data[]=$row;
      }
      $response=array(
                     'status' => 1,
                     'message' =>'Get List Mahasiswa Successfully.',
                     'data' => $data
                  );
      header('Content-Type: application/json');
      echo json_encode($response);
   }


   function get_nilai_all()
   {
      global $mysqli;
      $query="SELECT * FROM nilai_mahasiswa";
      $data=array();
      $result=$mysqli->query($query);
      while($row=mysqli_fetch_object($result))
      {
         $data[]=$row;
      }
      $response=array(
                     'status' => 1,
                     'message' =>'Get List Mahasiswa Successfully.',
                     'data' => $data
                  );
      header('Content-Type: application/json');
      echo json_encode($response);
   }
 
   function get_nilai_all_by_nim_mk($nim, $kode_mk)
   {
      global $mysqli;
      $query = "SELECT * FROM nilai_mahasiswa WHERE nim = '$nim' AND kode_mk = '$kode_mk'";


      $data=array();
      $result=$mysqli->query($query);
      while($row=mysqli_fetch_object($result))
      {
         $data[]=$row;
      }
      $response=array(
                     'status' => 1,
                     'message' =>'Get List Mahasiswa Successfully.',
                     'data' => $data
                  );
      header('Content-Type: application/json');
      echo json_encode($response);
   }

   function get_nilai_by_nim($nim="")
   {
      global $mysqli;
      $query = "SELECT nama, nama_mk, nilai FROM nilai_mahasiswa";

      if($nim != "")
      {
         $query .= " WHERE nim = '$nim'";
      }
      $data=array();
      $result=$mysqli->query($query);
      while($row=mysqli_fetch_object($result))
      {
         $data[]=$row;
      }
      $response=array(
                     'status' => 1,
                     'message' =>'Get Mahasiswa Successfully.',
                     'data' => $data
                  );
      header('Content-Type: application/json');
      echo json_encode($response);
        
   }
 
   function insert_mhs()
      {
         global $mysqli;
         if(!empty($_POST["nim"])){
            $data=$_POST;
         }else{
            $data = json_decode(file_get_contents('php://input'), true);
         }

         $arrcheckpost = array('nilai' => '', 'nim' => '','kode_mk' => '');
         $hitung = count(array_intersect_key($data, $arrcheckpost));
         if($hitung == count($arrcheckpost)){
          
               $result = mysqli_query($mysqli, "INSERT INTO perkuliahan SET
               nim = '$data[nim]',
               kode_mk= '$data[kode_mk]',
               nilai = '$data[nilai]' ");     

               if($result)
               {
                  $response=array(
                     'status' => 1,
                     'message' =>'Added Successfully.'
                  );
               }
               else
               {
                  $response=array(
                     'status' => 0,
                     'message' =>'Addition Failed.'
                  );
               }
         }else{
            $response=array(
                     'status' => 0,
                     'message' =>'Parameter Do Not Match'
                  );
         }
         header('Content-Type: application/json');
         echo json_encode($response);
      }
 
   function update_mhs($nim, $kode_mk)
      {
         global $mysqli;
         if(!empty($_POST["nim"])){
            $data=$_POST;
         }else{
            $data = json_decode(file_get_contents('php://input'), true);
         }

         $arrcheckpost = array('nilai' => '');
         $hitung = count(array_intersect_key($data, $arrcheckpost));
         if($hitung == count($arrcheckpost)){
          

            $result = mysqli_query($mysqli, "UPDATE perkuliahan SET
            nilai = '$data[nilai]'
            WHERE nim = '$nim' AND kode_mk = '$kode_mk'");
         
            if($result)
            {
               $response=array(
                  'status' => 1,
                  'message' =>'Updated  Successfully.'
               );
            }
            else
            {
               $response=array(
                  'status' => 0,
                  'message' =>'Updation Failed.'
               );
            }
         }else{
            $response=array(
                     'status' => 0,
                     'message' =>'Parameter Do Not Match'
                  );
         }
         header('Content-Type: application/json');
         echo json_encode($response);
      }
 
   function delete_mhs($nim, $kode_mk)
   {
      global $mysqli;

      $query = "DELETE FROM perkuliahan WHERE nim='$nim' AND kode_mk='$kode_mk'";
      
      if(mysqli_query($mysqli, $query))
      {
         $response=array(
            'status' => 1,
            'message' =>'Deleted Successfully.'
         );
      }
      else
      {
         $response=array(
            'status' => 0,
            'message' =>'Deletion Failed.'
         );
      }
      header('Content-Type: application/json');
      echo json_encode($response);
   }
 
?> 
