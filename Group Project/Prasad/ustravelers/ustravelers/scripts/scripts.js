    function on(divid) {
        document.getElementById(divid).style.display = "block";
    }

    function off(divid) {
        document.getElementById(divid).style.display = "none";
    }
    $(document).ready(function() {
        $('#travelhistory').DataTable({
            searching: false,
            paging: false,
            bInfo: false,
            ordering:false
        });
    });
