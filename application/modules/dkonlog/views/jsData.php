<input type="hidden" value="n" id="modaltype">
											<div class="row">
												<div class="col-md-4 info-invoice">
													<h5 class="sub">Update Terakhir  </h5>
													<p>Kondisi  </p>
												</div>
											<!--	<div class="col-md-4 info-invoice">
													<h5 class="sub">Nilai rata-rata</h5>
													<p>80</p>
												</div>-->
												<div class="col-md-4 info-invoice">
													<h5 class="sub" style="min-width:300px"><?php echo $this->tanggal->hariLengkapJam($data->_ctime,"/");?> </h5>
													<p class="fw-bold"><?php echo $data->kondisi;?></p>
												</div>
											</div>


											<div class="row">
												<div class="col-md-12">
													<div class="separator-solid  mb-3"></div>
													<div class="invoice-detail">
													 
														<div class="invoice-item">
															<div class="tborder">
																
															
															<table>
																	<thead>
																		<tr>
																			<th class="text-center" style="width:10%"><strong>No</strong></tthd>
																			<th class="text-center" style="width:40%"><strong>Jenis bahan bakar</strong></td>
																			<th class="text-center" style="width:15%"><strong>Jumlah</strong></th>
																			<th class="text-center" style="width:15%"><strong>  Minimal</strong></th>
																			<th class="text-center" style="min-width:100px"><strong>Kondisi</strong></th>
																			<th class="text-center" style="width:15%"><strong>Keterangan</strong></th>
																		</tr>
																	</thead>
																	<tbody>
																		<?php 
																		$ray	=	isset($data->data)?($data->data):"";
																		$dataray=	json_decode($ray,TRUE);
																		$dataray=	isset($dataray['data'])?($dataray['data']):"";
																		$no=1;$t_siap=$t_tsiap=0;
                                                                        if ($dataray) {
																				foreach ($dataray as $key=>$val) {
																					if(strtolower($val['kondisi'])=="siap"){
																								$t_siap++;
																					}else{
																							   $t_tsiap++;
																					}
																					echo '
																							<tr>
																							<td class="text-center">'.$no++.'</td>
																							<td class="text-left">'.$val['nama'].'</td>
																							<td class="text-center">'.$val['jumlah'].'</td>
																							<td class="text-center">'.$val['min'].'</td>
																							<td class="text-center">'.$val['kondisi'].'</td>
																							<td class="text-left">'.$val['ket'].'</td>
																							</tr>
																							';
																				}
                                                                        }
																		
																		?>
																	
																		 
																		<tr>
																			<td class="text-right" colspan="5"><strong>Total Siap</strong></td>
																			<td class="text-right"><strong><?php echo $t_siap;?></strong></td>
																		</tr>
																		<tr>
																			<td class="text-right" colspan="5"><strong>Total tidak siap</strong></td>
																			<td class="text-right"><strong><?php echo $t_tsiap;?></strong></td>
																		</tr>
																	</tbody>
																</table>



																</div>
														</div>
													</div>	
													<div class="separator-solid  mb-3"></div>
												<!--	<h6 class="text-uppercase mt-4 mb-3 fw-bold">
														*Notes
													</h6>
													<p class="text-muted text-sm mb-0">
														Nilai 0-60 (TIDAK SIAP)<br>
														Nilai 60-80 (SIAP TERBATAS)<br>
														Nilai 80-100 (SIAP)
													</p>-->
												</div>	
											</div>