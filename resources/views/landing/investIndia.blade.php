<style>
.modal-lg{
    max-width:180%  !important;
}

</style>
<div class="modal fade" id="InvestIndia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    data-backdrop="static" aria-hidden="true">
    
    <div class="modal-dialog ">

        <div class="modal-content">
        <a data-dismiss="modal" class="float-right"><i class="fas fa-window-close" style="
    margin-left: 95%;
"></i></a>
          
            <div class="">
                <div class="">
                    <div class="">
                    
                        
                    <div class="table-responsive pt-2">
                   <a href="https://investindiavc.webex.com/mw3300/mywebex/default.do?nomenu=true&siteurl=investindiavc&service=6&rnd=0.6740140009078076&main_url=https%3A%2F%2Finvestindiavc.webex.com%2Fec3300%2Feventcenter%2Fevent%2FeventAction.do%3FtheAction%3Ddetail%26%26%26EMK%3D4832534b00000005dffda1306ea6604eeddf6898f2535d2086110e4d1211eff504387c18d9ac9c36%26siteurl%3Dinvestindiavc%26confViewID%3D207596232912147162%26encryptTicket%3DSDJTSwAAAAWj-noZjFy52kcyq7YuZCJuD-eH1VOcWR2bopwg2wswBw2%26"> <embed src="{{asset('images/InvestIndia.jpg')}}" width="100%" height="600px" /> </a>
                            </div>
             

                        

                       
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')


<script>

    $(document).ready(function () {


        var t = $('#cat3Disq').DataTable({
            "columnDefs": [{
                "searchable": false,
                "orderable": false,
                "targets": 0
            }],
            "order": [
                [0, 'asc']
            ],
            "language": {
                "search": 'Enter any value for <span class="text-danger">LIVE</span> Search <i class="fa fa-search"></i>',
                "searchPlaceholder": "search",
                "paginate": {
                    "previous": '<i class="fa fa-angle-left"></i>',
                    "next": '<i class="fa fa-angle-right"></i>'
                }
            },
        });

        t.on('order.dt search.dt', function () {
            t.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();


    });

</script>
@endpush
