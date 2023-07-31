<!-- index.php -->
<div class="card">
    <div></div>
    <div class="card-body">
    <h1>JUDUL LAPORAN 1</h1>
            <table>
                <tr>
                    <td>Tanggal Awal</td>
                    <td>:</td>
                    <td><input class="form-control tgl_awal" type="date" name="tanggal_awal" id="tgl_awal"></td>
                </tr>
                <tr>
                    <td>Tanggal Akhir</td>
                    <td>:</td>
                    <td><input class="form-control tgl_akhir" type="date" name="tanggal_akhir" id="tgl_akhir"></td>
                </tr>
            </table>
            <!-- <button class="btn btn-success" name="submit" id="submit">Cari</button> -->
            <a href='javascript:void(0);' class='submit-button btn btn-success'>Cari</a>
    </div>
    <div class="card-body" id="hasil_laporan">
        Data laporan
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
<script>

$(document).ready(function() {
  $('.submit-button').click(function(e) {
    e.preventDefault();

        var tgl_awal = $("#tgl_awal").val();
        var tgl_akhir = $("#tgl_akhir").val();

    // Mengirim permintaan AJAX ke server
    $.ajax({
      url: '../process/laporan_1.php',
      method: 'POST',
      data: { tgl_awal : tgl_awal, tgl_akhir : tgl_akhir
	},
      success: function(response) {
        $('#hasil_laporan').html(response);
      },
      error: function(xhr, status, error) {
        // Kesalahan pada permintaan AJAX
        alert('Terjadi kesalahan pada permintaan AJAX: ' + error);
      }
    });
  });
});

function exportToExcel() {
    const table = document.getElementById('myTable');
    const tgl_awal = document.getElementById('tgl_awal').value
    const tgl_akhir = document.getElementById('tgl_akhir').value
    const wb = XLSX.utils.table_to_book(table, {sheet: 'Sheet1'});
    XLSX.writeFile(wb, `Laporan 1 ${tgl_awal} - ${tgl_akhir}.xlsx`);
}
        
</script>

