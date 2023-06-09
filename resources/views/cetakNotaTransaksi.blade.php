<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />

		<!-- Favicon -->
		<link rel="icon" href="./images/favicon.png" type="image/x-icon" />

		<!-- Invoice styling -->
		<style>
			body {
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				text-align: center;
				color: #777;
			}

			body h1 {
				font-weight: 300;
				margin-bottom: 0px;
				padding-bottom: 0px;
				color: #000;
			}

			body h3 {
				font-weight: 300;
				margin-top: 10px;
				margin-bottom: 20px;
				font-style: italic;
				color: #555;
			}

			body a {
				color: #06f;
			}

			.invoice-box {
				max-width: 800px;
				margin: auto;
				padding: 30px;
				border: 1px solid #eee;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
				font-size: 16px;
				line-height: 24px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
			}

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
				border-collapse: collapse;
			}
            .alamat{
                width: 300px;
            }

            .nama{
                width: 300px;
            }

			.invoice-box table td {
				padding: 5px;
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(2) {
				text-align: right;
			}

			.invoice-box table tr.top table td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.top table td.title {
				font-size: 45px;
				line-height: 45px;
				color: #333;
			}

			.invoice-box table tr.information table td {
				padding-bottom: 40px;
			}

			.invoice-box table tr.heading td {
				background: #eee;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
			}

			.invoice-box table tr.details td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.item td {
				border-bottom: 1px solid #eee;
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total td:nth-child(2) {
				border-top: 2px solid #eee;
				font-weight: bold;
			}

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}
		</style>
	</head>

	<body>
		<div class="invoice-box">
			<table>
				<tr class="top">
					<td colspan="2">
						<table>
							<tr>
								<td class="title">
									<img src="{{ 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('img/logobg1.png'))) }}" alt="Company logo" style="width: 100%; max-width: 300px" />
								</td>

								<td>
									Invoice #: {{$transaksi->invoice}}<br />
									Tanggal Transaksi: {{$transaksi->tanggal}}
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="information">
					<td colspan="2">
						<table>
							<tr>
								<td>
									<div class="alamat">
                                        {{$transaksi->alamat}}
                                    </div>
								</td>

								<td>
                                    {{$transaksi->user->name}}
                                    <br>
                                    {{$transaksi->user->no_hp}}
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="heading">
					<td>Produk</td>
					<td>Harga</td>
                    
				</tr>

				@foreach ($transaksi->keranjang as $item)
                <tr class="details">
					<td>{{$item->produk->nama}}</td>
					<td>Rp {{$item->produk->harga}}</td>
				</tr>
                @endforeach

                <tr class="heading">
                    <td>Jumlah Beli</td>
                    <td>Total Harga</td>
                </tr>

                @foreach ($transaksi->keranjang as $item)
                    <tr class="details">
                        <td>{{$item->jumlah}}</td>
                        <td>Rp {{$item->total_harga}}</td>
                    </tr>
                @endforeach

				<tr class="heading">
					<td></td>

					<td>Total Harga Semua</td>
				</tr>

				<tr class="item">
					<td>Ongkir: Rp 6000</td>

					<td>Rp {{$transaksi->total - 6000}}</td>
				</tr>

				<tr class="total">
					<td></td>

					<td>Total: Rp {{$transaksi->total}}</td>
				</tr>

				<br><br><br>
				<tr class="information">
						<td colspan="2">
							<table>
								<tr>
									<td>
										<div class="alamat">
											Nota Pembelian
										</div>
									</td>

									<td>
										#Nota Ini Dicetak Otomatis Oleh Sistem
									</td>
								</tr>
							</table>
						</td>
					</tr>
			</table>
		</div>
	</body>
</html>