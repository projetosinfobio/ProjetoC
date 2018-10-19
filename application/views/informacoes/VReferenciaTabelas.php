<!DOCTYPE html>

<style>
table, th, td {
    border: 2px solid dimgrey;
}
th {
    height: 50px;
    background-color: #CD5C5C;
}

</style>

<div class="panel-body">
	<div class="container">
		<div class="panel-heading">
			<h3>
				<center>
					<i class="fa fa-user"></i> Titulo (se achar necessário) <?php echo $this->session->userdata('nome') ?>
				</center>
			</h3>
		</div>

        <center>
			<div class="row">
				<div style="overflow-x:auto;">
				<table class="table">
					<thead>
						<th>Nome </th>
						<th>Informação 1/th>
						<th>Informação 2</th>
					</thead>
					<tbody>
						<tr>
							<td>nome 1...</td>
							<td>conteudo debaixo da coluna(informação 1)...</td>
							<td>conteudo debaixo da coluna(informação 2)...</td>
						</tr>
						<tr>
							<td>(linha 2) nome 2...</td>
							<td>(linha 2) conteudo debaixo da coluna(informação 1)...</td>
							<td>(linha 2) conteudo debaixo da coluna(informação 2)...</td>
						</tr>
						<tr>
							<td>terceira linha</td>
							<td>bla bla bla</td>
							<td>bla bla bla bla </td>
						</tr>
					</tbody>
				</table>
				</div><!-- End-style -->
			</div><!-- End-class-row -->
        </center>

    </div><!-- End-container -->

</div><!-- End-panel-body -->

</html><!-- End-html -->