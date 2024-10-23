<form action="{{ url('departements') }}" method="POST" enctype="multipart/form-data">
    <!-- Classic Modal -->
       <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Ajouter département</h4>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                <i class="material-icons">clear</i>
              </button>
            </div>
            <div class="modal-body">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <label for="">Nom département</label>
                        <input type="text" name="departmentLabel" class="form-control">
                    </div>
                </div>
                
                <div class="row" style="margin-top: 3%">
                    <div class="col-md-12">
                        <label for="">Description</label>
                        <input type="text" name="description" class="form-control">
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary float-right">Ajouter</button>

            </div>
          </div>
        </div>
      </div>
      <!--  End Modal -->
</form>