					<?php
					error_reporting(0);
					$b = $brg->row_array();
					?>
					<table>

						<tr>

							<td> <label for="">Nama barang</label><input type="text" name="nabar" value="<?php echo $b['barang_nama']; ?>" style="width:290px;margin-right:5px;" class="form-control input-sm" readonly>
							</td>

						</tr>
						<tr>

							<td>
								<label for="">Satuan</label>
								<input type="text" name="satuan" value="<?php echo $b['barang_satuan']; ?>" style="width:120px;margin-right:5px;" class="form-control input-sm" readonly>
							</td>
						</tr>
						<tr>

							<td>
								<label for="">Harga Pokok</label><input type="text" name="harpok" value="<?php echo $b['barang_harpok']; ?>" style="width:130px;margin-right:5px;" class="form-control input-sm" required>
							</td>
						</tr>
						<tr>
							<td><label for="">Harga Jual</label><input type="text" name="harjul" value="<?php echo $b['barang_harjul']; ?>" style="width:130px;margin-right:5px;" class="form-control input-sm" required></td>
						</tr>
						<tr>
							<td><label for="">Jumlah</label><input type="text" name="jumlah" id="jumlah" class="form-control input-sm" style="width:90px;margin-right:5px;" required></td>
						</tr>
						<tr>

							<td><br><button type="submit" class="btn btn-sm btn-primary">Ok</button></td>
						</tr>
					</table>