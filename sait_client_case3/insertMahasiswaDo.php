



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert barang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .status {
            text-align: center;
            margin-top: 20px;
        }
        .status p {
            margin: 5px 0;
        }
        .btn {
            display: block;
            width: 100px;
            margin: 20px auto;
            padding: 10px;
            text-align: center;
            background-color: #ff7f00;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color:  #cc6600;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Tambah Nilai Mahasiswa </h2>
        <div class="status">
            <?php

            if(isset($_POST['submit']))
            {    
                $nim = $_POST['nim'];
                $kode_mk = $_POST['kode_mk'];
                $nilai = $_POST['nilai'];

            $url = 'http://localhost/UTS_PSAIT/sait_project_api/mahasiswa_api.php';
            $ch = curl_init($url);
            $jsonData = array(
                'nim' =>  $nim,
                'kode_mk' =>  $kode_mk,
                'nilai' => $nilai
            );

            //Encode the array into JSON.
            $jsonDataEncoded = json_encode($jsonData);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            //pastikan mengirim dengan method POST
            curl_setopt($ch, CURLOPT_POST, true);

            //Attach our encoded JSON string to the POST fields.
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

            //Set the content type to application/json
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 

            //Execute the request
            $result = curl_exec($ch);
            $result = json_decode($result, true);

            curl_close($ch);
            print("<center><br>Status :  {$result["status"]} "); 
            print("<br>");
            print("Message :  {$result["message"]} "); 
            }
            ?>
        </div>
        <a href="selectMahasiswaView.php" class="btn">OK</a>
    </div>
</body>
</html>
