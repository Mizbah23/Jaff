@extends('admin.master')
@section('title'){{$title}}@stop

@section('link')

<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/qtip2/3.0.3/basic/jquery.qtip.css" />-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" />
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/fullcalendar.min.css')}}">
@stop

@section('content')
<style>
    .fc-prev-button ,.fc-button, .fc-state-default, .fc-corner-left{
       color: #030079;padding: 0px;border: 0px;}
    h2{ font-weight: 600; color: #4C649E; }
</style>

<!--***********************************addhour*******************************-->
<div class="modal fade text-left addHourMdl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel130" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info white">
                <h5 class="modal-title" id="myModalLabel130" style="text-align: center;">Add Hour Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post" id="addHourFrm" enctype="">    
            <div class="modal-body" style="padding-top: 23px;">
                <div class="row" >  
                    <div class="col-md-12 col-12">
                        <div class="form-label-group position-relative has-icon-left">
                            <input type="text" id="user-floating-icon" class="form-control" name="type" placeholder="Hour Pack">
                            <div class="form-control-position"><i class="feather icon-package"></i></div>
                            <label for="user-floating-icon">Hour Pack</label>
                        </div>
                    </div>
                                                    
                    <div class="col-md-12 col-12">
                        <div class="form-label-group position-relative has-icon-left">
                            <input type="number" id="phone-floating-icon" class="form-control" name="price" placeholder="Price">
                            <div class="form-control-position"><i class="fa fa-money"></i></div>
                            <label for="phone-floating-icon">Price</label>
                        </div>
                    </div>
                    {{csrf_field()}}

                </div>
                
            </div>
                
           <!--data-dismiss="modal"-->     
                
            <div class="modal-footer">
                <button type="reset" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light">Reset</button>
                <button type="submit" class="btn btn-outline-info mr-1 mb-1 waves-effect waves-light">
                    Save <span class="addbtn" role="status" aria-hidden="true"></span>  
                </button>
            </div>
        </form>
        </div>
    </div>
</div>
<!--*************edit Hour***************-->


<!--*****************Bookmodal***********-->
<div class="modal fade text-left" id="onshow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel21" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title" id="myModalLabel21">Slot of <span class="bookDate" style="color:purple;"></span></h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body aslot">

              </div>
<!--              <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Add to cart</button>
                  <button type="button" class="btn btn-outline-primary mr-1 mb-1 waves-effect waves-light">
                      <i class="feather icon-shopping-cart"></i> Add</button>
              </div>-->
          </div>
      </div>
  </div>
<!--*************Slot Model***************-->

<!--**************************************************-->
<section id="basic-examples">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
             <div id="calendar"></div> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- calendar Modal starts-->
                    <div class="modal fade text-left modal-calendar" tabindex="-1" role="dialog" aria-labelledby="cal-modal" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title text-text-bold-600" id="cal-modal">Add Event</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <form action="#">
                                    <div class="modal-body">
                                        <div class="d-flex justify-content-between align-items-center add-category">
                                            <div class="chip-wrapper"><div id="calendar"></div></div>
                                            <div class="label-icon pt-1 pb-2 dropdown calendar-dropdown">
                                                <i class="feather icon-tag dropdown-toggle" id="cal-event-category" data-toggle="dropdown"></i>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="cal-event-category">
                                                    <span class="dropdown-item business" data-color="success">
                                                        <span class="bullet bullet-success bullet-sm mr-25"></span>
                                                        Business
                                                    </span>
                                                    <span class="dropdown-item work" data-color="warning">
                                                        <span class="bullet bullet-warning bullet-sm mr-25"></span>
                                                        Work
                                                    </span>
                                                    <span class="dropdown-item personal" data-color="danger">
                                                        <span class="bullet bullet-danger bullet-sm mr-25"></span>
                                                        Personal
                                                    </span>
                                                    <span class="dropdown-item others" data-color="primary">
                                                        <span class="bullet bullet-primary bullet-sm mr-25"></span>
                                                        Others
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <fieldset class="form-label-group">
                                            <input type="text" class="form-control" id="cal-event-title" placeholder="Event Title">
                                            <label for="cal-event-title">Event Title</label>
                                        </fieldset>
                                        <fieldset class="form-label-group">
                                            <input type="text" class="form-control pickadate picker__input" id="cal-start-date" placeholder="Start Date" readonly="" aria-haspopup="true" aria-expanded="false" aria-readonly="false" aria-owns="cal-start-date_root"><div class="picker" id="cal-start-date_root" aria-hidden="true"><div class="picker__holder" tabindex="-1"><div class="picker__frame"><div class="picker__wrap"><div class="picker__box"><div class="picker__header"><div class="picker__month">October</div><div class="picker__year">2019</div><div class="picker__nav--prev" data-nav="-1" role="button" aria-controls="cal-start-date_table" title="Previous month"> </div><div class="picker__nav--next" data-nav="1" role="button" aria-controls="cal-start-date_table" title="Next month"> </div></div><table class="picker__table" id="cal-start-date_table" role="grid" aria-controls="cal-start-date" aria-readonly="true"><thead><tr><th class="picker__weekday" scope="col" title="Sunday">Sun</th><th class="picker__weekday" scope="col" title="Monday">Mon</th><th class="picker__weekday" scope="col" title="Tuesday">Tue</th><th class="picker__weekday" scope="col" title="Wednesday">Wed</th><th class="picker__weekday" scope="col" title="Thursday">Thu</th><th class="picker__weekday" scope="col" title="Friday">Fri</th><th class="picker__weekday" scope="col" title="Saturday">Sat</th></tr></thead><tbody><tr><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1569693600000" role="gridcell" aria-label="2019-09-29">29</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1569780000000" role="gridcell" aria-label="2019-09-30">30</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1569866400000" role="gridcell" aria-label="2019-10-01">1</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1569952800000" role="gridcell" aria-label="2019-10-02">2</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1570039200000" role="gridcell" aria-label="2019-10-03">3</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1570125600000" role="gridcell" aria-label="2019-10-04">4</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1570212000000" role="gridcell" aria-label="2019-10-05">5</div></td></tr><tr><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1570298400000" role="gridcell" aria-label="2019-10-06">6</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1570384800000" role="gridcell" aria-label="2019-10-07">7</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1570471200000" role="gridcell" aria-label="2019-10-08">8</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1570557600000" role="gridcell" aria-label="2019-10-09">9</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1570644000000" role="gridcell" aria-label="2019-10-10">10</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1570730400000" role="gridcell" aria-label="2019-10-11">11</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1570816800000" role="gridcell" aria-label="2019-10-12">12</div></td></tr><tr><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1570903200000" role="gridcell" aria-label="2019-10-13">13</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1570989600000" role="gridcell" aria-label="2019-10-14">14</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1571076000000" role="gridcell" aria-label="2019-10-15">15</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1571162400000" role="gridcell" aria-label="2019-10-16">16</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1571248800000" role="gridcell" aria-label="2019-10-17">17</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1571335200000" role="gridcell" aria-label="2019-10-18">18</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1571421600000" role="gridcell" aria-label="2019-10-19">19</div></td></tr><tr><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1571508000000" role="gridcell" aria-label="2019-10-20">20</div></td><td role="presentation"><div class="picker__day picker__day--infocus picker__day--today picker__day--highlighted" data-pick="1571594400000" role="gridcell" aria-label="2019-10-21" aria-activedescendant="true">21</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1571680800000" role="gridcell" aria-label="2019-10-22">22</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1571767200000" role="gridcell" aria-label="2019-10-23">23</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1571853600000" role="gridcell" aria-label="2019-10-24">24</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1571940000000" role="gridcell" aria-label="2019-10-25">25</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1572026400000" role="gridcell" aria-label="2019-10-26">26</div></td></tr><tr><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1572112800000" role="gridcell" aria-label="2019-10-27">27</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1572199200000" role="gridcell" aria-label="2019-10-28">28</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1572285600000" role="gridcell" aria-label="2019-10-29">29</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1572372000000" role="gridcell" aria-label="2019-10-30">30</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1572458400000" role="gridcell" aria-label="2019-10-31">31</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1572544800000" role="gridcell" aria-label="2019-11-01">1</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1572631200000" role="gridcell" aria-label="2019-11-02">2</div></td></tr><tr><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1572717600000" role="gridcell" aria-label="2019-11-03">3</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1572804000000" role="gridcell" aria-label="2019-11-04">4</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1572890400000" role="gridcell" aria-label="2019-11-05">5</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1572976800000" role="gridcell" aria-label="2019-11-06">6</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1573063200000" role="gridcell" aria-label="2019-11-07">7</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1573149600000" role="gridcell" aria-label="2019-11-08">8</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1573236000000" role="gridcell" aria-label="2019-11-09">9</div></td></tr></tbody></table><div class="picker__footer"><button class="picker__button--today" type="button" data-pick="1571594400000" disabled="" aria-controls="cal-start-date">Today</button><button class="picker__button--clear" type="button" data-clear="1" disabled="" aria-controls="cal-start-date">Clear</button><button class="picker__button--close" type="button" data-close="true" disabled="" aria-controls="cal-start-date">Close</button></div></div></div></div></div></div>
                                            <label for="cal-start-date">Start Date</label>
                                        </fieldset>
                                        <fieldset class="form-label-group">
                                            <input type="text" class="form-control pickadate picker__input" id="cal-end-date" placeholder="End Date" readonly="" aria-haspopup="true" aria-expanded="false" aria-readonly="false" aria-owns="cal-end-date_root"><div class="picker" id="cal-end-date_root" aria-hidden="true"><div class="picker__holder" tabindex="-1"><div class="picker__frame"><div class="picker__wrap"><div class="picker__box"><div class="picker__header"><div class="picker__month">October</div><div class="picker__year">2019</div><div class="picker__nav--prev" data-nav="-1" role="button" aria-controls="cal-end-date_table" title="Previous month"> </div><div class="picker__nav--next" data-nav="1" role="button" aria-controls="cal-end-date_table" title="Next month"> </div></div><table class="picker__table" id="cal-end-date_table" role="grid" aria-controls="cal-end-date" aria-readonly="true"><thead><tr><th class="picker__weekday" scope="col" title="Sunday">Sun</th><th class="picker__weekday" scope="col" title="Monday">Mon</th><th class="picker__weekday" scope="col" title="Tuesday">Tue</th><th class="picker__weekday" scope="col" title="Wednesday">Wed</th><th class="picker__weekday" scope="col" title="Thursday">Thu</th><th class="picker__weekday" scope="col" title="Friday">Fri</th><th class="picker__weekday" scope="col" title="Saturday">Sat</th></tr></thead><tbody><tr><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1569693600000" role="gridcell" aria-label="2019-09-29">29</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1569780000000" role="gridcell" aria-label="2019-09-30">30</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1569866400000" role="gridcell" aria-label="2019-10-01">1</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1569952800000" role="gridcell" aria-label="2019-10-02">2</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1570039200000" role="gridcell" aria-label="2019-10-03">3</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1570125600000" role="gridcell" aria-label="2019-10-04">4</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1570212000000" role="gridcell" aria-label="2019-10-05">5</div></td></tr><tr><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1570298400000" role="gridcell" aria-label="2019-10-06">6</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1570384800000" role="gridcell" aria-label="2019-10-07">7</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1570471200000" role="gridcell" aria-label="2019-10-08">8</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1570557600000" role="gridcell" aria-label="2019-10-09">9</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1570644000000" role="gridcell" aria-label="2019-10-10">10</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1570730400000" role="gridcell" aria-label="2019-10-11">11</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1570816800000" role="gridcell" aria-label="2019-10-12">12</div></td></tr><tr><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1570903200000" role="gridcell" aria-label="2019-10-13">13</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1570989600000" role="gridcell" aria-label="2019-10-14">14</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1571076000000" role="gridcell" aria-label="2019-10-15">15</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1571162400000" role="gridcell" aria-label="2019-10-16">16</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1571248800000" role="gridcell" aria-label="2019-10-17">17</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1571335200000" role="gridcell" aria-label="2019-10-18">18</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1571421600000" role="gridcell" aria-label="2019-10-19">19</div></td></tr><tr><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1571508000000" role="gridcell" aria-label="2019-10-20">20</div></td><td role="presentation"><div class="picker__day picker__day--infocus picker__day--today picker__day--highlighted" data-pick="1571594400000" role="gridcell" aria-label="2019-10-21" aria-activedescendant="true">21</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1571680800000" role="gridcell" aria-label="2019-10-22">22</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1571767200000" role="gridcell" aria-label="2019-10-23">23</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1571853600000" role="gridcell" aria-label="2019-10-24">24</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1571940000000" role="gridcell" aria-label="2019-10-25">25</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1572026400000" role="gridcell" aria-label="2019-10-26">26</div></td></tr><tr><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1572112800000" role="gridcell" aria-label="2019-10-27">27</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1572199200000" role="gridcell" aria-label="2019-10-28">28</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1572285600000" role="gridcell" aria-label="2019-10-29">29</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1572372000000" role="gridcell" aria-label="2019-10-30">30</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1572458400000" role="gridcell" aria-label="2019-10-31">31</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1572544800000" role="gridcell" aria-label="2019-11-01">1</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1572631200000" role="gridcell" aria-label="2019-11-02">2</div></td></tr><tr><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1572717600000" role="gridcell" aria-label="2019-11-03">3</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1572804000000" role="gridcell" aria-label="2019-11-04">4</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1572890400000" role="gridcell" aria-label="2019-11-05">5</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1572976800000" role="gridcell" aria-label="2019-11-06">6</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1573063200000" role="gridcell" aria-label="2019-11-07">7</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1573149600000" role="gridcell" aria-label="2019-11-08">8</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1573236000000" role="gridcell" aria-label="2019-11-09">9</div></td></tr></tbody></table><div class="picker__footer"><button class="picker__button--today" type="button" data-pick="1571594400000" disabled="" aria-controls="cal-end-date">Today</button><button class="picker__button--clear" type="button" data-clear="1" disabled="" aria-controls="cal-end-date">Clear</button><button class="picker__button--close" type="button" data-close="true" disabled="" aria-controls="cal-end-date">Close</button></div></div></div></div></div></div>
                                            <label for="cal-end-date">End Date</label>
                                        </fieldset>
                                        <fieldset class="form-label-group">
                                            <textarea class="form-control" id="cal-description" rows="5" placeholder="Description"></textarea>
                                            <label for="cal-description">Description</label>
                                        </fieldset>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary cal-add-event waves-effect waves-light" disabled="">
                                            Add Event</button>
                                        <button type="button" class="btn btn-primary d-none cal-submit-event waves-effect waves-light" disabled="">submit</button>
                                        <button type="button" class="btn btn-flat-danger cancel-event waves-effect waves-light" data-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-flat-danger remove-event d-none waves-effect waves-light" data-dismiss="modal">Remove</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- calendar Modal ends-->
                </section>




        
        

@stop
@section('script')
<script src="{{asset('public/js/back/moment.min.js')}}"></script>
<script src="{{asset('public/js/back/fullcalendar.min.js')}}"></script>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/qtip2/3.0.3/basic/jquery.qtip.js"></script>-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>-->
<script>
    $(document).ready(function()
    {
       $('.cal').addClass('active');
    });
    
    
    
    
    $('#calendar').fullCalendar({
        contentHeight: 650,
        weekends: true,
        height: 500,
        editable: false,
//        defaultView: 'month'
        eventClick :false,
        
        header    : {
            left  : 'prev,next today',
            center: 'title',
            right : 'month,agendaWeek,agendaDay,list'
        },
        buttonText: {
            today: 'today',
            month: 'month',
            week : 'week',
            day  : 'day'
        },
        dayClick: function(date, jsEvent, view, resourceObj)
        {
//            alert('Date: ' + date.format());
//            alert('Resource ID: ' + resourceObj.id);
//            getCaldate();
            var d = date.format();
            $('.bookDate').html(d);
            availableSlot(d);
            $('#onshow').modal('show');

            
        },
        events: function(start, end, timezone, callback)
        {
            console.log(start.format());
            console.log(end.format());
//            console.log(timezone);
//            console.log(callback);
            jQuery.ajax({
                url: "{{route('load.event')}}",
                type: 'POST',
                dataType: 'json',
                data: {
                    start: start.format(),
                    end: end.format(),
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(doc) {
                    console.log(doc);
                    var events = [];
                    if(!!doc){
                        $.map( doc, function( r ) {
                            events.push({
                                id: r.id,
                                title: r.title,
                                start: r.start,
                                end: r.end,
                                color: r.color,
                                textColor: 'white'
                            });
                        });
                    }
                    callback(events);
                }
            });
        }
        
//        viewRender: function(view, $element) 
//        {
//            $element.find('.fc-day-number').each(function() {
//              var $this = $(this);
//              var match = (/^(\d+)\-(\d+)\-(\d+)$/).exec($this.attr('data-date'));
//              var date = new Date(+match[22], +match[22], +match[2]);
//
//              $(this).wrapInner('<a href="http://www.example.com/booking.php?booking_date=' + encodeURIComponent(date.toUTCString()) + '" target="_blank"></a>');
//            });
//        }
//        events: [
//          {
//            title  : 'available',
//            start  : '2019-10-22T06:30:00',
//            end    : '2019-10-22T08:00:00',
//            backgroundColor:'#009900'
//          },
//          {
//            title  : 'booked',
//            start  : '2019-10-22T08:00:00',
//            end    : '2019-10-22T09:30:00',
//            color  : '#ff531a'
//          },
//          {
//            title  : 'booked',
//            start  : '2019-10-22T09:30:00',
//            end    : '2019-10-22T11:00:00',
//            color  : '#ff531a'
//          },
//          {
//            title  : 'booked',
//            start  : '2019-10-22T11:00:00',
//            end    : '2019-10-22T12:30:00',
//            color  : '#ff531a'
//          },
//          {
//            title  : 'available',
//            start  : '2019-10-22T12:30:00',
//            end    : '2019-10-22T14:00:00',
//            color  : '#009900'
//          },
//          {
//            title  : 'available',
//            start  : '2019-10-22T14:00:00',
//            end    : '2019-10-22T15:30:00',
//            color  : '#009900'
//          },
//          {
//            title  : 'available',
//            start  : '2019-10-22T15:30:00',
//            end    : '2019-10-22T17:00:00',
//            color  : '#009900'
//          },
//          {
//            title  : 'available',
//            start  : '2019-10-22T17:00:00',
//            end    : '2019-10-22T18:30:00',
//            color  : '#009900'
//          },
//          {
//            title  : 'booked',
//            start  : '2019-10-22T18:30:00',
//            end    : '2019-10-22T20:00:00',
//            color  : '#ff531a'
//          },
//          {
//            title  : 'available',
//            start  : '2019-10-22T20:00:00',
//            end    : '2019-10-22T21:30:00',
//            color  : '#009900'
//          },
//          {
//            title  : 'booked',
//            start  : '2019-10-22T21:30:00',
//            end    : '2019-10-22T23:00:00',
//            color  : '#ff531a'
//          },
//          {
//            title  : 'available',
//            start  : '2019-10-30T23:00:00',
//            end    : '2019-10-30T00:30:00',
//            color  : '#009900'
//          }
//        ]
  
    });
    
//    function getCaldate()
//    {
//        var calendar = $('#calendar').fullCalendar('getCalendar');
//        var view = calendar.view;
//        var start = view.start._d;
//        var end = view.end._d;
//        var dates = { start: start, end: end };
//        console.log( dates);
//    }
//    $('.fc-prev-button').click(function(){
//       getCaldate();
//    });
//
//    $('.fc-next-button').click(function(){
//       getCaldate();
//    });
//    $('.fc-today-button').click(function(){
//       getCaldate();
//    });
    function availableSlot(d)
    {
        $.ajax({
        type: 'POST',
        url: "{{route('cart.slot')}}",
        data: {
         _token: $('meta[name="csrf-token"]').attr('content'),
         date: d
        },
       success: function(data)
       {
//         toastr[data.type](data.message);
          $('.aslot').html(data);
           
       }
    });
    }
</script>
<script>

$(document).on('change', '.cartslot', function()
{
    var slot_id = $(this).data('slot_id');
    var date = $(this).data('date');
    var time = $(this).data('time');
    var price = $(this).data('price');
    var ischecked= $(this).is(':checked');
    if(!ischecked)
    {
        $.ajax({
            type: 'POST',
            url: "{{route('del.cart')}}",
            data: {
             _token: $('meta[name="csrf-token"]').attr('content'),
             slot_id: slot_id,
             date : date,
             time:time,
             price:price
            },
           success: function(data)
           {
               $('.cartTotal').html(data.carttotal);
               $('#cartDeatils').html('');$('#cartDeatils').html(data.cartdeatils);
               Toast.fire({type:data.type,title:data.message,position:'top-center'});
           }
        });
    }else{
        $.ajax({
            type: 'POST',
            url: "{{route('add.cart')}}",
            data: {
             _token: $('meta[name="csrf-token"]').attr('content'),
             slot_id: slot_id,
             date : date,
             time:time,
             price:price
            },
           success: function(data)
           {
               $('.cartTotal').html(data.carttotal);
               $('#cartDeatils').html('');$('#cartDeatils').html(data.cartdeatils);
               Toast.fire({type:data.type,title:data.message,position:'top-center'});
           }
        });
    }

});
$(document).on('click', '.delRow', function()
{
    var rowid = $(this).data('rowid');
    
    console.log(rowid);
    $.ajax({
            type: 'POST',
            url: "{{route('del.cartrow')}}",
            data: {
             _token: $('meta[name="csrf-token"]').attr('content'),
             rowid: rowid
            },
           success: function(data)
           {
               $('.cartTotal').html(data.carttotal);
               $('#cartDeatils').html('');$('#cartDeatils').html(data.cartdeatils);
               Toast.fire({type:data.type,title:data.message,position:'top-end'});
               $('.cartDrop').addClass('show');
           }
        });
}); 
</script>
@stop