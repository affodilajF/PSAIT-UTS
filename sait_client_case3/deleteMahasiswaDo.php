<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete barang</title>
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
        <h2>Delete Data Nilai Mahasiswa </h2>
        <div class="status">
            <?php
                
                $nim = $_GET['nim'];
                $kode_mk = $_GET['kode_mk'];
                $url = 'http://localhost/UTS_PSAIT/sait_project_api/mahasiswa_api.php?nim=' . $nim . '&kode_mk=' . $kode_mk;

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $result = curl_exec($ch);
                $result = json_decode($result, true);
                curl_close($ch);

                echo "<p>Status: {$result["status"]}</p>"; 
                echo "<p>Message: {$result["message"]}</p>"; 
            ?>
        </div>
        <a href="selectMahasiswaView.php" class="btn">OK</a>
    </div>
</body>
</html>
