<div class="modal inmodal fade" id="modal-educ" role="dialog" data-no="" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Add Education</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <small class="text-danger">Note : All fields with asterisk( * ) are required.</small>
                </div>
                <div class="row">
                  <div class="col-md-5">
                    <h5>Education Type<span class="text-danger">*</span></h5>
                    <select id="modal-educ-type" class="form-control select2-basic" data-placeholder="Select Education Type" style="width: 100%">
                        <option></option>
                        <option value="1">Primary</option>
                        <option value="2">Secondary</option>
                        <option value="3">Tertiary</option>
                        <option value="4">Diploma</option>
                        <option value="5">Vocational / Trade Course</option>
                        <option value="6">Master's Degree</option>
                        <option value="7">Doctorate Degree</option>
                        <option value="8">Training Seminar</option>
                    </select>
                  </div>
                  <div class="col-md-7">
                    <h5>Field of Study<span class="text-danger">*</span></h5>
                    <select id="modal-educ-fos" class="form-control select2-educ-fos" data-placeholder="Select Field of Study" style="width: 100%">
                      <option></option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <h5>School<span class="text-danger">*</span></h5>
                    <select id="modal-educ-school" class="form-control select2-school" data-placeholder="Select School" style="width: 100%">
                      <option></option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-5">
                    <h5>Start Date<span class="text-danger">*</span></h5>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input id="modal-educ-start-date" type="text" placeholder="Select Date Start" class="form-control datepicker-month-year" value="">
                    </div>
                  </div>
                  <div class="col-md-5">
                    <h5>End Date<span class="text-danger">*</span></h5>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input id="modal-educ-end-date" type="text" placeholder="Select End Start" class="form-control datepicker-month-year" value="">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <h5>&nbsp;</h5>
                    <label class="checkbox-inline i-checks"> <input id="modal-educ-end-date-current" class="brent" type="checkbox" > <i></i> Current </label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <h5>Course / Program Taken</h5>
                    <input type="text" id="modal-educ-course" class="form-control" placeholder="Enter Course / Program Taken">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <h5>Additional Info</h5>
                    <textarea class="form-control" id="modal-educ-add-info" rows="4" placeholder="Enter Additional Info like 'With Honors, 'Awards, 'GWA, 'Scholarship, etc."></textarea>
                  </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal"><i class="fa fa-ban"></i> Cancel</button>
                <button type="button" id="modal-educ-add" class="btn btn-primary" value="add"><i class="fa fa-floppy-o"></i> Save</button>
            </div>
        </div>
    </div>
</div>
