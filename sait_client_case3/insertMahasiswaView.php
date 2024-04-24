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
 $curl= curl_init();
 curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($curl, CURLOPT_URL, 'http://localhost/UTS_PSAIT/sait_project_api/mahasiswa_api.php?allmahasiswa=true');
 $res = curl_exec($curl);
 $json = json_decode($res, true);
?>

    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Add New Data</h2>
                    </div>
                    <p>Please fill this form and submit to add student record to the database.</p>
                    <form action="insertMahasiswaDo.php" method="post">

                        <div class="form-group">
                            <label>Data Mahasiswa </label>
                            <select name="nim" class="form-control">
                            <?php foreach ($json['data'] as $item) : ?>
                                <option value="<?php echo $item['nim']; ?>"><?php echo $item['nim'] . ' - ' . $item['nama']; ?></option>
                            <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Matakuliah</label>
                            <select type="mobile" name="kode_mk" class="form-control">
                                <option value="svpl_001">Database </option>
                                <option value="svpl_002">Kecerdasan Artifisial </option>
                                <option value="svpl_003">Interoperabilitas</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Nilai</label>
                            <input type="number" name="nilai" class="form-control">
                        </div>


                        <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>