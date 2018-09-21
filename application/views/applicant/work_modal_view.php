<div class="modal inmodal fade" id="modal-work" role="dialog" data-no="" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Add Work Experience</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <small class="text-danger">Note : All fields with asterisk( * ) are required.</small>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <h5>Company Name<span class="text-danger">*</span></h5>
                    <input type="text" id="modal-work-company-name" class="form-control" placeholder="Enter Company Name">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <h5>Field of Work<span class="text-danger">*</span></h5>
                    <select id="modal-work-fos" class="form-control select2-educ-fos" data-placeholder="Select Field of Work" style="width: 100%">
                      <option></option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-5">
                    <h5>Start Date<span class="text-danger">*</span></h5>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input id="modal-work-start-date" type="text" placeholder="Select Date Start" class="form-control datepicker-month-year" value="">
                    </div>
                  </div>
                  <div class="col-md-5">
                    <h5>End Date<span class="text-danger">*</span></h5>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input id="modal-work-end-date" type="text" placeholder="Select End Start" class="form-control datepicker-month-year" value="">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <h5>&nbsp;</h5>
                    <label class="checkbox-inline i-checks"> <input id="modal-work-end-date-current" type="checkbox" value="current"> <i></i> Current </label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <h5>Additional Info</h5>
                    <textarea class="form-control" id="modal-work-add-info" rows="4" placeholder="Enter Additional Info or Significant Experience Gained"></textarea>
                  </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal"><i class="fa fa-ban"></i> Cancel</button>
                <button type="button" id="modal-work-add" class="btn btn-primary" value="add"><i class="fa fa-floppy-o"></i> Save</button>
            </div>
        </div>
    </div>
</div>
