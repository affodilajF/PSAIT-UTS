<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>

<?php
 $nim = $_GET['nim'];
 var_dump($nim);

 $kode_mk = $_GET['kode_mk'];
 var_dump($kode_mk);

 $curl= curl_init();
 curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($curl, CURLOPT_URL, 'http://localhost/UTS_PSAIT/sait_project_api/mahasiswa_api.php?nim=' . $nim . '&kode_mk=' . $kode_mk);
 $res = curl_exec($curl);
 $json = json_decode($res, true);
?>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Update Data</h2>
                    </div>
                    <p>Please fill this form and submit to add student record to the database.</p>
                    <form action="updateMahasiswaDo.php" method="post">
                        <input type = "hidden" name="id_mhs" value="<?php echo"$id_mhs";?>">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control" value="<?php echo($json["data"][0]["nama"]); ?>">
                        </div>
                        <div class="form-group">
                            <label>Nama Matakuliah</label>
                            <input type="mobile" name="alamat" class="form-control" value="<?php echo($json["data"][0]["nama_mk"]); ?>">
                        </div>
                        <div class="form-group">
                            <label>Nilai</label>
                            <input type="number" name="nilai" class="form-control" value="<?php echo($json["data"][0]["nilai"]); ?>">
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="kode_mk" class="form-control" value="<?php echo($json["data"][0]["kode_mk"]); ?>">
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="nim" class="form-control" value="<?php echo($json["data"][0]["nim"]); ?>">
                        </div>

                        <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>