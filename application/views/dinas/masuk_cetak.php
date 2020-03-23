<? defined('SYSPATH') or die('No direct script access.'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>

<style>
html,body,div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,pre,form,fieldset,input,p,blockquote,th,td {
	margin:0;padding:0;
	font-family:Arial, Helvetica, sans-serif;
}
img,body,html{border:0;}
address,caption,cite,code,dfn,em,strong,th,var{font-style:normal;font-weight:normal;}
ol,ul {list-style:none;}caption,q:before,q:after{content:'';}

table {
	width: 100%;
	font-size: 11px;
	font-family: arial;
	border-collapse: collapse;
}

table th {
	padding: 4px 3px 4px 5px;
	border: 1px solid #d0d0d0;
	background-color: #ededed;
	font-weight:bold;
}

table td {
	padding: 4px 3px 4px 5px;
	border: 1px solid #d0d0d0;
}
.title {
	font-family:Tahoma,Verdana, Arial, Helvetica, sans-serif;
	font-size:14px;
	font-weight:bold;
	margin-bottom:20px
}
.title1 {	font-family:Arial, Geneva, sans-serif;
	font-size:14px;
}
.sub_title {	font-family:Arial, Geneva, sans-serif;
	font-size:16px;
	font-weight:bold;
}
</style>
</head>
<body>
<div class="title">
 	<div class="title1"><? echo strtoupper(Auth::instance()->get_user()->skpd->name); ?></div>
    <div class="sub_title">DAFTAR ARSIP MASUK</div>
</div>
<table width="100%" cellpadding="5" cellspacing="0">
    <thead>
    <tr>
        <th width="5%" align="center">No</th>
        <th width="8%" align="center">No Urut</th>
        <th width="12%" align="center">Tanggal Surat</th>
      	<th width="22%" align="left">Dari</th>
      	<th width="8%" align="center">Klasifikasi</th>
      	<th width="20%" align="left">Indeks Surat</th>
    	<th width="25%" align="left">Isi</th>
      </tr>
    </thead>
    <?
    $i=1;
    foreach($results as $masuk) {
		$tanggal_surat = new DateTime($masuk->tanggal_surat);
        ?>
        
        <tr>
            <td align="center"><? echo $i; ?></td>
            <td align="center"><? echo $masuk->urut; ?></td>
            <td align="center"><? echo $tanggal_surat->format("d-m-Y"); ?></td>
            <td align="left"><? echo $masuk->name; ?></td>
            <td align="center"><? echo $masuk->klasifikasi->kode; ?></td>
            <td align="left"><? echo $masuk->indeks; ?></td>
            <td align="left"><? echo $masuk->isi; ?></td>
        </tr>
        <?
        $i++;
    }
    ?>
</table>
</body>
</html>