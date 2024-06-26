<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper{
            width: 100%;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
            border-radius: 10px;
        }
        table tr td:last-child{
            width: 120px;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
    <style>
        div.scroll {
            height: calc(100vh - 200px);
            overflow-y: auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Nilai Mahasiswa</h2>
                        <a href="insertMahasiswaView.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New</a>
                    </div>
                    <div class="scroll">
                    <?php
                    $curl= curl_init();
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($curl, CURLOPT_URL, 'http://localhost/UTS_PSAIT/sait_project_api/mahasiswa_api.php');
                    $res = curl_exec($curl);
                    $json = json_decode($res, true);

                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>No</th>";
                                        echo "<th>Nim</th>";
                                        echo "<th>Name</th>";
                                        // echo "<th>Alamat</th>";
                                        // echo "<th>Tanggal Lahir</th>";
                                        echo "<th>Kode Matakuliah</th>";
                                        echo "<th>Nama Matakuliah</th>";
                                        echo "<th>SKS</th>";
                                        echo "<th>Nilai</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                for ($i = 0; $i < count($json["data"]); $i++){
                                    echo "<tr>";
                                        echo "<td><b>" . ($i + 1) . "</b></td>";
                                        echo "<td> {$json["data"][$i]["nim"]} </td>";
                                        echo "<td> {$json["data"][$i]["nama"]} </td>";
                                        // echo "<td> {$json["data"][$i]["alamat"]} </td>";
                                        // echo "<td> {$json["data"][$i]["tanggal_lahir"]} </td>";
                                        echo "<td> {$json["data"][$i]["kode_mk"]} </td>";
                                        echo "<td> {$json["data"][$i]["nama_mk"]} </td>";
                                        echo "<td> {$json["data"][$i]["sks"]} </td>";
                                        echo "<td> {$json["data"][$i]["nilai"]} </td>";
                                        echo "<td>";
                                        echo '<a href="deleteMahasiswaDo.php?nim=' . $json["data"][$i]["nim"] . '&kode_mk=' . $json["data"][$i]["kode_mk"] . '" title="Delete Record" data-toggle="tooltip" style="color: red;"><span class="fa fa-trash"></span></a>';
                                        echo '<span style="margin-right: 10px;"></span>';
                                        echo '<a href="updateMahasiswaView.php?nim='. $json["data"][$i]["nim"] . '&kode_mk=' . $json["data"][$i]["kode_mk"] .'" class="mr-3" title="Update Record" data-toggle="tooltip" style="color: blue;"><span class="fa fa-pencil"></span></a>';

                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                    curl_close($curl);
                    ?>
                </div>
                </div>
            </div>        
        </div>
    </div>

    <p><p><p>
    
   
</body>
</html>