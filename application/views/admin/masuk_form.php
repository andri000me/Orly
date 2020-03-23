<?
defined('SYSPATH') or die('No direct script access.');

echo Form::open($url, array('enctype' => 'multipart/form-data'));
if(isset($id)) {
	echo Form::hidden('id', $id);
}
?>
<script>
$(function() {
	var dates = $("#tanggal_terima, #tanggal_surat, #tanggal_diteruskan").datepicker({
		dateFormat:'yy-mm-dd',
		numberOfMonths: 1,
		showOn: "both",
		changeMonth: 'true',
		changeYear: 'true',
		buttonImage: "<? echo URL::base(); ?>assets/images/calendar.gif",
		buttonImageOnly: true,
		onSelect: function( selectedDate ) {
			var option = this.id == "tanggal_surat" ? "minDate" : "maxDate",
				instance = $( this ).data( "datepicker" ),
				date = $.datepicker.parseDate(
					instance.settings.dateFormat ||
					$.datepicker._defaults.dateFormat,
					selectedDate, instance.settings );
			$("#tanggal_surat").datepicker( "option", option, date );
		}
	});
	
	$("#skpd_id").select2({
		width: "75%",
		placeholder: "Pilih jika Pengirim dari OPD",
		allowClear: true
	});
	
	$("#klasifikasi_id").select2({
		width: "75%",
		placeholder: "Pilih Klasifikasi"
	});
	
	$("#sotk_id").select2({
		width: "75%",
		placeholder: "Pilih SOTK",
		allowClear: true,
	});
	
	$("#guna_id,#tingkat_id,#media_id").select2({
		width: "250px",
	});
	
	$(document).on('change', '#skpd_id', function() {
		$.ajax ({
			type: 'POST',
			url: '<? echo URL::base()."base/skpd"; ?>',
			data: $(this).serializeArray(),
			success: function(result) {
				$('#name').val(result);
			}
		}); 
	});
});
</script>
<style>
.ui-datepicker-trigger {
	margin-left:5px;
	margin-bottom: 5px;
}
</style>
<div class="box box-solid box-info">    
    <div class="box-header">
      <h4>Surat Masuk</h4>
    </div>
    <div class="box-body">
        <table width="100%" class="table">
            <tr>
                <td width="16%" align="right" valign="baseline"><strong>Instansi Pengirim</strong></td>
                <td width="84%" valign="baseline"><?php echo Form::select('dari',$skpd_list,Arr::get($form, 'dari'),array('id'=>'skpd_id')); 
                        if(isset($error['skpd_id'])) {
                            echo " <img src='".URL::base()."assets/images/error12.gif'>";
                        }?></td>
            </tr>
            <tr>
              <td align="right" valign="baseline"><strong>Nama Pengirim</strong></td>
              <td valign="baseline"><? echo Form::input('name',Arr::get($form, 'name'),array('id'=>'name','size'=>'75'));
                        if(isset($error['name'])) {
                            echo " <img src='".URL::base()."assets/images/error12.gif'>";
                        }?></td>
            </tr>
            <tr>
              <td align="right" valign="baseline"><strong>Tanggal terima</strong></td>
              <td valign="baseline"><?php echo Form::input('tanggal_terima',Arr::get($form, 'tanggal_terima'),array('id'=>'tanggal_terima','size'=>'10')); 
                        if(isset($error['tanggal'])) {
                            echo " <img src='".URL::base()."assets/images/error12.gif'>";
                        }?></td>
            </tr>
            <tr>
              <td align="right" valign="baseline"><strong>Tanggal surat</strong></td>
              <td valign="baseline"><?php echo Form::input('tanggal_surat',Arr::get($form, 'tanggal_surat'),array('id'=>'tanggal_surat','size'=>'10')); 
                        if(isset($error['tanggal_surat'])) {
                            echo " <img src='".URL::base()."assets/images/error12.gif'>";
                        }?></td>
            </tr>
            <?
			if(!isset($id)) {
				?>
				<tr>
				  <td align="right" valign="baseline"><strong>Tanggal diteruskan</strong></td>
				  <td valign="baseline"><?php echo Form::input('tanggal_diteruskan',Arr::get($form, 'tanggal_diteruskan'),array('id'=>'tanggal_diteruskan','size'=>'10')); ?></td>
				</tr>
				<tr>
				  <td align="right"><strong>Diteruskan kepada</strong></td>
				  <td valign="top"><?php echo Form::select('sotk_id', $sotk_list, Arr::get($form, 'sotk_id'),array('id' => 'sotk_id'));
					if(isset($error['sotk_id'])) {
						echo "<div class='error_form'><img src='".URL::base()."assets/images/error12.gif'>".Arr::get($errors, 'sotk_id')."</div>";
					}
					?></td>
				</tr>
				<tr>
				  <td align="right"><strong>Catatan</strong></td>
				  <td valign="top"><?php echo Form::textarea('rekomendasi',Arr::get($form, 'rekomendasi'),array('id' => 'rekomendasi','rows'=>'2','cols'=>'75'));
									if(isset($error['rekomendasi'])) {
										echo " <img src='".URL::base()."assets/images/error12.gif'>";
									}?></td>
				</tr>
				<?
			}
			?>
            <tr>
              <td align="right">&nbsp;</td>
              <td valign="top">&nbsp;</td>
            </tr>
            <!--tr>
              <td align="right" valign="baseline"><strong>Nomor Urut</strong></td>
              <td valign="baseline"><? echo Form::input('urut',Arr::get($form, 'urut'),array('id'=>'urut','size'=>'15')); 
                        /*if(isset($error['urut'])) {
                            echo " <img src='".URL::base()."assets/images/error12.gif'>";
                        }?> <?
                        $surats = ORM::factory('Masuk')
                            ->where('skpd_id','=',Auth::instance()->get_user()->skpd->id)
                            ->where(DB::expr('YEAR(tanggal_surat)'),'=',date("Y"))
                            ->order_by('id','DESC')
                            ->find();
                        echo "Nomor urut terakhir : ".$surats->urut." / Tahun : ".substr($surats->tanggal_surat,0,4);*/
                        ?></td>
            </tr!-->
            <tr>
              <td align="right" valign="baseline"><strong>Nomor Surat</strong></td>
              <td valign="baseline"><?php echo Form::input('nomor',Arr::get($form, 'nomor'),array('size'=>'50')); 
                        if(isset($error['nomor'])) {
                            echo " <img src='".URL::base()."assets/images/error12.gif'>";
                            echo "<br><br>";
                            echo "Surat dengan nomor yang sama :";
                            echo "<br>";
                            $i = 1;
                            $surats = ORM::factory('Masuk')->where('nomor','=',Arr::get($form, 'nomor'))->find_all();
                            foreach($surats as $surat) {
                                echo $i.". ".$surat->nomor." dari ".$surat->name." tertanggal  ".$surat->tanggal_surat;
                            }
                        }?></td>
            </tr>
            <tr>
              <td align="right" valign="baseline"><strong>Perihal</strong></td>
              <td valign="baseline"><?php echo Form::input('perihal',Arr::get($form, 'perihal'),array('size'=>'50')); 
                        if(isset($error['perihal'])) {
                            echo " <img src='".URL::base()."assets/images/error12.gif'>";
                        }?></td>
            </tr>
            <tr>
              <td align="right" valign="baseline"><strong>Kode Klasifikasi</strong></td>
              <td valign="baseline"><?php echo Form::select('klasifikasi_id',$klasifikasi_list,Arr::get($form, 'klasifikasi_id'),array('id'=>'klasifikasi_id')); 
                        if(isset($error['klasifikasi_id'])) {
                            echo " <img src='".URL::base()."assets/images/error12.gif'>";
                        }?></td>
            </tr>
            <tr>
              <td align="right" valign="baseline"><strong>Isi surat</strong></td>
              <td valign="baseline"><?php echo Form::textarea('isi',Arr::get($form, 'isi'),array('id' => 'isi','rows'=>'5','cols'=>'100'));
                                if(isset($error['isi'])) {
                                    echo " <img src='".URL::base()."assets/images/error12.gif'>";
                                }?></td>
            </tr>
            <tr>
              <td align="right" valign="baseline"><strong>Indeks</strong></td>
              <td valign="baseline"><?php echo Form::input('indeks',Arr::get($form, 'indeks'),array('size'=>'50')); ?></td>
            </tr>
            <tr>
              <td align="right" valign="baseline"><strong>Nilai Guna</strong></td>
              <td align="left" valign="baseline"><?php echo Form::select('guna_id',$guna_list,Arr::get($form, 'guna_id'),array('id'=>'guna_id')); 
                            if(isset($error['guna_id'])) {
                                echo " <img src='".URL::base()."assets/images/error12.gif'>";
                            }?></td>
            </tr>
            <tr>
              <td align="right" valign="baseline"><strong>Media</strong></td>
              <td align="left" valign="baseline"><?php echo Form::select('media_id',$media_list,Arr::get($form, 'media_id'),array('id'=>'media_id')); 
                            if(isset($error['media_id'])) {
                                echo " <img src='".URL::base()."assets/images/error12.gif'>";
                            }?></td>
            </tr>
            <tr>
              <td align="right" valign="baseline"><strong>Tingkat Pekembangan</strong></td>
              <td align="left" valign="baseline"><?php echo Form::select('tingkat_id',$tingkat_list,Arr::get($form, 'tingkat_id'),array('id'=>'tingkat_id')); 
                            if(isset($error['tingkat_id'])) {
                                echo " <img src='".URL::base()."assets/images/error12.gif'>";
                            }?></td>
            </tr>
            <tr>
              <td align="right" valign="baseline"><strong>Lampiran</strong></td>
              <td align="left" valign="baseline"><?php echo Form::input('jumlah',Arr::get($form, 'jumlah'),array('size'=>'5')); ?> <? echo Form::select('lampiran_id',$lampiran_list,Arr::get($form, 'lampiran_id'),array('id'=>'lampiran_id')); ?></td>
            </tr>
            <tr>
              <td align="right" valign="baseline"><strong>Copy Digital</strong></td>
              <td valign="baseline"><? echo $file; ?></td>
            </tr>
            <tr>
              <td align="right" valign="baseline"><strong>Upload</strong></td>
              <td valign="baseline"><? echo Form::file('file'); ?></td>
            </tr>
            <tr>
              <td valign="middle">&nbsp;</td>
              <td valign="middle"><? echo "<div class='submit_option'>".Form::submit('submit',$submit_value,array('class'=>'btn btn-primary btn-sm'))."</div>"; 
									if(isset($id)) {
									echo "<div class='delete_option'><div class='delete_input'>".Form::checkbox('delete', '1', FALSE)."</div><div class='delete_text'> Hapus data ini</div></div>";
									}
									?></td>
            </tr>
        </table>
  </div>
</div>
<?php echo Form::close() ?>
