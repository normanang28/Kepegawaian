<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="card">
    <div class="card-body">
      <div class="basic-form">
        <form class="form-horizontal form-label-left" novalidate  action="<?= base_url('home/aksi_ganti_pw')?>" method="post">

          <div class="item form-group">
            <label class="control-label col-md-12 col-sm-12 col-xs-12">Ganti Password<span class="required"></span>
            </label>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <input id="password" class="form-control col-md-12 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="password" placeholder="Ganti Password Anda" required="required" type="text">
            </div>
          </div>
        </div>
        <br>
        <div class="ln_solid"></div>
        <div class="form-group">
          <div class="col-md-12 col-md-offset-12">
            <a href="<?= base_url('/home/dashboard')?>" type="submit" class="btn btn-primary">Cancel</a></button>
            <button id="send" type="submit" class="btn btn-success">Update</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
</div>