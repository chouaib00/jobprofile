<div class="wrapper wrapper-content animated fadeInLeft">
  <div class="row">
    <div class="col-lg-12">
      <h2>Personal Data Sheet</h2>
    </div>
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Personal Information</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="fullscreen-link">
                        <i class="fa fa-expand"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
              <form method="get" class="form-horizontal">
                  <h5>First Name, Middle Name, Last Name, Name Extension</h5>
                  <div class="form-group">
                      <div class="col-sm-3"><input name="applicant-first-name" type="text" class="form-control" placeholder="First Name"></div>
                      <div class="col-sm-3"><input name="applicant-middle-name" type="text" class="form-control" placeholder="Middle Name"></div>
                      <div class="col-sm-3"><input name="applicant-last-name" type="text" class="form-control" placeholder="Last Name"></div>
                      <div class="col-sm-3"><input name="applicant-name-ext" type="text" class="form-control" placeholder="Name Extension"></div>
                  </div>
                  <div class="hr-line-dashed"></div>

                  <h5>Present Address</h5>
                  <div class="form-group">
                      <div class="col-sm-12"><input type="text" class="form-control" placeholder="(House/Unit No., Floor & Bldg./Street, Lot / Blk, Brgy / Village)"></div>
                      <div class="col-sm-3 m-t-sm">
                        <select class="form-control select2-country" data-placeholder="Select Country">
                            <option></option>
                        </select>
                      </div>
                      <div class="col-sm-3 m-t-sm">
                        <select class="form-control select2-region" data-placeholder="Select Region">
                            <option></option>
                        </select>
                      </div>
                      <div class="col-sm-3 m-t-sm">
                        <select class="form-control select2-province" data-placeholder="Select Province">
                            <option></option>
                        </select>
                      </div>
                      <div class="col-sm-3 m-t-sm">
                        <select class="form-control select2-city" data-placeholder="Select City">
                            <option></option>
                        </select>
                      </div>
                  </div>
                  <h5>Permanent Address</h5>

                  <div class="form-group">
                    <div class="col-sm-12"><input type="text" class="form-control" placeholder="(House/Unit No., Floor & Bldg./Street, Lot / Blk, Brgy / Village)"></div>
                      <div class="col-sm-3 m-t-sm">
                      <select class="form-control select2-country" data-placeholder="Select Country">
                          <option></option>
                      </select>
                      </div>
                      <div class="col-sm-3 m-t-sm">
                        <select class="form-control select2-region" data-placeholder="Select Region">
                            <option></option>
                        </select>
                      </div>
                      <div class="col-sm-3 m-t-sm">
                        <select class="form-control select2-province" data-placeholder="Select Province">
                            <option></option>
                        </select>
                      </div>
                      <div class="col-sm-3 m-t-sm">
                        <select class="form-control select2-city" data-placeholder="Select City">
                            <option></option>
                        </select>
                      </div>
                  </div>
                  <div class="hr-line-dashed"></div>
                  <div class="form-group">
                    <div class="col-sm-3">
                      <h5>Gender</h5>
                      <label class="checkbox-inline i-checks"> <input type="radio" value="male" name="gender" checked> <i></i> Male </label>
                      <label class="checkbox-inline i-checks"> <input type="radio" value="female" name="gender"> <i></i> Female</label>
                    </div>
                    <div class="col-sm-3">
                      <h5>Birthday</h5>
                      <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="applicant-birthday" class="form-control" value="03/04/2014">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-3">
                      <h5>Civil Status</h5>
                      <select class="form-control select2-basic" data-placeholder="Select Civil Status">
                          <option></option>
                          <option value="single">Single</option>
                          <option value="married">Married</option>
                          <option value="divorced">Divorced</option>
                          <option value="separated">Separated</option>
                          <option value="widowed">Widowed</option>
                      </select>
                    </div>
                    <div class="col-sm-3">
                      <h5>Nationality</h5>
                      <input name="applicant-nationality" type="text" class="form-control" placeholder="Enter Nationality">
                    </div>
                    <div class="col-sm-3">
                      <h5>Citizenship</h5>
                      <input name="applicant-citizenship" type="text" class="form-control" placeholder="Enter Citizenship">
                    </div>
                    <div class="col-sm-3">
                      <h5>Highest Educational Attainment</h5>
                      <select name="applicant-educ-attainment" class="form-control select2-educ-attainment" data-placeholder="Select Highest Educational Attainment">
                          <option></option>
                      </select>
                    </div>
                  </div>
                  <div class="hr-line-dashed"></div>
                  <h4>Contact Details</h4>
                  <div class="form-group">
                    <div class="col-sm-4">
                      <h5>Main Contact Number</h5>
                      <input name="phone-number-1" type="text" class="form-control" placeholder="Enter Main Contact Number">
                    </div>
                    <div class="col-sm-4">
                      <h5>Mobile Number</h5>
                      <input name="phone-number-2" type="text" class="form-control" placeholder="Enter Mobile Number">
                    </div>
                    <div class="col-sm-4">
                      <h5>Home Number</h5>
                      <input name="phone-number-3" type="text" class="form-control" placeholder="Enter Home Number">
                    </div>
                  </div>
                  <div class="hr-line-dashed"></div>
                  <h4>Education</h4>
                  <div class="form-group">
                    <div class="table-responsive col-md-12">
                      <table class="table table-striped table-bordered table-hover datatable-basic">
                        <thead>
                          <tr>
                            <th class="col-md-1 text-center no-sort">Action</th>
                            <th class="col-md-3 text-center">Type</th>
                            <th class="col-md-2 text-center">Field of Study</th>
                            <th class="col-md-6 text-center">School</th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>
                    </div>
                  </div>




                    <div class="form-group"><label class="col-sm-2 control-label">Help text</label>
                        <div class="col-sm-10"><input type="text" class="form-control"> <span class="help-block m-b-none">A block of help text that breaks onto a new line and may extend beyond one line.</span>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Password</label>

                        <div class="col-sm-10"><input type="password" class="form-control" name="password"></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Placeholder</label>

                        <div class="col-sm-10"><input type="text" placeholder="placeholder" class="form-control"></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-lg-2 control-label">Disabled</label>

                        <div class="col-lg-10"><input type="text" disabled="" placeholder="Disabled input here..." class="form-control"></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-lg-2 control-label">Static control</label>

                        <div class="col-lg-10"><p class="form-control-static">email@example.com</p></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Checkboxes and radios <br>
                        <small class="text-navy">Normal Bootstrap elements</small></label>

                        <div class="col-sm-10">
                            <div><label> <input type="checkbox" value=""> Option one is this and that—be sure to include why it's great </label></div>
                            <div><label> <input type="radio" checked="" value="option1" id="optionsRadios1" name="optionsRadios"> Option one is this and that—be sure to
                                include why it's great </label></div>
                            <div><label> <input type="radio" value="option2" id="optionsRadios2" name="optionsRadios"> Option two can be something else and selecting it will
                                deselect option one </label></div>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Inline checkboxes</label>

                        <div class="col-sm-10"><label class="checkbox-inline"> <input type="checkbox" value="option1" id="inlineCheckbox1"> a </label> <label class="checkbox-inline">
                            <input type="checkbox" value="option2" id="inlineCheckbox2"> b </label> <label class="checkbox-inline">
                            <input type="checkbox" value="option3" id="inlineCheckbox3"> c </label></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Checkboxes &amp; radios <br><small class="text-navy">Custom elements</small></label>

                        <div class="col-sm-10">
                            <div class="i-checks"><label> <div class="icheckbox_square-green" style="position: relative;"><input type="checkbox" value="" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> <i></i> Option one </label></div>
                            <div class="i-checks"><label> <div class="icheckbox_square-green checked" style="position: relative;"><input type="checkbox" value="" checked="" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> <i></i> Option two checked </label></div>
                            <div class="i-checks"><label> <div class="icheckbox_square-green checked disabled" style="position: relative;"><input type="checkbox" value="" disabled="" checked="" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> <i></i> Option three checked and disabled </label></div>
                            <div class="i-checks"><label> <div class="icheckbox_square-green disabled" style="position: relative;"><input type="checkbox" value="" disabled="" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> <i></i> Option four disabled </label></div>
                            <div class="i-checks"><label> <div class="iradio_square-green" style="position: relative;"><input type="radio" value="option1" name="a" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> <i></i> Option one </label></div>
                            <div class="i-checks"><label> <div class="iradio_square-green checked" style="position: relative;"><input type="radio" checked="" value="option2" name="a" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> <i></i> Option two checked </label></div>
                            <div class="i-checks"><label> <div class="iradio_square-green checked disabled" style="position: relative;"><input type="radio" disabled="" checked="" value="option2" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> <i></i> Option three checked and disabled </label></div>
                            <div class="i-checks"><label> <div class="iradio_square-green disabled" style="position: relative;"><input type="radio" disabled="" name="a" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> <i></i> Option four disabled </label></div>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Inline checkboxes</label>

                        <div class="col-sm-10"><label class="checkbox-inline i-checks"> <div class="icheckbox_square-green" style="position: relative;"><input type="checkbox" value="option1" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>a </label>
                            <label class="checkbox-inline i-checks"> <div class="icheckbox_square-green" style="position: relative;"><input type="checkbox" value="option2" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> b </label>
                            <label class="checkbox-inline i-checks"> <div class="icheckbox_square-green" style="position: relative;"><input type="checkbox" value="option3" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> c </label></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Select</label>

                        <div class="col-sm-10"><select class="form-control m-b" name="account">
                            <option>option 1</option>
                            <option>option 2</option>
                            <option>option 3</option>
                            <option>option 4</option>
                        </select>

                            <div class="col-lg-4 m-l-n"><select class="form-control" multiple="">
                                <option>option 1</option>
                                <option>option 2</option>
                                <option>option 3</option>
                                <option>option 4</option>
                            </select></div>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group has-success"><label class="col-sm-2 control-label">Input with success</label>

                        <div class="col-sm-10"><input type="text" class="form-control"></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group has-warning"><label class="col-sm-2 control-label">Input with warning</label>

                        <div class="col-sm-10"><input type="text" class="form-control"></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group has-error"><label class="col-sm-2 control-label">Input with error</label>

                        <div class="col-sm-10"><input type="text" class="form-control"></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Control sizing</label>

                        <div class="col-sm-10"><input type="text" placeholder=".input-lg" class="form-control input-lg m-b">
                            <input type="text" placeholder="Default input" class="form-control m-b"> <input type="text" placeholder=".input-sm" class="form-control input-sm">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Column sizing</label>

                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-md-2"><input type="text" placeholder=".col-md-2" class="form-control"></div>
                                <div class="col-md-3"><input type="text" placeholder=".col-md-3" class="form-control"></div>
                                <div class="col-md-4"><input type="text" placeholder=".col-md-4" class="form-control"></div>
                            </div>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Input groups</label>

                        <div class="col-sm-10">
                            <div class="input-group m-b"><span class="input-group-addon">@</span> <input type="text" placeholder="Username" class="form-control"></div>
                            <div class="input-group m-b"><input type="text" class="form-control"> <span class="input-group-addon">.00</span></div>
                            <div class="input-group m-b"><span class="input-group-addon">$</span> <input type="text" class="form-control"> <span class="input-group-addon">.00</span></div>
                            <div class="input-group m-b"><span class="input-group-addon"> <input type="checkbox"> </span> <input type="text" class="form-control"></div>
                            <div class="input-group"><span class="input-group-addon"> <input type="radio"> </span> <input type="text" class="form-control"></div>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Button addons</label>

                        <div class="col-sm-10">
                            <div class="input-group m-b"><span class="input-group-btn">
                                <button type="button" class="btn btn-primary">Go!</button> </span> <input type="text" class="form-control">
                            </div>
                            <div class="input-group"><input type="text" class="form-control"> <span class="input-group-btn"> <button type="button" class="btn btn-primary">Go!
                            </button> </span></div>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">With dropdowns</label>

                        <div class="col-sm-10">
                            <div class="input-group m-b">
                                <div class="input-group-btn">
                                    <button data-toggle="dropdown" class="btn btn-white dropdown-toggle" type="button">Action <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a></li>
                                    </ul>
                                </div>
                                 <input type="text" class="form-control"></div>
                            <div class="input-group"><input type="text" class="form-control">

                                <div class="input-group-btn">
                                    <button data-toggle="dropdown" class="btn btn-white dropdown-toggle" type="button">Action <span class="caret"></span></button>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a></li>
                                    </ul>
                                </div>
                                </div>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Segmented</label>

                        <div class="col-sm-10">
                            <div class="input-group m-b">
                                <div class="input-group-btn">
                                    <button tabindex="-1" class="btn btn-white" type="button">Action</button>
                                    <button data-toggle="dropdown" class="btn btn-white dropdown-toggle" type="button"><span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a></li>
                                    </ul>
                                </div>
                                <input type="text" class="form-control"></div>
                            <div class="input-group"><input type="text" class="form-control">

                                <div class="input-group-btn">
                                    <button tabindex="-1" class="btn btn-white" type="button">Action</button>
                                    <button data-toggle="dropdown" class="btn btn-white dropdown-toggle" type="button"><span class="caret"></span></button>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a></li>
                                    </ul>
                                </div>
                                </div>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-white" type="submit">Cancel</button>
                            <button class="btn btn-primary" type="submit">Save changes</button>
                        </div>
                    </div>
                </form>
                <p>
                    Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. </p>
                <p>
                    Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi.
                </p>
            </div>
        </div>
    </div>
  </div>
</div>
<div class="modal inmodal fade" id="modal-educ-type" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Add Education</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                  <div class="col-md-5">
                    <h5>Education Type</h5>
                    <select class="form-control select2-basic" data-placeholder="Select Education Type" style="width: 100%">
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
                    <h5>Field of Study</h5>
                    <select class="form-control select2-educ-fos" data-placeholder="Select Field of Study" style="width: 100%">
                      <option></option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <h5>School</h5>
                    <select class="form-control select2-school" data-placeholder="Select School" style="width: 100%">
                      <option></option>
                    </select>
                  </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal"><i class="fa fa-ban"></i> Cancel</button>
                <button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo JS_DIR ?>components/applicant/update_profile.js"></script>
