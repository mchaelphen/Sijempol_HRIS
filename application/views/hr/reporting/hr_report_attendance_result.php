<!-- Page Wrapper -->
<div class="page-wrapper">

  <!-- Page Content -->
  <div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="page-title">Report Attendance All </h3>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url().'Authentication/admin_dashboard/'.base64_encode($this->session->userdata('user_name'))?>">Dashboard </a></li>
            <li class="breadcrumb-item active">Reporting </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- /Page Header -->
    <h4>Result from period: <?php echo $startDate." - ".$endDate ?></h4>
    <div class="row">
      <div class="col-md-12">
        <table class="table table-striped custom-table table-responsive mb-0 export_datatable">
          <thead>
            <tr>
              <th style="width: 30px;"># </th>
              <th>NIP </th>
              <th>Full Name </th>
              <th>Department</th>
              <th>Office Hour</th>
              <th>Attendance Date </th>
              <th>Day</th>
              <!-- <th>Absen Id </th> -->
              <!-- <th>Month </th> -->
              <!-- <th>Year </th> -->
              <th>Time In </th>
              <th>Time Out </th>
              <!-- <th>Status </th>
              <th>Status </th> -->
              <!-- <th>Status </th> -->
              <th>Permit Requested </th>
              <th>Permit Status </th>
              <th class="text-center">Late in Min. </th>
              <th>Status </th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($row)) { ?>
              <?php
              $no = 1;
              foreach ($row as $key => $value) { ?>
              <tr>
                <td> <?php echo $no ?></td>
                <td> <?php echo $value["pairingnik"]?> </td>
                <td> <?php echo $value["emp_fullname"]?> </td>
                <td> <?php echo $value["dept_division"]."<br> - ".$value["dept_position"]?> </td>
                <td> <?php echo !empty($value["pairingTimeOffice"])?$value['pairingTimeOffice']:'NULL' ?> </td>
                <td> <?php echo $value["pairingdate"]?> </td>
                <td> <?php echo $value["pairingcurday"]?> </td>
                <!-- <td> <?php echo $value["emp_absen_id"]?> </td> -->
                <!-- <td> <?php echo $value["pairingmonth"]?> </td> -->
                <!-- <td> <?php echo $value["pairingyear"]?> </td> -->
                <td> <?php echo $value["pairingtimein"]?> </td>
                <td> <?php echo $value["pairingtimeout"]?> </td>
                <!-- <td> <?php echo $value["actualdatein"]?> </td>
                <td> <?php echo $value["actualtimein"]?> </td> -->
                <!-- <td> <?php echo $value["pairingstatus"]?> </td> -->
                <td> <?php echo $value["permit_reason"]?> </td>
                <td class="text-center">
                  <?php if (!empty($value["permit_approved_flag"])) { ?>
                  <div class="action-label">
                    <a class="btn btn-white btn-sm btn-rounded" href="javascript:void(0);">
                      <?php if ($value["permit_approved_flag"] == 1) { ?>
                        <i class="fa fa-dot-circle-o text-purple"></i> Waiting
                        <!-- <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-info"></i> Pending </a> -->
                      <?php } elseif ($value["permit_approved_flag"] == 2) { ?>
                        <i class="fa fa-check text-success"></i> Approved
                        <!-- <a class="dropdown-item" href="#" data-toggle="modal" data-target="#approve_leave"><i class="fa fa-dot-circle-o text-success"></i> Approved </a> -->
                      <?php } elseif ($value["permit_approved_flag"] == 3) { ?>
                        <i class="fa fa-close text-danger"></i> Declined
                        <!-- <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"></i> Declined </a> -->
                      <?php } ?>
                    </a>
                    <?php echo $value["permit_approved_date"] ?>
                  </div>
                  <?php } ?>
                </td>
                <td> <?php echo $value["minute_telat"]?> </td>
                <td> <?php echo $value["status_masuk"]?> </td>

              </tr>
            <?php $no++; } ?>
          <?php } else { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <p> Data not found.</p>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times; </span>
              </button>
            </div>
          <?php } ?>
          </tbody>
        </table>
      </div>
    </div>

    <!-- row2 detailed late -->
    <!-- <div class="row">
      <div class="col-md-12">
        <table class="table table-striped custom-table table-responsive mb-0 export_datatable">
          <thead>
            <tr>
              <th>NIP</th>
              <th>16</th>
              <th>17</th>
              <th>18</th>
              <th>19</th>
              <th>20</th>
              <th>21</th>
              <th>22</th>
              <th>23</th>
              <th>24</th>
              <th>25</th>
              <th>26</th>
              <th>27</th>
              <th>28</th>
              <th>29</th>
              <th>30</th>
              <th>31</th>
              <th>1</th>
              <th>2</th>
              <th>3</th>
              <th>4</th>
              <th>5</th>
              <th>6</th>
              <th>7</th>
              <th>8</th>
              <th>9</th>
              <th>10</th>
              <th>11</th>
              <th>12</th>
              <th>13</th>
              <th>14</th>
              <th>15</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($row2 as $key => $value): ?>
              <tr>
                <td><?php echo $value["emp_fullname"]." - ".$value["pairingnik"] ?></td>
                <td><?php echo $value["telat16"] ?></td>
                <td><?php echo $value["telat17"] ?></td>
                <td><?php echo $value["telat18"] ?></td>
                <td><?php echo $value["telat19"] ?></td>
                <td><?php echo $value["telat20"] ?></td>
                <td><?php echo $value["telat21"] ?></td>
                <td><?php echo $value["telat22"] ?></td>
                <td><?php echo $value["telat23"] ?></td>
                <td><?php echo $value["telat24"] ?></td>
                <td><?php echo $value["telat25"] ?></td>
                <td><?php echo $value["telat26"] ?></td>
                <td><?php echo $value["telat27"] ?></td>
                <td><?php echo $value["telat28"] ?></td>
                <td><?php echo $value["telat29"] ?></td>
                <td><?php echo $value["telat30"] ?></td>
                <td><?php echo $value["telat31"] ?></td>
                <td><?php echo $value["telat1"] ?></td>
                <td><?php echo $value["telat2"] ?></td>
                <td><?php echo $value["telat3"] ?></td>
                <td><?php echo $value["telat4"] ?></td>
                <td><?php echo $value["telat5"] ?></td>
                <td><?php echo $value["telat6"] ?></td>
                <td><?php echo $value["telat7"] ?></td>
                <td><?php echo $value["telat8"] ?></td>
                <td><?php echo $value["telat9"] ?></td>
                <td><?php echo $value["telat10"] ?></td>
                <td><?php echo $value["telat11"] ?></td>
                <td><?php echo $value["telat12"] ?></td>
                <td><?php echo $value["telat13"] ?></td>
                <td><?php echo $value["telat14"] ?></td>
                <td><?php echo $value["telat15"] ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div> -->
  </div>
  <!-- /Page Content -->

</div>
<!-- /Page Wrapper -->
