<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/dropzone.min.css')}}">
</head>
<body>
    <div class="card-body">
        <div id="print-area">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="font-weight-bold">Informasi kegiatan</h4>
                    <p>NamaUKM</p>
                    <p><a href="">UKM@gmail.com</a></p>
    
                </div>
                <div class="col-md-6 text-sm-right">
                    <p><strong>Proposal terkait: </strong> Nama Proposal</p>
                    <p><strong>Tanggal Kegiatan: </strong> 10 Dec, 2018</p>
                    <p><strong>Penanggung Jawab: </strong> NamaPenanggungJawab</p>
                </div>
            </div>
        </div>
        <form action="#" method="POST" class="dropzone" id="multple-file-upload" enctype="multipart/form-data">
            @csrf
    
            <div class="fallback">
                <input  type="file" name="file" />
            </div>
            
        </form>
        <button type="submit" class="btn btn-primary mt-4 btn-lg">Selesai</button>
    </div>  
</body>
</html>


